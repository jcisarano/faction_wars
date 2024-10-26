<?php
/**
* Primary page for crafting items.
*
* @version 11 December 2009
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 11 December 2009
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

require_once(FB_PATH . 'facebook.php');
require_once(LIB_PATH . 'display.php');
require_once LIB_PATH . 'map.class.php';
require_once LIB_PATH . 'db_access_player.php';

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$facebook->require_frame();
$fb_user = $facebook->require_login();

$db = new PlayerDatabase;
$player = $db->get_player_data($fb_user);
$output = '';

  //update town ownership status
include_once(HANDLER_PATH . 'town_ownership_inline.php');
/*
 $output .= '<style>';
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_mish_style.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_mini_fac_bar.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_recipe_style.css', true));
 $output .= '</style>';
*/

  //include stylesheet
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_recipe_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_mish_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
    type="text/css" href="'.ROOT.STYLE.'fw_mini_fac_bar.css?v=' . $js_ver . '" />';


$output .= add_scripts($player);
$output .= '<script src="'. ROOT . JS_PATH
                       . 'recharge_timer.js?v=' . $js_ver . '"></script>';
$output .= '<script src="'. ROOT . JS_PATH
                       . 'common.js?v=' . $js_ver . '"></script>';

$output .= '<div id="fwBody">';
//$output .= '<div id="banner"></div>';

$output .= '<div id="playerData">' . render_player_data($player) . '</div>';
//$output .= '<div id="leftCol">leftcol</div>';

$output .= '<div id="rightColBorderTop"></div>';
$output .= '<div id="rightCol">';

$output .= render_nav_bar('Crafting');

$output .= '<div id="loadscreen">Loading...<br />
              <img src="' . ROOT . IMG_PATH . 'loader64.gif"><br />
              <input type="submit" class="fwButton" value="Refresh">
              </div>';

$map = new Map;
$output .= '<div id="content"><div id="map">' . $map->draw_crafting_map( $player->faction,
                                                       $player->level )
        .'</div>';
$output .= '<h1 id="townName"></h1>';
$output .= '<div id="facStandingsTitle"></div>';
$output .= '<h1>Countdown to turnover: <span id="townTimer"
                          style="color:#e5bc75;">00:00</span></h1>';
$output .= '<div id="facStandings">
            <div id="townOwner"></div>
            <div id="facPanels"></div></div>';

$output .= '<div id="resultTitle2"></div>';
$output .= '<div id="resultBody2"></div>';
$output .= '<div id="resultTitle"></div>';
$output .= '<div id="resultBody"></div>';
$output .= '<div id="recipeList"></div>';

$output .= '</div></div>'; //end content, rightCol
$output .= '<div id="footer">';
$output .= include('footer.php');
$output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

$output .= render_timer_script($player);

include( INCLUDE_PATH . 'start_town_inline.php');
$output .= '<script>showRecipes("' . ROOT . HANDLER_PATH . 'get_recipes.php", '
                                . $start_town_id . ', "' 
                                . $start_town_name . '"'
                                . ');'
                                . 'var oldTown = "' . $start_town_name . '";
                                   var currTownId = ' . $start_town_id . ';
                                   var mapType = "crafting";
                                   var handlerPath = "' . ROOT
                                                        . HANDLER_PATH . '";
                                   var imgPath     = "' . ROOT
                                                        . IMG_PATH
                                                        . '";';
//$output .= 'showFactions( ' . $start_town_id . ', '
  //                          . $player->userid . ', "crafting",
    //                        "' . $start_town_name . '" );';
$output .= '</script>';
$output .= render_town_timer_script($count_time);

echo $output;

function add_scripts($player)
{
    return '<script><!--
             function showRecipes(url, townid, townname)
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
                     document.getElementById( "recipeList" )
                             .setInnerFBML(data);
                     document.getElementById("townName")
                             .setInnerXHTML("<span>" + townname + "</span>");
                     setPlayerLocation(oldTown, townname, "' . ROOT
                             . IMG_PATH . '/player_icon2.png");
                     oldTown = townname;
                     currTownId = townid;
                     showFactions( townid, ' . $player->userid . ', "crafting",
                                   townname );
                 }
                 var params ={"townid": townid, "p_id": "'
                     . $player->userid . '"};

                 ajax.post(url, params);
             }

             function craftItem(url, playerid, missionid, townid)
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
                     document.getElementById("playerData")
                             .setInnerXHTML(data.player_stats);
                     set_stam_timer('
                             . $player->stam_update_rate
                             . ', "stamTimer");
                     showFactions( townid, ' . $player->userid . ', "crafting",
                                   townname );

                 }
                 var params={"playerid": playerid,
                             "missionid": missionid,
                             "townid": townid };
                 ajax.post(url, params);
             }
           //--></script>';
}
?>