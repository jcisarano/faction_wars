<?php
echo 'start<br />';
$townid=1;
$userid = 1407955289;

include_once('lib/config.php');
include_once(LIB_PATH . 'db_access_message.php');
echo 'userid=' . $userid . '<br />';
$message_db = new MessageDatabase;

$messages = $message_db->get_unposted_messages($userid);

foreach($messages as $key=>$message)
{
    echo $key . ' : ' . implode(', ', $message) . '<br />';
}

echo count($messages) . ' messages found.<br />';
echo 'done';

?>