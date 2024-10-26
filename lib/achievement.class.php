<?php
/**
  * Stores info for one achievement
  *
  * @version 3 October 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  * @history
  *          created 3 October 2009
  */

class Achievement
{
    public $achievementid = 'none';
    public $name          = 'none';
    public $description   = 'none';
    public $category      = 'none';
    public $reps          = 'none';
    public $image         = 'none';

      //player-specific data
    public $player_reps   = 'none';
    public $achieved      = 'none';

}
?>