<?php
/**
  * Calculate town that should be displayed on first load page based on player's 
  * level and number of towns currently in database.
  *
  * Needs:
  *       Player $player (player.class.php)
  *       DatabaseAccess $db (db_access.php)
  * Sets up:
  *       $start_town_id
  *       $start_town_name
  *
  * @version 29 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 29 April 2010
  */

require_once( LIB_PATH . 'db_access.php');
$db = new DatabaseAccess;

$start_town_id = 0;
$start_town_name = '';

//get list of towns from database
$fl_town = $db->get_town_info();
//compare player level to towns
foreach($fl_town as $key=>$t)
{
    if($player->level > $t->town_level)
    {
        $start_town_id = $t->id;
        $start_town_name = $t->name;
    }
    else
    {
        break;
    }
}
?>