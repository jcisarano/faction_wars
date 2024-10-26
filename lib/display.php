<?php
 /**
   * Display elements common to multiple pages in Faction Wars
   *
   * @version 11 October 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         created 25 August 2009
   *         levelup and faction popups 11 October 2009
   */
 require_once 'config.php';
 //require_once 'db_access.php';

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

 /**
   * Add markup to player data for display
   * @param $player Player to display
   * @return XHTML for display
   */
 function render_player_data($player)
 {
     $pd = '<div><div id="pdBorderTop">Level ' . $player->level
               . ' ' . $player->faction_name  . '</div>';
     $pd .= '<div id="pdBody">';
     $pd .= '<table>';
     $pd .= '<tr><td class="label">Experience: </td><td class="stat">'
            . number_format($player->current_xp) . '/'
            . number_format($player->xp_to_level) . '</td><td></td></tr>';
     $pd .= '<tr><td class="label">Gamma: </td><td class="stat">'
            . number_format($player->current_gamma) 
            . '/' . number_format($player->max_gamma)
            . '</td><td class="timer"><span id="gamTimer"></span></td></tr>';
     $pd .= '<tr><td class="label">Stamina: </td><td class="stat">' 
            . number_format($player->current_stamina)
            . '/' . number_format($player->max_stamina) . '</td><td class="timer">
            <span id="stamTimer"></span></td></tr>';
     $pd .= '<tr><td class="label">Chips: </td><td class="stat">'
            . number_format($player->chips) . '</td><td></td></tr>';
     $pd .= '<tr><td class="label">Health: </td><td class="stat">'
            . number_format($player->current_health) . '/' 
            . number_format($player->max_health)
            .  '</td><td  class="timer"><span id="healthTimer"></span></td>
            </tr>';
     $pd .= '</table>';
     $pd .= '</div>';
     $pd .= '<div id="pdBorderBottom"></div></div>';

     return $pd;
 }

 /**
   * Navigation bar for display at top of each page
   * @param $selected Currently displayed page
   * @return XHTML to display
   */
 function render_nav_bar($selected='Home', $selected2='')
 {
     $navbar = '<div id="navBar"><div><ul id="menuItems">';

     if($selected=='Home')
     {
         //$navbar .= '<li>Home</li>';
         $navbar .= '<li><a href="index.php">Home</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="index.php">Home</a></li>';
     }

     if($selected=='Missions')
     {
         //$navbar .= '<li>Missions</li>';
         $navbar .= '<li><a href="missions.php">Missions</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="missions.php">Missions</a></li>';
     }

     if($selected=='Factions')
     {
         $navbar .= '<li>Factions<ul>';
     }
     else
     {
         $navbar .= '<li>Factions<ul>';
     }
     if($selected2=='Towns')
     {
         //$navbar .= '<li>Towns</li>';
         $navbar .= '<li><a href="factions.php">Towns</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="factions.php">Towns</a></li>';
     }
     if($selected2=='Vault')
     {
         //$navbar .= '<li>Vault</li>';
         $navbar .= '<li><a href="clan.php">Vault</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="clan.php">Vault</a></li>';
     }
     if($selected2=='Clan')
     {
         //$navbar .= '<li>Clan</li>';
         $navbar .= '<li><a href="team.php">Clan</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="team.php">Clan</a></li>';
     }
     $navbar .= '</ul></li>';

     if($selected=='Crafting')
     {
         //$navbar .= '<li>Crafting</li>';
         $navbar .= '<li><a href="crafting.php">Crafting</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="crafting.php">Crafting</a></li>';
     }
     
     if($selected=='Boss')
     {
         //$navbar .= '<li>Boss</li>';
         $navbar .= '<li><a href="boss.php">Boss</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="boss.php">Boss</a></li>';
     }

     if($selected=='Merchant')
     {
         //$navbar .= '<li>Merchant</li>';
         $navbar .= '<li><a href="merchant.php">Merchant</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="merchant.php">Merchant</a></li>';
     }

     if($selected=='Fight')
     {
         //$navbar .= '<li>Brawl</li>';
         $navbar .= '<li><a href="pvp.php">Brawl</a></li>';
     }
     else
     {
         $navbar .= '<li><a href="pvp.php">Brawl</a></li>';
     }

     $navbar .= '</ul></div></div>';

     $navbar .= '<div id="loadscreen">Loading...<br />
                <img src="' . ROOT . IMG_PATH . 'loader64.gif"><br />
                <input type="submit" class="fwButton" value="Refresh">
                </div>';

     return $navbar;
 }

 /**
   * Script that checks status of player's gamma and stamina and generates
   * necessary scripts for inclusion in canvas pages
   *
   * @param $player current player info as player object
   * @return XHTML/FBML ready for inclusion in canvas page
   */
 function render_timer_script($player)
 {
       //determine if any stats need timers
       //gamma
     $currTime = time();
     $scr = '<script>
                 <!--
                 var playerid=' . $player->userid .';
                 statHandler="' . ROOT . HANDLER_PATH . 'stat_update_handler.php";';
     if($player->current_gamma < $player->max_gamma) //gamma not full
     {
         $g_time = $player->gamma_update_time + $player->gamma_update_rate
                    - $currTime;
         $scr .= 'set_gamma_timer(' . $g_time
                                          . ', "gamTimer");';
     }
       //stamina
     if($player->current_stamina < $player->max_stamina) //gamma not full
     {
         $s_time = $player->stam_update_time + $player->stam_update_rate
                    - $currTime;
         $scr .= 'set_stam_timer(' . $s_time
                                          . ', "stamTimer");';
     }
     
     if($player->current_health < $player->max_health) //health not full
     {
         $h_time = $player->health_update_time + $player->health_update_rate
                   - $currTime;
         $scr .= 'set_health_timer(' . $h_time .', "healthTimer");';
     }

     $scr .= '
                 //-->
                 </script>';
     return $scr;
 }
 
 /**
   * @param $time Where to start the count
   */
 function render_town_timer_script($time)
 {
     $scr = '<script>
              <!--
              set_town_timer(' . $time . ', "townTimer" );'
              . '
                 //-->
                 </script>';
     return $scr;
 }
 
 /**
   * Converts seconds to min:seconds format
   *
   * @param $time num seconds to convert
   * @return string in min:sec format w/ leading zeroes on seconds, e.g:
   *         4:08
   */
 function format_time($time)
 {
       //create output
     $min = floor( $time / 60);
     $sec = $time % 60;
     if ($sec < 10)
     {
         $sec = "0" . $sec;
     }
     return $min . ':' . $sec;
 }
 
 /**
   * Turn seconds into hh:mm:ss format
   *
   * @param $seconds
   * @return string in hh:mm:ss format
   */
 function format_time_2($seconds)
 {
     $sec  = $seconds %60;
     $min  = (($seconds - $sec) /60) %60;
     $hour = floor( $seconds / (60 * 60) );

     if ($sec < 10)
     {
         $sec = "0" . $sec;
     }
     if ($min < 10)
     {
         $min = "0" . $min;
     }
     if ($hour < 10)
     {
         $hour = "0" . $hour;
     }

     return $hour . ':' . $min . ':' . $sec;
 }
 
 /**
   * Creates output for levelup popup
   *
   * @param $player
   * @return XHTML for inclusion in page
   */
 function render_levelup_notice($player)
 {
     return //'<div id="levelupNotice">'
        '<img src="' . ROOT . GEN_PATH . '/levelup.jpg"/>
          <div class="mishText">You have been promoted to level '
           . $player->level . '.</div>'
        . '<div class="mishText">You earned ' . AP_REW
                . ' achievement points and '
                . FAC_REW . ' faction points.
                <br /><a href="' . ROOT . '/home.php">Use your AP to 
                improve your character\'s stats.</a>
                <br /><a href="' . ROOT . '/clan.php">Spend faction 
                points for special perks.</a></div>';
 }

 /**
   * HTML output for earning achievement
   * @param achievement
   */
 function render_achievement_notice($achievement)
 {
     return '<img src="' . ROOT . ACH_IMG_PATH . '/medal_star_small.jpg"/>'
                 . '<div class="mishText">You earned the '
                         . $achievement['name']
                 . ' achievement along with ' . $achievement['ap']
                 . ' achievement points and ' . $achievement['fp']
                 . ' faction points.</div>';
 }

/*
 * Builds navigation using page numbers as links
 *
 * @param $totalPages total num of pages in range 0-x
 * @param $currPage current page number in range 0-x
 * @param $link Target url used by all links
 * @return navigation as HTML wrapped in <div id="pageNav">
 */
function pageNav($totalPages, $currPage, $link)
{
     $nav = '<div id="pageNav">';
     if($totalPages <=1) //no nav needed
     {
         return $nav . '</div>';
     }

     for ($index = 0; $index < $totalPages; $index += 1)
     {
          if( $index == $currPage)
          {
               $nav .= ($index+1) . ' ';
          }
          else
          {
               $nav .= '<a href="';
               $nav .= $link;
               $nav .= '?page=';
               $nav .= $index;
               $nav .= '">';
               $nav .= ($index+1) . ' </a>';
          }
     }
     $nav .= '</div>';
     return $nav;
 }


?>