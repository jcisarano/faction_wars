<?php
/**
  * Manages item upgrades
  *
  * @version 15 October 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 15 October 2009
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
require_once('../' . LIB_PATH . 'db_access_mastery.php');
require_once('../' . LIB_PATH . 'display.php');

$db        = new DatabaseAccess;

$item_id    = 0;
$player_id  = 0;
$town_id    = 0;
//$price      = 0;
$progress   = 0;
$increment  = 0;
$fail       = false;

//for text output to fbjs dialog popup
$title      = '';
$body       = '';
$stats      = '';
$popuptitle = '';
$popup      = '';
$output;

//get item and player info
if(isset($_POST['itemid']))
{
  $item_id = $_POST['itemid'];
}

//if(isset($_POST['townid']))
//{
//  $town_id = $_POST['townid'];
//

if(isset($_POST['fb_sig_user']))
{
  $player_id = $_POST['fb_sig_user'];
}

$item = $db->get_item_info($item_id, $player_id);
//item is array: {id, name, description, use_text, image, attack_bonus,
//                     defense_bonus, price, item_type, purchasable, player_reps,
//                     mastery, trainingtype, count_type, completion_one,
//                     completion_two, completion_three}

$mastery = ( $item['mastery'] )? $item['mastery'] : 0;
$progress = 0 + $item['player_reps'];

//***********
//mastery
//***********
if( MAX_UPGRADE <= $mastery)
{
    $fail = true;
    $title = 'Upgrade failed';
    $body = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                                    . '" />
                     <div class="transText">You have already
                          advanced this item as far as possible.</div>';
}
require_once('../' . LIB_PATH . 'db_access_player.php');
$player_db = new PlayerDatabase;
$player = $player_db->get_player_data($player_id);

$curr_time = time();
$one_day = 24 * 60 * 60; //num secs in a day
$time_diff = $curr_time - $item['update_time'];

/*
if(!$fail && $item['update_time'] != null && $time_diff < $one_day )
{
    $fail = true;
    $title = 'Upgrade failed';
    $body = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                                    . '" />'
                     . '<div class="transText">You may upgrade
                             this item once every ' . format_time_2($one_day)
                             . ' hours. Try again in ' . format_time_2($one_day - $time_diff)
                             . ' hours.</div></div>';
    //$body .= '<br />last update=' . $item['update_time'];
    //$body .= '<br />current time=' . $curr_time;
    //$body .= '<br />time diff=' . $time_diff;
    //$body .= '<br />less than a day=' . ($time_diff < $one_day);
}*/

if(!$fail)
{
      //determine what level item is currently at and find corresponding
      //values
    switch((int)$item['mastery'])
    {
        case 0:
        case null:
            $progress += $item['completion_one'];
            //$price = $item['upgrade_price_one'];
            $increment = $item['completion_one'];
            $next_increment = $item['completion_two'];
            $attack = $item['attack_bonus_one'];
            $defense = $item['defense_bonus_one'];
            $next_attack = $item['attack_bonus_two'];
            $next_defense = $item['defense_bonus_two'];
            $cost = $item['upgrade_price_one'];  //price to upgrade an item
            $next_cost = $item['upgrade_price_two'];
            break;
        case 1:
            $progress += $item['completion_two'];
            //$price = $item['upgrade_price_two'];
            $increment = $item['completion_two'];
            $next_increment = $item['completion_three'];
            $attack = $item['attack_bonus_two'];
            $defense = $item['defense_bonus_two'];
            $next_attack = $item['attack_bonus_three'];
            $next_defense = $item['defense_bonus_three'];
            $cost = $item['upgrade_price_two'];
            $next_cost = $item['upgrade_price_three'];
            break;
        case 2:
            $progress += $item['completion_three'];
            //$price = $item['upgrade_price_three'];
            $increment = $item['completion_three'];
            $attack = $item['attack_bonus_three'];
            $defense = $item['defense_bonus_three'];
            $next_attack = $item['attack_bonus_three'];
            $next_defense = $item['defense_bonus_three'];
            $cost = $item['upgrade_price_three'];
            $next_cost = $item['upgrade_price_three'];
            $next_increment = 0;
            break;
        default:
            $progress = $item['player_reps'];
            break;
    }
}

if( !$fail && $player->chips < $cost )//verify no time fail already
{
    $fail = true;
    $title = 'Upgrade failed!';
    $body = '<div class="transResult">'
                  . '<img src="' . ROOT . ITEM_PATH . $item['image']
                                    . '" />'
                  . '<div class="transText">You need at least ' . $cost
                  . ' chips to apply this upgrade.</div></div>';
}

if (!$fail)
{
      //charge player and set new time
    $player->chips -= $cost;

    $mastery_db = new MasteryDatabase;
      //determine how many points the player earns for this click
      //and cost for the upgrade

    if($progress >= 100 * ($mastery + 1))
    {
        //set new mastery level for player
      $mastery += 1;

        //award player AP
      $player->achieve_points += AP_REW_MISH;
        //set popup output
      $popuptitle = 'Congratulations!';
      $popup .= '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                                    . '" />'
                     . '<div class="transText">You improved '
                     . $item['name'] . ' to level ' . ($mastery + 1) 
                     . ' and earned ' . AP_REW_MISH . ' AP.</div></div>';
      $attack  = $next_attack;
      $defense = $next_defense;
      $cost    = $next_cost;
    }
    $mastery_db->set_progress($player_id, $item['trainingtype'],
                            $item['id'], $progress);
    $mastery_db->set_mastery($player_id, $item['trainingtype'],
                            $item['id'], $mastery);
    $player_db->update_player_db( $player );
    
    /***************************
    ***check for achievements***
    ****************************/
    require_once('../' . LIB_PATH . 'db_access_achievement.php');
    $achieve_db = new AchievementDatabase;
    $achieve_db->update_player_achievements($player->userid);

      //output
    $title = 'Upgrade applied';
    $body = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                                    . '" />'
                     . '<div class="transText">You improved your ' 
                     . $item['name'] . ' by ' . $increment . '% for ' 
                     . $cost .' chips.</div></div>';
}//end fail check

$stats = render_player_data($player);

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

$output = array( 'fail'           => $fail,
                 'fbml_title'     => '<h1>' . $title . '</h1>',
                 'fbml_body'      => $body,
                 'player_stats'   => $stats,
                 'fbml_popup'     => $popup,
                 'next_increment' => $next_increment,
                 'popuptitle'     => $popuptitle,
                 'progress'       => $progress,
                 'mastery'        => $mastery + 1,
                 'attack'         => $attack,
                 'defense'        => $defense,
                 'cost'           => $cost);
echo json_encode($output);


?>