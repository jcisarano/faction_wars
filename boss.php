<?php
/**
* Boss fight management page. Lists available fights from current user
*      and all friends.
*
* @version 18 March 2010
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 18 March 2010
*/

require_once 'lib/config.php';

if($facebook_config['debug']==1)
{
    ini_set('display_errors', true);
    ini_set('log_errors', true);
    $js_ver=time();
}
else
{
    ini_set('display_errors', false);
    ini_set('log_errors', false);
    $js_ver=VERSION;
}

require_once(FB_PATH.'facebook.php');
require_once(LIB_PATH.'display.php');
require_once LIB_PATH . 'db_access_player.php';
require_once LIB_PATH . 'db_access_boss.php';

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$facebook->require_frame();
$fb_user = $facebook->require_login();

$player_db = new PlayerDatabase;
$player = $player_db->get_player_data($fb_user);

//db = new DatabaseAccess;

$boss_db = new BossDatabase;
$output = '';
$old_friend_fights = null;
$friend_fights = null;

//////////////////////////////////////
//Get this player's boss fights
//////////////////////////////////////
//active
$my_fights = $boss_db->get_boss_fight($player->userid);
//check time on active fight. If timed out:
//           set as inactive, clear active fight list
$time_remaining = ($my_fights[0]['completion_one'] * BOSS_TIME_UNIT)
                       - (time() - $my_fights[0]['datestarted']);
//$output .= 't=' . $time_remaining;

if($time_remaining <= 0)
{
    $boss_db->set_boss_fight_complete($player->userid);
    $my_fights = null;
}

$time_remaining = max(0,$time_remaining); //use zero as floor

//inactive
//$my_old_fights = $boss_db->get_completed_fights($player->userid);
$my_old_fights = $boss_db->get_my_completed_fights($player->userid);

  //////////////
  //update number of friends the player has playing the game
  //updates also in pvp.php
$player_friends = $facebook->api_client->friends_getAppUsers();
$player_db->update_player_friends($player->userid, $player_friends);
$player_team_list = $player_db->get_friends($player->userid);
$player->army_size = count($player_team_list);
$player_db->update_player_db($player);
  //////////////end update team size

//////////////////////////////////////
//Get all friends' fights
//////////////////////////////////////
if(is_array($player_team_list))
{
    foreach($player_team_list as $key=>$friend)
    {
        $active = $boss_db->get_boss_fight($friend);
        $time_remaining = ($active[0]['completion_one'] * BOSS_TIME_UNIT)
                           - (time() - $active[0]['datestarted']);
        if($time_remaining <= 0) //look for timed out fights
        {
            $boss_db->set_boss_fight_complete($friend);
        }
        else
        {
            $friend_fights = array_merge((array)$friend_fights,
                         (array)$active);
        }

        $old_friend_fights = array_merge((array)$old_friend_fights,
                          (array)$boss_db->get_completed_fights($player->userid,
                                                                $friend));
    }
}
//////////////////////////////////////
/*
 $output .= '<style>';
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_boss_style.css', true));
 $output .= '</style>'; */
//include stylesheet
$output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_boss_style.css?v=' . $js_ver . '" />';


$output .= add_scripts($player);
$output .= '<script src="'. ROOT . JS_PATH
                       . 'recharge_timer.js?v=' . $js_ver . '"></script>';
$output .= '<script src="'. ROOT . JS_PATH
                       . 'common.js?' .$js_ver . '"></script>';

$output .= '<div id="fwBody">';

$output .= '<div id="playerData">' . render_player_data($player) . '</div>';
//$output .= '<div id="leftCol">leftcol</div>';

$output .= '<div id="rightColBorderTop"></div>';
$output .= '<div id="rightCol">';

$output .= render_nav_bar('Boss');

//$output .= '<div id="resultBody"></div>';
$output .= '<div id="content"><div id="contentHead"></div>';
$output .= '<div id="contentBody">';
$output .= '<div class="bossList"><h1>Your bosses</h1>';

if($my_fights)
{
    //currently active boss fight - there should be only one
    foreach($my_fights as $key => $f )
    {

        $output .= parse_active_fight($f, true);
    }
}
else
{
    $output .= '<div
            class="bossFightItem">You have no active boss fights. 
            <a href="team.php">Share gifts</a>,
            <a href="crafting.php">craft items</a>, and then
            <a href="missions.php">summon a boss</a>!</div>';
}

if($my_old_fights)
{
    $output .= '<div class="topRule">';
      //old fights whose rewards haven't been claimed yet
    foreach($my_old_fights as $key => $f )
    {
        $output .= parse_completed_fight($f, true);
    }
    $output .= '</div>';
}
else
{
    $output .= '<div
            class="bossFightItem">You have no unclaimed rewards from your own 
            fights.</div>';
}

$output .= '</div>';//end player's fights in BossList
$output .= '<div class="bossList"><h1>Your friends\' bosses</h1>';

if(isset($old_friend_fights))
{
      //completed fights with rewards to be collected
    foreach($old_friend_fights as $key => $f)
    {
        $output .= parse_completed_fight($f, false);
    }
}

