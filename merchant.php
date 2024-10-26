<?php
/**
* Mission update for FE faction wars. Grabs info from db, returns markup
* for display in browser.
*
* @version 6 Sepember 2009
* @author Jason Cisarano jcisarano@icarusstudios.com
*
* @history
*         created 6 September 2009
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
require_once LIB_PATH . 'map.class.php';
require_once LIB_PATH . 'db_access_player.php';

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$facebook->require_frame();
$fb_user = $facebook->require_login();

$map = new Map;
$output = '';

  //update town ownership status
include_once(HANDLER_PATH . 'town_ownership_inline.php');

$db = new PlayerDatabase;
$player = $db->get_player_data($fb_user);
$p_inventory = $db->get_player_inventory($fb_user);

$output .= '<style>';
$output .= htmlentities(
                 file_get_contents(ROOT.STYLE.'fw_style.css', true));
$output .= htmlentities(
                  file_get_contents(ROOT.STYLE.'fw_merch_style.css', true));
$output .= '</style>';

//include stylesheet
/*$output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_style.css?v=' . $js_ver . '" />';
$output .= '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_merch_style.css?v=' . $js_ver . '" />';
*/
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

$output .= render_nav_bar('Merchant');

$output .= '<div id="content"><div id="map">'
        . $map->draw_item_map($player->faction, $player->level)
        . '</div>';

$output .= '<a onclick="showPopup(\'pvpItem\');return false;"
            class="infoLink">More info</a>
        <div id="pvpItem"><div class="helpiteminner">
        <h1>Weapons and Armor: Can\'t Buy</h1>
        <p>The Merchant tab displays all items that can be purchased 
        in the town or gained through missions and crafting. If you 
        can\'t buy an item, check the town\'s missions and crafting 
        pages to see if you can win it or create it there. Even if you 
        can\'t buy an item, you can still sell it for chips.</p>
        <h1>Skills and Mutations: Mastery</h1>
        <p>Skills and mutations can be mastered from the Merchant tab 
        similarly to missions. To work toward mastery of an ability, 
        click Improve. If you have enough cash, the ability\'s 
        progress bar increases. You can only improve each ability once 
        per day. Once the progress bar fills and you master the 
        ability, you will gain AP and also increase the ability\'s 
        effectiveness for you in combat. Like missions, abilities can 
        be improved to two extra levels of mastery.</p>
    <a onclick="hidePopup(\'pvpItem\');return false;">Close</a></div></div>';

$output .= '<h1 id="townName"></h1>';
        //empty divs used for displaying results
$output .= '<div id="resultTitle2"></div>'
        . '<div id="resultBody2"></div>'
        . '<div id="resultTitle"></div>'
        . '<div id="resultBody"></div>';

$output .= '<div id="playerInventory"><h1>Click a town to see what\'s for sale.</h1>';
$output .= '</div>'; //end playerInventory

$output .= '</div></div>'; //end content, rightCol
$output .= '<div id="footer">';
$output .= include('footer.php');
$output .= '</div><div id="borderFrameBottom"></div></div>'; //end warBody

$output .= render_timer_script($player);

include( INCLUDE_PATH . 'start_town_inline.php');
$output .= '<script>var oldTown = "' . $start_town_name . '";showItems("'
                                . ROOT . HANDLER_PATH . 'get_items.php", '
                                . $start_town_id .', ' . $player->faction
                                . ', "' . $start_town_name . '"'
                                . ');</script>';
echo $output;

