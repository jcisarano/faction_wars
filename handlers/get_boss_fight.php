<?php

/**
* Get info on a particular boss fight and output HTML for inclusion in page.
*
* @version 20 March 2010
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 20 March 2010
*/

include_once( '../lib/config.php' );
include_once( '../' . LIB_PATH . 'db_access_boss.php' );
require_once( '../' . LIB_PATH . 'display.php' );
include_once( '../' . LIB_PATH . 'utilities.class.php');
include_once('../' . LIB_PATH . 'db_access_player.php');

//$db        = new DatabaseAccess;
$player_db = new PlayerDatabase;

$boss_db   = new BossDatabase;
$utilities = new Utilities;

$playerId       = 0;
$summoner_id    = 0;
$fight_complete = false;
$title          = '';
$body           = '';

if(isset($_POST['summoner_id']))
{
 $summoner_id = $_POST['summoner_id'];
}

if(isset($_POST['p_id']))
{
 $playerId = $_POST['p_id'];
}

if(isset($_POST['summon_id']))
{
 $summonId = $_POST['summon_id']; //why not just pull from fight info?
}

$player = $player_db->get_player_data($playerId);
$fight = $boss_db->get_boss_fight($summoner_id);
//verify that this fight is still active i.e., it still has time left
$time_remaining = ($fight[0]['completion_one'] * BOSS_TIME_UNIT)
                       - (time() - $fight[0]['datestarted']);

$title .= '<div id="popupTitle"></div><div id="popupBody"></div>';

//make sure fight hasn't timed out already
if($time_remaining <= 0)
{
    $boss_db->set_boss_fight_complete($player->userid);
    $fight_complete = true;
}
if($fight_complete)
{
    //player was too late - can't particpate in this fight
    $body .= 'This fight is over. Go back and collect your reward - if you
                    earned one.';
} 
else
{
    $gamestrings = $boss_db->get_boss_fight_text( $fight[0]['missionid'],
                                                  BOSS_MISSION );
    $description = $utilities->get_description($gamestrings, $fight[0]);

    $hp_perc = round((100 * $fight[0]['boss_hp']) / $fight[0]['boss_start_hp']);

    $title .= '<div>'
        . '<div id="bossHeader">'
        . '<h1>' . $fight[0]['title'] . '</h1>'
        . '<p>Time remaining: <span id="bossTimer">00:00</span></p>'
        . '</div></div>';
    $title .= '<div id="bossResult"><div id="resultTitle"></div>
                                 <div id="resultBody"></div></div>';
    $body .= '<div id="bossBody">'
        . '<div class="hpBarFrame"><div id="hpBar"
                     style="width:' . $hp_perc
                     . '%;height:100%;">'
                     //. '<span><span id="bossHp">' . $fight[0]['boss_hp']'
                     //. '</span>/' . $fight[0]['boss_start_hp'] . '</span>'
                     . '</div></div>'
        . '<img src="' . ROOT . MISH_IMG_PATH . 'boss/' . $fight[0]['image'] . '" />'
        . '<span id="bossText">' . $description . '</span>'
        . '<input type="submit" value="Attack (' . $fight[0]['energy_drain']
                                                 . ' stamina)"
                        class = "fwButton"
                        onclick="handleBossFight(\'' . ROOT
                               . HANDLER_PATH . 'boss_fight_handler.php\', '
                               . $fight[0]['playerid']
                               . ', ' . $summonId
                               . ');return false;">'
        . '<div><input type="submit"
                      value="Invite friends to the fight"
                      class = "fwButton"
                      onclick="post(\'Fallen Earth Faction Wars\',
                             \'' . CANVAS_PATH . '\',
                             \'{*actor*} has challenged the '
                             . $fight[0]['title']
                             . ' and wants your help.\');return false;"></div>';
}

//retrieve/display data on other players who are helping out in the fight
$helpers = $boss_db->get_boss_fight_participation(-1, $summoner_id, 0,
                                                     $fight[0]['summonid']);
$body .= '<div id="bossPalsList">
               <h1>Fight history:</h1>';
if($helpers)
{
    foreach($helpers as $h)
    {
        $point_pl = $utilities->get_plural($h['dmg']);
        $click_pl = $utilities->get_plural($h['clicks']);

        $body .= '<div class="bossPal"><fb:name uid="' . $h['playerid']
              . '" linked="false" capitalize="true"/> did ' . $h['dmg']
              . ' point' . $point_pl . ' of damage with ' . $h['clicks'] 
              . ' hit' . $click_pl . '.</div>';
    }
}

$body .= '<div class="bossPal">Recruit some friends to the fight and take down 
               the boss even faster.</div>';

$body .= '</div></div>';

$body .= '<script>
              <!--
              set_boss_timer(' . $time_remaining . ', "bossTimer" );'
              . '
                 //-->
                 </script>';
$body .= '<script><!--
            function handleBossFight(url, summoner_id, summon_id)
            {
                showLoadscreen();

                document.getElementById( "resultTitle" )
                        .setInnerXHTML("<span></span>");
                document.getElementById( "resultBody" )
                        .setInnerXHTML("<span></span>");

                var ajax = new Ajax();

                ajax.responseType = Ajax.JSON;
                ajax.requireLogin = 1;

                ajax.ondone = function(data)
                {
                    hideLoadscreen();
                    document.getElementById("bossResult")
                            .setStyle("display","block");

                    if(data.popuptitle != "" )
                    {
                        document.getElementById("popupTitle")
                            .setInnerXHTML(
                                 "<h1>" + data.popuptitle + "</h1>");
                        document.getElementById("popupBody")
                            .setInnerFBML(data.fbml_popup);
                    }
                    document.getElementById( "resultTitle" )
                            .setInnerFBML(data.fbml_title);
                    document.getElementById( "resultBody" )
                            .setInnerFBML(data.fbml_body);
                    document.getElementById( "bossText" )
                            .setInnerFBML(data.fbml_flavor);
                    document.getElementById("playerData")
                            .setInnerXHTML(data.player_stats);
                    document.getElementById("hpBar")
                            .setStyle("width", data.boss_hp_perc +"%");
                    set_stam_timer(' . $player->stam_update_rate
                                     . ', "stamTimer");
                }
                var params ={"summoner_id": summoner_id,
                             "summon_id": summon_id,
                             "p_id":"' . $playerId . '"};

                ajax.post(url, params);
            }

            function swapText()
            {

            }
            //--></script>';

$output = array( 'fbml_title'    => $title,
                 'fbml_body'    => $body );

echo json_encode($output);
?>