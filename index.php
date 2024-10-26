<?php
 /**
   * Welcome page for FE faction wars. Displays character info, game info,
   * and achievements.
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
     $js_ver=VERSION;
 }

 require_once(LIB_PATH . 'player.class.php');
 require_once(FB_PATH  . 'facebook.php');
 include_once(LIB_PATH . 'display.php');
 require_once LIB_PATH . 'db_access_player.php';
 require_once(LIB_PATH . 'db_access_achievement.php');

 $facebook = new Facebook(
                 $facebook_config['api_key'],
                 $facebook_config['secret']);

 $facebook->require_frame(); //make sure we're in a facebook context
 $fb_user = $facebook->require_login(); //make sure player is logged in

 $db = new PlayerDatabase;
 $achieve_db = new AchievementDatabase;
 $output = '';

   //looks for data from character creation form
   //processes data if found
 if(isset($_POST['faction']))
 {
     //get vals from post,
     $n_fac  = $_POST['faction'];
     $n_name = $_POST['charName'];
     $db->create_new_user($fb_user, $n_name, $n_fac);
 }

 $player = $db->get_player_data($fb_user);

 $app_users = $facebook->api_client->friends_getAppUsers();
 $player->army_size = count($app_users);
 $db->update_player_db($player); //save army size

 /*$output .= '<style>';
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
  $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_char_style', true));
  $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_achieve_style.css', true));
 //include 'http://facebook.fallenearth.com/faction_wars/css/fw_style.css';
 $output .= '</style>'; */

   //include stylesheets
 $output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
 $output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_char_style.css?v=' . $js_ver . '" />';
 $output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_achieve_style.css?v=' . $js_ver . '" />';
 

 $output .= add_scripts();
 $output .= '<script src="'. ROOT . JS_PATH
                           . 'recharge_timer.js?v=' . $js_ver. '"></script>';
 $output .= '<script src="'. ROOT . JS_PATH
                           . 'common.js?v=' . $js_ver. '"></script>';
 $output .= '<div id="fwBody">';
 //include('fbPosts.php');
 //include_once(HANDLER_PATH . 'banner.php');

  //determine what to display
 if($player->faction==null || $player->faction==0 || $player->faction=='')
 {
       //if no datein set, then only default data is available in db
       //display form to choose faction, set name
     $output .= '<div id="playerData">'
             . render_player_data($player) . '</div>';
     //$output .= '<div id="leftCol">leftcol</div>';
     $output .= '<div id="rightColBorderTop"></div>';
     $output .= '<div id="rightCol">';
     $output .= create_character();
 }
 else
 {
       //normal display with character information
     $output .= '<div id="playerData">'
                . render_player_data($player) . '</div>';
     //$output .= '<div id="leftCol">leftcol</div>';

     $output .= '<div id="rightColBorderTop"></div>';
     $output .= '<div id="rightCol">';

     $output .= render_nav_bar();

     $output .= '<div id="content"><h1>' . $player->name . ' - Level '
            . $player->level . ' - ' . $player->faction_name . '</h1>';
       //fp item offer
       //chooose random item from current offers, display in page
     require_once( LIB_PATH . 'db_access_fp.php');
     $fp_db = new FacPointDatabase;
     $items = $fp_db->get_fp_items();
     $feat_item = $items[rand(0, count($items)-1)];
     $output .= '<div id="featItem"><h1>Rare combat item</h1>'
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

       //message panel
     require_once( LIB_PATH . 'db_access_message.php');
     $message_db = new MessageDatabase;
     $messages = $message_db->get_received_messages($player->userid);

     $output .= '<div id="messageFrame"><h1>Your message queue</h1>
                      <div id ="messagePanel">';
     if($messages)
     {
         foreach($messages as $message)
         {
             $output .= '-' . $message_db->parse_message($message) 
                     . '<br />~~~<br />';
         }
     }
     else
     {
         $output .= 'No messages currently incoming.';
     }
     $output .= '</div></div>';
     /////////////////////////////end message panel
     
     
     $output .= '<div class="fullWidthPanel"><fb:prompt-permission 
                               perms="email">Defend yourself! Let Faction Wars 
                               email you when a friend sends you a gift . . . 
                               or an enemy attacks!</fb:prompt-permission>
                               </div>';

     //$output .= include('bookmark.php');
     $output .= character_data($player);
     $output .= stat_update($player);

       //build achievement output
     $achievements = $achieve_db->get_player_achievements($player->userid);
     $output .= '<div id="achievementList"><h1>Achievements</h1>
                      <a onclick="showPopup(\'achItem\'); return false;" 
                         class="infoLink" class="infoLink">More info</a>';
     $output .= '<div id="achItem"><div class="helpiteminner">
                  <h1>Achievements</h1>
                  <p>Achievements are unlocked when you hit certain milestones 
                  in the game, such as 15 victories against a specific faction 
                  or earning 100,000 chips. When you unlock an achievement, you 
                  will get AP and be able to share it with your friends.</p>
                  <a onclick="hidePopup(\'achItem\');return false;">Close</a>
              </div></div>';

     foreach($achievements as $achievement)
     {
         //$output .= '<hr />';
         if($achievement->achieved)
         {
             $output .= '<div class="achievement">'
                 . '<img src="' . ROOT
                               . ACH_IMG_PATH . $achievement->image . '"/>'
                 . '<h1>' . $achievement->name .   '</h1>'
                 . '<p>' . $achievement->description . '</p>'
                 . '</div>';
         }
         else
         {
             $output .= '<div class="achievement">'

                 . '<img src="' . ROOT
                               . ACH_IMG_PATH . '/test.jpg"/>'
                 . '<h1>' . $achievement->name .   '</h1>'
                 . '<p>' . $achievement->description . ' -- LOCKED</p>'
                 . '</div>';
         }
     }
     $output .= '</div>';
 }

 $output .= '</div></div>'; //end content, rightCol
 $output .= '<div id="footer">';
 $output .= include('footer.php');
 $output .= '</div><div id="borderFrameBottom"></div>';
 $output .= '</div>'; //end warBody

 $output .= render_timer_script($player);

 echo $output;

   //special display uses form to pick faction and set character name
 function create_character()
 {
     include_once(LIB_PATH . 'db_access_faction.php');
     $fac_db = new FactionDatabase;
     $factions = $fac_db->get_faction_info();

     $char_form = '<form action="index.php" method="POST">'
                . '<div class="title">First, choose a faction:</div>';
                foreach($factions as $faction)
                {
                    $char_form .= '<div class="pickFaction">'
                        . '<img src="' . ROOT
                                       . FAC_IMG_PATH
                                       . $faction->image
                                       . '" width="150px">'
                        . '<div class="factionName"><input type="radio"
                                        name="faction" value="'
                                        . $faction->id . '"';
                                        if(!$checked)
                                        {
                                            $checked = true;
                                            $char_form .= ' CHECKED ';
                                        }
                        $char_form .= '>'
                        . '<span>' . $faction->faction . '</span></div>'
                        . '<p>' . $faction->description . '</p>'
                        . '<p>' . $faction->description_2 . '</p>'
                        . '</div>';
                }
     $char_form .= '<div class="clearDiv"></div>'
                .'<div class="title">Next, choose your character\'s name:</div>
                   <input type="text" name="charName" id="nameField" />';

     $char_form .= '<div class="title">And when you\'re ready,
                   click to continue!</div><input type="submit"
                   value="Create" id="fwButton" />'
                .'</form>';

     return $char_form;
 }

   //format player data for output to screen
 function character_data($player)
 {
     $display = '<div id="clanInfo"><h1>Team</h1>'
         . 'You have ' . $player->army_size . ' clan members.
            Adding members means increased chances of surviving a brawl.'
         . '<form method="link" action="team.php">'
         . '<input type="submit" value="Grow your clan" class="fwButton"/>'
         . '<input type="submit" value="Send gifts to clan members"
                   class="fwButton"/></form>'
         . '</div>'; //end clanInfo

     $display .= '<div id="pvpInfo"><h1>Brawl Standings</h1>'
         . '<table><tr><td>Brawls won:</td><td>'
                 . $player->fights_won . '</td></tr>'
         . '<tr><td>Brawls lost:</td><td>'
                 . $player->fights_lost . '</td></tr>'
                 . '<tr><td>Deaths:</td><td>'
                 . $player->deaths . '</td></tr>'
                 . '<tr><td>Kills:</td><td>'
                 . $player->kills . '</td></tr>'
         . '</table></div>'; //end pvpInfo

     return $display;
 }

 function stat_update($player)
 {
        //ap increase table
     $update = '<div id="stats">';

     if($player->achieve_points > 0)
     {
         $update .= '<h1>You have <span id="gam_pt">' . $player->achieve_points
                           . '</span> achievement points. Spend 1
                           AP to improve a stat.</h1>';
     }
     else
     {
         $update .= '<p>Earn achievement points and spend them to improve your
                 stats. </p>';
     }

     $update .= '<table id="charSheet">'
         // . '<tr><th>Stat</th><th>Value</th><th></th><th id="descCol">Description</th></tr>'
         . '<tr><td class="label">Gamma: </td><td class="statCol">
               <span id="gamma_boost">' . $player->max_gamma . '</span></td>'
               . ap_button($player, 'gamma', 'gamma_boost') . '<td>Gamma
                 determines how many missions you can undertake before you
                 need to rest.</td></tr>'
         . '<tr><td class="label">Stamina: </td><td class="statCol">
               <span id="stamina_boost">' . $player->max_stamina . '</span></td>'
               . ap_button($player, 'stamina', 'stamina_boost') . '<td>The more
                 Stamina you have, the more frequently you can engage opponents 
                 in one-on-one brawls.</td></tr>'
         . '<tr><td class="label">Health:</td><td class="statCol">
               <span id="health_boost">' . $player->max_health . '</span></td>'
               . ap_button($player, 'health', 'health_boost') . '<td>How much
                 damage you can sustain in brawls before you\'re out of the fight.
                 </td></tr>'
         . '<tr><td class="label">Offense: </td><td class="statCol">
               <span id="attack_boost">' . $player->attack . '</span></td>'
               . ap_button($player, 'attack', 'attack_boost') . '<td>The higher
                 your Offense ability, the more likely you are to win a fight
                 you start.</td></tr>'
         . '<tr><td class="label">Defense: </td><td class="statCol">
               <span id="defense_boost">' . $player->defense . '</span></td>'
               . ap_button($player, 'defense', 'defense_boost') . '<td>A high
                 Defense ability helps you win brawls you didn\'t start.
                 </td></tr>'
         .'</table>
           <p style="text-align:center;"><a href="clan.php">Spend faction 
                                points to get achievement points</a></p>
           <a onclick="showPopup(\'apItem\');return false;"
                      class="infoLink">More info</a>
           <div id="apItem"><div class="helpiteminner">
                  <h1>Achievement Points</h1>
                  <p>Earn Achievement Points (APs) to improve your character in
                  Fallen Earth: Faction Wars. You gain APs from leveling up,
                  mastering missions, upgrading abilities, earning achievements,
                  and spending faction points. Each AP can be spent to
                  permanently improve your Gamma, Stamina, Hit Points, Offense,
                  or Defense on a one-for-one basis. Customize your character to
                  take advantage of your favorite parts of the game.</p>
                  <a onclick="hidePopup(\'apItem\');return false;">Close</a>
           </div></div>
           </div>';

     return $update;
 }

 /**
   * Looks at player's AP and generates appropriate code for increase button.
   *
   * @param $player player object
   * @param $type Type of button to make: gamma, stamina,
                                          health, attack, defense
   * @return html markup for "increase" button of appropriate type
   */
 function ap_button($player, $type, $node)
 {
     $increase = '';
     if( $player->achieve_points >= 1)
     {
         $increase .= '<td><span class=\'ap_button\'>'
                   . '<a href="#" onclick="buyStat(\''
                                  . ROOT . HANDLER_PATH
                                  . 'stat_purchase_handler.php\', '
                                  . $player->userid . ', \''
                                  . $type . '\', 1, \''
                                  . $node . '\', '
                                  . '\'gam_pt\' );return false;">Increase!'
                                  //. $type . '</a>!'
                                  . '</a>'
                   . '</span></td>';
     }
     else
     {
         $increase = '<td> </td> ';
     }
     return $increase;
 }

 function add_scripts()
 {   /**
       * buyStat
       * @param url path to handler
       * @param playerid player's facebook id
       * @param type what kind of transaction are we doing
       * @param amount how many points to add (usually 1)
       * @param s_node id of stat element for update
       * @param p_node id of faction/achieve point element for update
       */
     return '<script><!--
                 function removeButtons()
                 {


                 }

                 function buyStat(url, playerid, type,
                                       amount, s_node, p_node)
                 {
                     var ajax = new Ajax();

                     ajax.responseType = Ajax.JSON;
                     ajax.requireLogin = 1;

                     ajax.ondone = function(data) {
                         document . getElementById(s_node)
                                  . setInnerXHTML("<span>" + data.newval
                                                           + "</span>");
                         document . getElementById(p_node)
                                  . setInnerXHTML("<span>" + data.pointsleft
                                                           + "</span>");
                         document . getElementById("playerData")
                                  . setInnerXHTML(data.playerstats);

                           //no more points left, remove buttons
                         if(parseInt(data.pointsleft) < 1)
                         {
                             var class = "";
                               //first, figure out what class name to use
                             if(type=="gamma" || type=="stamina" ||type=="health" ||
                                type=="attack" ||type=="defense")
                             {
                                 class = "ap_button";
    
                             }
                             else if(type=="g_rech" || type=="s_rech")
                             {
                                 class = "fp_button";
                             }

                               //then find all those items
                             var buttons = [];
                             buttons = document.getRootElement().getElementsByTagName("*");

                             for(i=0; i<buttons.length; i++)
                             {
                                 if(buttons[i].getClassName()==class)
                                 {
                                     //and remove everthing inside the spans
                                     buttons[i].setStyle("display", "none");
    
                                 }
                             }
                         }
                     }
                     var params ={"playerid": playerid,
                                  "type": type,
                                  "amount": amount};
                     ajax.post(url, params);

                 }


                 //--></script>';
 }
?>