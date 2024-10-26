<?php
/*
 * Database utilities related to achievements
 *
 * @version 2 October 2009
 * @author Jason Cisarano jcisarano@icarusstudios.com
 *
 * @history
 *         created 2 October 2009
 */

require_once('db_connect.php');
require_once('achievement.class.php');

class AchievementDatabase
{

    protected $db_util;

    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }
    
    /**
      * Gets list of all achievements from db
      *
      * @return list of all achievements in game
      */
    function get_achievements()
    {
    }
    
    /**
      * Gets list of achievements associated with particular player
      *
      * @param $userid player's facebook userid
      * @param $all When set to true, returns a list of all achievements
      *        in the game along with whether the player has completed them
      *        When false, returns only achievements the player has completed
      * @return array of Achievement objects
      */
    function get_player_achievements($userid, $all=true)
    {
        $query = 'SELECT ' . ACHIEVEMENT . '. *, ' 
               . PLAYER_ACHIEVE . '.playerid '
               . ' FROM ' . ACHIEVEMENT . ' LEFT JOIN ' . PLAYER_ACHIEVE
               . ' ON ' . ACHIEVEMENT . '.achievementid = '
               . PLAYER_ACHIEVE . '.achievementid'
               . ' AND ' . PLAYER_ACHIEVE . '.playerid=' . $userid;

        $result = $this->db_util->execute_query($query);
        while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $achieve = new Achievement;
            $achieve->achievementid = $row['achievementid'];
            $achieve->name          = $row['name'];
            $achieve->description   = $row['description'];

              //reps based on player input - may not be set
            if(isset($row['reps']))
            {
                $achieve->reps  = $row['reps'];
            }
            else
            {
                $achieve->reps = 0;
            }

            $achieve->image         = $row['image'];

            if($row['playerid'] != null)
            {
                $achieve->achieved = true;
            }
            else
            {
                $achieve->achieved = false;
            }

            $list[] = $achieve;
        }
        return $list;
    }

    /**
      * Increments given achievement count for given player 
      * by passed-in quantity.
      *
      * @param $id identifier of item being counted (e.g. missionid, itemid, etc)
      * @param $type time of item being counted.
      *        mission = 1, item = 2, etc
      * @param $userid player's fb userid
      * @param $quantity increment amount, will be added to old total
      */
    function increment_achievement($id, $type, $userid, $quantity)
    {
          //first update quantities on record
        $query = 'INSERT INTO ' . COUNT
            . '(itemid, itemtype, playerid, player_reps) VALUES ('
            . $id . ', ' . $type. ', ' . $userid . ', ' . $quantity
            . ') ON DUPLICATE KEY UPDATE player_reps=player_reps+' . $quantity;
        $this->db_util->execute_query($query);
          //then check to see if any new trophies are won
        return $this->update_player_achievements($userid);
    }
    
    /**
      * Iterates over achievements and player count to see if the player has
      * completed any new achievements
      *
      * @param $userid player's fb user id
      * @return Array of achievements inserted, each with these keys:
      *         {name: name of achievement, 
      *          ap: how many ap awarded, 
      *          fp:faction award for the achievement}
      */
    function update_player_achievements($userid)
    {
        $inserted = null;//will be list of any earned achievements
          //first, get info about all achievements and this player's reps
        $query = 'SELECT ' . ACHIEVEMENT
            . '.achievementid, achievement_type, player_reps, needed, name,'
            . COUNT . '.itemtype FROM '
            . ACHIEVE_COUNT . ' JOIN ' . COUNT . ' ON ' . COUNT . '.itemid='
            . ACHIEVE_COUNT . '.itemid AND ' . COUNT . '.itemtype='
            . ACHIEVE_COUNT . '.itemtype AND ' . COUNT . '.playerid=' . $userid
            . ' JOIN ' . ACHIEVEMENT . ' ON ' . ACHIEVEMENT
            . '.achievementid=' . ACHIEVE_COUNT . '.achievementid';
        $result = $this->db_util->execute_query($query);

        //iterate over them all and decide if update needed
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            //make sure player hasn't alreade earned this one
            $query = 'SELECT * FROM ' . PLAYER_ACHIEVE
                . ' WHERE playerid=' . $userid
                . ' AND achievementid=' . $row['achievementid'];
            $achieve_result = $this->db_util->execute_query($query);

              //if no value found, acheivement not already earned
            if(!$achieve_row = mysql_fetch_array($achieve_result, MYSQL_ASSOC))
            {
                //handle each achivement_type differently
                if($row['achievement_type'] == SIMPLE_ACHIEVEMENT)
                {
                    //check if player has earned it
                    if($row['needed'] <= $row['player_reps'])
                    {
                        //add to player's roster if so
                        $query = 'INSERT IGNORE INTO ' . PLAYER_ACHIEVE
                            . '(achievementid, playerid) VALUES ('
                            . $row['achievementid'] . ', ' . $userid . ')';
                        $this->db_util->execute_query($query);

                        $inserted[]= array ('name' => $row['name'],
                                            'ap'   => AP_REW,
                                            'fp'   => FAC_REW );
                    }
                }
                else if ($row['achievement_type'] == SUM_ACHIEVEMENT)
                {
                      //get player's total
                    $query = 'SELECT SUM(player_reps) FROM ' . COUNT
                        . ' LEFT JOIN ' . ACHIEVE_COUNT
                        . ' ON ' . COUNT . '.itemid=' . ACHIEVE_COUNT 
                        . '.itemid'
                        . ' WHERE ' . ACHIEVE_COUNT .  '.achievementid='
                        . $row['achievementid'] . ' AND ' . COUNT .'.itemtype='
                        . $row['itemtype']
                        . ' AND ' . COUNT . '.playerid=' . $userid;

                    $sum_result = $this->db_util->execute_query($query);
                    $sum_row = mysql_fetch_array($sum_result, MYSQL_ASSOC);

                    //check if player has earned it
                    if($row['needed'] <= $sum_row['SUM(player_reps)'])
                    {
                          //add to player's list if so
                        $query = 'INSERT IGNORE INTO ' . PLAYER_ACHIEVE
                            . '(achievementid, playerid) VALUES ('
                            . $row['achievementid'] . ', ' . $userid . ')';
                        $this->db_util->execute_query($query);

                        $inserted[]= array ('name' => $row['name'],
                                            'ap'   => AP_REW,
                                            'fp'   => FAC_REW );
                    }
                }
                else if ($row['achievement_type'] == AGGREGATE_ACHIEVEMENT)
                {
                    $fail = false;
                      //get list of all player_reps w/ matching needed
                    $query = 'SELECT ' . ACHIEVEMENT . '.achievementid,
                        player_reps, needed FROM ' . ACHIEVE_COUNT
                        . ' INNER JOIN ' . ACHIEVEMENT . ' ON ' . ACHIEVEMENT
                        . '.achievementid=' . ACHIEVE_COUNT
                        . '.achievementid LEFT JOIN ' . COUNT . ' ON '
                        . ACHIEVE_COUNT . '.itemid=' . COUNT . '.itemid AND '
                        . ACHIEVE_COUNT . '.itemtype=' . COUNT
                        . '.itemtype AND ' . COUNT . '.playerid=' . $userid
                        . ' WHERE ' . ACHIEVE_COUNT . '.achievementid='
                        . $row['achievementid'];
                    $agg_result = $this->db_util->execute_query($query);

                    while($agg_row = mysql_fetch_array($agg_result, MYSQL_ASSOC))
                    {
                        //check if each value is good
                        if($agg_row['player_reps'] == null
                             || $agg_row['player_reps'] < $agg_row['needed'])
                        {
                            $fail = true;
                            break;
                        }
                    }
                    //add to player's list if found good
                    if( !$fail )
                    {
                          //add to player's list if so
                        $query = 'INSERT IGNORE INTO ' . PLAYER_ACHIEVE
                            . '(achievementid, playerid, date_won) VALUES ('
                            . $row['achievementid'] . ', ' . $userid 
                            . ', ' . time() . ')';
                        $this->db_util->execute_query($query);
                          //return values
                        $inserted[]= array ('name' => $row['name'],
                                            'ap'   => AP_REW,
                                            'fp'   => FAC_REW );
                    }
                }
            }
        }
        return $inserted;
    }
}

?>