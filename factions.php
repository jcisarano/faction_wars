<?php
 /**
   * Faction page for FE faction wars.
   * Displays sector map with towns and allows players to access
   * information on which faction leads those towns.
   *
   * @version 31 August 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         created 31 August 2009
   *         rework to support separated return info from get_factions
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
 
   //update town ownership status
 include_once(HANDLER_PATH . 'town_ownership_inline.php');
 $output .= '<style>';
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_fac_style.css', true));
 $output .= '</style>';
/* $output .= '<link rel="stylesheet" media="screen"
        type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
 $output .= '<link rel="stylesheet" media="screen"
        type="text/css" href="'.ROOT.STYLE.'fw_fac_style.css?v=' . $js_ver
                                                                 . '" />';
 */
 $output .= addScripts($player);
 $output .= '<script src="'. ROOT . JS_PATH
                           . 'recharge_timer.js?v=' . $js_ver . '"></script>';
 $output .= '<script src="'. ROOT . JS_PATH
                           . 'common.js?v=' . $js_ver . '"></script>';
 $output .= '<div id="fwBody">';
 //$output .= '<div id="banner"></div>';
 $output .= '<div id="playerData">'
         . render_player_data($player) . '</div>';
 
 //$output .= '<div id="leftCol">leftcol</div>';
 $output .= '<div id="rightColBorderTop"></div>';
 $output .= '<div id="rightCol">';
 $output .= render_nav_bar('Factions', 'Towns');
 
 $output .= '<div id="content"><div id="map">'
         . $map->draw_faction_map($player->faction)
         . '</div>';
 $output .= '<a onclick="showPopup(\'pvpItem\');return false;"
                class="infoLink">More info</a>
            <div id="pvpItem"><div class="helpiteminner">
            <h1>Owning a Town</h1>
            ' .ROOT . JS_PATH. '
            <p>Owning a town unlocks better missions for members of the 
            owning faction and its allies. Run missions within the town or 
            win brawls with other players in the town to increase your 
            faction\'s control. Once a faction gains enough control, they
            take the town and all faction control is set back to zero. The 
            owning faction cannot gain control on the town, so ownership 
            will inevitably switch to the next most active faction.</p>
        <a onclick="hidePopup(\'pvpItem\');return false;">Close</a></div></div>';

 $output .= '<h1 id="townName"></h1>';
 $output .= '<div id="facStandingsTitle"></div>';
 $output .= '<h1>Countdown to turnover: <span id="townTimer"
                           style="color:#e5bc75;">00:00</span></h1>';
 $output .= '<div id="facStandings">

             <div id="facPanels"></div></div>';

 $output .= '<div id="townInfo">Click on a town to see its stats.</div>';

 $output .= '</div></div>'; //end content, rightCol
 $output .= '<div id="footer">';
 $output .= include('footer.php');
 $output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

 $output .= render_timer_script($player);

 include( INCLUDE_PATH . 'start_town_inline.php');
 $output .= '<script>var oldTown = "' . $start_town_name . '";
                     var currTownId = ' . $start_town_id . ';
                     var mapType = "faction";
                     var handlerPath = "' . ROOT . HANDLER_PATH . '";
                     var imgPath     = "' . ROOT . IMG_PATH . '";';
                     /*showFactions( ' . $start_town_id . ', '
                                     . $player->userid
                                     . ', "faction", "' . $start_town_name
                                                        . '" );  */
 $output .= 'showTownInfo("' . ROOT . HANDLER_PATH
                                    . 'get_factions.php",
                                   ' . $start_town_id . ', '
                                     . $player->faction
                                     . ', "' . $start_town_name 
                                     . '");</script>';
 echo $output;

 /*
  * Helper function returns FBJS to add to document
  * @return FBJS as plain text
  */
 function addScripts($player)
 {
       /**
         */
     return '<script><!--
                 function showTownInfo(url, townid, playerFaction, townname)
                 {
                     showLoadscreen();
                     var ajax = new Ajax();
                     ajax.responseType = Ajax.JSON;
                     ajax.requireLogin = 1;
                     ajax.ondone = function(data) {
                         hideLoadscreen();
                         document.getElementById("townInfo")
                                 .setInnerXHTML(data.town_info);
                         document.getElementById("map")
                                 .setInnerFBML(data.fbml_map);
                         document.getElementById("townName")
                                 .setInnerXHTML("<span>" + townname + "</span>");

                         setPlayerLocation(oldTown, townname, "' . ROOT
                                 . IMG_PATH . '/player_icon2.png");
                         oldTown = townname;
                         currTownId = townid;
                         showFactions( townid, '
                                     . $player->userid 
                                     . ', "faction", townname );
                     }
                     var params={"townid":townid, 
                                 "p_faction":playerFaction};
                     ajax.post(url, params);
                 }
            //--></script>';
 }
       
?>