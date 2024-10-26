<?php
/**
* Primary page for faction point spending.
*
* @version 19 October 2009
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 19 October 2009
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

require_once(FB_PATH.'facebook.php');
require_once(LIB_PATH.'display.php');
//require_once LIB_PATH . 'map.class.php';
require_once LIB_PATH . 'db_access_player.php';
require_once(LIB_PATH . 'db_access_fp.php');

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$facebook->require_frame();
$fb_user = $facebook->require_login();

//$map = new Map;

$db = new PlayerDatabase;
$player = $db->get_player_data($fb_user);
$fp_db = new FacPointDatabase;
$output = '';

/*
$output .= '<style>';
$output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_style.css', true));
$output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_clan_style.css', true));
$output .= '</style>';
*/

//include stylesheets
$output .= '<link rel="stylesheet" media="screen"
                  type="text/css"
                  href="'. ROOT . STYLE . 'fw_style.css?v='
                         . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
                  type="text/css"
                  href="'. ROOT . STYLE . 'fw_clan_style.css?v='
                         . $js_ver . '" />';

$output .= add_scripts();
$output .= '<script src="'. ROOT . JS_PATH
                       . 'recharge_timer.js?v=' . $js_ver . '"></script>';
$output .= '<script src="'. ROOT . JS_PATH
                       . 'common.js?' .$js_ver . '"></script>';

$output .= '<div id="fwBody">';
//$output .= '<div id="banner"></div>';

$output .= '<div id="playerData">' . render_player_data($player) . '</div>';
//$output .= '<div id="leftCol">leftcol</div>';

$output .= '<div id="rightColBorderTop"></div>';
$output .= '<div id="rightCol">';

$output .= render_nav_bar('Clan', 'Vault');
$output .= '<div id="content"><div id="resultTitle"></div>';
$output .= '<div id="resultBody"></div>';
$output .= '<p>You currently have <span id="facpoints">' 
        . $player->faction_points . '</span> faction points.</p>';
  //information popup
$output .= '<a onclick="showPopup(\'clanItem\');return false;" class="infoLink">
           More info</a>
           <div id="clanItem"><div class="helpiteminner">
           <h1>How to Earn and How to Spend Faction Points</h1>
           <p>Faction points can be spent to give you a special advantage outside the 
           normal rules of the game: instantly refill your Gamma, Stamina, or Health; 
           buy more APs or special items; shorten the recharge timers for your Gamma or 
           Stamina; even change your faction, name, or character specialization. You gain 
           a faction point every time you level up, and you can gain additional ones via 
           special offers.</p>
           <a onclick="hidePopup(\'clanItem\');return false;">Close</a></div></div>';

//find fp items in db
$items = $fp_db->get_fp_items();

$output .= '<div id="specials"><h1>Buy powerful items with faction points</h1>';
if(is_array($items))
{
    foreach($items as $item )
    {
        $output .= '<div class="fpItem"><div class="itemDescription"><h1>'
            . $item['name'] . '</h1><br />'
            . '<img src="' . ROOT . ITEM_PATH . '/' .$item['image']
                           . ' " width="64" title="' . $item['description'] . '" />'
            . '<br />'
            . 'Attack: ' . $item['attack_bonus_one'] . '<br />'
            . 'Defense: ' . $item['defense_bonus_one'] . '<br />'
            . 'Cost: ' . $item['fp_price'] . ' faction points. <br />'
            . '<br /></div>'
            . '<div class="itemButton"><input type="submit" value="Buy now"
                    class="fwButton"
                    onclick="handleFpTransaction(\''
                        . ROOT . HANDLER_PATH . 'fp_trans_handler.php\','
                        . $item['id'] . ', ' . $player->userid . ', '
                        . $player->faction . ', 0, 0, 1 );return false;" /></div>'
            . '</div>';
    }
}
$output .= '</div>';
$output .= include(INCLUDE_PATH . 'health_offer_inline.php');
$output .= '<div id="factionItems"><h1>Use faction points to improve your
                                           character</h1>';
