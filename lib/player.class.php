<?php
     require_once('config.php');

     /**
       * Stores information about a player. Includes some functions to 
       * safely manipulate player data.
       *
      * @version 9 October 2009
      * @author Jason Cisarano jcisarano@icarusstudios.com
      *
      * @history
      *         created 3 September 2009
      *         added support for constants 9 October 2009
      */

     class Player
     {
         public $name              = 'none';
         public $userid            = 'none';

         public $datein            = 'none';
         public $dateout           = 'none';

         public $faction           = 'none';
         public $faction_name      = 'none';

         public $level             = 'none';
         public $xp_to_level       = 'none';
         public $current_xp        = 'none';
         public $xp_bonus          = 'none';
         
         public $achieve_points    = 'none';
         public $ap_spent          = 'none';
         public $faction_points    = 'none';

         public $current_gamma     = 'none';
         public $max_gamma         = 'none';
         public $gamma_update_time = 'none';
         public $gamma_update_rate = 'none';

         public $current_stamina   = 'none';
         public $max_stamina       = 'none';
         public $stam_update_time  = 'none';
         public $stam_update_rate  = 'none';

         public $current_health     = 'none';
         public $max_health         = 'none';
         public $health_update_time = 'none';
         public $health_update_rate = 'none';

         public $chips              = 'none';
         public $chips_bonus        = 'none';

         public $attack             = 'none';
         public $adj_attack         = 'none';
         public $defense            = 'none';
         public $adj_defense        = 'none';
         public $army_size          = 'none';
         public $fights_won         = 'none';
         public $fights_lost        = 'none';
         
         public $deaths             = 'none';

         /**
           * Checks player stats and updates them based on refresh times and
           * last update. Useful when player info drawn from db after long
           * downtime. Not used with client-side timer updates.
           *
           * Updates gamma, stamina, and health.
           * DOES NOT UPDATE DATABASE!!
           *
           * @return true if any changes made
           */
         function auto_update_stats()
         {
             $currTime = time();
             $changed = false;

               //get time passed since last update
             $gamdif = $currTime - $this->gamma_update_time;
             
               //if this is greater than threshold, update stat
             if( $gamdif > $this->gamma_update_rate)
             {
                   //determine how many points to give based on 
                   //rate over time
                 $g = floor($gamdif / $this->gamma_update_rate);
                 $this->current_gamma += $g;
                   //don't allow point overages
                 if ($this->current_gamma > $this->max_gamma)
                 {
                     $this->current_gamma = $this->max_gamma;
                 }
                 $this->gamma_update_time = $currTime;
                 $changed = true;
             }

             $stamdif = $currTime - $this->stam_update_time;
             if( $stamdif > $this->stam_update_rate)
             {
                 $s = floor($stamdif / $this->stam_update_rate );
                 $this->current_stamina += $s;
                 if($this->current_stamina > $this->max_stamina)
                 {
                     $this->current_stamina = $this->max_stamina;
                 }
                 $this->stam_update_time = $currTime;
                 $changed = true;
             }

             $healthdif = $currTime - $this->health_update_time;
             if( $healthdif > $this->health_update_rate)
             {
                 $h = floor($healthdif / $this->health_update_rate);
                 $this->current_health += $h;
                 if($this->current_health > $this->max_health)
                 {
                     $this->current_health = $this->max_health;
                 }
                 $this->health_update_time = $currTime;
                 $changed = true;
             }
             return $changed;
         }//end autoUpdateStats
         
         /**
           * Add passed-in value to current XP using xp_bonus.
           * Updates level and xp to next level if needed.
           *
           * DOES NOT UPDATE DATABASE
           *
           * @param $xp
           * @return true on level up, else false
           */
         function update_xp($xp)
         {
               //adjust xp for any bonus, add to total
             $adj_xp = $xp * $this->xp_bonus;
             $this->current_xp += $adj_xp;

               //check for level up
             if( $this->current_xp >= $this->xp_to_level )
             {
                 $this->level += 1;

                 //rough xp update for testing
                 $this->xp_to_level = $this->xp_to_level
                                    + 25 + ($this->level * $this->level);
                 $this->achieve_points += AP_REW;
                 $this->faction_points += FAC_REW;

                 $this->current_gamma   = $this->max_gamma;
                 $this->current_stamina = $this->max_stamina;
                 $this->current_health = $this->max_health;

                 return true;
             }
             return false;
         }

         /**
           * Adds passed-in chips to player's wallet using chips_bonus.
           * If passed-in value is negative (i.e. chips spent), chips_bonus
           *    is ignored. If negative value would drop chips below zero,
           *    chips are not updated.
           *
           * DOES NOT UPDATE DATABASE.
           *
           * @param $chips Chips to add
           * @return Change amount on success, false on failure
           */
         function add_chips($ch)
         {
             if($ch<0) //subtracting chips, make sure there are enough
             {
                 if($this->chips < $ch)
                 {
                     return false;
                 }
                 else
                 {
                     $this->chips += $ch;
                     return $ch;
                 }

             }
             else
             {
                   //add any bonus the player has
                 $adj_chips = round($ch * $this->chips_bonus);
                 $this->chips += $adj_chips;
                 return $adj_chips;
             }
         }
         
         /**
           * Boost current gamma by passed-in value to current max. Will not
           * boost higher than max. Also sets update time to current time.
           *
           * DOES NOT VERIFY THAT CURRENT GAMMA IS CORRECT
           * DOES NOT UPDATE DATABASE
           *
           * @param $gamma
           * @return
           */
         function update_gamma($gamma)
         {
             $this->current_gamma
                   = min( $this->current_gamma + $gamma,
                          $this->max_gamma);
             if($this->current_gamma < 0)
             {
                 $this->current_gamma = 0;
             }    
             $this->gamma_update_time = time();
         }
         
         /**
           * Boost current stamina by passed-in value to current max. Will not
           * boost higher than max. Will not drop below zero. Also sets update
           * time to current time.
           *
           * DOES NOT VERIFY THAT CURRENT STAMINA IS CORRECT
           * DOES NOT UPDATE DATABASE
           *
           * @param $stamina
           * @return
           */
         function update_stamina($stamina)
         {
             $this->current_stamina = min( $this->current_stamina + $stamina,
                                        $this->max_stamina );
             if($this->current_stamina < 0)
             {
                 $this->current_stamina = 0;
             }
             $this->stam_update_time = time();
         }
        /**
          * Boost current health by passed-in value to current max. Will not
          * boost higher than max. Will not drop below zero. Also sets update
          * time to current time.
          *
          * DOES NOT VERIFY THAT CURRENT HEALTH IS CORRECT W/DB
          * DOES NOT UPDATE DATABASE
          *
          * @param $health
          * @return true if player died, else false
          */
         function update_health($health)
         {
			 $died = false;
             $this->current_health = min( $this->current_health + $health,
                                          $this->max_health );
             if($this->current_health < 0)
             {
                 $this->current_health = 0;
				 $died = true;
             }
             $this->health_update_time = time();
			 return $died;
         }
     }
?>