<?php
/**
* Store and retrieve message items in database
*
* @version 14 April 2010
* @author Jason Cisarano jcisarano@icarusstudios.com
* @history
*         created 2 November 2009
*         added dashboard message feature 14 April 2010
*/

require_once('config.php');
require_once('db_connect.php');

class MessageDatabase
{
    protected $db_util;
    
    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }
    
    /**
      * Add message to queue. All params other than sender, recipient, and type
      *     are optional.
      *
      * @param $recipientid
      * @param $senderid
      * @param $param_one
      * @param $param_two
      * @param $param_three
      */
    function send_message($recipientid, $senderid, $type, $param_one="",
                                        $param_two="", $param_three="")
    {
        if( !$this->db_util->validate_int($recipientid)
            || !$this->db_util->validate_int($senderid) )
        {
            die('Invalid value in send_message( recipientid='
                                 . $recipientid . ' & senderid=' . $senderid 
                                 . ')');
        }

        $query = 'INSERT INTO ' . MESSAGE_QUEUE . ' (recipientid, senderid,
                         datein, message_type, param_one, param_two, 
                         param_three) VALUES (' . $recipientid . ', ' 
                         . $senderid . ', ' . time() . ', ' . $type . ', "'
                         . $param_one . '", "' . $param_two . '", "' 
                         . $param_three . '")';
        $this->db_util->execute_query($query);
    }
    
    /**
      * Get list of recipient's incoming messages. Defaults to getting only 
      * unread messages.
      *
      * @param $recipient
      * @param $unread Default to true
      * @param $recent If true, will only return messages sent within the last
      *                week. Default = true
      * @return assoc array of messages with keys matching table columns
      */
    function get_received_messages($recipientid, $unread=1, $recent=1)
    {
        $query = 'SELECT * FROM ' . MESSAGE_QUEUE . ' WHERE recipientid='
               . $recipientid;
        if($recent)
        {
            $one_week = 60 * 60 * 24 * 7;
            $query .= ' AND datein > ' . (time() - $one_week);
        }
        if($unread)
        {
            $query .= ' AND dateread IS NULL';
        }
        else
        {
            $query .= ' AND dateread IS NOT NULL';
        }
        $query .= ' ORDER BY datein DESC';
        $result = $this->db_util->execute_query($query);

        $messages = null;
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $messages[] = $row;
        }

        return $messages;
    }

    /**
      * Pull list of messages sent by the user not yet posted to FB.
      *
      * @param senderid Player's fb userid
      *
      * @return Array of messages, each an assoc array with keys matching the
      *         table column headings.
      */
    function get_unposted_messages($senderid)
    {
          //make sure $recipientid is integer only
        if( !$this->db_util->validate_int($senderid) )
        {
            die('Invalid user id in get_unposted_messages('
                                 . $senderid . ')');
        }

        $query = 'SELECT * FROM ' . MESSAGE_QUEUE . ' WHERE senderid='
                 . $senderid . ' AND dateFbPosted=0  ORDER BY datein DESC';
        $result = $this->db_util->execute_query($query);

        $messages = null;
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $messages[] = $row;
        }

        return $messages;
    }

    /**
      * Sets a group of messages as posted to fb by assigning a time to their
      *      dateFbPosted field.
      *
      * @param $messageids Array of one or more message ids to set as posted
      *
      */
    function set_messages_posted($messageids)
    {
        foreach((array)$messageids as $id)
        {
            if( !$this->db_util->validate_int($id) )
            {
                die('Invalid message id in set_messages_posted('
                                     . $id . ')');
            }

            $query = 'UPDATE ' . MESSAGE_QUEUE . ' SET dateFbPosted=' . time()
               . ' WHERE messageid=' . $id;
            $this->db_util->execute_query($query);
            //echo $query;
        }
    }

    /**
      * Get list of sender's outgoing messages. Defaults to getting only
      * unread messages.
      *
      * @param $sender
      * @param $unread Default to true
      * @return assoc array of messages with keys matching table columns
      */
    function get_sent_messages($senderid, $unread=1)
    {
        if( !$this->db_util->validate_int($senderid)
            || !$this->db_util->validate_int($unread) )
        {
            die('Invalid value in get_sent_messages( senderid='
                                 . $senderid . ' & unread=' . $unread . ')');
        }

        $query = 'SELECT * FROM ' . MESSAGE_QUEUE . ' WHERE senderid='
               . $senderid;
        if($unread)
        {
            $query .= ' AND dateread IS NULL';
        }
        else
        {
            $query .= ' AND dateread IS NOT NULL';
        }
        $query .= ' ORDER BY datein DESC';
    
        $result = $this->db_util->execute_query($query);
        
        $messages = null;
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $messages[] = $row;
        }
        return $messages;
    }
    
    /**
      * Mark an individual message as read, set dateread to current time
      *
      * @param $messageid
      */
    function mark_read($messageid)
    {
        if( !$this->db_util->validate_int($messageid) )
        {
            die('Invalid message id in mark_read('
                                     . $messageid . ')');
        }
        $query = 'UPDATE ' . MESSAGE_QUEUE . ' SET dateread=' . time()
               . ' WHERE messageid=' . $messageid;
        $this->db_util->execute_query($query);
    }
    
    function mark_unread($messageid)
    {
        if( !$this->db_util->validate_int($messageid) )
        {
            die('Invalid message id in mark_unread('
                                     . $messageid . ')');
        }
        $query = 'UPDATE ' . MESSAGE_QUEUE . ' SET dateread=null'
               . ' WHERE messageid=' . $messageid;
        $this->db_util->execute_query($query);
    }
    
    /**
      * Build message from params based on type.
      *
      * @param $message Assoc array of message item -- keys should match column 
      *                 headings
      * @includeTime Whether to append timestamp to message. Default=1, set to
      *              0 for no timestamp.
      * @return Message text as string
      */
    function parse_message($message, $includeTime=1)
    {
        $text_out = '';
        switch($message['message_type'])
        {
            case GIFT_MESSAGE:
                 $text_out = 'You received one ' . $message['param_one']
                 . ' from ' . '<fb:name uid="' . $message['senderid']
                            . '" linked="false"/>';
                 if($includeTime)
                 {
                     $text_out .= ' on ' . date( 'r', (int)$message['datein']) . '. ' ;
                 }
                 break;
            case SYSTEM_MESSAGE:
                 $text_out = $message['param_one'];
                 if($includeTime)
                 {
                     $text_out .= ' Sent ' 
                               . date( 'r', (int)$message['datein']) . '. ' ;
                 }
                 break;
            case PVP_LOSS_MESSAGE:
                 $text_out = '<fb:name uid="' . $message['senderid']
                                              . '" linked="false"/>'
                     . ' beat you in a brawl, doing ' . $message['param_one']
                     . ' points of damage and stealing ' . $message['param_two']
                     . ' chips.';
                 if($includeTime)
                 {
                     $text_out .= date( 'r', (int)$message['datein']);
                 }
                 break;
            case PVP_WIN_MESSAGE:
                 $text_out = '<fb:name uid="' . $message['senderid']
                                              . '" linked="false"/>'
                     . ' attacked you and lost. You stole '
                     . $message['param_two']
                     . ' chips and did ' . $message['param_one']
                     . ' points of damage to pay for your time.';
                 if($includeTime)
                 {
                     $text_out .= date( 'r', (int)$message['datein']);
                 }
                 break;
            default:
                 break;
        }

        return $text_out;
    }


    /**
      * Takes info from internal message and parses it for use with FB
      *     dashboard.
      *
      * @param $message
      * @return Array of items for use in message with these keys:
      *         message: message text
      *         link_text: Text for action_link
      *         link_url: Target for action_link
      */
    function parse_dashboard_message($message)
    {
        $text_out = '';
        switch($message['message_type'])
        {
            case GIFT_MESSAGE:
                 $text_out = '@:' . $message['senderid'] 
                                  .  ' sent you a gift.';
                 $link_text = 'Claim your gift';
                 $link_url = CANVAS_PATH . '/team.php';
                 break;

            case SYSTEM_MESSAGE:
                 $text_out = $message['param_one'];
                 $link_text = 'Fallen Earth Faction Wars';
                 $link_url = CANVAS_PATH;
                 break;

            case PVP_LOSS_MESSAGE:
            case PVP_WIN_MESSAGE:
                 $text_out = '@:' . $message['senderid'] 
                                  .  ' brawled with you.';
                 $link_text = 'Fight back';
                 $link_url = CANVAS_PATH . '/pvp.php';
                 break;

            default:
                 break;
        }

        return array('message'   => $text_out,
                     'link_text' => $link_text,
                     'link_url'  => $link_url );
    }
}

?>