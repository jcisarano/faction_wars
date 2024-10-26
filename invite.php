<?php
/**
  * This include creates button for feed post using streamPublish(). It should
  * be included in a page only after config.php has been loaded. It also requires
  * common.js in order to work.
  *
  * @version 7 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 7 April 2010
  */
return '<div class="fullWidthPanel">Want more help? Post a one-time message to your facebook
    stream and recruit friends to your clan. <input type="submit"
    value="Get help" class="fwButton"
    onclick="post(\'Fallen Earth Faction Wars\',
                  \'' . CANVAS_PATH . '\',
                  \'{*actor*} needs your help. Join Fallen Earth Faction Wars today.\');return false;"></div>';
?>