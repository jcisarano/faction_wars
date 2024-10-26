<?php
/**
  * Handles gift transaction:
  *         removes item from giver's inventory
  *         adds item to recipient inventory
  *         send fw notification to recipient
  *
  * @version 15 October 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 28 October 2009
  */


include_once('../lib/config.php');

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

require_once('../' . LIB_PATH . 'db_access.php');
require_once('../' . LIB_PATH . 'db_access_message.php');

$db         = new DatabaseAccess;
$message_db = new MessageDatabase;

$item_id    = 0;
$player_id  = 0;
$fail       = false;

//for text output to fbjs dialog popup
$title      = '';
$body       = '';
$popuptitle = '';
$popup      = '';

//get item and player info
if(isset($_POST['itemid'])
    && isset($_POST['recipientid'])
    && isset($_POST['senderid']))
{
    $item_id = $_POST['itemid'];
    
    $recipient = $_POST['recipientid'];
      //add item to recipient inventory
    $db->give_item($item_id, $recipient, 1);
    
    $player_id = $_POST['senderid'];
      //remove item from giver's inventory
    $db->remove_item($item_id, $player_id, 1);

      //output
    $title = '<h1>Gift sent</h1>';
    $body = '<p>Send more items and earn more rewards!</p>';
}
else
{
    //failure
    $title = '<h1>Unable to send gift</h1>';
    $body = '<p>Please try again.</p>';
}

//send fb notification to recipient

//send fw message to recipient

$gift = $db->get_item_info($item_id, $player_id);
$message_db->send_message($recipient, $player_id, GIFT_MESSAGE, $gift['name'] );

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => $title,
                 'fbml_body'    => $body,
                 'fbml_popup'   => $popup,
                 'popuptitle'   => $popuptitle );

echo json_encode($output);

?>