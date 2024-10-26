<?php
     /**
       * Stores info about a mission
       *
       * @version 28 August 2009
       * @author Jason Cisarano jcisarano@icarusstudios.com
       *
       * @history
       *         created 28 August 2009
       */

     class Mission
     {
         public $id           = 'none';
         public $title        = 'none';
         public $description  = 'none';
         public $result_text  = 'none';
         public $image        = 'none';
         public $chips_max    = 'none';
         public $chips_min    = 'none';
         public $xp_max       = 'none';
         public $xp_min       = 'none';
         public $energy_drain = 'none';
         
         public $chance       = 'none';
         
         public $achievement  = 'none';
         
         public $ingredients   = 'none'; //array
         public $reward_table = 'none'; //array
         
         public $completion_one   = 'none';
         public $completion_two   = 'none';
         public $completion_three = 'none';
         
         public $player_mastery  = 'none';
         public $player_progress = 'none';
     }
?>