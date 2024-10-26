<?php
/**
* Misson page for FE faction wars.
* Displays sector map with towns and allows players to access
* missions in those towns.
*
* @version 24 August 2009
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 24 August 2009
*/

require_once 'lib/config.php';

if($facebook_config['debug']==1)
{
 ini_set('display_errors', true);
 ini_set('log_errors', true);
 $js_ver = time();
}
else
{
 ini_set('display_errors', false);
 ini_set('log_errors', false);
 $js_ver = VERSION;
}

require_once(FB_PATH . 'facebook.php');
include_once(LIB_PATH . 'display.php');
require_once LIB_PATH . 'map.class.php';

require_once LIB_PATH . 'db_access_player.php';

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$facebook->require_frame();
$fb_user = $facebook->require_login();

$map = new Map;
$db = new PlayerDatabase;
$player = $db->get_player_data($fb_user);
$output = '';

include_once(HANDLER_PATH . 'town_ownership_inline.php');

$output .= '<style>';
$output .= htmlentities(
              file_get_contents(ROOT.STYLE.'fw_style.css', true));
$output .= htmlentities(
              file_get_contents(ROOT.STYLE.'fw_mish_style.css', true));
$output .= htmlentities(
              file_get_contents(ROOT.STYLE.'fw_mini_fac_bar.css', true));
$output .= htmlentities(
              file_get_contents(ROOT.STYLE.'fw_summon_style.css', true));
$output .= '</style>';

//include stylesheet
/*$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_mish_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_mini_fac_bar.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_summon_style.css?v=' . $js_ver . '" />';
*/
$output .= addScripts($player);
$output .= '<script src="'. ROOT . JS_PATH
                       . 'recharge_timer.js?v=' . $js_ver . '"></script>';
$output .= '<script src="'. ROOT . JS_PATH
                       . 'common.js?v=' . $js_ver . '"></script>';

$output .= '<div id="fwBody"><div id="playerData">';
//$output .= '<div id="banner"></div>';
$output .= render_player_data($player);
$output .= '</div>';
//$output .= '<div id="leftCol">leftcol</div>';
$output .= '<div id="rightColBorderTop"></div>'
     . '<div id="rightCol">';
$output .= render_nav_bar('Missions');

$output .= '<div id="content"><div id="map">'
     . $map->draw_mission_map($player->faction, $player->level)
     . '</div>';

$output .= '<a onclick="showPopup(\'mishItem\');return false;" class="infoLink">
            More info</a>
       <div id="mishItem"><div class="helpiteminner"><h1>Unlocking a town</h1>
       <p>To gain control of a town, either run missions or defeat other players 
       within the town. You can check the Factions tab to see how close your
       faction is to taking over. Once you win a town, make use of it while
       you can: When you run a town, your faction no longer gains control
       points, and you will inevitably lose it in time.</p>
       <h1>Mission Requirements and Rewards</h1>
       <p>Each mission, in addition to its flavor text, lists a certain number
       of requirements and rewards. To undertake the mission, you must meet
       the requirements: a certain amount of Gamma and sometimes one or more
       items or abilities. If you meet the requirements, once you run the
       mission, the Gamma and any consumable items will be spent, but gear
       and abilities will remain with your character. Once you complete a
       mission, you will gain the rewards: experience and chips from within
       the listed range, and one of the other rewards (selected randomly).</p>
       <h1>Missions Mastery</h1>
       <p>After completing a mission a certain number of times, you will master
       it and gain AP. You can complete each mission to two different levels 
       of mastery. The bar under the mission title will fill as you grow 
       closer to mastery.</p>
       <h1>Mission availability</h1>
       <p>If the town is controlled by an enemy faction, you will have access to
       three generic missions. If it is controlled by an ally faction, you 
       will have access to three additional ally missions. Only when your 
       faction controls the town can you access the seventh mission, which is
       generally the most lucrative.</p>
       <a onclick="hidePopup(\'mishItem\');return false;">Close</a></div></div>';

$output .= '<h1 id="townName"></h1>';
$output .= '<div id="facStandingsTitle"></div>';
$output .= '<h1>Countdown to turnover: <span id="townTimer" 
                       style="color:#e5bc75;">00:00</span></h1>';
$output .= '<div id="facStandings">
         <div id="townOwner"></div>
         <div id="facPanels"></div></div>';
$output .= '<div id="summonMishDiv"></div>';
$output .= '<div id="resultTitle2"></div>'
     . '<div id="resultBody2" style="overflow:hidden;"></div>'
     . '<div id="resultTitle"></div>'
     . '<div id="resultBody" style="overflow:hidden;"></div>'
     . '<div id="missionList" style="overflow:hidden;">'
     . '<h1>Choose a town to see available missions.</h1>';
$output .= '</div>' //end mission list
     . '</div></div>' //end content, rightCol
     . '<div id="fwClear"></div>';
$output .= '<div id="footer">';
$output .= include('footer.php');
$output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

$output .= render_timer_script($player);

//count_time comes from town_ownership_inline.php

include( INCLUDE_PATH . 'start_town_inline.php');

$output .= '<script>showMissions("' . ROOT . HANDLER_PATH
                  . 'get_missions.php", ' . $start_town_id . ', ' 
                  . $player->faction
                  . ', "' . $start_town_name . '" );
                  var oldTown = "' . $start_town_name . '";
                  var currTownId = ' . $start_town_id . ';
                  var mapType = "mission";
                  var handlerPath = "' . ROOT . HANDLER_PATH . '";
                  var imgPath     = "' . ROOT . IMG_PATH . '";';
