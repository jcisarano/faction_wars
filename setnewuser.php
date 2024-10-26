<?php
     /*
      * setnewuser.php initializes a user's account by setting an empty entry 
      * in the player statistics database.
      *
      * @version 21 September 2009
      *          28 December 2009
      * @author Jason Cisarano jcisarano@icarusstudios.com
      * @history
      *         created 21 September 2009
      *                 28 December 2009 - Added logic for reinstall/returning
      *                                          player
      */


     require_once 'lib/config.php';
     require_once LIB_PATH . '/db_access_message.php';

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

     require_once(FB_PATH . 'facebook.php');
     require_once LIB_PATH . 'db_access_player.php';

     $facebook = new Facebook(
                     $facebook_config['api_key'],
                     $facebook_config['secret']);

     $fb_user = $facebook->require_login();

     $db = new PlayerDatabase;
     
     $player = $db->get_player_data($fb_user);
     
     if($player->name != 'none' )
     {
         //player has past account
         $db->update_player_db( $player );
         
         $message_db = new MessageDatabase;
         $message_db->send_message($fb_user, 0, SYSTEM_MESSAGE
                  , "Welcome back to Fallen Earth Faction Wars!");
     }
     else
     {
         //create new player account
         $isNewUser = $db->create_new_user($fb_user);

         $message_db = new MessageDatabase;
         $message_db->send_message($fb_user, 0, SYSTEM_MESSAGE
                  , "Welcome to Fallen Earth Faction Wars!");
     }



?>