<?php

include_once('config.php');
include_once('db_connect.php');

$db_util = new DatabaseUtilities;

$query = 'SELECT * FROM ' . MISH;

$result = $db_util->execute_query($query);
//output mission info w/ids
while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $mish = 'Mission id: ' . $row['missionid'] . '<br />';
    $mish .= 'Title: ' . $row['title'] . '<br />';
    $mish .= 'Description: ' . $row['description'] . '<br />';
    $mish .= 'Result text: ' . $row['result_text'] . '<br /><br />';
    echo $mish;
}

/*
$query = 'SELECT * FROM ' . ITEM;
$result = $db_util->execute_query($query);
//output item ids & item name
while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $item = 'Item id: ' . $row['id'];
    $item .= ' ' . $row['name'] . '<br />';
    //$mish .= 'Description: ' . $row['description'] . '<br />';
    //$mish .= 'Result text: ' . $row['result_text'] . '<br /><br />';
    echo $item;
}
*/
/*
$query = 'SELECT * FROM ' . TOWN_MISH;

$result = $db_util->execute_query($query);

while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $mish = 'INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (55, '
                    . $row['missionid'] . ', 6);';
    echo $mish . '<br />';
}

echo '<br /><br /><br /><br />';

$query = 'SELECT * FROM ' . FAC_MISH;
$result = $db_util->execute_query($query);

while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $mish = 'INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (55, '
                    . $row['missionid'] . ', 6);';
    echo $mish . '<br />';
}
*/
?>