if(isset($friend_fights))
{
    $output .= '<div class="topRule">';
    foreach($friend_fights as $key => $f )
    {
        $output .= parse_active_fight($f, false);
    }
    $output .= '</div>';
}
else
{
    $output .= '<div class="bossFightItem">Your friends have no active boss
               fights. <a href="team.php">Send them gifts</a> so they can get
               started.</div>';
}

$output .= '</div></div>';  //end bossList

/**
$numPages     = 0;
$usersPerPage = 20;
$numPages = count($player_team_list) / $usersPerPage;
if( floor($numPages) < $numPages )
{
      //handle rounding, if needed
    $numPages = ceil($numPages);
}

 //determine current page number
$thisPage = 0;
if (isset($_GET['page']) )
{
    $thisPage = $_GET['page'];
}
  //display friends based on page number
$minIndex = $thisPage * $usersPerPage; //loop start
$maxIndex = $usersPerPage + $thisPage * $usersPerPage; //loop end

$output .= pageNav($numPages, $thisPage, 'team.php');

$exclude_list = '';
//build exclude list and also build appuser output
if($player_team_list)
{
    $exclude_list = '';
    for( $key = $minIndex;
         $key < $maxIndex && $key < sizeof($player_team_list);
         $key += 1)
    //for($key=0; $key<count($player_team_list); $key++)
    {
          //app user output
        $output .= '<div class="teammate"><fb:profile-pic uid="'
            . $player_team_list[$key] . '" size="square"/><br /><fb:name uid="'
            . $player_team_list[$key]
            . '"/><br /><span class="gift"><a href="#" onclick="showList(\''
            . ROOT . HANDLER_PATH . 'get_gift_list.php\', '
            . $player->userid . ', ' . $player_team_list[$key] . ', '
            . $player_team_list[$key]
            . ');return false;">Send a gift</span></a></div>';

          //exclude list
        if($key != 0)
        {
            $exclude_list .= ', ';
        }
        $exclude_list .= $player_team_list[$key];
    }
}
$output .= '</div>';**/

$output .= '<div class="clearDiv"></div>';


$output .= '</div></div>'; //end content, rightCol
$output .= '<div id="footer">';
$output .= include('footer.php');
$output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

$output .= render_timer_script($player);

echo $output;

/**3
  * Format info from fight object for display.
  */
function parse_active_fight($fight, $myFight=false)
{
    $time_passed = time() - $fight['datestarted'];
    $deadline = $fight['completion_one'] * BOSS_TIME_UNIT; //#secs boss will live
    $time_left = max(($deadline - $time_passed), 0);

    $f = '<div class="bossFightItem"><div id="fight_' . $fight['summonid']
                 . '"><img src="' . ROOT . MISH_IMG_PATH . 'boss/' 
                                                         . $fight['image']
                 . '"><h1>' . $fight['title'];
    if(!$myFight)
    {
        //include player name only if not current player
        $f .= ' (<fb:name uid="' . $fight['playerid'] . '" linked="false"
                                           capitalize="true"/>)';
    }

    $f .= '</h1><h1>Active</h1>'
                 //. format_time($time_left) . '</span>
                 . '<input type="submit"
                               class="fwButton"
                               value="Fight ' . $fight['title'] . '"
                               onclick="swapContent(\'' . ROOT
                               . HANDLER_PATH . 'get_boss_fight.php\', '
                               . $fight['playerid'] 
                               . ', \'contentHead\', \'contentBody\', ' 
                                    . $fight['summonid'] . ')">
                 </div></div><div class="fwClear"></div>';
    return $f;
}

function parse_completed_fight($fight, $myFight=false)
{
    $f= '<div id="title_' . $fight['summonid']
                 . '"></div><div id="body_' . $fight['summonid']
                . '"><div class="bossFightItem"><img src="' 
                          . ROOT . MISH_IMG_PATH . 'boss/'
                          . $fight['image'] . '"><h1>' . $fight['title'];
                 if(!$myFight)
                 {
                     $f .= ' (<fb:name uid="'
                 . $fight['summon_playerid'] . '" linked="false"
                                           capitalize="true"/>)';
                 }

                 $f .= '</h1>
                 <input type="submit" class="fwButton" value="Claim Reward"
                        onclick="swapContent(\'' . ROOT
                         . HANDLER_PATH . 'boss_reward_handler.php\', ';
                 if($myFight)
                 {
                     $f .= $fight['playerid'];
                 }
                 else
                 {
                     $f .= $fight['summon_playerid'];
                 }
                 
                 $f .= ', \'title_' . $fight['summonid']
                       . '\', \'body_' . $fight['summonid']
                       . '\', ' . $fight['summonid']
                       . ' ); return false;"></div></div>
                       <div class="fwClear"></div>';
    return $f;
}

function add_scripts($player)
{
    return '<script><!--
        function swapContent(url, summoner_id, div1, div2, summon)
        {
            showLoadscreen();
            var ajax = new Ajax();

            ajax.responseType = Ajax.JSON;
            ajax.requireLogin = 1;

            ajax.ondone = function(data) {
                hideLoadscreen();
                document.getElementById( div1 )
                        .setInnerFBML(data.fbml_title);
                document.getElementById( div2 )
                        .setInnerFBML(data.fbml_body);

            }
            var params ={"summoner_id": summoner_id,
                         "summon_id": summon,
                         "p_id":"' . $player->userid . '"};

            ajax.post(url, params);
        }
        //--></script>';
}
?>