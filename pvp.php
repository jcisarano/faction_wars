<?php
 /**
   * Primary PvP combat page -- displays a list of players you can fight
   * against. Calls a handler to resolve combat, update the database, and 
   * return results.
   *
   * @version 15 September 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         created 15 September 2009
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
 include_once(LIB_PATH . 'display.php');
 require_once(LIB_PATH . 'db_access_player.php');
 require_once(LIB_PATH . 'db_access_pvp.php');
 require_once(LIB_PATH . 'map.class.php');

 $facebook = new Facebook(
                 $facebook_config['api_key'],
                 $facebook_config['secret']);

 $facebook->require_frame();
 $fb_user = $facebook->require_login();

 $db        = new PlayerDatabase;
 $player    = $db->get_player_data($fb_user);
 $inventory = $db->get_player_inventory($fb_user);
 
   //update town ownership status
 include_once(HANDLER_PATH . 'town_ownership_inline.php');

 $pvp = new PvpDatabase;
 $map = new Map;
 $output = '';

   //////////////
   //update number of friends the player has playing the game
   //updates also in team.php
 $player_friends = $facebook->api_client->friends_getAppUsers();
 $db->update_player_friends($player->userid, $player_friends);
 $player_team_list = $db->get_friends($player->userid);
 $player->army_size = count($player_team_list);
 $db->update_player_db($player);
   //////////////end update team size

 /*$output .= '<style>';
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_pvp_style', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_mini_fac_bar.css', true));
 $output .= '</style>';*/

   //include stylesheet
 $output .= '<link rel="stylesheet" media="screen"
        type="text/css" href="' . ROOT . STYLE . 'fw_style.css?v=' 
                                . $js_ver . '" />';
 $output .= '<link rel="stylesheet" media="screen"
        type="text/css" href="' . ROOT . STYLE . 'fw_pvp_style.css?v=' 
                                . $js_ver . '" />';
 $output .= '<link rel="stylesheet" media="screen"
        type="text/css" href="'.ROOT.STYLE.'fw_mini_fac_bar.css?v=' 
                                . $js_ver . '" />';
  
 $output .= addScripts($player);
 $output .= '<script src="' . ROOT . JS_PATH
                            . 'recharge_timer.js?v=' . $js_ver
                            . '"></script>';
 $output .= '<script src="' . ROOT . JS_PATH
                            . 'common.js?v=' . $js_ver . '"></script>';

 $output .= '<div id="fwBody">';
 //$output .= '<div id="banner"></div>';
 $output .= '<div id="playerData">'
         . render_player_data($player) . '</div>';
 //$output .= '<div id="leftCol">leftcol</div>';
 $output .= '<div id="rightColBorderTop"></div>';
 $output .= '<div id="rightCol">';
 $output .= render_nav_bar('Fight');

 $output .= '<div id="loadscreen">Loading...<br />
                  <img src="' . ROOT . IMG_PATH . 'loader64.gif"><br />
                  <input type="submit" class="fwButton" value="Refresh">
                  </div>';

 $output .= '<div id="content"><div id="map">' 
                             . $map->draw_pvp_map($player->userid,
                               $player->faction, $player->level)
            .'</div>';

 //info popup
 $output .= '<a onclick="showPopup(\'pvpItem\');return false;" 
                class="infoLink">More info</a>
            <div id="pvpItem"><div class="helpiteminner">
            <h1>Picking Opponents</h1>
            <p>Each town on the Brawl tab will display a list of potential opponents 
            in that town\'s level range. You can attack any of them by clicking the 
            Attack button next to his or her name. The information next
            to the player\'s name gives you an idea of whether it\'s a fight you can
            win: more difficult individuals typically give better rewards, but if you
            lose, you\'ll also lose health and chips.</p>
            <h1>Your Army</h1>
            <p>Each of your Facebook friends who also plays Faction Wars is considered
            to be a member of your army, and they are essential to your success in
            battle. Each member of your army automatically wields your extra gear and
            abilities to aid you in battle, so if you\'ve accumulated a lot of goods,
            it\'s best to have a large army. Conversely, if your army is larger than
            your pool of equipment, some of them will only be contributing their fists
            to the fight. Invite all of your friends to the game, and make sure you have
            enough weapons, armor, skills, and mutations that everyone has something
            to fight with.</p>
            <h1>Gear</h1>
            <p>When you attack an opponent, your best weapon, offensive skill, and
            offensive mutation are added to your base Offense score to determine success.
            When you are attacked, your best armor, defensive skill, and defensive mutation
            are added to your Defense score to protect you. Any extra gear and abilities
            you own will be wielded by your army to further increase your effective Offense
            and Defense.</p>
            <h1>Owning a Town</h1>
            <p>If you or other members of your faction win enough brawls in a town, you
            will take control, just as if you had completed a lot of missions in the town.
            Check the Factions tab to find out how close your faction is to taking over the 
            town. Once you\'ve brawled your way to success, don\'t forget to check the town 
            again on the Missions tab to see what new missions you\'ve unlocked.</p>
            <a onclick="hidePopup(\'pvpItem\');return false;">Close</a></div></div>';

 $output .= '<h1 id="townName"></h1>';
 $output .= '<div id="facStandingsTitle"></div>';
 $output .= '<h1>Countdown to turnover: <span id="townTimer"
                           style="color:#e5bc75;">00:00</span></h1>';
 $output .= '<div id="facStandings">
             <div id="townOwner"></div>
             <div id="facPanels"></div></div>';

 $output .= '<div id="pvpWheel"><img src="' . ROOT . FAC_IMG_PATH
         . '/FactionRelationships4a.jpg"></div>';

   //fp item offer
   //chooose random item from current offers, display in page
 require_once( LIB_PATH . 'db_access_fp.php');
 $fp_db = new FacPointDatabase;
 $items = $fp_db->get_fp_items();
 $feat_item = $items[rand(0, count($items)-1)];
 $output .= '<div class="pvpItem"><h1>Amp up your brawls</h1>'
    . '<img src="' . ROOT . ITEM_PATH . '/' .$feat_item['image']
    .' " width="64">' . $feat_item['name'] . '<br />'
    . $feat_item['description'] . '<br />'
    . 'Attack: ' . $feat_item['attack_bonus_one'] . '<br />'
    . 'Defense: ' . $feat_item['defense_bonus_one'] . '<br />'
    . '<div>Cost: ' . $feat_item['fp_price'] . ' faction points <br />'
    . '<input type="submit" value="Buy now" class="fwButton"
              onclick="handleFpTransaction(\''
                  . ROOT . HANDLER_PATH . 'fp_trans_handler.php\','
                  . $feat_item['id'] . ', ' . $player->userid . ', '
                  . $player->faction . ', 0, 0, 1 );return false;" />'
    . '<br /><a href="clan.php">See more offers</a>'
    . '</div></div>';
   /////////////////////////////end fp offer

   //request help button
 $output .= '<div class="pvpItem">Need more help? Recruit friends to your 
     team by posting a one-time message to your facebook
     status. <p></p><div><input type="submit" value="Get help" class="fwButton"
     onclick="post();return false;"></div></div>';
   ////////////////////////////end help button

 $output .= '<div id="pvpInfo">'
     . '<table><tr><td><h1>Brawl Standings</h1></td></tr><tr>
             <td>Wins: </td><td>' . $player->fights_won . '</td></tr>'
     . '<tr><td>Losses: </td><td>'
             . $player->fights_lost . '</td></tr>'
     . '<tr><td>Team size:</td><td>' . $player->army_size
             . '</td></tr>'
     . '<tr><td>Deaths:</td><td>'
             . $player->deaths . '</td></tr>'
     . '<tr><td>Kills:</td><td>'
             . $player->kills . '</td></tr>'
     . '</table></div>'; //end pvpInfo

 /*
 $weapons   = 'Your weapons: ';
 $armor     = 'Your armor: ';
 $skills    = 'Your skills: ';
 $mutations = 'Your mutations: ';

 foreach( $inventory as $item )
 {
     if($item['item_type']==WEAPON)
     {

         $weapons .= $item['name'] . ', ';
     }
     else if($item['item_type']==ARMOR)
     {

         $armor .= $item['name'] . ', ';
     }
     else if($item['item_type']==SKILL)
     {
         $skills .= $item['name'] . ', ';
     }
     else if($item['item_type']==MUTATION)
     {
         $mutations .= $item['name'] . ', ';
     }
 }
 $output .= $weapons . '<br />' . $armor . '<br />'
          . $skills. '<br />' . $mutations . '<br /> Army: '
          . $player->army_size . '<br />';
 */

 $output .= '<div class="clearDiv"></div>';
 $output .= '<div id="resultTitle2"></div>';
 $output .= '<div id="resultBody2"></div>';
 $output .= '<div id="resultTitle"></div>';
 $output .= '<div id="resultBody"></div>';
 $output .= '<div id="opponentList">Life in the wasteland is rough--
                 sometimes you have to go all Wayne Brady on your 
                 neighbors. Choose a town to see a list of opponents</div>';
 $output .= '</div></div>'; //end content, rightCol

 $output .= '<div id="footer">';
 $output .= include('footer.php');
 $output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

 $output .= render_timer_script($player);
 
 include( INCLUDE_PATH . 'start_town_inline.php');
  $output .= '<script>var oldTown = "' . $start_town_name . '";
             var currTownId = ' . $start_town_id . ';
             var mapType = "pvp";
             var handlerPath = "' . ROOT . HANDLER_PATH . '";
             var imgPath     = "' . ROOT . IMG_PATH . '";
             showOpponents("' . ROOT . HANDLER_PATH . 'get_opponents.php", '
                              . $start_town_id . ', ' . $player->faction . ', '
                              . $player->userid . ', '
                              . $player->level . ', "' . $start_town_name 
                              . '");';
  //$output .= 'showFactions( 1, ' . $player->userid . ', "pvp",
    //                               "Trailer Park" );';
  $output .= '</script>';
  $output .= render_town_timer_script($count_time);

 echo $output;

 /*
  * Helper function returns FBJS to add to document
  * @return FBJS as plain text
  */
  function addScripts($player)
 {
       /**
         * showOpponents gets a list of opponents from db and updates this
         *  page
         */
     return '<script><!--
                 function handlePvp(url, playerid, opponentid, townid)
                 {
                     showLoadscreen();

                     document.getElementById("resultTitle2")
                             .setInnerXHTML("<span> </span>");
                     document.getElementById("resultBody2")
                             .setInnerXHTML("<span> </span>");
                     document.getElementById("resultTitle")
                             .setInnerXHTML("<span> </span>");
                     document.getElementById("resultBody")
                             .setInnerXHTML("<span> </span>");

                     var ajax = new Ajax();
                     ajax.responseType = Ajax.JSON;
                     ajax.requireLogin = 1;

                     ajax.ondone = function(data) {
                         hideLoadscreen();
                         document.getElementById("resultTitle")
                                 .setInnerFBML(data.fbml_title);
                         document.getElementById("resultBody")
                                 .setInnerFBML(data.fbml_body);
                         document.getElementById("playerData")
                                 . setInnerXHTML(data.playerstats);
                         set_stam_timer('
                                 . $player->stam_update_rate
                                 . ', "stamTimer");
                         showOpponents("' . ROOT . HANDLER_PATH
                                                 . 'get_opponents.php", '
                            . 'townid, ' . $player->faction
                            . ', ' . $player->userid
                            . ', ' . $player->level
                            . ', oldTown'
                            .  ' );
                         if(data.popuptitle != "" )
                         {
                             document.getElementById("resultTitle2")
                                 .setInnerXHTML(
                                     "<h1>" + data.popuptitle + "</h1>");
                             document.getElementById("resultBody2")
                                 .setInnerFBML(data.fbml_popup);
                         }
                         if(data.update_map > 0)
                         {
                             document.getElementById("map")
                                 .setInnerFBML(data.fbml_map);
                             setPlayerLocation(oldTown, townname, "' . ROOT
                                 . IMG_PATH . '/player_icon2.png");
                         }
                         showFactions( townid, '
                                       . $player->userid . ', "pvp",
                                       "Trailer Park" );
                     }

                     var params ={"player_id": playerid,
                                  "opponent_id": opponentid,
                                  "town_id": townid};
                     ajax.post(url, params);
                 }

                 function showOpponents(url, townid, playerFac,
                                        userid, playerLevel, townname)
                 {
                     showLoadscreen();

                     var ajax = new Ajax();
                     ajax.responseType = Ajax.FBML;
                     ajax.requireLogin = 1;

                     ajax.ondone = function(data) {
                         hideLoadscreen();
                         document.getElementById( "opponentList" )
                                 .setInnerFBML(data);
                         document.getElementById("townName")
                                 .setInnerXHTML("<span>" + townname + "</span>");
                         setPlayerLocation(oldTown, townname, "' . ROOT
                                 . IMG_PATH . '/player_icon2.png");
                         oldTown = townname;
                         showFactions( townid, '
                                       . $player->userid . ', "pvp",
                                       "Trailer Park" );

                     }
                     var params ={"townid": townid,
                                  "p_faction":playerFac,
                                  "player_id": userid,
                                  "player_level": playerLevel};
                     ajax.post(url, params);
                 }
            //--></script>';
 }
?>