<?php
/**
  * Provides methods that access database and return information needed
  * for FE Faction War.
  * @version 25 August 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 25 August 2009
  *                 23 September 2009 - removed player-related functions
  *                 12 October 2009 - remove faction functions
  *                                 - add spend ingredients function
  */

require_once('db_connect.php');
//require_once('player.class.php');
require_once('town.class.php');
require_once('mission.class.php');
require_once('faction.class.php');

class DatabaseAccess
{

    protected $db_util;

    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }

    /**
      * Fetch all info about a given mission from the db
      *
      * @param $missionid
      * @param $userid player's fb userid
      * @return Mission object
      */
    function get_mission_data($missionid, $userid)
    {
          //make sure $missionid is integer only
        if( !$this->db_util->validate_int($missionid) )
        {
            die('Invalid mission id in get_mission_data('.$missionid.')');
        }

        $query = 'SELECT ' . MISH . '.*, player_reps, mastery FROM ' . MISH
            . ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' . MISH
            . '.missionid AND ' . COUNT . '.itemtype=' . MISSION_MASTERY 
            . ' AND ' . COUNT . '.playerid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.playerid=' . $userid . ' AND ' . MISH_COMPLETION 
            . '.itemid=' . MISH . '.missionid AND ' . MISH_COMPLETION 
            . '.itemtype=' . MISSION . ' WHERE ' . MISH . '.missionid='
            . $missionid;
        //echo $query;

        $result = $this->db_util->execute_query($query);
        //$mish = new Mission;

        while($row=mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $mish = $this->parse_mission($row);
        }

        return $mish;
    }//end get_mission_data()

    /**
      * Gets sector name from database. If specific id not requested,
      * a list of all sector names is returned.
      *
      * @param $sectorid sector id to return. Default = all
      * @return array of sector names
      */
    function get_sector_name($sectorid='0')
    {
        if( !$this->db_util->validate_int($sectorid) )
        {
            die('Invalid sector id in get_sector_name('.$sectorid.')');
        }

        $s;
        $query = 'SELECT id, name FROM ' . SECTOR;

        //echo '<p style="color:#000;">'.$query.'</p>';

        if( $sectorid != 0 )
        {
            $query .= ' WHERE id=' . $sectorid;
        }

        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $s[$row['id']]= $row['name'];
        }

        return $s;
    }

    /**
      * Gets all town info from database. If town id number not supplied,
      * will return a list of all towns and their info.
      *
      * @param $townid id of town to fetch from db. Default = all
      * @return array of town objects
      */
    function get_town_info($townid='0')
    {
        if( !$this->db_util->validate_int($townid) )
        {
            die('Invalid town id in get_town_info('.$townid.')');
        }

        $t;
        $query = 'SELECT * FROM ' . TOWN;

        //echo '<p style="color:#000;">'.$query.'</p>';

        if( $townid != 0 )
        {
            $query .= ' WHERE id=' . $townid;
        }

        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $town = new Town;

            $town->id                 = $row['id'];
            $town->name               = $row['name'];

            $town->town_level         = $row['town_level'];
            $town->sector             = $row['sector'];
            $town->description        = $row['description'];
            $town->image              = $row['image'];
            $town->owned              = $row['owned'];
            $town->ownership_date     = $row['ownership_date'];
            $town->owner_factionid    = $row['owner_factionid'];
            $town->hit_x              = $row['hit_x'];
            $town->hit_y              = $row['hit_y'];
            $town->img_x              = $row['img_x'];
            $town->img_y              = $row['img_y'];

               //get faction score info from other table,
            $query = 'SELECT * FROM ' . FAC_SCORES
                   . ' WHERE townid=' . $town->id
                   . ' ORDER BY factionid';
            $fac_result = $this->db_util->execute_query($query);
            $fac_scores;
            while($f_row = mysql_fetch_array($fac_result, MYSQL_ASSOC))
            {
                //put info into array ordered by faction numbers
                $fac_scores[$f_row['factionid']] = $f_row['score'];
            }
                  //faction values in class - names in alpha order
            $town->chota_score        = $fac_scores[1];
            $town->enforcer_score     = $fac_scores[2];
            $town->lightbearer_score  = $fac_scores[3];
            $town->tech_score         = $fac_scores[4];
            $town->traveler_score     = $fac_scores[5];
            $town->vista_score        = $fac_scores[6];

            $t[$row['id']] = $town;
            //$t[] = $town;
        }

        return $t;
    }


    /**
      * Get all generic missions for a town from the db
      *
      * @param $townid town id to search
      * @return array of Mission objects
      */
    function get_gen_town_missions($townid, $userid)
    {
        if( !$this->db_util->validate_int($townid) )
        {
            die('Invalid town id in get_gen_town_missions('.$townid.')');
        }

        $missions;

        $query = 'SELECT ' . MISH . '.*, player_reps, mastery FROM ' . MISH
            . ' INNER JOIN ' . TOWN_MISH . ' ON ' . TOWN_MISH . '.townid='
            . $townid . ' AND ' . MISH . '.missionid=' . TOWN_MISH 
            . '.missionid'
            . ' LEFT JOIN '. COUNT . ' ON ' . COUNT . '.itemid=' . MISH
            . '.missionid AND ' . COUNT . '.itemtype=' . MISSION_MASTERY
            . ' AND ' . COUNT . '.playerid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.playerid=' . $userid . ' AND ' . MISH_COMPLETION . '.itemid='
            . MISH . '.missionid AND ' . MISH_COMPLETION . '.itemtype='
            . MISSION;
        $result = $this->db_util->execute_query($query);
        //echo $query;

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $missions[] = $this->parse_mission($row);
        }

        return $missions;
    }

    /**
      * Get all owned town missions for a town from db on conditions:
      *     1) town is owned by a faction
      *     2) player is member of that faction
      * Will not return faction-specific missions
      *
      * @param $townid
      * @param $playerfaction faction id number
      * @param $userid player's facebook id number
      * @return array of Mission objects or NULL if none found
      */
    function get_owned_town_missions($townid, $playerfaction, $userid)
    {
        if( !$this->db_util->validate_int($townid) ||
            !$this->db_util->validate_int($playerfaction) )
        {
            die('Invalid data in get_owned_town_missions('.$townid.')');
        }

          //get player's ally factions
        $query = 'SELECT * FROM ' . ALLIES 
            . ' WHERE ' . ALLIES . '.factionid=' . $playerfaction;

        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $allies[] = $row['allyid'];
        }

        $query = 'SELECT ' . MISH
            . '.*, player_reps, mastery, ' . FACTION . '.faction FROM ' . MISH
            . ' INNER JOIN ' . OWNED_TOWN . ' ON ' . MISH . '.missionid='
            . OWNED_TOWN . '.missionid AND ' . OWNED_TOWN . '.townid=' . $townid
            . ' INNER JOIN ' . TOWN . ' ON ' . TOWN . '.id=' . OWNED_TOWN
            . '.townid AND ' . TOWN . '.owned=1 AND (' . TOWN
            . '.owner_factionid=' . $playerfaction;

        foreach($allies as $ally)
        {
              //add selectors for ally factions
            $query .= ' OR ' . TOWN . '.owner_factionid=' . $ally;
        }
        $query .= ') INNER JOIN ' . FACTION
            . ' ON ' . FACTION . '.id=' . TOWN . '.owner_factionid '
            . ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid='
            . MISH . '.missionid AND ' . COUNT . '.itemtype=' . MISSION_MASTERY
            . ' AND ' . COUNT . '.playerid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.playerid=' . $userid . ' AND ' . MISH_COMPLETION . '.itemid='
            . MISH . '.missionid' . ' AND ' . MISH_COMPLETION . '.itemtype='
            . MISSION;

        //echo $query;

        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $mish = $this->parse_mission($row);
            $missions[] = $mish;
        }

        if(isset($missions))
        {
            return $missions;
        }
        else
        {
            return null;
        }
    }

    /**
      * Get faction-specific missions for a town from db on conditions:
      *     1) town is owned by a faction
      *     2) player is member of that faction
      *
      * @param $townid
      * @param $playerfaction
      * @return array of Mission objects or NULL if none found
      */
    function get_faction_missions($townid, $playerfaction, $userid)
    {
        if( !$this->db_util->validate_int($townid) ||
            !$this->db_util->validate_int($playerfaction) )
        {
            die('Invalid data in get_faction_town_missions('.$townid.')');
        }

        $missions;
        $query = 'SELECT ' . MISH . '.*, player_reps, mastery FROM ' . MISH 
            . ' INNER JOIN ' . TOWN . ' ON ' . TOWN . '.id=' . $townid
            . ' AND ' . TOWN . '.owned=1 AND ' . TOWN . '.owner_factionid=' 
            . $playerfaction . ' INNER JOIN ' . FAC_MISH . ' ON ' 
            . FAC_MISH . '.townid=' . $townid . ' AND ' . FAC_MISH 
            . '.missionid=' . MISH . '.missionid AND ' . FAC_MISH 
            . '.factionid=' . $playerfaction . ' LEFT JOIN ' . COUNT 
            . ' ON ' . COUNT . '.itemid=' . MISH . '.missionid AND '
            . COUNT . '.itemtype=' . MISSION_MASTERY . ' AND ' . COUNT 
            . '.playerid=' . $userid . ' LEFT JOIN ' . MISH_COMPLETION 
            . ' ON ' . MISH_COMPLETION . '.playerid=' . $userid . ' AND ' 
            . MISH_COMPLETION . '.itemid=' . MISH . '.missionid' . ' AND ' 
            . MISH_COMPLETION . '.itemtype=' . MISSION;
        //echo $query;

        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $missions[] = $this->parse_mission($row);
        }

        if(isset($missions))
        {
            return $missions;
        }
        else
        {
            return null;
        }
    }
    
    /**
      * Get only crafting missions associated with one or all towns
      *
      * @param townid Id of town whose missions are needed.
      */
    function get_crafting_missions($townid)
    {
        if( !$this->db_util->validate_int($townid) )
        {
            die('Invalid data in get_crafting_missions( townid='.$townid.')');
        }

        $query = 'SELECT ' . MISH . '.* FROM ' . MISH . ', ' . CRAFTING
            . ' WHERE ' . MISH . '.missionid=' . CRAFTING . '.missionid';
            
        if($townid>0)
        {
            $query .= ' AND ' . CRAFTING . '.townid=' . $townid;
        }

        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $recipes[] = $this->parse_mission($row);
        }

        return $recipes;
    }

    /**
      * Get only summons crafting missions associated with one or all towns.
      *
      * @param townid Id of town whose missions are needed.
      */
    function get_summon_crafting_missions($townid)
    {
        if( !$this->db_util->validate_int($townid) )
        {
            die('Invalid data in get_summon_crafting_missions( townid=' 
                         . $townid.')');
        }

        $query = 'SELECT ' . MISH . '.* FROM ' . MISH . ', ' . SUMMON_CRAFTING
            . ' WHERE ' . MISH . '.missionid=' . SUMMON_CRAFTING . '.missionid';

        if($townid>0)
        {
            $query .= ' AND ' . SUMMON_CRAFTING . '.townid=' . $townid;
        }
        //echo '<p style="color:#000;">'.$query.'</p>';
        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $recipes[] = $this->parse_mission($row);
        }

        return $recipes;
    }

    /*
     * Get ingredient or reward items associated with this mission.
     *
     * @param $missionid
     * @param $type 0=ingredients, 1=rewards. Default=ingredients
     * @return array of arrays with keys from table columns
     *         {itemid, name, image, quantity, item_type}
     */
    function get_mission_items($missionid, $type=0)
    {
        $query = 'SELECT ';
        $items = null;
        if($type==0)
        {
            $query .= MISH_INGRED . '.*, '
               . ITEM . '.* '
               . ' FROM ' . MISH_INGRED . ', ' . ITEM
               . ' WHERE ' . MISH_INGRED . '.missionid=' . $missionid
               . ' AND ' . MISH_INGRED . '.itemid=';
        }
        else if($type==1)
        {
            $query .= MISH_REWARD . '.*, '
               . ITEM . '.* '
               . ' FROM ' . MISH_REWARD . ', ' . ITEM
               . ' WHERE ' . MISH_REWARD . '.missionid=' . $missionid
               . ' AND ' . MISH_REWARD . '.itemid=';
        }
        $query .= ITEM . '.id';

        $result = $this->db_util->execute_query($query);
        $items;
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $items[] = $row;
        }

        return $items;
    }

    /**
      * Removes all required ingredients from a player's inventory
      * Player inventory must already have been verified to have enough
      * of each ingredient.
      *
      * @param $missionid
      * @param $userid player's facebook userid
      */
    function spend_mission_items($missionid, $userid)
    {
        $ingredients = $this->get_mission_items($missionid, 0); //0 is ingreds
        if ($ingredients == null)
           return;
        foreach( $ingredients as $ingredient)
        {
            if( $ingredient['item_type'] == SCRAP
                || $ingredient['item_type'] == SUMMON_INGRED
                || $ingredient['item_type'] == SUMMON_ITEM )
            {
                $query = 'UPDATE ' . PLAYER_INV 
                    . ' SET quantity = quantity - '
                    . $ingredient['quantity'] . ' WHERE itemid='
                    . $ingredient['itemid'] . ' AND userid=' . $userid;
                $this->db_util->execute_query($query);
            }
        }
        //return $query;
    }

    /**
      * Gets all info about an item from db
      *
      * @param $itemid item to search
      * @return assoc array of item's info with these keywords:
      *         {id, name, description, use_text, image, attack_bonus,
                     defense_bonus, price, item_type, purchasable, player_reps,
                     mastery, training_type, count_type, completion_one,
                     completion_two, completion_three}
      */
    function get_item_info($itemid, $userid)
    {
        $query = 'SELECT ' . ITEM . '.*, player_reps, mastery, update_time FROM '
            . ITEM
            . ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' . ITEM
            . '.id AND ' . COUNT . '.itemtype=' . ITEM . '.trainingtype AND '
            . COUNT . '.playerid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.itemid=' . ITEM . '.id AND ' . MISH_COMPLETION . '.itemtype='
            . ITEM . '.trainingtype AND ' . MISH_COMPLETION . '.playerid='
            . $userid
            . ' LEFT JOIN ' . ITEM_UPDATE . ' ON ' . ITEM_UPDATE . '.itemid='
            . ITEM . '.id AND ' . ITEM_UPDATE . '.userid=' . $userid
            . ' WHERE ' . ITEM . '.id=' . $itemid;

        $result = $this->db_util->execute_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        //echo $query . '<br />';
        //echo $itemid. '<br />';
        //echo $playerid. '<br />';

        return $row;
    }

    /**
      * Add all items in list to player's inventory
      *
      * @param $userid player's fb user id
      * @param $treasure Assoc array of items to add. Each item must have
               at least 'itemid' and 'quantity' field.
      * @return
      */
    function give_item_list($userid, $treasure)
    {
        if( !$this->db_util->validate_int($userid) )
        {
            die('Invalid data in give_item_list( userid='
                         . $userid.')');
        }
          //check for existence of first value in treasure
        if( !is_array($treasure) || count($treasure) < 1 )
        {
              //no first item found, so quit
            return 'Error: Invalid treasure list in give_item_list';
        }

        foreach($treasure as $item)
        {
            $query = 'INSERT INTO ' . PLAYER_INV 
                . '(userid, itemid, quantity) VALUES (' . $userid . ', '
                . $item['itemid'] . ', ' . $item['quantity']
                . ') ON DUPLICATE KEY UPDATE quantity=quantity+' 
                . $item['quantity'];
            $this->db_util->execute_query($query);
        }
    }

    /**
      * Confirms player has enough cash for purchase, then
      * adds item to player inventory, lowers player chips
      * by proper amount.
      *
      * @param $itemid
      * @param $userid player's fb user id
      * @param $quantity number of items to buy. Default=1
      *
      * @return returns array of results info:
      *                 {total_cost, new_quant}
      *                    or -1 if transaction rejected
      */
    function buy_item($itemid, $userid, $quantity=1)
    {
          //get prices, player current cash
        $query = 'SELECT ' . ITEM . '.*, chips, mastery, '
            . PLAYER_INV . '.quantity FROM ' . ITEM . ' JOIN ' . PLAYER_STATS
            . ' ON ' . ITEM . '.id=' . $itemid
            . ' AND ' . PLAYER_STATS . '.userid=' . $userid
            . ' LEFT JOIN ' . PLAYER_INV . ' ON ' . PLAYER_INV . '.itemid='
            . $itemid . ' AND ' . PLAYER_INV . '.userid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.playerid=' . PLAYER_STATS . '.userid AND ' . MISH_COMPLETION
            . '.itemid=' . ITEM . '.id AND ' . MISH_COMPLETION . '.itemtype='
            . ITEM . '.trainingtype';

        $result = $this->db_util->execute_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        $inventory = $row['quantity'];

          //determine the current sale price for the item based on upgrades
        $price = 0;
        switch($row['mastery'])
        {
            case null:
            case 0:
                 $price = $row['price_one'];
                 break;
            case 1:
                 $price = $row['price_two'];
                 break;
            case 2:
                 $price = $row['price_three'];
                 break;
            default:
                 //error -- should be one of the other three
                 $price = $row['price_one'];
                 break;
        }
          //does the player have enough money?
        $total = $price * $quantity;

        if( $total > $row['chips'])
        {
              //cash fail, deal with it
            return -1;
        }
        else
        {
            /*replacement for current code/queries
              //not set up for return values needed
            $this->give_item($itemid, $userid, $quantity);

            $query = 'UPDATE ' . PLAYER_STATS . ' SET chips=chips-' . $total
                . ' WHERE userid=' . $userid;
            $this->db_util->execute_query($query);
            */

              //find out if player has one already
            if($inventory != null)
            {
                   //modify existing entry
                $query = 'UPDATE '
                       . PLAYER_INV . ', '
                       . PLAYER_STATS
                       . ' SET quantity=quantity+'
                       . $quantity . ', '
                       . 'chips=chips-' . $total
                       . ' WHERE '
                       . PLAYER_INV . '.userid=' . $userid
                       . ' AND '
                       . PLAYER_INV .'.itemid=' . $itemid
                       . ' AND '
                       . PLAYER_STATS . '.userid=' . $userid;
                $inventory += $quantity;
            }
            else
            {
                   //subtract chips
                 $query = 'UPDATE ' . PLAYER_STATS
                    . ' SET chips=chips-' . $total
                    . ' WHERE '
                    . PLAYER_STATS . '.userid=' . $userid;
                 $this->db_util->execute_query($query);

                   //give item query
                 $query = 'INSERT INTO ' . PLAYER_INV
                    . '(itemid, userid, quantity) VALUES ('
                    . $itemid . ', '
                    . $userid . ', '
                    . $quantity . ')';
                 $inventory = $quantity;
            }

            $this->db_util->execute_query($query);
            $r = array('total_cost' => $total,
                       'new_quant'  => $inventory);
            return $r;
        }
    }

    /**
      * Handle complete sale transaction:
      *        verify player has enough in inventory
      *        deduct sold items
      *        give player cash
      *
      * @param $itemid item to sell
      * @param $userid player's fb user id
      * @param $quantity number of items to sell
      * @return returns array:
                        {total_cost, new_quant}
      *                 or -1 if sale not completed
      */
    function sell_item($itemid, $userid, $quantity=1)
    {
          //first make sure player has the item to sell
        $query ='SELECT ' . ITEM .'.*, quantity, mastery FROM ' . ITEM . ' JOIN '
            . PLAYER_INV . ' ON ' . ITEM . '.id=' . PLAYER_INV . '.itemid AND '
            . PLAYER_INV . '.userid=' . $userid . ' LEFT JOIN '
            . MISH_COMPLETION . ' ON ' . MISH_COMPLETION . '.playerid=' . $userid
            . ' AND ' . MISH_COMPLETION . '.itemid=' . ITEM . '.id'
            . ' AND ' . MISH_COMPLETION . '.itemtype=' . ITEM . '.trainingtype '
            . ' WHERE ' . ITEM . '.id=' . $itemid;
        $result = $this->db_util->execute_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);

        $inventory = $row['quantity'];

          //make sure the player has enough to sell
        if( $quantity > $inventory )
        {
            return -1;
        }
        else
        {
            //determine the correct sale price
            switch($row['mastery'])
            {
                case null:
                case 0:
                     $price = $row['price_one'];
                     break;
                case 1:
                     $price = $row['price_two'];
                     break;
                case 2:
                     $price = $row['price_three'];
                     break;
                default:
                     //error -- should be one of the other three
                     $price = $row['price_one'];
                     break;
            }
              //assume 25% resale, rounded up
            $total = ceil($price * SALE_PRICE_MULT) * $quantity;

            //deduct item from inventory
            //and fatten wallet
            $inventory -= $quantity;

            $query = 'UPDATE ' . PLAYER_INV . ', ' . PLAYER_STATS
                . ' SET quantity=quantity-' . $quantity . ', '
                . 'chips=chips+' . $total
                . ' WHERE ' . PLAYER_INV . '.userid=' . $userid
                . ' AND ' . PLAYER_INV . '.itemid=' . $itemid
                . ' AND ' . PLAYER_STATS . '.userid=' . $userid;
            $this->db_util->execute_query($query);
        }
        $r = array('total_cost'       => $total,
                   'new_quant'    => $inventory );
        return $r;
    }
    
    /**
      * Removes specified item from player's inventory in quantity given
      *
      * @param itemid
      * @param userid player's fb userid
      * @param quantity default value = 1
      */
    function remove_item($itemid, $userid, $quantity=1)
    {
        $query = 'UPDATE ' . PLAYER_INV . ' SET quantity=quantity-' . $quantity
           . ' WHERE itemid=' . $itemid . ' AND userid=' . $userid;
        $this->db_util->execute_query($query);
    }

    /**
      * Gives specified item to player in quantity specified
      *
      * @param itemid
      * @param userid player's fb userid
      * @param quantity default value = 1
      */
    function give_item($itemid, $userid, $quantity=1)
    {
        $query = 'INSERT INTO ' . PLAYER_INV
            . ' (userid, itemid, quantity) VALUES (' . $userid . ', ' . $itemid
            . ', ' . $quantity . ') ON DUPLICATE KEY UPDATE quantity=quantity+'
            . $quantity;
        $this->db_util->execute_query($query);
    }

    /**
      * Query db for items associated with a given town.
      * If userid specified, will include quantity of these items
      * currently owned by the player. If not, returns all records for town
      * without user quantity
      *
      * @param $townid town to search
      * $param $userid fb user id for player
      * @param $type item type to search for. Default=all
      * @return assoc array of items:
      *   {id, name, description, use_text, image,
      *        attack_bonus, defense_bonus, price, item_type, quantity}
     */
    function get_town_items($townid, $userid='0', $type='0')
    {
        if($userid != 0)
        {
            //inner join- used to select from first two tables
            //left join- gives precedence to first results, if nothing found
            //in player_inv, that line is still returned
            $query = 'SELECT ' . ITEM . '.*, ' . PLAYER_INV . '.quantity,'
                   . ' player_reps, mastery'
                   . ' FROM (' . TOWN_ITEM . ' INNER JOIN '
                   . ITEM . ' ON ' . ITEM . '.id=' . TOWN_ITEM
                   . '.itemid' . ' AND ' . TOWN_ITEM . '.townid=' . $townid;
             if ($type != '0')
             {
                 $query .= ' AND ' . ITEM . '.item_type=' . $type;
             }

             $query .= ')';
             $query .= ' LEFT JOIN ' . PLAYER_INV . ' ON ' . PLAYER_INV
                 . '.itemid=' . TOWN_ITEM . '.itemid AND ' . PLAYER_INV
                 . '.userid=' . $userid;
             $query .= ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' 
                 . ITEM . '.id AND ' . COUNT . '.itemtype='
                 . ITEM . '.trainingtype AND ' . COUNT . '.playerid=' . $userid;
             $query .= ' LEFT JOIN ' . MISH_COMPLETION . ' ON '
                 . MISH_COMPLETION . '.playerid=' . $userid . ' AND '
                 . MISH_COMPLETION . '.itemid=' . ITEM . '.id AND '
                 . MISH_COMPLETION . '.itemtype=' . ITEM . '.trainingtype';
        }
        else
        {
            $query = 'SELECT ' . ITEM . '.* ' . ' FROM ' . TOWN_ITEM . ', '
                 . ITEM . ' WHERE ' . ITEM . '.id=' . TOWN_ITEM . '.itemid'
                 . ' AND ' . TOWN_ITEM . '.townid=' . $townid;
            if ($type != '0')
            {
                $query .= ' AND ' . ITEM . '.item_type=' . $type;
            }
        }
        
        $query .= ' ORDER BY ' . ITEM . '.item_type';

        $result = $this->db_util->execute_query($query);
        $items;

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $quantity = 0;
            if($row['quantity'] != null)
            {
                $quantity = $row['quantity'];
            }
            $items[] = $row;
        }

        return $items;
    }

    /**
      * Helper method to convert database row into mission object
      *
      * @param $row Database row to parse
      * @return Mission object with mission info from $row
      */
    function parse_mission($row)
    {
        $mish = new Mission;

        $mish->id            = $row['missionid'];
        $mish->title         = $row['title'];
        $mish->description   = $row['description'];
        $mish->result_text   = $row['result_text'];
        $mish->image         = $row['image'];
        $mish->chips_max     = $row['chips_max'];
        $mish->chips_min     = $row['chips_min'];
        $mish->xp_max        = $row['xp_max'];
        $mish->xp_min        = $row['xp_min'];
        $mish->energy_drain  = $row['energy_drain'];
        
        if(isset($row['chance']))
        {
            $mish->chance    = $row['chance'];
        }

        $mish->ingredients    = $this->get_mission_items($mish->id);
        $mish->treasure_table = $this->get_mission_items($mish->id, 1);

        $mish->completion_one   = $row['completion_one'];
        $mish->completion_two   = $row['completion_two'];
        $mish->completion_three = $row['completion_three'];

          //mastery and player_reps based on player activity - they may
          //not always have a value
        if(isset($row['mastery']))
        {
            $mish->player_mastery  = $row['mastery'];
        }
        else
        {
            $mish->player_mastery = 0;
        }

        if(isset($row['player_reps']))
        {
            $mish->player_progress = $row['player_reps'];
        }
        else
        {
            $mish->player_progress = 0;
        }

        return $mish;
    }
}
?>