function add_scripts($player)
{
   /**
     */
 return '<script><!--
             function showItems(url, townid, playerFaction, townname)
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

                 document.getElementById("playerInventory")
                         .setInnerXHTML("<span> </span>");
                 var ajax = new Ajax();
                 ajax.responseType = Ajax.FBML;
                 ajax.requireLogin = 1;
                 ajax.ondone = function(data) {
                     hideLoadscreen();
                     document.getElementById( "playerInventory" )
                             .setInnerFBML(data);
                     document.getElementById("townName")
                             .setInnerXHTML("<span>" + townname + "</span>");
                     setPlayerLocation(oldTown, townname, "' . ROOT
                             . IMG_PATH . '/player_icon2.png");
                     oldTown = townname;

                 }
                 var params={"townid":townid,
                             "p_faction":playerFaction,
                             "p_id":"' . $player->userid . '"};
                 ajax.post(url, params);
             }

             function handleTransaction(url, itemid, playerid,
                                        playerFaction, townid,
                                        type, quant_id )
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

                 var selector = type + "_select_" + itemid;
                 var quantity = getSelectVal(selector);

                 var ajax = new Ajax();
                 ajax.responseType = Ajax.JSON;
                 ajax.requireLogin = 1;
                 ajax.ondone = function(data) {
                     hideLoadscreen();
                     showItems("' . ROOT . HANDLER_PATH
                                  . 'get_items.php", '
                                  . 'townid, ' . $player->faction
                                . ', oldTown );
                     document.getElementById("resultTitle")
                         .setInnerXHTML("<h1>"+data.title+"</h1>");
                     document.getElementById("resultBody")
                         .setInnerFBML(data.fbml_body);
                 }
                 var params={ "itemid":itemid, "playerid":playerid,
                              "townid":townid, "p_faction":townid,
                              "type":type, "quantity":quantity };
                 ajax.post(url, params);
             }

             function handleUpgrade(url, itemid)
             {
                 showLoadscreen();
                 document.getElementById("resultTitle")
                         .setInnerXHTML("<span> </span>");
                 document.getElementById("resultBody")
                         .setInnerXHTML("<span> </span>");
                 var ajax = new Ajax();
                 ajax.responseType = Ajax.JSON;
                 ajax.requireLogin = 1;
                 ajax.ondone = function(data)
                 {
                     hideLoadscreen();
                     document.getElementById("resultTitle")
                             .setInnerFBML(data.fbml_title);
                     document.getElementById("resultBody")
                             .setInnerFBML(data.fbml_body);
                     if(!data.fail)
                     {
                         document.getElementById( "attack_" + itemid )
                             .setInnerXHTML("<span>" + data.attack
                               + "</span>");
                         document.getElementById( "defense_" + itemid )
                             .setInnerXHTML("<span>" + data.defense
                               + "</span>");
                         try
                         {
                             //not all items have cost
                             document.getElementById( "cost_" + itemid )
                                     .setInnerXHTML("<span>" + data.cost
                                                             + "</span>");
                         }
                         catch(e){}
                         try
                         {
                             var price = round(data.cost * '
                                         . SALE_PRICE_MULT . ');
                             document.getElementById( "salep_" + itemid )
                                     .setInnerXHTML("<span>" +
                                                             + "</span>");
                         }
                         catch(e){}
                         document.getElementById( "mastery_" + itemid )
                             .setInnerXHTML("<span>" + data.mastery
                               + "</span>");
                         document.getElementById("progress_" + itemid)
                             .setStyle("width", data.progress +"%");
                         document.getElementById("playerData")
                             .setInnerXHTML(data.player_stats);                             
                     }
                     if(data.popuptitle != "" )
                     {
                         document.getElementById("resultTitle2")
                             .setInnerXHTML(
                                 "<h1>" + data.popuptitle + "</h1>");
                         document.getElementById("resultBody2")
                             .setInnerFBML(data.fbml_popup);

                         //new Dialog().showMessage(data.popuptitle,
                           //                       data.fbml_popup);

                         document.getElementById( "delta_" + itemid )
                                 .setInnerXHTML ("<span>" + data.next_increment 
                                   + "</span>");
                     }
                 }
                 var params={"itemid": itemid};
                 ajax.post(url, params);
             }

             function getSelectVal(selector)
             {
                 var i = document.getElementById(selector)
                                 .getSelectedIndex();
                 return document.getElementById(selector).getOptions()[i].getValue();
             }
        //--></script>';
}

?>