//$output .= 'showFactions( 1, '. $player->userid
  //                               . ', "mission", "Trailer Park" );';
$output .= '</script>';
//$output .= render_town_timer_script($count_time);
echo $output;

/*
* Helper function returns FBJS to add to document
* @return FBJS as plain text
*/
function addScripts($player)
{
   /**
     * showMissions updates the list of missions displayed on the screen
     * runMission calls a script that will process a mission and display
     *     results to the current page.
     */
 return '<script><!--
         function showMissions(url, townid, playerFaction,
                                    townname)
         {
             showLoadscreen();

             document.getElementById("resultTitle")
                     .setInnerXHTML("<span></span>");
             document.getElementById("resultBody")
                     .setInnerXHTML("<span></span>");
             document.getElementById("resultTitle2")
                     .setInnerXHTML("<span></span>");
             document.getElementById("resultBody2")
                     .setInnerXHTML("<span></span>");

             var ajax = new Ajax();

             ajax.responseType = Ajax.FBML;
             ajax.requireLogin = 1;

             ajax.ondone = function(data) {
                 hideLoadscreen();
                 document.getElementById( "missionList" )
                         .setInnerFBML(data);
                 document.getElementById("townName")
                         .setInnerXHTML("<span>" + townname + "</span>");
                 setPlayerLocation(oldTown, townname, "' . ROOT
                         . IMG_PATH . '/player_icon2.png");
                 oldTown = townname;
                 currTownId = townid;

                 showFactions( townid, '
                                 . $player->userid . ', "mission",
                                 townname );
                 showSummonMissions(townid);
             }
             var params ={"townid": townid,
                          "p_faction": playerFaction,
                          "p_id":"' . $player->userid . '"};

             ajax.post(url, params);
         }
         
         function showSummonMissions(townid)
         {
             var url = "' . ROOT . HANDLER_PATH
                         . 'get_summon_missions.php";
             showLoadscreen();
             document.getElementById("summonMishDiv")
                     .setInnerXHTML("<span></span>");

             var ajax = new Ajax();
             ajax.responseType = Ajax.JSON;
             ajax.requireLogin = 1;
             ajax.ondone = function(data)
             {
                 hideLoadscreen();
                 //new Dialog().showMessage("summon mish","summon mish");
                 document.getElementById("summonMishDiv")
                         .setInnerFBML(data.fbml_body);
             }
             var params={"p_id":' .$player->userid
                                      . ', "townid":townid};
             ajax.post(url, params);

         }
         
         function runSummonMission(url, missionid)
         {
             showLoadscreen();
             document.getElementById("summonMishDiv")
                     .setInnerXHTML("<span></span>");
             
             var ajax = new Ajax();
             ajax.responseType = Ajax.JSON;
             ajax.requireLogin = 1;

             ajax.ondone = function(data)
             {
                 hideLoadscreen();
                 document.getElementById("summonMishDiv")
                     .setInnerFBML(data.fbml_body);
             }
             var params={"p_id":' .$player->userid
                                      . ', "townid":currTownId, 
                                      "mission_id":missionid};
             ajax.post(url, params);
         }

         function runMission(url, missionid, townid, progress,
                                  mastery, earn)
         {
            showLoadscreen();
            document.getElementById("resultTitle2")
                    .setInnerXHTML("<span></span>");
            document.getElementById("resultBody2")
                    .setInnerXHTML("<span></span>");

            showMissions("' . ROOT . HANDLER_PATH
                . 'get_missions.php", townid, '
                . $player->faction . ', oldTown );

             var ajax = new Ajax();
             ajax.responseType = Ajax.JSON;
             ajax.requireLogin = 1;
             ajax.ondone = function(data)
             {
                 hideLoadscreen();
                 if(data.popuptitle != "" )
                 {
                     document.getElementById("resultTitle2")
                         .setInnerXHTML(
                             "<h1>" + data.popuptitle + "</h1>");
                     document.getElementById("resultBody2")
                         .setInnerFBML(data.fbml_popup);
                 }

                 document.getElementById("resultTitle")
                         .setInnerFBML(data.fbml_title);
                 document.getElementById("resultBody")
                         .setInnerFBML(data.fbml_body);
                 document.getElementById(mastery)
                         .setInnerXHTML("<span>"
                         + data.mastery + "</span>");
                 document.getElementById("playerData")
                         .setInnerXHTML(data.player_stats);
                 document.getElementById(progress)
                         .setStyle("width", data.progress +"%");
                 set_gamma_timer('
                           . $player->gamma_update_rate
                           . ', "gamTimer");
                 if(data.update_map > 0)
                 {
                     document.getElementById("map")
                         .setInnerFBML(data.fbml_map);
                     setPlayerLocation(oldTown, townname, "' . ROOT
                         . IMG_PATH . '/player_icon2.png");
                 }
                 showFactions(townid, ' . $player->userid . ', "mission",
                              townname );
                 document.getElementById(earn)
                         .setInnerXHTML("<span>"
                         + data.earn + "</span>");
             }

             var params={"missionid":missionid, "townid":townid};
             ajax.post(url, params);
         }
        //--></script>';
}
?>