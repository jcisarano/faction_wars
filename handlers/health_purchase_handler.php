<?php
/**
  * Handle health refill based on chips:
  *        Verify player isn't already at full health
  *        Verify that the player has the chips to buy at least one point
  *        Determine price, how many hp to give
  *        Give points, charge, build output message
  *
  * @version 27 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 27 April 2010
  */

require_once('../lib/config.php');
require_once('../' . LIB_PATH . 'db_access_player.php');
require_once('../' . LIB_PATH . 'display.php');
$player_db = new PlayerDatabase;

if(isset($_POST['p_id']))
{
    $playerId = $_POST['p_id'];
}

$player = $player_db->get_player_data($playerId);
$d_health = $player->max_health - $player->current_health;
$perPoint = $player->level * HEALTH_POINT_COST;

if($d_health < 1)
{
    //fail because player health is already full
    $title = 'Unable to purchase health';
    $body = '<p>You are already at full health.</p>';
}
if($player->chips < $perPoint )
{
    //fail because player can't afford at least one point
    $title = 'Unable to purchase health';
    $body = '<p>You don\'t have enough chips to buy any health.</p>';
}
else
{
        //no failure found -- calc and award points

    $totalCost = $d_health * $perPoint;
    
    //make sure the player can afford the refill
    //and award points appropriately
    if($player->chips >= $totalCost)
    {
      $player->add_chips(-$totalCost);
      $player->current_health = $player->max_health;
    }
    else
    {
        //player can't afford a full recharge -- calc how many points to
        //award and total cost. Reset vars to those values.
      $d_health = floor($player->chips / $perPoint);
      $totalCost = $points * $perPoint;
      $player->current_health = $player->current_health
                                     + $d_health;
    }
    
    //set changes in db
    $player_db->update_player_db($player);
    
    //build success message
    $title = 'Purchase completed';
    $body = '<p>You paid ' . $totalCost . ' for '
                           . $d_health . ' health points.</p>';
}

$stats = render_player_data($player);

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => '<h1>' . $title . '</h1>',
                 'fbml_body'    => $body,
                 'player_stats' => $stats );

echo json_encode($output);
?>