<?php

/**
  * Container for faction information
  *
  * @version 1 September 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 1 September 2009
  */

class Faction
{
    public $id            = 'none';
    public $faction       = 'none';
    public $description   = 'none';
    public $description_2 ='none';
    public $image         = 'none';
    public $allyid        = 'none'; //use array of ids
    public $enemyid       = 'none';
    
    public $gamma_update_rate  = 'none';
    public $stam_update_rate   = 'none';
    public $health_update_rate = 'none';
    public $chips_bonus        = 'none';
    public $xp_bonus           = 'none';
    public $start_attack       = 'none';
    public $start_defense      = 'none';
    public $thumb              = 'none';
}

?>