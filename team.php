<?php
/**
* Team management page. View roster, send invites here.
*
* @version 26 October 2009
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 26 October 2009
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
require_once LIB_PATH . 'db_access.php';

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$facebook->require_frame();
$fb_user = $facebook->require_login();

$player_db = new PlayerDatabase;
$player = $player_db->get_player_data($fb_user);

$db = new DatabaseAccess;
$output = '';

  //////////////
  //update number of friends the player has playing the game
  //updates also in pvp.php
$player_friends = $facebook->api_client->friends_getAppUsers();
$player_db->update_player_friends($player->userid, $player_friends);
$player_team_list = $player_db->get_friends($player->userid);
$player->army_size = count($player_team_list);
$player_db->update_player_db($player);
  //////////////end update team size

//$app_users = $facebook->api_client->friends_getAppUsers();
/*
 $output .= '<style>';
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
 $output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_team_style.css', true));
 $output .= '</style>';
*/
//include stylesheet
$output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_team_style.css?v=' . $js_ver . '" />';


//most fbjs includes
$output .= add_scripts($player);
$output .= '<script src="'. ROOT . JS_PATH
                       . 'recharge_timer.js?v=' . $js_ver . '"></script>';
$output .= '<script src="'. ROOT . JS_PATH
                       . 'common.js?' .$js_ver . '"></script>';

$output .= '<div id="fwBody">';

$output .= '<div id="playerData">' . render_player_data($player) . '</div>';

$output .= '<div id="rightColBorderTop"></div>';
$output .= '<div id="rightCol">';
$output .= render_nav_bar('Factions', 'Clan');
$output .= '<div id="content">';
$output .= include('invite.php');

$output .= include( INCLUDE_PATH . '/free_gift_inline.php');

//frame used for gift output
$output .= '<div id="giftFrame"><div id="resultTitle"></div>';
$output .= '<div id="resultBody"></div></div>';

$output .= '<div id="team"><h1>Your clan - ' . $player->army_size
                                             . ' members</h1>';

//help info
$output .= '<a onclick="showPopup(\'teamItem\');return false;"
               class="infoLink">More info</a>
           <div id="teamItem"><div class="helpiteminner">
           <h1>Build a Clan</h1>
           <p>Your clan serves as your army for brawls, and you can help each
           other out by sending gifts. The more clan mates you have, the more
           effective you\'ll be in Fallen Earth: Faction Wars. So go ahead and
           invite any friends you think might want to play.</p>
           <h1>Gifts</h1>
           <p>You can give equipment to your clan mates. Select the friend
           you want to send the gift to, select an item, and click the Send
           Gift button. One item of that type will be sent to your ally.</p>
           <a onclick="hidePopup(\'teamItem\');return false;">Close</a></div></div>';

//page flipping code for player friends list
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
    $exclude_list = ''; //exclude list used to avoid showing friends w/app
    for( $key = $minIndex;
         $key < $maxIndex && $key < sizeof($player_team_list);
         $key += 1)
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
$output .= '</div>';
$output .= '<div class="clearDiv"></div>';

//fb request form used for inviting friends to the game
$invite_text = 'I\'m playing Faction Wars. How about you?'
     . htmlentities('<fb:req-choice url=\'')
     . CANVAS_PATH
     . htmlentities ('\' label=\'Join the fight\' />');

$output .= '<fb:request-form action="team.php" method="post" content="'
               . $invite_text
               . '" type="FW Invitation"><div id="selector">
               <h1 style="color:#e5bc75;">
               Invite a friend to your FE Faction Wars clan</h1>'
    . '<fb:multi-friend-selector condensed="true"  selected_rows="4" '
    . 'exclude_ids="' . $exclude_list . '" />'
    . '<input type="submit" class="fwButton" label="Send Invitation">'
    . '</div></fb:request-form></div>';         //end selector div, rightcol

$output .= '</div></div>'; //end content, rightCol
$output .= '<div id="footer">';
$output .= include('footer.php');
$output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

