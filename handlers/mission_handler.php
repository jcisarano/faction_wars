<?php
/*
* Process mission results -
* General outline of steps involved:
* get post info
* get mission info
* get player info
* verify player inventory
* verify player has enough gamma
*
* calculate rewards (chips, xp, items)
* give player rewards
* handle level up case (extra popup on return to main page)
* update player db - stats, inventory
* handle achievements
* handle faction standings, prep town changeover notice if needed
* remove mission ingredients from player inventory (only required scrap items are removed)
* generate output
* return results
*
* @version 3 September 2009
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 3 September 2009
*         documentation 12 Oct 2009
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

//require_once('../' . FB_PATH  . 'facebook.php');
require_once('../' . LIB_PATH . 'db_access.php');
require_once('../' . LIB_PATH . 'db_access_player.php');
require_once('../' . LIB_PATH . 'db_access_faction.php');
require_once('../' . LIB_PATH . 'display.php');

/*
$facebook = new Facebook(
       $facebook_config['api_key'],
       $facebook_config['secret']);

$fb_user = $facebook->get_loggedin_user();
 */

$db        = new DatabaseAccess;
$player_db = new PlayerDatabase;
$fac_db    = new FactionDatabase;

$mission_id = 0;
$player_id  = 0;
$town_id    = 0;
$mission    = null;
$player     = null;
$treasure   = null;

  //for text output to fbjs dialog popup
$title      = '';
$body       = '';
$popup      = '';
$popuptitle = '';
$new_map    = '';
$update_map = 0;
$output;

  //true if unable to complete mission
$fail       = false;

  //get mission and player info
if(isset($_POST['missionid']))
{
    $mission_id = $_POST['missionid'];
}

if(isset($_POST['townid']))
{
    $town_id = $_POST['townid'];
}

if(isset($_POST['fb_sig_user']))
{
    $player_id = $_POST['fb_sig_user'];
}
$player = $player_db->get_player_data($player_id);
$mission = $db->get_mission_data($mission_id, $player_id);
$title   = $mission->title;

  //mission mastery initial values
$progress = 0;
$earn = 0; //store current upgrade amount
$mastery = ( $mission->player_mastery )? $mission->player_mastery : 0;
$progress = 0 + $mission->player_progress;
  //determine how many points the player earns for this click
$earn = get_bump($mission->player_mastery, $mission);

  //verify ingredients
if( !$player_db->verify_player_inventory($player_id, $mission_id) )
{
    $body = '<div class="mishResult">This mission requires at
                 least one item you haven\'t acquired yet. Buy it from the 
                 merchant or win it in another mission.</div>';
    //ingredient fail

    $fail = true;
}

//verify energy, make sure fail hasn't already happend on ingredients
if( !$fail
    && $player->current_gamma < $mission->energy_drain )
{
    //energy fail
    $body = '<div class="mishResult">You don\'t have the '
                    . $mission->energy_drain
                    . ' gamma needed to attempt this mission.</div>';
    $fail = true;
}

