<?php

    /**
      * Provides pvp-specific tools for db access
      *
      * @version 15 August 2009
      * @author Jason Cisarano jcisarano@icarusstudios.com
      *
      * @history
      *         created 15 August 2009
      */

    require_once('config.php');
    require_once('db_connect.php');
    require_once('player.class.php');
    require_once('faction.class.php');

    class PvpDatabase
    {

        protected $db_util;

        public function __construct()
        {
            $this->db_util = new DatabaseUtilities;
        }

        /**
          * Gets list of pvp opponents for the current player. Opponents returned
          * will be within the range of min_level and max_level. Opponents
          * are not currenty filtered by faction or any stat other than level.
          *
          * @param $userid player's facebook user id
          * @param $min_level
          * @param $max_level
          * @return array of player objects for opponents
          */
        function get_opponent_list($userid, $min_level, $max_level)
        {
            $opponents = null; //will be array of any opponents found
            $faction   = '';

            $fifteen_min = 15 * 60; //fifteen min in seconds
            $query = 'SELECT ' . PLAYER_STATS . '.*, ' . FACTION . '.faction'
                   . ' FROM ' . PLAYER_STATS . ', ' . FACTION
                   . ' WHERE player_level >=' . $min_level
                   . ' AND player_level <=' . $max_level
                   . ' AND ' . PLAYER_STATS . '.factionid=' . FACTION . '.id'
                   . ' AND ' . PLAYER_STATS . '.userid != ' . $userid
                   . ' AND ' . PLAYER_STATS . '.current_health >=' . MIN_HEALTH
                   //. ' AND ' . PLAYER_STATS . '.lastseen >='
                     //        . time() - $fifteen_min
                   . ' ORDER BY RAND() LIMIT 0, 20';

            $result = $this->db_util->execute_query($query);
            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
                $player = new Player;

                $player->userid             =$row['userid'];
                $player->level              =$row['player_level'];
                $player->current_xp         =$row['current_xp'];
                $player->xp_to_level        =$row['needed_xp'];
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
                $player->army_size          =$row['army_size'];
                $player->fights_won         =$row['fights_won'];
                $player->fights_lost        =$row['fights_lost'];
                $player->attack             =$row['attack'];
                $player->adj_attack         =$row['adj_attack'];
                $player->defense            =$row['defense'];
                $player->adj_defense        =$row['adj_defense'];

                $faction                    =$row['faction'];


                  //update to make sure their health, etc is current?
                //if( $player->auto_update_stats() )
                //{
                  //  $this->db_acc->update_player_db($player);
                //}


                $opponents[] = array( 'opponent' => $player,
                                      'faction'  => $faction );
            }

            return $opponents;
        }

        /**
          * Query db for items in player's inventory according to type.
          * Items are returned in descending order of attack or defense
          * stats.
          *
          * @param $userid player's fb user id
          * @param $type item type:
          *        2: weapon, 3: armor, 4: skill, 5: mutation
          *        Default is weapon
          * @param $orderby Order by attack or defense numbers.
          *        0: attack, 1: defense
          *        Default is attack
          * @return array of assoc arrays with these keywords:
          *         {quantity, player_reps, mastery} in addition to all
          *         column headings from fw_item
          */
        function get_items_by_type($userid, $type='2', $orderby='0')
        {
            $items = null;
            $query = 'SELECT ' . PLAYER_INV . '.quantity, player_reps, mastery, '
                       . ITEM . '.* FROM ' . PLAYER_INV
                   . ' JOIN ' . ITEM . ' ON '. PLAYER_INV . '.itemid=' . ITEM 
                       . '.id '
                   . ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' . ITEM
                       . '.id AND ' . COUNT . '.itemtype=' . ITEM . '.item_type 
                         AND ' . COUNT . '.playerid=' . $userid
                   . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
                       . '.itemid=' . ITEM . '.id AND ' . MISH_COMPLETION 
                       . '.itemtype=' . ITEM . '.trainingtype AND ' 
                       . MISH_COMPLETION . '.playerid=' . $userid
                   . ' WHERE userid=' . $userid . ' AND ' . ITEM 
                       . '.item_type=' . $type;

            if($orderby=='0')
            {
                $query .= ' ORDER BY ' . ITEM . '.attack_bonus_one DESC';
            }
            else if($orderby=='1')
            {
                $query .= ' ORDER BY ' . ITEM . '.defense_bonus_one DESC';
            }

            $result = $this->db_util->execute_query($query);
            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
                $items[] = $row;
            }
            return $items;
        }
        
        /**
          * PvP reward values are modified according to what faction 
          * a player chooses to fight. This function takes two userids
          * and returns a multiplier for PvP rewards.
          *
          * @param $fac1 Attacking player's faction id number
          * @param $fac2 Defender's faction id number
          * @return Decimal multiplier
          */
        function get_faction_multiplier($fac1, $fac2)
        {
            if( $fac1 == $fac2 )
            {
                return OWN_FAC_MULT;
            }
            $query = 'SELECT enemyid FROM ' 
                   . FACTION . ' WHERE id=' . $fac1;

            $result = $this->db_util->execute_query($query);
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            $archenemy = $row['enemyid'];
            if( $fac2 == $archenemy )
            {
                return ARCHENEMY_MULT;
            }
            
            $query = 'SELECT allyid FROM ' . ALLIES
                   . ' WHERE factionid=' . $fac1;
            $result = $this->db_util->execute_query($query);
            while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
                if($fac2 == $row['allyid'])
                {
                    return ALLY_MULT;
                }
            }
            
            //assume it's an enemy since no other case fit
            return ENEMY_MULT;
        }
    }
?>