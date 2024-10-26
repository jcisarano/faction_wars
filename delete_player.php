<?php
/**
  * Generates mysql scripts to completely delete a player from database.
  *
  * 16 November 2009
  */
  
require_once('lib/config.php');
//require_once('db_connect.php');
$script = 'Enter a player id number and hit submit to generate script to delete 
                 player info from database.';
if(isset($_GET['playerid']))
{
    $playerid = $_GET['playerid'];
    $script = ' DELETE FROM ' . COUNT . ' WHERE playerid=' . $playerid . ';'
              . ' DELETE FROM ' . ITEM_UPDATE . ' WHERE userid=' . $playerid . ';'
              . ' DELETE FROM ' . MESSAGE_QUEUE . ' WHERE recipientid=' 
                                . $playerid . ';'
              . ' DELETE FROM ' . MESSAGE_QUEUE . ' WHERE senderid=' 
                                . $playerid . ';'
              . ' DELETE FROM ' . PLAYER_ACHIEVE . ' WHERE playerid=' 
                                . $playerid . ';'
              . ' DELETE FROM ' . PLAYER_INV . ' WHERE userid=' . $playerid . ';'
              . ' DELETE FROM ' . PLAYER_STATS . ' WHERE userid=' . $playerid . ';'
              . ' DELETE FROM ' . MISH_COMPLETION . ' WHERE playerid=' 
                                . $playerid . ';'
              . ' DELETE FROM ' . FRIENDS . ' WHERE playerid=' . $playerid .';';
}
?>

<form action="" method="get">
Player id: <input type="text" name="playerid" /><br />
<input type="submit" value="Submit" />
</form>

<?php
echo $script
?>