if( !$fail ) //no failure case met, so process results
{
    //calculate results
    $chips    = rand($mission->chips_min, $mission->chips_max);
    $xp       = rand($mission->xp_min, $mission->xp_max);

      //make sure there is at least one potential item
    if($mission->treasure_table)
    {
        //independent system: player can win all items with good rolls, no
        //item excludes any other
        //foreach($mission->treasure_table as $t)
        //{
        //    $t_roll = mt_rand(1, 100);
        //    if($t_roll <= $t['chance'])
        //    {
        //        $treasure[] = $t;
        //    }
        //
        //}
        
          //exclusive system: win one item only out of all possible
        $totalchance = 0; //will store total probability of all items
        foreach( $mission->treasure_table as $t )
        {
            $totalchance += $t['chance'];
        }

        mt_srand();
        $t_roll = mt_rand(1, $totalchance);

        $chance = 0;
        
          //loop through all potential items, award based on chance roll
        foreach($mission->treasure_table as $t)
        {
            $chance += $t['chance'];
            if($t_roll <= $chance)
            {
                //award item
                if($t['item_type'] != NOTHING)
                {
                    $treasure[] = $t;
                }
                break 1;
            }
        }
    }

    $chips = $player->add_chips($chips);
    $player->update_gamma(-$mission->energy_drain);

    //award treasure
    $db->give_item_list($player->userid, $treasure);

    if($player->update_xp($xp)) //update returns true on level up
    {
        $popuptitle = 'Congratulations!';
        $popup .= '<div class="mishResult">'
                          . render_levelup_notice($player)
                          . '</div>';

          //track levelup statistics
        require_once('../' . LIB_PATH . 'db_access_metrics.php');
        $metrics_db = new MetricsDatabase;
        $ttl = time() - $player->datein;
        $metrics_db->set_time_to_level($player->level, $ttl);
        $metrics_db->set_cash_on_level($player->level,
                                             $player->chips);
    }
    //***********
    //mastery
    //***********
    if( $mission->player_mastery < MAX_UPGRADE)//3 levels max right now
    {
        require_once('../' . LIB_PATH . 'db_access_mastery.php');
        $mastery_db = new MasteryDatabase;

        $progress += $earn;
        $old_earn = $earn; //save original value for display in result
                           //if there's a progress bump, we still want to 
                           //see the first value

        if($progress >= 100 * ($mission->player_mastery + 1))
        {
              //set new mastery level for player
            $mastery = $mission->player_mastery + 1;
              //updated value for new level
            $earn = get_bump($mastery, $mission);
              //award player AP
            $player->achieve_points += AP_REW_MISH;
              //set popup output
            $popuptitle = 'Congratulations!';
            $popup .= '<div class="mishResult"><p>You mastered '
                . $mission->title . ' to level ' . ($mastery + 1)
                . ' and earned ' . AP_REW_MISH . ' AP.</p></div>';
        }
          //percent progress
        $mastery_db->set_progress($player->userid, MISSION_MASTERY,
                                  $mission->id, $progress);
          //mastery level
        $mastery_db->set_mastery($player->userid, MISSION,
                                  $mission->id, $mastery);
    }

          //set progress for %width of progress bar
    if($mastery >= MAX_UPGRADE)
    {
        //maxed out, set to 100%
        $progress = 100;
    }
    else
    {
        //use mod as progress to next level
        $progress = $progress % 100;
    }

    //***********
    //update faction standings in db
    //***********
    //add influence earned: influence gain == xp
    $fac_result = $fac_db->update_faction_score($town_id,
                                                $player->faction,
                                                $xp);
    $town       = $db->get_town_info($town_id);
    $fac        = $fac_db->get_faction_info($player->faction);
    $fac_output = '';

    if($fac_result['points']>0)
    {
        $fac_output = '<div id="mishFac"><p>Your work on this mission has
                            earned influence for the '
                      . $fac[$player->faction]->faction
                      . ' in ' . $town[$town_id]->name . '.</p>';

        //handle a faction turnover
        //if($fac_result['win'])
        //{
        //    $fac_output .= '<p>' . $fac[$player->faction]->faction
        //                . ' take over ' . $town[$town_id]->name . '!</p>';
        //
        //    require_once('../' . LIB_PATH . 'map.class.php');
        //    $map = new Map;
        //    $new_map = $map->draw_mission_map( $player->faction,
        //                                   $player->level);
        //    $update_map = 1;

              //metrics tracking for town turnover
        //    require_once('../' . LIB_PATH . 'db_access_metrics.php');
        //    $metrics_db = new MetricsDatabase;
        //    $metrics_db->set_town_win($town_id);
        //}
        $fac_output .= '</div>';
    }
    //***********
    //achievements
    //***********
    require_once('../' . LIB_PATH . 'db_access_achievement.php');
    $achieve_db = new AchievementDatabase;
      //add points to player's achievement tracking
    $add= 1; //(one mission completed)
    $ach = $achieve_db->increment_achievement($mission->id, MISSION,
                                       $player->userid, $add);
      //update chip achievement total
    $ach2 = $achieve_db->increment_achievement(CHIP_ITEM, CHIP_TOTAL,
                                       $player->userid, $chips);

    if($ach2)
    {
        $ach = array_merge($ach, $ach2);
    }

      //create achievement output if needed
    if($ach != null)
    {
        $popuptitle = 'Congratulations!';
        foreach($ach as $achievement)
        {
            $player->achieve_points += $achievement['ap'];
            $player->faction_points += $achievement['fp'];
            $popup .= '<div class="mishResult">' 
                   . render_achievement_notice($achievement)
                   . '</div>';
        }
    }

    //save changes to player
    $player_db->update_player_db( $player );

    //spend inventory items
    $db->spend_mission_items($mission_id, $player->userid);

    //build output and return
    $body = '<div class="mishResult">'
       . '<div class="mishResultImgCol"><img src="'
               . ROOT . MISH_IMG_PATH . $mission->image . '" />'
       . '<input type="submit" value="Run mission again"
                      class="fwButton"'
            . 'onClick="runMission(\''
            . ROOT . HANDLER_PATH . '/mission_handler.php\', '
            . $mission->id .', '. $town_id . ', \'progress_'
            . $mission->id
            . '\', \'mastery_' . $mission->id .'\', \'earn_'
               . $mission->id . '\')" /></div>'//img/button column div end
       . '<div class="mishText">' . $mission->result_text . '</div>'
       . '<div class="mishText">Level ' . ($mastery + 1) . ' progress '
       . $progress . '%'
       . '<div id="resultProgressBarFrame">
               <div style="width:' . $progress . '%;"></div></div></div>'
       . '<div class="mishLoot">Loot:<br />' . number_format($xp) . ' xp<br />'
       .  number_format($chips) . ' chips<br />';

    if( isset($treasure[0]) ) //make sure that at least one item exists
    {
        foreach( $treasure as $item )
        {
            $body .= $item['name'] . ' x' . $item['quantity'] . '<br />';
        }
    }
    if(isset($old_earn))
    {
        $body .= $old_earn . '% mastery';
    }
    $body .= '</div>'; //loot div w/rewards
    
    $body .= '<div class="mishLoot">Cost:<br />'
          . $mission->energy_drain . ' gamma<br />';
    if($mission->ingredients)
    {
        foreach($mission->ingredients as $ingredient)
        {
            if($ingredient['item_type'] == SCRAP)
            {
                $body .= $ingredient['name'] . ' x' 
                                             . $ingredient['quantity'];
            }
        }
    }
    $body .= '</div>';  //loot div w/costs

    $body  .= $fac_output;
    $body  .= '</div>';
    $body  .= '</div>';//mish result
    //$popup .= '</div><div class="popupHorizBar"></div>';
}
$stats = render_player_data($player);

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => '<h1>' . $title . '</h1>',
                 'fbml_body'    => $body,
                 'player_stats' => $stats,
                 'fbml_popup'   => $popup,
                 'popuptitle'   => $popuptitle,
                 'progress'     => $progress,
                 'earn'         => $earn,
                 'mastery'      => $mastery + 1,
                 'fbml_map'     => $new_map,
                 'update_map'   => $update_map );

 echo json_encode($output);
 
 /**
   * Given the player's mastery level, this function returns the bump
   * (amount to increment progress percentage) for this mission.
   * @param 
   * @return
   */
 function get_bump($player_mastery, $mission)
 {
     switch((int)$player_mastery)
     {
         case 0:
         case null:
              $earn = $mission->completion_one;
              break;
         case 1:
              $earn = $mission->completion_two;
              break;
         case 2:
              $earn = $mission->completion_three;
              break;
         default:
               //error case - should be one of the other options
              $earn = 0;
              break;
     }
     return $earn;
 }
?>