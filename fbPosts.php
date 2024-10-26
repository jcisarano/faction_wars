<?php
/**
  * Grabs unposted messages from the queue and updates recipient's dashboard
  *       counter and attempts to post a news item.
  * Designed for inclusion in existing page. Facebook object must already have 
  * been instantiated as $facebook.
  *
  * @version 8 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 8 April 2010
  */
include_once( LIB_PATH . 'db_access_message.php');
$message_db = new MessageDatabase;
$posts_out = $message_db->get_unposted_messages($player->userid);

foreach($posts_out as $key=>$post)
{
      //stack ids for dashboard increment
    $increment_ids[] = $post['recipientid'];

      //build and send message to dashboard
    $message = $message_db->parse_dashboard_message($post, 0); //zero excludes timestamp
    $news = array(array('message' => $message['message'],
                        'action_link' => array('text' => $message['link_text'],
                                               'href' => $message['link_url'] )));
    $facebook->api_client->dashboard_addNews($news, $post['recipientid']);

      //build list of sent posts
    $sent_posts[] = $post['messageid'];
}
if($increment_ids)
{
    $facebook->api_client->dashboard_multiIncrementCount($increment_ids);
}
if($sent_posts)
{
    $message_db->set_messages_posted($sent_posts);
}
//$output .= 'posts= ' . count($posts_out);
?>