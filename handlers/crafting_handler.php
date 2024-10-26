<?php
/**
  * Backend support for crafting item.
  *
  * @version 15 December 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 15 December 2009
  *         documentation 15 December 2009
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
require_once('../' . LIB_PATH . 'db_access_player.php');
require_once('../' . LIB_PATH . 'display.php');

$db        = new DatabaseAccess;
$player_db = new PlayerDatabase;

$mission_id = 0;
$player_id  = 0;
$mission    = null;
$player     = null;
$town_id    = null;

  //for text output to fbjs dialog popup
$title      = '';
$body       = '';
$popup      = '';
$popuptitle = '';
$new_map    = '';
$fac_output = '';
$update_map = 0;
$output;

  //true if unable to complete mission
$fail       = false;

  //get mission and player info
if(isset($_POST['missionid']))
{
    $mission_id = $_POST['missionid'];
}
if(isset($_POST['playerid']))
{
    $player_id = $_POST['playerid'];
}

if(isset($_POST['townid']))
{
    $town_id = $_POST['townid'];
}


$player = $player_db->get_player_data($player_id);
$mission = $db->get_mission_data($mission_id, $player_id);
$title   = $mission->title;

  //verify ingredients
if( !$player_db->verify_player_inventory($player_id, $mission_id) )
{
    //ingredient fail
    $title .= ' - Crafting failed';
    $body = '<div class="mishResult">You\'re missing at least one crafting
                  ingredient. Scout out the missions to determine where you can
                  acquire it.</div>';
    $fail = true;
}

//verify energy, make sure fail hasn't already happend on ingredients
if( !$fail
    && $player->current_stamina < $mission->energy_drain )
{
      //energy fail
    $title .= ' - Crafting failed';
    $body = '<div class="mishResult">You don\'t have the '
                    . $mission->energy_drain
                    . ' stamina needed to craft this item.</div>';
    $fail = true;
}

if( !$fail ) //no failure case met, so process results
{
    $xp       = rand($mission->xp_min, $mission->xp_max);

    //$treasure[] = $mission->treasure_table[rand(0,count($mission->treasure_table)-1)];

      //make sure there is at least one potential item
    if($mission->treasure_table)
    {
          //exclusive system: win one item only out of all possible
        $totalchance = 0; //will store total probability of all items
        foreach( $mission->treasure_table as $t )
        {
            $totalchance += $t['chance'];
        }

        mt_srand(); //seed random number generator
        $t_roll = mt_rand(1, $totalchance);

        $chance = 0;//for running tally of item chance to drop

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
                break 1; //one item given, break out of loop
            }
        }
    }

    $player->update_stamina(-$mission->energy_drain);

      //award treasure
    $db->give_item_list($player->userid, $treasure);

    if($player->update_xp($xp)) //update returns true on level up
    {
        $popuptitle = 'Congratulations!';
        $popup .= '<div class="mishResult">'
                          . render_levelup_notice($player)
                          . '</div>';        
    }
    /***********
    //Faction influenc points
    /***********/
    require_once('../' . LIB_PATH . 'db_access_faction.php');
    $fac_db     = new FactionDatabase;
    $fac_result = $fac_db->update_faction_score($town_id,
                                                $player->faction,
                                                $xp);
    $town       = $db->get_town_info($town_id);
    $fac        = $fac_db->get_faction_info($player->faction);

    if($fac_result['points']>0)
    {
        $fac_output = '<p>Your work on this item has
                            earned influence for the '
                        . $fac[$player->faction]->faction
                        . ' in ' . $town[$town_id]->name . '.</p>';
    }

      //build output and record achievements
    $body = '<div class="mishResult">'
       . '<img src="' . ROOT . ITEM_PATH . $mission->image . '"/>'
       . '<div class="mishText">' . $mission->result_text . '<br /><br />'
       . 'Results:<br /> ' . $xp . ' xp<br />';

    if( isset($treasure[0]) ) //make sure that at least one item exists
    {
          //init achievement db
        require_once('../' . LIB_PATH . 'db_access_achievement.php');
        $achieve_db = new AchievementDatabase;

        foreach( $treasure as $item )
        {
              //add points to player's achievement tracking
            $ach = $achieve_db->increment_achievement($item['itemid'], CRAFT,
                                       $player->userid, $item['quantity']);
              //build output for crafting results
            $body .= $item['name'] . ' x' . $item['quantity'] . '<br />';
        }
    }
    $body .= $fac_output;
    $body .= '</div></div>';

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
    
      //save changes to player db
    $player_db->update_player_db( $player );

      //spend inventory items
    $db->spend_mission_items($mission_id, $player->userid);
}

$stats = render_player_data($player);

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => '<h1>' . $title . '</h1>',
                 'fbml_body'    => $body,
                 'player_stats' => $stats,
                 'fbml_popup'   => $popup,
                 'popuptitle'   => $popuptitle );

echo json_encode($output);
?>