<?php
/**
  * Cleans up after a user who uninstalls the game.
  *
  * @version 29 December 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  * @history
  *         created 29 December 2009
  */
  
require_once 'lib/config.php';

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

require_once(FB_PATH  . 'facebook.php');
require_once LIB_PATH . 'db_access_player.php';

$facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

$fb_user = $facebook->require_login();

$player_db = new PlayerDatabase;
$player_db->set_user_departed($fb_user);

?>