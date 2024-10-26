<?
/**
  * Handle attack and damage for boss battles:
  *        Verify the fight still active
  *        Determine damage amount
  *        Change boss's hp
  *        Save damage to record
  *        Spend player's stamina
  *        Build and return output
  *
  * @version 22 March 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 22 March 2010
  */

require_once( '../lib/config.php' );
require_once( '../' . LIB_PATH . 'db_access_boss.php' );
require_once( '../' . LIB_PATH . 'db_access_player.php' );
require_once( '../' . LIB_PATH . 'db_access_pvp.php' );
require_once( '../' . LIB_PATH . 'display.php' );
require_once( '../' . LIB_PATH . 'utilities.class.php' );

//$db        = new DatabaseAccess;
$player_db = new PlayerDatabase;
$boss_db   = new BossDatabase;
$pvp_db    = new PvpDatabase;
$util      = new Utilities;

$playerId       = 0;
$summonerId     = 0;
$fight_complete = false;
$popuptitle     = '';
$popup          = '';
$body           = '';
$title          = '';
$hp_perc        = 0;
$flavor_text    = '';

if(isset($_POST['summoner_id']))
{
 $summonerId = $_POST['summoner_id'];
}

if(isset($_POST['p_id']))
{
 $playerId = $_POST['p_id'];
}

if(isset($_POST['summon_id']))
{
 $summonId = $_POST['summon_id'];
}
  //get boss fight info and verify that fight is still active
$fight = $boss_db->get_boss_fight($summonerId);
$time_remaining = ($fight[0]['completion_one'] * BOSS_TIME_UNIT)
                       - (time() - $fight[0]['datestarted']);

if($time_remaining <= 0 || $fight[0]['isActive'] == 0)
{
    //fight is no longer valid
    if($time_remaining <= 0)
    {
        $boss_db->set_boss_fight_complete($summonerId);
        $fight_complete = true;
    }
    else
    {
        $fight_complete = true;
    }
    $title = 'Unable to fight this boss';
    $body = 'This fight is over. Choose another
             fight or summon another boss and get back into the fray.';
}
  //get player info
$player = $player_db->get_player_data($playerId);

if($player->current_stamina < $fight[0]['energy_drain'])
{
    $fight_complete = true;
    $title = 'Unable to fight this boss';
    $body = 'You need at least ' . $fight[0]['energy_drain']
                                 . ' stamina to fight this boss.';
} 

if(!$fight_complete)
{
    //Determine damage amount
    //damage based on player's attack value and best items: weapon, skill, mute
    //grab lists of player's best weapons, etc
    //these lists come organized with best items at the top
    $item[] = $pvp_db->get_items_by_type($player->userid, WEAPON, 0);
    $item[] = $pvp_db->get_items_by_type($player->userid, SKILL, 0);
    $item[] = $pvp_db->get_items_by_type($player->userid, MUTATION, 0);

    $damage = $player->attack;

    foreach($item as $i)
    {
        //$body .= http_build_query($util->get_bonus($i[0])) . '<br />';
        $bonus = $util->get_bonus($i[0]);
        $damage += $bonus['attack'];
    }

    $stamina_cost = $fight[0]['energy_drain'];
    $damage = $damage * $stamina_cost; //allow for more damage based on cost

    //add +/-10% damage
    $mod = round($damage * 0.1);
    $damage = round(mt_rand(($damage-($mod)),($damage+($mod))));

    //Change boss's hp and save player's participation
    $result = $boss_db->set_boss_fight_participation($playerId,
                                                     $summonerId, $damage);

    $f = $fight[0];
    $f['boss_hp'] = $f['boss_hp'] - $result['dmg_applied'];
    $gamestrings = $boss_db->get_boss_fight_text( $f['missionid'],
                                                  BOSS_MISSION );
    $flavor_text = $util->get_description($gamestrings, $f);

      //award chips and xp
    $chips = rand($fight[0]['chips_min'], $fight[0]['chips_max']);
    $xp    = rand($fight[0]['xp_min'], $fight[0]['xp_max']);

    $player->chips += $chips;
    if($player->update_xp($xp)) //update returns true on level up
    {
          //level up message
        $popuptitle = 'Congratulations!';
        $popup .= render_levelup_notice($player);
        //$popup .= '<div class="">'
          //                . render_levelup_notice($player)
            //              . '</div>';

          //track levelup statistics
        require_once('../' . LIB_PATH . 'db_access_metrics.php');
        $metrics_db = new MetricsDatabase;
        $ttl = time() - $player->datein;
        $metrics_db->set_time_to_level($player->level, $ttl);
        $metrics_db->set_cash_on_level($player->level,
                                             $player->chips);
    }

      //Spend player's stamina
    $player->current_stamina -= $stamina_cost;

      //save changes to player
    $player_db->update_player_db( $player );

      //Build and return output
    $title = 'Hit!';

    $body .= '<div>You did ' . $result['dmg_applied']
                       . ' points of damage to the boss and made off with '
                       .  $chips . ' chips. Earned '
                       . $xp . ' experience points.';
    $body .= '<input type="submit" value="Attack Again"
                        class = "fwButton"
                        onclick="handleBossFight(\'' . ROOT
                               . HANDLER_PATH . 'boss_fight_handler.php\', '
                               . $fight[0]['playerid']
                               . ');return false;">';

    $body .= '</div>';
    
    if($f['boss_start_hp'] >0)
    {
        $hp_perc = round((100 * $f['boss_hp']) / $f['boss_start_hp']);
    }
    
    $boss_new_hp = $f['boss_hp'];
}
else
{
      //unable to fight, set values for output
    $boss_new_hp = $fight[0]['boss_hp'];
    $hp_perc = round((100 * $fight[0]['boss_hp']) / $fight[0]['boss_start_hp']);
    $gamestrings = $boss_db->get_boss_fight_text( $fight[0]['missionid'],
                                                  BOSS_MISSION );
    $flavor_text = $util->get_description($gamestrings, $fight[0]);
}

  //updated player stat display
$stats = render_player_data($player);

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => '<h1>' . $title . '</h1>',
                 'fbml_body'    => $body,
                 //'desc_update'  => $desc,
                 'player_stats' => $stats,
                 'fbml_popup'   => $popup,
                 'popuptitle'   => $popuptitle,
                 'boss_hp'      => $boss_new_hp,
                 'boss_hp_perc' => $hp_perc,
                 'fbml_flavor'  => '<span>' . $flavor_text . '<span>' );

echo json_encode($output);
?>