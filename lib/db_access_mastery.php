<?php
/**
  * Attributes and methods for managing mission completion.
  *
  * @version 27 January 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 15 November 2009
  *         corrected bug in set_progress() that caused conflict between
  *                   mission (untimed) and skill/mute (timed) updates
  *                   26 January 2010
  */

require_once('db_connect.php');

class MasteryDatabase
{
    protected $db_util;

    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }

    /**
      * Get player's current mastery level for one or more items.
      * If item number not supplied, returns list of all items associated
      * with this player.
      *
      * @param $userid
      * @param $type
      * @param $itemid
      *
      * @return array of arrays:
      *         {{itemid, level, progress}, ...}
      */
    function get_mastery($userid, $type, $itemid=0)
    {
        $query = 'SELECT missionid, mastery, player_reps FROM '
            . COUNT . ', ' . MISH_COMPLETION . ' WHERE '   ;
    }
    
    /**
      * update player level to passed-in value
      * @param $userid
      * @param $type
      * @param $itemid
      * @param $level
      *
      * @return
      */
    function set_mastery($userid, $type, $itemid, $level)
    {
        $query = 'INSERT INTO ' . MISH_COMPLETION 
            . ' (playerid, itemid, itemtype, mastery) VALUES('
            . $userid . ', ' . $itemid . ', ' . $type . ', ' . $level . ')'
            . ' ON DUPLICATE KEY UPDATE mastery=' . $level;
        $this->db_util->execute_query($query);
    }
    
    /**
      * Update progress in item to passed-in values
      *
      * @param $userid player's facebook userid
      * @param $type Mastery type from config file (e.g. MISSION_MASTERY, 
      *              MUTE_MASTERY, etc
      * @param $itemid itemid from item table
      * @param $progress new progress value to set
      *
      */
    function set_progress($userid, $type, $itemid, $progress)
    {
          //set progress
        $query = 'INSERT INTO ' . COUNT
            . ' (itemid, itemtype, player_reps, playerid) VALUES ('
            . $itemid . ', ' . $type . ', ' . $progress . ', ' . $userid
            . ') ON DUPLICATE KEY UPDATE player_reps=' . $progress;
        $this->db_util->execute_query($query);
        
          //set update time only for mutations and skills
        if($type == SKILL_MASTERY 
           || $type == MUTE_MASTERY )
        {
            $query = 'INSERT INTO ' . ITEM_UPDATE
                . '(itemid, userid, update_time) VALUES (' . $itemid . ', '
                . $userid . ', ' . time() 
                . ') ON DUPLICATE KEY UPDATE update_time=' . time();
            $this->db_util->execute_query($query);
        }
    }
}
?>