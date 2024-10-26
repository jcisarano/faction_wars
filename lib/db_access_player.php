<?php
 /**
   * Database access items related to player data
   *
   * @version 21 September 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   * @history
   *         created 21 September 2009
   *         add one-time gift functions 2 March 2010
   */

 require_once 'config.php';

 if($facebook_config['debug']==1)
 {
     ini_set('display_errors', true);
     ini_set('log_errors', true);
 }
 else
 {
     ini_set('display_errors', false);
     ini_set('log_errors', false);
 }

 require_once('db_connect.php');
 require_once('player.class.php');

 class PlayerDatabase
 {


     protected $db_util;

     public function __construct()
     {
         $this->db_util = new DatabaseUtilities;
     }


     /**
       * Attempts to create new user entry in player statistics database.
       * Entry will have default info that player will fill in later on
       * choosing a faction.
       *
       * If name and faction given, this function will attempt to update
       * an existing player's entry in playerstats with the new data
       *
       * @param $userid player's facebook userid
       */
     function create_new_user($userid, $name='', $factionid='')
     {
         if($name != '')
         {
             $name = $this->db_util->real_escape($name);
         }

         include_once('db_access_faction.php');
         if($factionid != '')
         {
               //get faction info on starting gamma, etc
             $fac_db = new FactionDatabase;
             $fac = $fac_db->get_faction_info($factionid);
         }

         $query = 'INSERT INTO ' . PLAYER_STATS
                . '(userid, current_gamma, total_gamma,
                            current_stamina, total_stamina,
                            current_health, total_health) VALUES ('
                . $userid . ', '
                . GAMMA_START   . ', ' . GAMMA_START   . ', '
                . STAMINA_START . ', ' . STAMINA_START . ', '
                . HEALTH_START  . ', ' . HEALTH_START
                . ') ON DUPLICATE KEY UPDATE'
                . ' name="' . $name
                . '", factionid="' . $factionid
                . '", datein=' . time()
                . ', xp_bonus="' . $fac[$factionid]->xp_bonus
                . '", gamma_update_rate="' . $fac[$factionid]->gamma_update_rate
                . '", stam_update_rate="' . $fac[$factionid]->stam_update_rate
                . '", health_update_rate="' . $fac[$factionid]->health_update_rate
                . '", chips_bonus="' . $fac[$factionid]->chips_bonus
                . '", factionid="' . $factionid
                . '", attack="' . $fac[$factionid]->start_attack
                . '", adj_attack="' . $fac[$factionid]->start_attack
                . '", defense="' . $fac[$factionid]->start_defense
                . '", adj_defense="' . $fac[$factionid]->start_defense . '"';

         //echo '<span style="color:red;">'.$query.'</span>';

         $this->db_util->execute_query($query);
     }

     /**
      * Draws all player data from player stats database
      *
      * @param $userid fb user id
      * @return player data as Player object
      */
    function get_player_data($userid)
    {
        if( !$this->db_util->validate_int($userid) )
        {
            die('Invalid user id in get_player_data('.$userid.')');
        }

        $query = 'SELECT ' . PLAYER_STATS . '.*, faction FROM ' . PLAYER_STATS
            . ' LEFT JOIN ' . FACTION . ' ON ' . FACTION . '.id='
            . PLAYER_STATS . '.factionid WHERE ' . PLAYER_STATS . '.userid=' 
            . $userid;

        //echo '<p style="color:#000;">'.$query.'</p>';

        $result = $this->db_util->execute_query($query);
        $player = new Player;

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $player = new Player;

            $player->userid             =$userid;
            $player->level              =$row['player_level'];
            $player->current_xp         =$row['current_xp'];
            $player->xp_to_level        =$row['needed_xp'];
            $player->achieve_points     =$row['achieve_points'];
            $player->ap_spent           =$row['ap_spent'];
            $player->faction_points     =$row['faction_points'];

            $player->current_gamma      =$row['current_gamma'];
            $player->max_gamma          =$row['total_gamma'];
            $player->gamma_update_time  =$row['gamma_update_time'];
            $player->current_stamina    =$row['current_stamina'];
            $player->max_stamina        =$row['total_stamina'];
            $player->stam_update_time   =$row['stam_update_time'];
            
            $player->current_health     =$row['current_health'];
            $player->max_health         =$row['total_health'];
            $player->health_update_time =$row['health_update_time'];
            $player->chips              =$row['chips'];
            $player->name               =$row['name'];

            $player->faction            =$row['factionid'];
            $player->faction_name       =$row['faction'];
            $player->army_size          =$row['army_size'];
            $player->fights_won         =$row['fights_won'];
            $player->fights_lost        =$row['fights_lost'];
            $player->attack             =$row['attack'];
            $player->adj_attack         =$row['adj_attack'];
            $player->defense            =$row['defense'];
            $player->adj_defense        =$row['adj_defense'];
            $player->deaths             =$row['deaths'];
            $player->kills              =$row['kills'];
            
            $player->datein             =$row['datein'];
            $player->dateout            =$row['dateout'];
            $player->xp_bonus           =$row['xp_bonus'];
            $player->gamma_update_rate  =$row['gamma_update_rate'];
            $player->stam_update_rate   =$row['stam_update_rate'];
            $player->health_update_rate =$row['health_update_rate'];
            $player->chips_bonus        =$row['chips_bonus'];
        }

        if( $player->auto_update_stats() )
        {
            $this->update_player_db($player);
        }

        return $player; 
    }//end get_player_data()
    
    /**
      * Updates database entry for that player to current values.
      */
    function update_player_db( $player )
    {
        $active = 1;

        $query = 'UPDATE ' . PLAYER_STATS . ' SET '
           . 'player_level="'       . $player->level              . '", '
           . 'lastseen="'           . time()                      . '", '
           . 'isActive="'           . $active                     . '", '

           . 'current_xp="'         . $player->current_xp         . '", '
           . 'needed_xp="'          . $player->xp_to_level        . '", '
           . 'xp_bonus="'           . $player->xp_bonus           . '", '
           . 'achieve_points="'     . $player->achieve_points     . '", '
           . 'ap_spent="'           . $player->ap_spent           . '", '
           . 'faction_points="'     . $player->faction_points    . '", '

           . 'current_gamma="'      . $player->current_gamma      . '", '
           . 'total_gamma="'        . $player->max_gamma          . '", '
           . 'gamma_update_time="'  . $player->gamma_update_time  . '", '
           . 'gamma_update_rate="'  . $player->gamma_update_rate  . '", '

           . 'current_stamina="'    . $player->current_stamina    . '", '
           . 'total_stamina="'      . $player->max_stamina        . '", '
           . 'stam_update_time="'   . $player->stam_update_time   . '", '
           . 'stam_update_rate="'   . $player->stam_update_rate   . '", '

           . 'current_health="'     . $player->current_health     . '", '
           . 'total_health="'       . $player->max_health         . '", '
           . 'health_update_rate="' . $player->health_update_rate . '", '
           . 'health_update_time="' . $player->health_update_time . '", '

           . 'chips="'              . $player->chips              . '", '
           . 'chips_bonus="'        . $player->chips_bonus        . '", '

           . 'name="'               . $player->name               . '", '
           . 'factionid="'          . $player->faction            . '", '
           . 'army_size="'          . $player->army_size          . '", '
           . 'fights_won="'         . $player->fights_won         . '", '
           . 'fights_lost="'        . $player->fights_lost        . '", '
           . 'attack="'             . $player->attack             . '", '
           . 'adj_attack="'         . $player->adj_attack         . '", '
           . 'deaths="'             . $player->deaths             . '", '
           . 'kills="'              . $player->kills              . '", '
           . 'defense="'            . $player->defense            . '", '
           . 'adj_defense="'        . $player->adj_defense        . '" '
           . 'WHERE userid='        . $player->userid;

        $result = $this->db_util->execute_query($query);

        //verify that exactly one row returned in the result set?
        //& return true/false based on that?
    }

    /**
      * Get player's inventory from db
      *
      * @param $userid fb user id for player
      * @return complete player inventory as array:
      *   {id, name, description, use_text, image,
      *        attack_bonus, defense_bonus, price, item_type}
      *    Returns null if player has no inventory yet
      */
    function get_player_inventory($userid)
    {
        $inventory = null;
        $query = 'SELECT quantity, ' . ITEM
            . '.*, player_reps, mastery, update_time FROM ' . PLAYER_INV
            . ' JOIN ' . ITEM . ' ON ' . PLAYER_INV . '.itemid=' . ITEM . '.id '
            . ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' . ITEM
            . '.id AND ' . COUNT . '.itemtype=' . ITEM . '.item_type AND '
            . COUNT . '.playerid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.itemid=' . ITEM . '.id AND ' . MISH_COMPLETION . '.itemtype='
            . ITEM . '.trainingtype AND ' . MISH_COMPLETION . '.playerid='
            . $userid
            . ' LEFT JOIN ' . ITEM_UPDATE . ' ON ' . ITEM_UPDATE . '.itemid='
            . ITEM . '.id AND ' . ITEM_UPDATE . '.userid=' . $userid
            . ' WHERE ' . PLAYER_INV . '.userid=' . $userid
            . ' AND ' . PLAYER_INV . '.quantity>0';

        $result = $this->db_util->execute_query($query);
        $inventory;

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $inventory[] = $row;
        }
        //echo '<span style="color:red;">'.$query.'</span>';
        return $inventory;
    }
    
    /**
      * Checks the player's inventory against the mission requirements
      *
      * @param $userid fb user id
      * @param $missionid missionid from fw_mission
      */
    function verify_player_inventory($userid, $missionid)
    {
          //look for matches - items in player inventory and
          //mish ingredients, make sure player has sufficient quantity
        $query = 'SELECT COUNT(' . MISH_INGRED . '.id) FROM '
               . MISH_INGRED . ', ' . PLAYER_INV
               . ' WHERE ' . PLAYER_INV
                         . '.itemid=' . MISH_INGRED . '.itemid'
               . ' AND ' . PLAYER_INV . '.userid=' . $userid
               . ' AND ' . PLAYER_INV . '.quantity >= '
                         . MISH_INGRED . '.quantity'
               . ' AND ' . MISH_INGRED . '.missionid=' . $missionid;


        $result = $this->db_util->execute_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        $p_count = $row['COUNT(' . MISH_INGRED . '.id)'];

          //find number of ingredients
        $query = 'SELECT COUNT(id) FROM '
               . MISH_INGRED . ' WHERE missionid=' . $missionid;

        $result = $this->db_util->execute_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        $m_count = $row['COUNT(id)'];

          //if num matches == num ingredients, return true
        return $p_count == $m_count;
    }
    
    /**
      * Determines if given item is present in player's inventory in
      * given quantity. Default quantity is one.
      *
      * @param $playerid player's facebook userid
      * @param $itemid id of item to check
      * @param $quantity how many of that item should the player have.
      *                  default = 1
      * @return quantity of this item in player's inventory
      */
    function player_has_item($playerid, $itemid, $quantity=1)
    {
        $query = 'SELECT quantity FROM ' . PLAYER_INV . ' WHERE userid='
            . $playerid . ' AND itemid=' . $itemid;
        $result = $this->db_util->execute_query($query);

        if($result)
        {
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            $quantity = $row['quantity'];
        }
        else
        {
            $quantity = 0;
        }
        return $quantity;
    }
    
    /**
      * Retrieve info on unclaimed gifts between two players.
      *
      * @param $senderid sender's facebook id
      * @param $recipientid recipient's facebook id
      * @param $claimed if 0 return only unclaimed items
      *                 if 1 return only claimed items
      *                 default is 0
      * @param $type currently unused
      *
      * @return array of info with these keys:
      *         'newest' - time of most recent gift
      *         'oldest' - time of oldest gift
      *         'count'  - number of unclaimed gifts
      *
      *         if no unclaimed gifts found, returns -1
      */
    function get_free_gift_info($senderid, $recipientid, $claimed='0',
                                           $type='')
    {
        $query = 'SELECT MAX(datesent), MIN(datesent), COUNT(datesent) FROM '
               . FREE_GIFT
               . ' WHERE senderid=' . $senderid
               . ' AND recipientid=' . $recipientid
               . ' AND isClaimed=' . $claimed;
        $result = $this->db_util->execute_query($query);
        if($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $info['newest'] = $row['MAX(datesent)'];
            $info['oldest'] = $row['MIN(datesent)'];
            $info['count'] = $row['COUNT(datesent)'];
        }
        //echo '<span style="color:red;">'.$query.'</span>';
        if($info)
        {
            return $info;
        }
        else
        {
            return -1;
        }
    }
    
    /**
      * Similar to get_free_gift_info except that it returns an array of 
      *         gift info from all senders to this recipient.
      *
      * @param $recipientid recipient's facebook id
      * @param $isClaimed if 0 return only unclaimed items
      *                 if 1 return only claimed items
      *                 default is 0
      * @param $type currently unused
      *
      * @return 2D array of info with these keys:
      *         'senderid' - senders fb id
      *         'newest'   - time of most recent gift
      *         'oldest'   - time of oldest gift
      *         'count'    - number of unclaimed gifts
      *
      *         if no unclaimed gifts found, returns -1
      *
      */
    function get_gift_list($recipientid, $isClaimed='0', $type='')
    {
        $query = 'SELECT senderid, COUNT(datesent), MAX(datesent),
                         MIN(datesent) FROM ' . FREE_GIFT 
                  . ' WHERE recipientid=' . $recipientid 
                  . ' AND isClaimed=' . $isClaimed
                  . ' GROUP BY senderid';
        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $temp['senderid'] = $row['senderid'];
            $temp['newest']   = $row['MAX(datesent)'];
            $temp['oldest']   = $row['MIN(datesent)'];
            $temp['count']    = $row['COUNT(datesent)'];
            
            $info[] = $temp;
        }
        //echo '<span style="color:red;">'.$query.'</span><br/>';
        if(isset($info))
        {
            return $info;
        }
        else
        {
            return -1;
        }
    }
    
    /**
      * Sends one free gift between two players and sets current time 
      *       as send time.
      *
      * @param $senderid sender's facebook id
      * @param $recipientid recipient's facebook id
      * @param $type currently unused
      */
    function send_free_gift($senderid, $recipientid, $type='')
    {
        $query = 'INSERT INTO ' . FREE_GIFT
               . '(senderid, recipientid, datesent) VALUES'
               . ' (' . $senderid . ', '. $recipientid . ', '. time(). ')';
        $this->db_util->execute_query($query);
    }

    /**
      * Set gift between two players as claimed.
      *
      * @param $senderid sender's facebook id
      * @param $recipientid recipient's facebook id
      * @param $datesent timecode of the gift
      */
    function set_free_gift_claimed($senderid, $recipientid, $datesent, $type='')
    {
        $query = 'UPDATE ' . FREE_GIFT . ' SET isClaimed=1'
            . ' WHERE senderid=' . $senderid
            . ' AND recipientid=' . $recipientid
            . ' AND datesent=' . $datesent;
		//echo '<span style="color:red;">'.$query.'</span><br/>';
        $this->db_util->execute_query($query);
		return $query;
    }

    
    /**
      * Compares passed-in list and adds new friends to database.
      *
      * @param $playerid player's facebook id
      * @param $friends_list Array of facebook user ids
      **/
    function update_player_friends($playerid, $friends_list)
    {
          //make sure at least one value was passed in
        if( is_array($friends_list) )
        {
            foreach( $friends_list as $friendid )
            {
                $query = 'INSERT INTO ' . FRIENDS
                    . ' SELECT ' . $playerid .', ' . $friendid . ' FROM DUAL
                        WHERE NOT EXISTS(
                              SELECT playerid FROM ' . FRIENDS
                                  . ' WHERE playerid=' . $playerid
                                  . ' AND friendid=' . $friendid . ' LIMIT 1
                        )';
                $result = $this->db_util->execute_query($query);
            }
        }
    }
    
    /**
      * Get list of summon missions along with their respective item.
      *
      * @param $playerid
      * @param $townid
      *
      * @return Array of arrays with these keywords:
      *         Mission data: missionid, title, description, result_text, image
      *         Item data: name, item_description, use_text, item_image
      *                    player_inv
      */
    function get_summon_items($playerid, $townid='0')
    {
        $query = 'SELECT ' . MISH . '.*, ' . ITEM . '.name, ' . ITEM
                 . '.description AS item_description, ' . ITEM . '.use_text, '
                 . ITEM . '.image AS item_image, ' . PLAYER_INV 
                 . '.quantity AS player_inv '
                 . ' FROM ' . MISH_INGRED
                 . ' LEFT JOIN ' . PLAYER_INV 
                 . ' ON ' . PLAYER_INV . '.itemid=' . MISH_INGRED . '.itemid '
                 . ' AND ' . PLAYER_INV . '.userid=' . $playerid
                 . ' JOIN ' . ITEM . ' ON ' . ITEM . '.id=' 
                                   . MISH_INGRED . '.itemid'
                 . ' JOIN ' . SUMMON_MISH
                 . ' ON ' . SUMMON_MISH . '.missionid=' . MISH_INGRED
                                                            . '.missionid'
                 . ' JOIN ' . MISH . ' ON ' . MISH . '.missionid=' 
                                   . SUMMON_MISH . '.missionid';
        if($townid>0)
        {
            $query .= ' WHERE ' . SUMMON_MISH . '.townid=' . $townid;
        }

        //echo '<span style="color:red;">'.$query.'</span>';
        
        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $items[] = $row;
        }

        return $items;
    }
    
    /**
      * Get list of player's friends
      *
      * @param $playerid Player's fb id
      * @return list of facebook ids
      */
    function get_friends($playerid)
    {
        $query = 'SELECT friendid FROM ' . FRIENDS 
            . ' WHERE playerid=' . $playerid;
        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $friends[] = $row['friendid'];
        }

        return (isset($friends) ? $friends : null);
    }
    
    /**
      * Sets the user as inactive. All database entries are maintained.
      *
      * @param $userid player's facebook userid
      */
    function set_user_departed($userid)
    {
        $query = 'UPDATE ' . PLAYER_STATS . ' SET isActive=0, dateout=' . time()
               . ' WHERE userid=' . $userid;
        $this->db_util->execute_query($query);
    }
 }
?>