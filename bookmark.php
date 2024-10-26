<?php
/**
  * Checks to see if the player has bookmarked the app and become a fan of it.
  * If not, returns buttons that let the player do so.
  *
  * Built for inclusion in a page that has loaded config.php and already 
  * initialized a facebook object as $facebook.
  *
  * @version 7 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 7 April 2010
  */

  //facebook fql query to check if player has bookmarked the game
$permission = $facebook->api_client
              ->fql_query('SELECT bookmarked FROM permissions WHERE uid='
                                  . $player->userid . '');
  //api call to check if player has become a fan of the fw page
$fan = $facebook->api_client->pages_isFan(PAGE_ID, $player->userid);

if(!$fan)
{
    $fb_buttons .= '<div><iframe scrolling="no" frameborder="0" src="' . ROOT 
                . HANDLER_PATH . 'fan.html" style="border: none; width: 300px; 
                                            height: 85px;"></iframe></div>';
}

if(!$permission[0]['bookmarked'])
{
    $fb_buttons .= '<div ><p>Add Faction Wars to your bookmarks for
                quicker access.</p><fb:bookmark /></div>';
}

if(!$fan || !$permission[0]['bookmarked'])
{
    $fb_buttons = '<div id="bookmark">' . $fb_buttons . '</div>'
                . '<div class="fwClear"></div>';
}

return $fb_buttons;
?>