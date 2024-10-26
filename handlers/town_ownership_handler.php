<?php
/**
  * Updates town ownership based on player progress. Similar to 
  * town_ownership_inline, but made for use with independent, ansynch call.
  *
  * Info needed to be passed in: 
  *      townid - id of town to be checked, should match townid in db
  *      mapType   - what kind of map should be returned (mission, crafting, etc)
  *                    see switch statement for all cases
  *      playerid - current player's facebook id
  *
  * @version 15 February 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  * @history
  *         created 15 February 2009
  */

include_once('../lib/config.php');

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

require_once('../' . LIB_PATH . 'db_access.php');
require_once('../' . LIB_PATH . 'db_access_faction.php');
require_once('../' . LIB_PATH . 'map.class.php');
//require_once('../' . LIB_PATH . 'db_access_player.php');

$db = new DatabaseAccess;
//$player_db = new PlayerFaction;
$fac_db = new FactionDatabase;

$town_id   = 0;
$player_id = 0;
$refresh   = false;

//get post variable info
if(isset($_POST['townid']))
{   
    $town_id = $_POST['townid'];
}

if(isset($_POST['mapType']))
{
    $mapType = $_POST['mapType'];
}

$curr_time  = time();
$map        = '';
$new_map    = '';

$town       = $db->get_town_info($town_id);
$time_diff  = $curr_time - $town[$town_id]->ownership_date;
$count_time = $time_diff; //for now, assume some amount of time p

if($time_diff >= TOWN_TIME_THRESHOLD)
{
      //find new owner, set changes to db
    $fac_db->set_faction_owner($town_id);

    if(isset($_POST['playerid']))
	{
	      //draw new faction map
		$map = new Map;

		$player_id = $_POST['playerid'];
		require_once('../' . LIB_PATH . 'db_access_player.php');
		$player_db = new PlayerDatabase;
		$player = $player_db->get_player_data($player_id);
		
		switch($mapType)
		{
			case "mission":
				 $new_map = $map->draw_mission_map( $player->faction,
													$player->level);
				 break;
			case "crafting":
				 $new_map = $map->draw_crafting_map( $player->faction,
													 $player->level);
				 break;
			case "merchant":
				 $new_map = $map->draw_item_map( $player->faction,
												 $player->level);
				 break;
			case "pvp":
				 $new_map = $map->draw_pvp_map( $player->faction,
												$player->level);
				 break;
		}
	}

      //since town updated, timer resets to max
    $count_time = TOWN_TIME_THRESHOLD;
    $refresh = true;
}

  //return new map for display in calling page
$output = array( 'refresh'    => $refresh,
                 'map'        => $new_map,
                 'time'       => $count_time );
                 
echo json_encode($output);
?>