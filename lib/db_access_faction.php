<?php
 /**
   * Database access items related to player data
   *
   * @version 21 September 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   * @history
   *         created 21 September 2009
   */

 require_once 'config.php';
 /*
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
 */
 require_once('faction.class.php');
 require_once('db_connect.php');

 class FactionDatabase
 {
     protected $db_util;

     public function __construct()
     {
         $this->db_util = new DatabaseUtilities;
     }

     /**
       * Returns all info on factions from db. If factionid given,
       * returns info on that faction only. Default is all.
       *
       * @param $factionid
       * @return array of Faction objects
       */
     function get_faction_info($factionid='0')
     {
       
         if( !$this->db_util->validate_int($factionid) )
         {
             die('Invalid faction id in get_faction_name('.$factionid.')');
         }

         $factions;
         $query = 'SELECT * FROM '
                . FACTION;
         
         //echo '<p style="color:#000;">'.$query.'</p>';

         if( $factionid != 0 )
         {
             $query .= ' WHERE id=' . $factionid;
         }

         $result = $this->db_util->execute_query($query);

         while($row = mysql_fetch_array($result, MYSQL_ASSOC))
         {
             $fac = new Faction;

             $fac->id            = $row['id'];
             $fac->faction       = $row['faction'];
             $fac->description   = $row['description'];
             $fac->description_2 = $row['description_2'];
             $fac->image         = $row['image'];
             $fac->enemyid       = $row['enemyid'];
             
             $fac->gamma_update_rate  = $row['gamma_update_rate'];
             $fac->stam_update_rate   = $row['stamina_update_rate'];
             $fac->health_update_rate = $row['health_update_rate'];
             $fac->chips_bonus        = $row['chips_bonus'];
             $fac->xp_bonus           = $row['xp_bonus'];
             $fac->start_attack       = $row['start_attack'];
             $fac->start_defense      = $row['start_defense'];
             $fac->thumb              = $row['thumb'];

               //set ids according to faction id from db
             $factions[$row['id']]= $fac;
         }
         return $factions;
     }

    /**
      * Increment faction score for given town by amount provided.
      * Won't increment score of faction already owning town.
      * If a new fac takes the town, that db is also updated.
      *
      * @param $townid
      * @param $factionid
      * @param $score
      *
      * @return array of data added to db: {win, points, newFac}
      *         win - bool - did a new faction take the town?
      *         points - how many points actually added to score?
      *         newFac - if win, what fac now owns the town?
      */
    function update_faction_score($townid, $factionid, $score)
    {
        $threshold = TOWN_FAC_THRESHOLD;

        $faction_win = false;
        $newFacId    = null;

        require_once('db_access.php');
        $db_acc = new DatabaseAccess;
        $town = $db_acc->get_town_info($townid);
        if($town[$townid]->owner_factionid == $factionid)
        {
            return array('win'       => false,
                         'points'    => 0,
                         'newFac'    => null);
        } 

          //update score -- won't increment town owner's score
        $query = 'UPDATE ' . FAC_SCORES . ', ' . TOWN
               . ' SET score=score+' . $score
               . ' WHERE townid=' . $townid
               . ' AND factionid=' . $factionid
               . ' AND townid=' . TOWN . '.id'
               . ' AND ' . TOWN . '.owner_factionid != ' . $factionid;
        $this->db_util->execute_query($query);

        $query = 'UPDATE ' . FAC_SCORES
               . ' SET score=0 WHERE score<0';
        $this->db_util->execute_query($query);

        $results =  array('win'       => $faction_win,
                          'points'    => $score,
                          'newFac'    => $newFacId);
        return $results;
    }

    /**
      * Looks at faction stats and picks new owner of town by which fac 
      * has the highest current score. Then sets new faction owner info in 
      * town table and resets scores in faction score table.
      *
      * @param townid Town to check and update.
      */
    function set_faction_owner($townid='0')
    {
        $query = 'SELECT * FROM ' . FAC_SCORES . ' WHERE townid=' . $townid
               . ' ORDER BY score DESC LIMIT 0,1';

        $result = $this->db_util->execute_query($query);
        
        while($row=mysql_fetch_array($result, MYSQL_ASSOC))
        {
            if($row['score'] < 1)
            {
                //top score was zero, meaning no activity since last turnover
                //keep the same owner, reset timer
                $query = 'UPDATE ' . TOWN 
                    . ' SET ownership_date=' . time()
                    . ' WHERE ' . TOWN . '.id=' . $row['townid'];
            }
            else
            {
                //at least one point means legit win
                //set new owner, reset scores, reset timer
                $query = 'UPDATE ' . FAC_SCORES . ', ' . TOWN
                    . ' SET ' . FAC_SCORES . '.score=0, '
                    . TOWN . '.owner_factionid=' . $row['factionid'] . ', '
                    . TOWN . '.owned=1, '
                    . TOWN . '.ownership_date=' . time()
                    . ' WHERE ' . FAC_SCORES . '.townid=' . $row['townid']
                    . ' AND ' . TOWN . '.id=' . $row['townid'];
            }
            $this->db_util->execute_query($query);
        }
    }//end set_faction_owner
 }
?>