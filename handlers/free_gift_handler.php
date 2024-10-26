<?php
/**
  * Handles free gift transactions:
  *         send gift - first verify cooldown
  *
  * @version 3 March 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 3 March 2010
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

require_once('../' . LIB_PATH . 'db_access_player.php');
require_once('../' . LIB_PATH . 'db_access_message.php');

$player_db  = new PlayerDatabase;
$message_db = new MessageDatabase;

$senderId      = 0;
$recipientId   = 0;
$type          = 0;
$no_more_gifts = 0;
$treasure = null;

//for text output
$title      = '';
$body       = '';
$popuptitle = '';
$popup      = '';

if( isset($_POST['type']))
{
    $type = $_POST['type'];
}

//get item and player info
if( isset($_POST['recipientid'])
    && isset($_POST['senderid']))
{
    $recipientId = $_POST['recipientid'];
    $senderId    = $_POST['senderid'];

    $gift_info = $player_db->get_free_gift_info($senderId, $recipientId);

    if( $type == SEND_FREE_GIFT )
    {
        //verify gift time - make sure enough time has passed since last gift
        if(is_array($gift_info))
        {
            $curr_interval  = time() - $gift_info['newest'];
        }
        else
        {
            $curr_interval = $gift_info;
        }

        if($curr_interval > FREE_GIFT_COOLDOWN || $curr_interval == -1)
        {
              //send gift item
            $player_db->send_free_gift($senderId, $recipientId);

              //output
            $title = '<h1>Free gift sent</h1>';
            $body = '<p>Send more items and earn more rewards!</p>';
            $message_db->send_message($recipientId, $senderId, GIFT_MESSAGE,
                                      "mystery box" );
        }
        else
        {
            //cooldown failure - no gift sent
            $title = '<h1>Unable to send gift</h1>';
            $body = 'You have already sent <fb:name uid="' . $recipientId
                       . '" firstnameonly="true" linked="false"/> a free gift 
                                                 today. Come back in ' 
                                        . ( FREE_GIFT_COOLDOWN - $curr_interval )
                                        . ' seconds to send another one.';
        }
    }
    else if( $type == CLAIM_FREE_GIFT )
    {
          //make sure recipient has unclaimed gift from sender, handle error
        if( $gift_info != -1 )
        {
              //determine which gift to give
              //get ingredient list based on town mission number
            if(isset($_POST['townid']))
            {
                $town_id = $_POST['townid'];
            }
            
            require_once('../' . LIB_PATH . '/db_access.php');
            $db = new DatabaseAccess;
            $missions = $db->get_summon_crafting_missions( $town_id );

              //first, pull out one array of only treasure items from
              //all summon crafting missions for this town
            if( $missions )
            {
                foreach($missions as $mission)
                {
                    if($mission->ingredients)
                    {
                        $treasure = array_merge($mission->ingredients,
                                                (array)$treasure);
                    }
                }
            }
              //choose one item at random
            $award_item[] = $treasure[mt_rand(0, (count($treasure)-1))];
            if($award_item)
            {
                $award_item[0]['quantity'] = 1; //give only one of this item
                  //add to inventory
                $db->give_item_list($recipientId, $award_item);
                  //set a free gift as spent
                $q = $player_db->set_free_gift_claimed($senderId, $recipientId,
                                                  $gift_info['oldest']);
                
                  //see if there are any more gifts left from this sender
                $updated_gift_info = $player_db->get_free_gift_info($senderId,
                                     $recipientId);
                if($updated_gift_info == -1)
                {
                    $no_more_gifts = 1;
                }
                  //build output
                $title = '<h1>Gift claimed</h1>';
                $body = 'You have recieved: ' . $award_item[0]['name'];
            }
            else
            {
                $title = 'Failed';
                $body = 'No item awarded. Please choose a different town and 
                            try again.';
            }

        }
        else
        {
            //didn't find a free gift to spend, send error message
            $title = '<h1>Unable to claim gift</h1>';
            $body = 'You don\'t seem to have an unused gift from this friend.';
        }

    }
    else
    {}
}
else
{
      //tech failure - no gift sent
    $title = '<h1>Unable to manage gift</h1>';
    $body = '<p>Please try again.</p>';
}

//send fb notification to recipient

//send fw message to recipient

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => $title,
                 'fbml_body'    => $body,
                 'fbml_popup'   => $popup,
                 'popuptitle'   => $popuptitle,
                 'no_more_gifts'=> $no_more_gifts,
                 'sender'       => $senderId );

echo json_encode($output);

?>