<?php
 /**
   * Database access items related to boss battles
   *
   * @version 12 March 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   * @history
   *         created 21 September 2009
   */

require_once 'config.php';
require_once('db_connect.php');
//require_once('db_access_player.php');

class BossDatabase
{
    protected $db_util;

    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }

    /**
      * Pull data on player's boss fights.
      *
      * @param $playerid Player's fb id. This should be the id of the player who
      *                  initiated the fight.
      * @param $isActive If true, only a currently in-progress fight will be
      *                  returned. Default = true
      * @param $summonid Used to specify a particular summon. Default ignores
      *                  this and will pull all summons using above params.
      *
      * @return Array of fights, each an assoc array. If only one fight is 3
      *         returned, this will still be an array with only one entry.
      *         Keys match column headings in fw_current_summon.
      *         Returns null if no items found.
      */
    function get_boss_fight($playerid, $isActive = 1, $summonid=-1)
    {
        $query = 'SELECT * FROM ' . BOSS_FIGHTS . ', ' . MISH
                 . ' WHERE playerid=' . $playerid
                 . ' AND isActive=' . $isActive
                 . ' AND ' . MISH . '.missionid=' 
                           . BOSS_FIGHTS . '.missionid';
        if($summonid > -1)
        {
            $query .= ' AND summonid=' . $summonid;
        }
        //echo '<p style="color:red;">'.$query.'</p>';
        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $fights[] = $row;
        }

        return (isset($fights)? $fights : null);
    }
    
    /**
      * Uses missionid to pull town info from fw_summon_mission
      *
      * @param missionId Id of the mission to search on
      *
      * @return Array of towns where the mission appears
      *
      */
    function get_summon_town($missionId)
    {
        $query = 'SELECT * FROM ' . SUMMON_MISH . ' WHERE missionid=' 
                                . $missionId;
        $towns = null;
        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $towns[] = $row['townid'];
        }

        return (isset($towns)? $towns : null);
    }

    /**
      * Fetch all strings that match both itemid and itemtype. Strings returned
      *       in order from oldest to newest according to when they were
      *       entered in the table.
      *
      * @param $itemid an id number associated with the item, e.g. use the
      *        missionid for a boss mission, itemid, etc. The combination of
      *        this and $itemtype need not be unique, but will be unique to
      *        all strings associated with a given mission.
      * @param $itemtype constants from config.php, e.g. BOSS_MISSION
      * @return array of assoc arrays with needed information. Assoc keys are:
      *         stringid, itemid, itemtype, gamestring
      */
    function get_boss_fight_text($itemid,$itemtype)
    {
        $query = 'SELECT * FROM ' . STRINGS . ' WHERE itemid=' . $itemid
               . ' AND itemtype=' . $itemtype . ' ORDER BY stringid ASC';
        //echo '<p style="color:red;">'.$query.'</p>';
        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $strings[] = $row;
        }

        return $strings;
    }

	/**
	  * Pulls data on completed fights this user was involved in. Will not
	  *       return any data on a fight the user didn't participate in.
	  *
	  * @param $playerid Player's fb id. This is the player who participated
	  *        in the fight, not the person who summoned the boss. However,
	  *        these may be the same player.
	  * @param $summonerid Id of person who originally summoned the boss. If
	  *        not specified, the function will return all fights this player
	  *        has participated in, regardless of summoner. Default is to
	  *        return all fights.
	  * @param $isRewardClaimed Flag to decide if items the player has already
	  *        collected the reward on should be returned. Default returns only
	  *        unclaimed rewards.
	  */
	function get_completed_fights($playerid, 
                                  $summonerid=-1,
                                  $isRewardClaimed=0)
	{
	    if($summonerid==-1)
		{
		    $summonerid = $playerid;
		}
		$query = 'SELECT ' . BOSS_DMG . '.*, ' . MISH . '.* FROM '
                           . BOSS_FIGHTS . ', ' . MISH . ', ' . BOSS_DMG
				. ' WHERE ' . BOSS_DMG . '.isRewardCollected=' . $isRewardClaimed
				. ' AND ' . BOSS_DMG . '.summon_playerid=' . $summonerid
				. ' AND ' . BOSS_DMG . '.playerid=' . $playerid
				. ' AND ' . BOSS_FIGHTS . '.summonid=' . BOSS_DMG . '.summonid'
				. ' AND ' . BOSS_FIGHTS . '.isActive=0'
				. ' AND ' . MISH . '.missionid=' . BOSS_FIGHTS . '.missionid';
		//echo '<p style="color:red;">'.$query.'</p>';

        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $fights[] = $row;
        }

        return (isset($fights)? $fights : null);
	}
	
	/**
	  * Pulls a player's own completed fights, whether the player participated
	  *       or not. Will not return fights whose rewards have been
	  *       collected.
	  *
	  * @param $playerid
	  *
	  * @return array of arrays, each with keys matching col headings in
	  *         fw_mission, fw_current_summon, fw_summon_participation
	  */
	function get_my_completed_fights($playerid)
	{
        $fights = null;
        $query = 'SELECT ' . MISH . '.*, ' . BOSS_DMG . '.dmg, '
               . BOSS_DMG . '.summon_playerid, '
               . BOSS_DMG . '.clicks, ' . BOSS_DMG . '.isRewardCollected,'
               . BOSS_DMG . '.dateCollected, ' . BOSS_FIGHTS . '.*'
               . 'FROM ' . BOSS_FIGHTS . ', ' . MISH . ', ' . BOSS_DMG
               . ' WHERE ' . BOSS_DMG . '.summon_playerid='
                       . BOSS_FIGHTS . '.playerid
                 AND ' . BOSS_DMG . '.playerid=' . BOSS_FIGHTS . '.playerid
                 AND ' . BOSS_FIGHTS . '.summonid=' . BOSS_DMG . '.summonid
                 AND ' . BOSS_DMG . '.isRewardCollected!=1'
               . ' AND ' . BOSS_FIGHTS . '.isActive=0
                 AND ' . MISH . '.missionid=' . BOSS_FIGHTS . '.missionid
                 AND ' .BOSS_FIGHTS . '.playerid=' . $playerid;
	    //echo '<p style="color:red;">'.$query.'</p>';
        
        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $fights[] = $row;
        }

        return (isset($fights)? $fights : null);
    }

    /**
      * Set a new boss fight for this player. The player can only have one fight
      *     active at a time, so duplicate requests will not be added.
      *
      * @param $playerid Player's facebook id.
      *
      * @return Returns true on success, false on failure.
      */
    function set_new_boss_fight($playerid, $missionid, $bosshp)
    {
        //make sure player has no current summon in progress
        $query = 'SELECT * FROM ' . BOSS_FIGHTS
               . ' WHERE playerid=' . $playerid . ' AND isActive=1';
        //echo '<p style="color:red;">'.$query.'</p>';
        $result = $this->db_util->execute_query($query);
        if(mysql_fetch_array($result, MYSQL_ASSOC))
        {
              //if active item found, return false and do nothing else
            return false;
        }

          //if no active item found, create new one
        $query = 'INSERT INTO ' . BOSS_FIGHTS . ' (playerid, missionid,
                   boss_start_hp, boss_hp, datestarted, isActive) VALUES ('
                   . $playerid . ', '
                   . $missionid. ' , '
                   . $bosshp . ', '
                   . $bosshp . ', '
                   . time() . ' , 1)';

        $this->db_util->execute_query($query);
        //echo '<p style="color:red;">'.$query.'</p>';
        return true;
    }

    /**
      * Sets player's currently active boss fight as complete.
      *
      * @param $playerid Player's fb id. This is the summoning player.
      * @param $isDefeat set to 1 if players killed the boss, 0 if the fight
      *        simply timed out. Default value is 0.
      */
    function set_boss_fight_complete($playerid, $isDefeat = 0)
    {
        $query = 'UPDATE ' . BOSS_FIGHTS . ' SET isActive=0,
                                                 dateEnded=' . time() . ',
                                                 isDefeated=' . $isDefeat
        . ' WHERE playerid=' . $playerid . ' AND isActive=1';
        //echo '<p style="color:red;">'.$query.'</p>';

        $this->db_util->execute_query($query);
    }

    /*
     * Modifies boss hp down by the amount given. Does not check for defeat.
     *
     * @param $playerid Player's fb id. This is the id of the player who
     *        summoned the boss, NOT the one doing the damage.
     *
     * @param $damage Amount of damage to apply.
     *
     */
    function update_boss_hp($playerid, $damage)
    {
        $query = 'UPDATE ' . BOSS_FIGHTS . ' SET boss_hp=boss_hp-' . $damage
               . ' WHERE playerid=' . $playerid . ' AND isActive=1';
        $this->db_util->execute_query($query);
    }

    /**
      * Pulls information on a player's activities in one or more boss fights.
      *
      * @param $playerid Player's facebook id. This should be the player whose
      *                  participation info you want to pull. If -1 is passed
      *                  into this parameter, the playerid field will not be
      *                  used to cull data.
      * @param $summonerid Player's facebook id. This is the player who first
      *                  summoned the boss. If no id given, the field
      *                  summoner_playerid is ignored.
      * @param $isClaimed If 1, the function will only return fights where the
      *                  player has already claimed the rewards for the fight.
      *                  If 0, only fights with unclaimed rewards will return.
      *                  If -1, this field will be ignored. Default value is 0.
      * @param $summonid Used to specify a particular item. Default ignores
      *                  this and pulls summons with other params.
      *
      * @return Assoc array of zero or more fights with keywords matching table
      *                 headings:
      */
    function get_boss_fight_participation($playerid = -1, $summonerid = -1,
                                                     $isClaimed = 0,
                                                     $summonid = -1)
    {
        $fights = null;
        $query = 'SELECT * FROM ' . BOSS_DMG . ' WHERE 1 ';

        if($isClaimed > -1)
        {
            $query .= ' AND isRewardCollected=' . $isClaimed;
        }

        if($playerid > -1)
        {
            $query .= ' AND playerid=' . $playerid;
        }

        if($summonerid > -1)
        {
            $query .= ' AND summon_playerid=' . $summonerid;
        }
        if($summonid > -1)
        {
            $query .= ' AND summonid=' . $summonid;
        }
        
        $query .= ' ORDER BY dmg DESC';

        //echo '<p style="color:red;">'.$query.'</p>';
        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $fights[] = $row;
        }

        return $fights;
    }

    /**
      * Updates player's participation in a boss fight. Verifies that the fight
      * exists before attempting an update.
      *
      * @param $playerid Player's fb id. This is the player doing the damage.
      * @param $summonerid Player's fb id. This player summoned the boss in the
      *        first place. May be the same player as $playerid.
      * @param $damage Number of hit points damage to apply to the creature.
      *
      * @return Returns amount of damage done on success. On failure, returns 0.
      */
    function set_boss_fight_participation($playerid, $summonerid, $damage)
    {
        //verify the fight still exists and determine how many points the
        //player can do with this hit (up to value of $damage)
        //retrieve summonid
        $fight = $this->get_boss_fight($summonerid);

        if(count($fight) > 0)
        {
            $fail = 0;

              //determine how many points dmg to apply
            if($fight[0]['boss_hp'] > $damage)
            {
                $dmg_applied = $damage;
                $win = 0;

                  //apply damage to boss
                $this->update_boss_hp($summonerid, $dmg_applied);
            }
            else
            {
                $dmg_applied = $fight[0]['boss_hp'];
                $win = 1;

                  //apply damage to boss, call fight over
                $this->update_boss_hp($summonerid, $dmg_applied);
                $isDefeated = 1;
                $this->set_boss_fight_complete($summonerid, $isDefeated);
            }

            //fight is verified, set damage, etc to individual participation
            $query = 'INSERT INTO ' . BOSS_DMG
                      . '(summonid, playerid, summon_playerid, dmg, clicks)
                       VALUES (' . $fight[0]['summonid'] . ', ' . $playerid
                           . ', ' . $summonerid . ', ' . $damage . ', 1 ' . ')
                      ON DUPLICATE KEY UPDATE dmg=dmg+' . $damage
                         . ', clicks=clicks+1';
           //echo '<p style="color:red;">'.$query.'</p>';
           $this->db_util->execute_query($query);
        }
        else
        {
            $dmg_applied = 0;
            $win         = 0;
            $fail        = 1;
        }

        return array('dmg_applied' => $dmg_applied,
                     'win'         => $win,
                     'failure'     => $fail,
                     'query'       => $query         );
    }

    /**
      * Set given reward status to collected. Doesn't verify that the fight is
      * complete, etc.
      * @param playerid Player's fb id. This is the player whose reward we're
      *        currently collecting.
      * @param $summonerid Player's fb id. This is the player who originally
      *        summoned the boss. Can be the same id as $playerid
      * @param $summonid Id number of the given summon. From fw_current_summon
      */
    function set_reward_collected($playerid, $summonerid, $summonid)
    {
        $query = 'UPDATE ' . BOSS_DMG . ' SET isRewardCollected=1,
                         dateCollected=' . time()
               . ' WHERE playerid=' . $playerid
               . ' AND summon_playerid=' . $summonerid
               . ' AND summonid=' . $summonid;
        $this->db_util->execute_query($query);
        return '<p style="color:red;">'.$query.'</p>';
    }
}
?>