//$output .= '<div id="resultTitle"></div>'
  //           . '<div id="resultBody"></div>';
$perks = $fp_db->get_perks();
foreach($perks as $perk)
{
    $output .= '<div style="clear:both;"></div><div class="perk"><h1>'
        . '<img src="' . ROOT . GEN_PATH . $perk['image'] . '"/>'
        . $perk['name'] . '</h1>'
        . $perk['description'] . '<br />'
        . 'Cost: ' . $perk['fp_price'] . ' faction points.<br />'
        . '<input type="submit" value="Buy now" class="fwButton"
                  onclick="handleFpTransaction(\''
                      . ROOT . HANDLER_PATH . 'fp_trans_handler.php\', '
                      . $perk['id'] . ', ' . $player->userid . ', '
                      . $player->faction . ', 0, '
                      . $perk['perk_type'] . ', 1 );return false;" />'
        . '</div>';
}
$output .= '</div></div></div>'; //end factionitems, content, rightCol
 $output .= '<div id="footer">';
 $output .= include('footer.php');
 $output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

$output .= render_timer_script($player);
echo $output;

function add_scripts()
{
    return '<script><!--
             function handleFpTransaction(url, itemid, playerid,
                                          playerFaction, townid,
                                          type, quantity )
             {
                 var ajax = new Ajax();
                 ajax.responseType = Ajax.JSON;
                 ajax.requireLogin = 1;
                 ajax.ondone = function(data)
                 {
                     document.getElementById("playerData")
                             .setInnerXHTML(data.player_stats);
                     document.getElementById("resultTitle")
                             .setInnerXHTML("<h1>"+data.title+"</h1>");
                     document.getElementById("resultBody")
                             .setInnerFBML(data.fbml_body);
                     document.getElementById("facpoints")
                             .setInnerXHTML("<span>"+data.new_fp+"</span>");
                 }
                 var params={ "itemid":itemid, "playerid":playerid,
                              "townid":townid, "p_faction":playerFaction,
                              "type":type, "quantity":quantity };
                 ajax.post(url, params);
             }

             function changeFac(url, userid, itemid)
             {
                 var ajax = new Ajax();
                 ajax.responseType = Ajax.JSON;
                 ajax.requireLogin = 1;
                 var newFaction = getNewFac();
                 ajax.ondone = function(data)
                 {
                     document.getElementById("playerData")
                             .setInnerXHTML(data.player_stats);
                     document.getElementById("resultTitle")
                             .setInnerXHTML("<h1>"+data.title+"</h1>");
                     document.getElementById("resultBody")
                             .setInnerFBML(data.fbml_body);
                     document.getElementById("facpoints")
                             .setInnerXHTML("<span>"+data.new_fp+"</span>");
                 }
                 var params={ "playerid":userid, "p_faction":newFaction,
                              "type":2, "itemid":itemid };
                 ajax.post(url, params);
             }
             
             function changeName(url, userid, itemid)
             {
                 var ajax = new Ajax();
                 ajax.responseType = Ajax.JSON;
                 ajax.requireLogin = 1;
                 var newName = document.getElementById("newName")
                               .getValue();
                 ajax.ondone = function(data)
                 {
                     document.getElementById("resultTitle")
                             .setInnerXHTML("<h1>"+data.title+"</h1>");
                     document.getElementById("resultBody")
                             .setInnerFBML(data.fbml_body);
                     document.getElementById("facpoints")
                             .setInnerXHTML("<span>"+data.new_fp+"</span>");                             
                 }
                 var params={ "playerid":userid, "name":newName,
                              "type":3, "itemid":itemid };
                 ajax.post(url, params);
             }
             
             function getNewFac()
             {
                 var selected = 0;
                 var numFacs = document.getElementById("numFactions")
                               .getValue();
                 for (i=1; i<=numFacs; i++)
                 {
                     if( document.getElementById("fac_" + i)
                                .getChecked())
                     {
                         selected = i;
                         break;
                     }
                 }
                 return selected;
             }
           //--></script>';
}

?>