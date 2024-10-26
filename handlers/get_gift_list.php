<?php
/**
  *
  * @version 29 October 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 29 October 2009
  */

require_once '../lib/config.php';

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

require_once('../' . LIB_PATH.'display.php');
require_once('../' . LIB_PATH . 'db_access_player.php');

$sender_id      = 0;
$recipient_id   = 0;
$recipient_name = '';
$output         = '';
if(isset($_POST['playerid']))
{
    $sender_id = $_POST['playerid'];
}

if(isset($_POST['recipientid']))
{
    $recipient_id = $_POST['recipientid'];
}

if(isset($_POST['recipientname']))
{
    $recipient_name = $_POST['recipientname'];
}

$db = new PlayerDatabase;
$inventory = $db->get_player_inventory($sender_id);
$gift_info = $db->get_free_gift_info($sender_id, $recipient_id);

if(is_array($gift_info))
{
    $curr_interval  = time() - $gift_info['newest'];
}
else
{
    $curr_interval = $gift_info;
}

if($inventory)
{
    $checked = false;
    $output .= '<h1 class="centeredTitle">Choose a gift for <fb:name uid="'
                   . $recipient_id
                   . '" firstnameonly="true" linked="false"></h1>';
      //free gift handling

    $output .= '<div id="inventoryGiftFrame">';
    $output .= '<h1>Or select an item from your inventory:</h1>';
    $output .= '<input type="hidden" id="recipientid" value="' . $recipient_id
            . '"/>';
    $output .= '<input type="hidden" id="numItems" value="' . count($inventory)
            . '" />';
    for($key = 0; $key < count($inventory); $key++)
    {
        if($inventory[$key]['quantity']>0)
        {
            $output .= '<div class="giftItem"><input type="radio"
                name="itemid" id="item_' . $key . '" value="'
                . $inventory[$key]['id'] . '" ';
            
            if(!$checked)
            {
                $checked = true;
                $output .= ' CHECKED ';
            }

            $output .= '/>' . $inventory[$key]['name'] . ' You have: '
                . number_format($inventory[$key]['quantity']) . '</div>';
        }
    }
    $output .= '</ul><input type="submit" value="Send gift" '
                   . ' onclick="sendGift(\''
                   . ROOT . HANDLER_PATH . 'gift_handler.php\', '
                   . $recipient_id
                   . ', ' . $sender_id . ');return false;" class="fwButton"/>
                   </div>';//end gift item list
}
else
{
    $output .= '<p>Earn or purchase items to give to your friends.</p>';
}


if( $curr_interval >= FREE_GIFT_COOLDOWN || $curr_interval == -1 )
{
    $output .= '<div id="freeGiftFrame"><h1>Send a free gift</h1>'
               . 'Send a free mystery box gift. <fb:name uid="'
               . $recipient_id
               . '" firstnameonly="true" linked="false"/> can use it to
               choose an item <fb:pronoun uid="' . $recipient_id
               . '"/> needs. <br />';
    $output .= '<input type="submit" value="Send a free gift" '
               . ' onclick="sendFreeGift(\''
               . ROOT . HANDLER_PATH . 'free_gift_handler.php\', '
               . $recipient_id
               . ', ' . $sender_id . ');return false;" class="fwButton"/>';
}
else
{
    $output .= 'You have already sent <fb:name uid="'
               . $recipient_id
               . '" firstnameonly="true" linked="false"/> a free gift today.
                 Come back in ' . (FREE_GIFT_COOLDOWN - $curr_interval)
                                . ' seconds to send another one.';
}

$output .= '</div>';

echo $output;
?>