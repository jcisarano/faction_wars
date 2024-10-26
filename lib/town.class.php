<?php
 /**
   * Stores info about a town
   *
   * @version 28 August 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         created 28 August 2009
   */
 require_once 'db_access.php';

 class Town
 {
     public $id                 = 'none';
     public $name               = 'none';
     public $town_level         = 'none';
     public $sectorid           = 'none';
     public $description        = 'none';
     public $image              = 'none';
     public $owned              = 'none';
     public $ownership_date     = 'none';
     public $owner_factionid    = 'none';
     public $owner_faction_name = 'none';
     public $chota_score        = 'none';
     public $enforcer_score     = 'none';
     public $lightbearer_score  = 'none';
     public $tech_score         = 'none';
     public $traveler_score     = 'none';
     public $vista_score        = 'none';
     public $hit_x              = 'none';
     public $hit_y              = 'none';
     public $img_x              = 'none';
     public $img_y              = 'none';

     /**
       * Get missions associated with this town from db
       *
       * @param $playerFaction factionid of current player
       * @return XHTML list of missions for this town
       */
     function get_town_missions($playerFaction)
     {
         //basic missions
         $db = new DatabaseAccess;
         $missions = $db->get_gen_town_missions($this->id);
         //owned missions if needed
         //faction missions
     }
     
     /**
       * Gets faction standing score in this town based on faction id number
       *
       * @param factionid
       * @return score
       */
     function get_faction_score($factionid)
     {
         switch($factionid)
         {
             case 1:
                  return $this->chota_score;
                  break;
             case 2:
                  return $this->enforcer_score;
                  break;
             case 3:
                  return $this->lightbearer_score;
                  break;
             case 4:
                  return $this->tech_score;
                  break;
             case 5:
                  return $this->traveler_score;
                  break;
             case 6:
                  return $this->vista_score;
                  break;
             default:
                  return 0;
         }
     }
}
?>