$output .= render_timer_script($player);
$output .= '<script>var g_senderid = -1;</script>';

echo $output;

function add_scripts($player)
{
 /** showList(url, playerid, recipientid, recipientname)
   * showTownPicker(senderid)
   * getRandomGift(url)
   * sendGift(url, recipientid, senderid)
   * sendFreeGift(url, recipientid, senderid)
   * getSelected(lengthId, prefix)
   */
 return '<script><!--
         function showList(url, playerid, recipientid, recipientname)
         {
             var ajax = new Ajax();
             ajax.responseType = Ajax.FBML;
             ajax.requireLogin = 1;

             ajax.ondone = function(data)
             {
                 document.getElementById("resultTitle")
                     .setInnerXHTML("<span></span>");
                 document.getElementById("resultBody")
                     .setInnerFBML(data);
                 document.getElementById("giftFrame")
                     .setStyle("display", "block");
             }
             var params ={"playerid": playerid, "recipientid": recipientid,
                          "recipientname": recipientname};
             ajax.post(url, params);
         }

         function showTownPicker(senderid)
         {
             g_senderid = senderid;
             document.getElementById("giftTownList")
                 .setStyle("display", "block");
         }

         function getRandomGift(url)
         {
             var ajax = new Ajax();
             ajax.responseType = Ajax.JSON;
             ajax.requireLogin = 1;

             var townid = getSelected("numTowns", "town_");
             ajax.ondone = function(data)
             {
                 document.getElementById("resultTitle")
                     .setInnerFBML(data.fbml_title);
                 document.getElementById("resultBody")
                     .setInnerFBML(data.fbml_body);
                 if(data.no_more_gifts)
                 {
                     document.getElementById("gift_" + data.sender)
                             .setStyle("display", "none");
                 }
                 document.getElementById("giftTownList")
                     .setStyle("display", "none");
                 document.getElementById("giftFrame")
                     .setStyle("display", "block");
                 document.getElementById("freeGiftOffer")
                     .setStyle("display", "none");
             }
             var params ={"townid": townid, "recipientid": '
                                              . $player->userid . ',
                          "senderid": g_senderid, "type": ' . CLAIM_FREE_GIFT
                                                            . '};
             ajax.post(url, params);
         }

         function sendGift(url, recipientid, senderid)
         {
             var ajax = new Ajax();
             ajax.responseType = Ajax.JSON;
             ajax.requireLogin = 1;

             var itemid = getSelected("numItems", "item_");

             ajax.ondone = function(data)
             {
                 document.getElementById("resultTitle")
                     .setInnerFBML(data.fbml_title);
                 document.getElementById("resultBody")
                     .setInnerFBML(data.fbml_body);
             }
             var params ={"itemid": itemid, "recipientid": recipientid,
                          "senderid": senderid};
             ajax.post(url, params);
         }
         
         function sendFreeGift(url, recipientid, senderid)
         {
             var ajax = new Ajax();
             ajax.responseType = Ajax.JSON;
             ajax.requireLogin = 1;

             ajax.ondone = function(data)
             {
                 document.getElementById("resultTitle")
                     .setInnerFBML(data.fbml_title);
                 document.getElementById("resultBody")
                     .setInnerFBML(data.fbml_body);
             }
             var params ={"recipientid": recipientid,
                          "senderid": senderid, "type": ' . SEND_FREE_GIFT
                                                          . '};
             ajax.post(url, params);
         }

         function getSelected(lengthId, prefix)
         {
             var selected = 0;
             var numRadio = document.getElementById(lengthId)
                           .getValue();

             for (i=0; i<=numRadio; i++)
             {
                 var p = prefix + i;

                 if( document.getElementById(p)
                             .getChecked())
                 {

                     selected = document.getElementById(prefix + i)
                             .getValue();
                     break;
                 }
             }

             return selected;
         }
         //--></script>';
}
?>