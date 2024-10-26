<?php
 /**
   * Gets faction data for a town from the database, returns it as
   * XHTML for presentation in factions page.
   *
   * @version 1 September 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         1 September 2009 - created
   *         15 February 2010 - added timed town turnover
   */
 include_once('../lib/config.php');
 include_once('../' . LIB_PATH . '/db_access.php');
 include_once('../' . LIB_PATH . '/db_access_faction.php');
 require_once('../' . LIB_PATH . 'map.class.php');

 $db = new DatabaseAccess;
 $fac_db = new FactionDatabase;
 
   //get useful info from db
 $sectors = $db->get_sector_name();
 $factions = $fac_db->get_faction_info(); //generic faction info

 $townid = 0;
 $player_faction;
 $map = '';

 $count_time = 0; //town update timer value
 $new_map        = null;


 if(isset($_POST['townid']))
 {
     $townid = $_POST['townid'];
 }
 if(isset($_POST['type']))
 {
     $mapType = $_POST['type'];
 }
 else
 {
     $mapType='';
 }
 
   //get current town time time info
 $town = $db->get_town_info($townid);
 $time_diff = time() - $town[$townid]->ownership_date;

  //check if it is time to update the town's ownership info
 if($time_diff >= TOWN_TIME_THRESHOLD)
 {
       //find new owner, set changes to db
     $fac_db->set_faction_owner($townid);
     $countdown  = TOWN_TIME_THRESHOLD;

       //get new values
     $town = $db->get_town_info($townid);
     $time_diff = time() - $town[$townid]->ownership_date;

     $update_map = true;
 }
 else
 {
       //countdown time to use
     $countdown  = TOWN_TIME_THRESHOLD - $time_diff;
     $update_map = false;
 }

 $town_info = '<div><div id="townData">';
 $town_info .= '<img src="' . ROOT . TOWN_IMG_PATH
                              . $town[$townid]->image . '" />';
 $town_info .= '<h1>' . $town[$townid]->name . '</h1>';
 $town_info .= '<p>Sector: ' . $sectors[$town[$townid]->sector] . '</p>';
 $town_info .= '<p>' . $town[$townid]->description . '</p></div>';

 if($town[$townid]->owned == 1)
 {
     //display info for owning faction
     $town_info .= '<div id="townOwner">'
               . '<img src="' . ROOT . FAC_IMG_PATH
                              . $factions[$town[$townid]
                                       ->owner_factionid]->image . '" />'
               . '<h1>' . $factions[$town[$townid]
                                       ->owner_factionid]->faction . '</h1>'
               . '<p>' . $factions[$town[$townid]->owner_factionid]
                                                 ->description . '</p>'
               . '<p>Rulers of ' . $town[$townid]->name . ' since '
               . date( 'r', $town[$townid]->ownership_date) . '</p>';

     $town_info .= '</div>';
     $town_info .= '<div style="clear:both;"></div></div>';
 }
 else
 {
     //no faction owns the town yet -- display default info
     $town_info .= '<div id="townOwner">'
               //. '<img src="' . ROOT . FAC_IMG_PATH
                 //             . $factions[$town[$townid]
                   //                    ->owner_factionid]->image . '" />'
               . '<h1>Anarchy!</h1>'
               . '<p>No faction currently owns ' . $town[$townid]->name 
               . '. <a href="missions.php">Run missions</a>, 
                    <a href="crafting.php">craft items</a>, and
                    <a href="boss.php">fight bosses</a>
                    to win influence for your group!</p>';
     $town_info .= '</div>';
     $town_info .= '<div style="clear:both;"></div></div>';
 }


  //*************************************
  //Build faction ownership display panels
  //*************************************
 $fac_points[1] = $town[$townid]->chota_score;
 $fac_points[2] = $town[$townid]->enforcer_score;
 $fac_points[3] = $town[$townid]->lightbearer_score;
 $fac_points[4] = $town[$townid]->tech_score;
 $fac_points[5] = $town[$townid]->traveler_score;
 $fac_points[6] = $town[$townid]->vista_score;

  //no longer using a fixed point goal, so base everything off of who has the
  //most at the time. Add remaining time so there's a gap that will shrink
  //as time runs out.
 $time_diff = time() - $town[$townid]->ownership_date; //redundant?

   //find max value in array
   //add time to it to avoid a 100% value and add a sort of countdown as
   //time dwindles, even if no new points won
 $top_points = max($fac_points) + $time_diff;

 $fac_data = '<div>';
 foreach($factions as $faction)
 {
       //avoid division by zero
     if($top_points > 0)
     {
           //make sure no value returned is greater than 100%
         $progress = min(round(($fac_points[$faction->id])
                                    /$top_points * 100),100);
     }
     else
     {
           //top_points is zero, then all progress must also be zero
         $progress = 0;
     }

       //check if town has an owner
     if($town[$townid]->owned > 0)
     {
           //this check excludes data from the current owner
         if($faction->id != $factions[$town[$townid]
                                       ->owner_factionid]->id)
         {
             $fac_data .= '<div class="townFaction">'
                  . '<img src="' . ROOT . FAC_IMG_PATH . $faction->image
                                        .'" /><br />'
                  . $faction->faction
                  . '<div class="factionBarFrame"><div id="progress_'
                  . $faction->id . '" style="width:'
                  . $progress
                  . '%;height:100%;"></div></div>'
                  . '</div>';
         }
     }
     else
     {
         //no faction owns the town yet
         $fac_data .= '<div class="townFaction">'
             . '<img src="' . ROOT . FAC_IMG_PATH . $faction->image
                                        .'" /><br />'
             . $faction->faction
             . '<div class="factionBarFrame"><div id="progress_'
             . $faction->id . '" style="width:'
             . $progress
             . '%;height:100%;"></div></div>'
             . '</div>';
     }
 }
 $fac_data .= '<div style="clear:both;"></div></div>';

 if(isset($_POST['p_faction']))
 {
     $player_faction = $_POST['p_faction'];
     $map = new Map;
     $new_map = $map->draw_faction_map($player_faction);
 }

 if(isset($_POST['playerid']))
 {
     require_once('../' . LIB_PATH . 'db_access_player.php');
     $player_id = $_POST['playerid'];
	 $player_db = new PlayerDatabase;
	 $player = $player_db->get_player_data($player_id);
 }

 $map = new Map;
  //determine which type of map we need
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
          $new_map = $map->draw_pvp_map( $player->userid,
                                         $player->faction,
                                         $player->level);
		  break;
     case "faction":
          $new_map = $map->draw_faction_map($player->faction);
          break;
	 default:
	       //simple faction map request doesn't set a type
	      $new_map = $map->draw_faction_map($player_faction);
 }
   //Set name based on town owner. If no owner, use default.
 if(isset($town[$townid]->owner_factionid))
 {
     $fac_name = $factions[$town[$townid]->owner_factionid]->faction;
 }
 else
 {
     $fac_name = 'no one';
 }

 $output = array('town_name'    => $town[$townid]->name,
                 'faction_name' => $fac_name,
                 'town_info'    => $town_info,
                 'standings'    => $fac_data,
                 'fbml_map'     => $new_map,
                 'new_map'      => $update_map,
                 'count_time'   => $countdown);

 echo json_encode($output);

?>