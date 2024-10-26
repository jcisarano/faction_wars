<?php
/**
  * Process conflict between players
  * Breakdown of steps involved:
  *
  *  get post data: player_id, opponent_id, town_id
  *
  * get player info
  *
  * verify player has enough stamina for pvp
  * if not, prepare insufficient stamina message4
  *
  * update player stamina
  * get opponent info
  *
  * get their weapon/armor inventories
  * choose player's best weapons, give as many as in his army
  * choose player's best skills, give as many as in his army
  * choose player's best mutations, give as many as in his army
  *
  * choose opponent's best armor, give as many as in his army
  * choose opponent's best skills, give as many as in his army
  * choose opponent's best mutations, give as many as in his army

  * determine faction relationship according to faction wheel, get faction multiplier

  * total attack values of player's weapons, skills, mutations
  * total defense values of opponenet's armor, skills, mutations
  *
  * calculate result multiplier (relative difficulty of fight)
  *
  * compare player's total attack to oppponent's total defense to determine victor
  *
  * victory:
  * 	calculate XP gain
  * 	update win/loss stats
  * 	update faction standings
  * 	calc chip reward
  * 	build output
  *
  * defeat:
  * 	update faction standings in opponent's favor
  * 	update win/loss stats
  * 	calc chip loss
  * 	build output
  *
  * build items used output
  * update player, opponent db
  * process acheivements
  * render new player data for display
  * return results array
  *
  * @version 13 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 16 September 2009
  *         return achievement and levelup notices 11 Oct 2009
  *         added more achievement support 13 April 2010
  */
  
 require_once('../lib/config.php');
 require_once('../' . LIB_PATH . '/display.php');
 require_once('../' . LIB_PATH . '/db_access_player.php');
 require_once('../' . LIB_PATH . '/db_access_pvp.php');
 require_once('../' . LIB_PATH . '/player.class.php');
 require_once('../' . LIB_PATH . '/db_access_faction.php');
 require_once('../' . LIB_PATH . '/db_access_message.php');


 $db  = new PlayerDatabase;
 $pvp = new PvpDatabase;
 $fac_db = new FactionDatabase;
 $db_message = new MessageDatabase;

 $player_id   = 0;
 $opponent_id = 0;
 $town_id     = 0;

 $xp     = 0;
 $chips  = 0;
 $damage = 0;

 $fail = false;

 $title      = '';
 $body       = '<div class="pvpResult">';
 $popup      = '';
 $popuptitle = '';
 $new_map    = '';
 $update_map = 0;
 
 $win_pics  = array(0 => 'rear_horse.jpg', 'sunset_horse.jpg',
                             'rockout.jpg', 'airguitar.jpg');
 $loss_pics = array(0 => 'deadhorse.jpg', 'melee.jpg', 'punch.jpg',
                                         'zombies1.jpg');

 if(isset($_POST['player_id']))
 {
     $player_id = $_POST['player_id'];
 }

 if(isset($_POST['opponent_id']))
 {
     $opponent_id = $_POST['opponent_id'];
 }
 if(isset($_POST['town_id']))
 {
     $town_id = $_POST['town_id'];
 }
 
   //player information from db
 $player   = $db->get_player_data($player_id);
 if( $player->current_stamina < 1)
 {
     $fail = true;
     $title = 'Too weak to continue . . .';
     $body .= 'You must have at least 1 stamina
                   to challenge an opponent.
                   <form method="link" action="clan.php">
                   <input type="submit" value="Get more stamina"
                   class="fwButton"/></form>';
 }

 if( $player->current_health < MIN_HEALTH )
 {
     $fail = true;
     $title = 'Already took a beating . . .';
     $body .= '<br />You must have at least ' . MIN_HEALTH . ' health
                   to challenge an opponent.
                   <form method="link" action="clan.php">
                   <input type="submit" value="Get more health"
                   class="fwButton"/></form>';
 }
 
 if( !$fail )
 { 
     $player->update_stamina(-STAM_COST);

     $opponent = $db->get_player_data($opponent_id);

      //get inventories
     $p_inventory = $db->get_player_inventory($player_id);
     $o_inventory = $db->get_player_inventory($opponent_id);

       //the number of players in each army determines how many
       //attacks or defenses the player can use in combat.
     //$player_team_list = $facebook->api_client->friends_getAppUsers();  
     $p_posse = $player->army_size +1;
     $o_posse = $opponent->army_size +1;
     
       //find items to use in combat
       /////////////////////////////
       //player stuff -- organize by best attack values
       //best player weapons
     $counter = $p_posse;
     $raw = $pvp->get_items_by_type($player->userid, WEAPON, 0);
     if($raw)
     {
         foreach($raw as $weapon)
         {
             if( $counter > 0 )
             {
                 if($weapon['quantity'] >= $counter) //more inventory than need
                 {
                     $weapon['quantity'] = $counter;
                     $counter = 0; //done counting
                     $p_weapons[] = $weapon;
                 }
                 else //less inventory than need
                 {
                     $counter -= $weapon['quantity'];
                     $p_weapons[] = $weapon;
                 }
             }
             else
             {
                 break;
             }
         }
     }
     
       //best player skills
     $counter = $p_posse;
     $raw = $pvp->get_items_by_type($player->userid, SKILL, 0);
     if($raw)
     {

         foreach($raw as $skill)
         {
             if( $counter > 0 )
             {
                 if($skill['quantity'] >= $counter)
                 {
                     $skill['quantity'] = $counter;
                     $counter = 0;
                     $p_skills[] = $skill;
                 }
                 else
                 {
                     $counter -= $skill['quantity'];
                     $p_skill[] = $skill;
                 }
             }
             else
             {
                 break;
             }
         }
     }

       //best player mutations
     $raw = $pvp->get_items_by_type($player->userid, MUTATION, 0);
     $counter = $p_posse;
     if($raw)
     {
         foreach($raw as $mutation)
         {
             if( $counter > 0 )
             {
                 if($mutation['quantity'] >= $counter)
                 {
                     $mutation['quantity'] = $counter;
                     $counter = 0;
                     $p_mutes[] = $mutation;
                 }
                 else
                 {
                     $counter -= $mutation['quantity'];
                     $p_mutes[] = $mutation;
                 }
             }
             else
             {
                 break;
             }
         }
     }

       //opponent stuff -- organize by best defense values
       //best armor
     $counter = $o_posse;
     $raw = $pvp->get_items_by_type($opponent->userid, ARMOR, 1);
     if($raw)
     {
         foreach($raw as $armor)
         {
             if( $counter > 0 )
             {
                 if($armor['quantity'] >= $counter)
                 {
                     $armor['quantity'] = $counter;
                     $counter = 0;
                     $o_armor[] = $armor;
                 }
                 else
                 {
                     $counter -= $armor['quantity'];
                     $o_armor[] = $armor;
                 }
             }
             else
             {
                 break;
             }
         }
     }

       //best skills
     $counter = $o_posse;
     $raw = $pvp->get_items_by_type($opponent->userid, SKILL, 1);
     if($raw)
     {
         foreach($raw as $skill)
         {
             if( $counter > 0 )
             {
                 if($skill['quantity'] >= $counter)
                 {
                     $skill['quantity'] = $counter;
                     $counter = 0;
                     $o_skills[] = $skill;
                 }
                 else
                 {
                     $counter -= $skill['quantity'];
                     $o_skills[] = $skill;
                 }
             }
             else
             {
                 break;
             }
         }
     }

       //best mutations
     $raw = $pvp->get_items_by_type($opponent->userid, MUTATION, 1);
     $counter = $o_posse;
     if($raw)
     {
         foreach($raw as $mutation)
         {
             if( $counter > 0 )
             {
                 if($mutation['quantity'] >= $counter)
                 {
                     $mutation['quantity'] = $counter;
                     $counter = 0;
                     $o_mutes[] = $mutation;
                 }
                 else
                 {
                     $counter -= $mutation['quantity'];
                     $o_mutes[] = $mutation;
                 }
             }
             else
             {
                 break;
             }
         }
     }

       //determine friend/ally for rewards
     $fac_mult = $pvp->get_faction_multiplier($player->faction,
                                              $opponent->faction);

     $attack_score = $player->attack; //base score
       //determine useable equipment on both sides
       //scores determined by mastery of item

     if(isset($p_weapons))
     {
         foreach( $p_weapons as $weapon )
         {
             $bonuses = get_bonus($weapon);
             $attack_score += $bonuses['attack'] * $weapon['quantity'];
         }
     }

     if(isset($p_skills))
     {
         foreach( $p_skills as $skill )
         {
             $bonuses = get_bonus($skill);
             $attack_score += $bonuses['attack'] * $skill['quantity'];
         }
     }

     if(isset($p_mutes))
     {
         foreach( $p_mutes as $mutation )
         {
             $bonuses = get_bonus($mutation);
             $attack_score += $bonuses['attack'] * $mutation['quantity'];
         }
     }
     
     $player->adj_attack = $attack_score; //store in db for use 
                                          //in get_opponents.php

     $defense_score = $opponent->defense;

     if(isset($o_armor))
     {
         foreach( $o_armor as $armor )
         {
             $bonuses = get_bonus($armor);
             $defense_score += $bonuses['defense'] * $armor['quantity'];
         }
     }
     if(isset($o_skills))
     {
         foreach( $o_skills as $skill )
         {
             $bonuses = get_bonus($skill);
             $defense_score += $bonuses['defense'] * $skill['quantity'];
         }
     }
     if(isset($o_mutes))
     {
         foreach( $o_mutes as $mutation )
         {
             $bonuses = get_bonus($mutation);
             $defense_score += $bonuses['defense'] * $mutation['quantity'];
         }
     }

     $opponent->adj_attack = $defense_score; //store for use in get_opponents

     $success_chance = 100 * ($attack_score
                               /($attack_score + $defense_score));
     
     $xp_multiplier = (100 - $success_chance)/100;
       //calculate xp gain
     //$xp = round( (BASE_XP + max($opponent->level - $player->level,0))
       //           * $xp_multiplier );
     //$xp = BASE_XP + max($opponent->level - $player->level,0);
     $xp = round( ((BASE_XP + $opponent->level)*$xp_multiplier)/2);


     $roll = mt_rand(1, 100); //die roll to hit
     
     //roll dice, determine outcome
     if($roll <= $success_chance)
     {
           ///////
           //player wins
           ///////
         $win = true;
         $p_achieve_type = PVP_WIN;
         $o_achieve_type = PVP_LOSS;

         if( $player->update_xp($xp))
         {
             $popuptitle .= 'Congratulations!';
            $popup .= '<div class="pvpResult">'
                              . render_levelup_notice($player)
                              . '</div>';

               //track levelup statistics
             require_once('../' . LIB_PATH . 'db_access_metrics.php');
             $metrics_db = new MetricsDatabase;
             $ttl = time() - $player->datein;
             $metrics_db->set_time_to_level($player->level, $ttl);
             $metrics_db->set_cash_on_level($player->level,
                                                  $player->chips);
         }

           //win/loss stats
         $player->fights_won += 1;
         $opponent->fights_lost += 1;

           //faction gain for player
         $faction = $xp * $fac_mult; //adjust base for fac wheel
           //set faction points in db
           //award to winner
         $facresult = $fac_db->update_faction_score( $town_id,
                                     $player->faction, $faction);
           //subtract from loser
         $fac_db->update_faction_score( $town_id,
                                        $opponent->faction, -$faction);

           //process faction update results
         $fac = $fac_db->get_faction_info($player->faction);
         $fac_output = get_faction_output($facresult,
                                          $fac[$player->faction]->faction);
           //damage done
         $damage = calculate_damage();

           //money gain/loss (both sides)
           //set a max gain?
         $multiplier = (mt_rand(1,BASE_CHIPS))/100;
         $chips = round($opponent->chips * $multiplier);

         $a_chips = $chips; //will be added to achievement total
         $chips = $player->add_chips($chips);
         $opponent->add_chips(-$chips);
         $opponent_died = $opponent->update_health( -$damage );
         $title = 'The Thrill of Victory!';
         $img = $win_pics[mt_rand(0,(count($win_pics)-1))];
         $body .= '<img src="' . ROOT . GEN_PATH . '/' . $img . '"/>'
               . '<p>';

           //items for output
         $plural = get_plural($damage);
         $abs_dmg = abs($damage);

         if($opponent_died)
         {
             $body .= '<span id="brawlKill">You did ' . $abs_dmg
                   . ' point' . $plural . ' of damage and killed '
                   . $opponent->name . '</span>';
             $opponent->deaths += 1;
             $player->kills += 1;
         }
         else
         {
             $body .= 'You won the brawl, doing ' . $abs_dmg
               . ' point' . $plural . ' of damage to ' . $opponent->name;
         }
         $plural = get_plural($chips);
         $body .= '. You earned ' . number_format($xp);
         $body .= ' xp and scavenged ' . number_format($chips);
         $body .= ' chip' . $plural . ' from the corpses.';
         $body .= $fac_output . '</p>';
     }
     else
     {
           /////////
           //opponent wins
           ////////
         $p_achieve_type = PVP_LOSS;
         $o_achieve_type = PVP_WIN;
         $win = false;
           //faction gain for opponent
         $faction = $xp * $fac_mult;
           //set faction points in db
           //opponent gains faction
         $facresult = $fac_db->update_faction_score( $town_id,
                                     $opponent->faction,
                                     $faction);
           //player loses faction
         $facresult = $fac_db->update_faction_score( $town_id,
                                     $player->faction,
                                     -$faction);

           //process faction update results
         $opp_fac    = $fac_db->get_faction_info($opponent->faction);
         $fac_output = get_faction_output($facresult,
                                          $opp_fac[$opponent->faction]
                                                              ->faction);
           //damage taken
         $damage = calculate_damage();
         //$damage = round(($roll - $success_chance)/4);

           //win/loss stats
         $opponent->fights_won += 1;
         $player->fights_lost += 1;

           //money gain/loss (both sides)
           //set a max gain?
         $multiplier = (mt_rand(1,BASE_CHIPS))/100;
         $chips = round($player->chips * $multiplier);

         $a_chips = $chips; //chips the opponent gets, used for acheivement
                            //tracking below

         $player->add_chips(-$chips);
         $player_died = $player->update_health( - $damage );
         $opponent->add_chips($chips);

         $title = 'The Agony of Defeat';
         $img = $loss_pics[mt_rand(0,(count($loss_pics)-1))];
         $body .= '<img src="' . ROOT . GEN_PATH . '/' . $img . '"/>'
             . '<p>';

         $plural  = get_plural($damage);
         $abs_dmg = abs($damage);
         if($player_died)
         {
             $body .= 'You took ' . $abs_dmg
                 . ' point' . $plural . ' of damage in the brawl and were
                     killed';
             $player->deaths += 1;
             $opponent->kills += 1;
         }
         else
         {
             $body .= 'You lost the brawl, taking ' . $abs_dmg
             . ' point' . $plural . ' of damage';
         }
         $xp=0;
         $plural = get_plural($chips);
         $body .= '. You earned ' . number_format($xp);
         $body .= ' xp and lost ' . number_format($chips);
         $body .= ' chip' . $plural;
         $body .= ' to ' . $opponent->name . '.';
         $body .= $fac_output . '</p>';
     }
     $body .= '<p>Win more brawls by growing your clan, finding better
                      gear, and upgrading your skills and
                      mutations.<br />';

       //table to display lists of player & opponent gear as used
     $body .= '<br /><a onclick="showPopup(\'pvpGear\');return false;"
                class="infoLink">See the gear used in the fight</a></p>
            <div id="pvpGear"><div id="pvpGearTable">
            <table id="gearTable">'
           . '<tr><th>You</th>
                  <th>' . $opponent->name . '</th></tr>'
           . '<tr><td><span class="label">Weapons: </span>';
     if(isset($p_weapons))
     {
         foreach($p_weapons as $weapon)
         {
             $body .= $weapon['name'] . ' (x' . $weapon['quantity'] . ') ';
         }
     }
     else
     {
         $body .= 'None';
     }
     $body .= '<br /><span class="label">Skills: </span>';
     if(isset($p_skills))
     {
         foreach($p_skills as $skill)
         {
             $body .= $skill['name'] . ' (x' . $skill['quantity'] . ') ';
         }
     }
     else
     {
         $body .= 'None';
     }
     $body .= '<br /><span class="label">Mutations: </span>';
     if(isset($p_mutes))
     {
         foreach($p_mutes as $mutation)
         {
             $body .= $mutation['name']
                   . ' (x' . $mutation['quantity'] . ') ';
         }
     }
     else
     {
         $body .= 'None';
     }

     $body .= '</td><td><span class="label">Armor: </span>';
     if(isset($o_armor))
     {
         foreach($o_armor as $armor)
         {
             $body .= $armor['name'] . ' (x' . $armor['quantity'] . ') ';
         }
     }
     else
     {
         $body .= 'None';
     }

     $body .= '<br /><span class="label">Skills: </span>';
     if(isset($o_skills))
     {
         foreach($o_skills as $skill)
         {
             $body .= $skill['name'] . ' (x' . $skill['quantity'] . ') ';
         }
     }
     else
     {
         $body .= 'None';
     }
     $body .= '<br /><span class="label">Mutations: </span>';
     if(isset($o_mutes))
     {
         foreach($o_mutes as $mutation)
         {
             $body .= $mutation['name']
                   . ' (x' . $mutation['quantity'] . ') ';
         }
     }
     else
     {
         $body .= 'None';
     }

     $body .= '</td></tr></table><br />
            <a onclick="hidePopup(\'pvpGear\');return false;">Close</a>
            </div></div>';

       //achievement handling
       //init
     require_once( '../' . LIB_PATH . 'db_access_achievement.php');
     $achieve_db = new AchievementDatabase;

       //update pvp win/loss numbers
       //player
     $ach = $achieve_db->increment_achievement($opponent->faction,
                                               $p_achieve_type,
                                               $player->userid, 1);
       //opponent
     $achieve_db->increment_achievement($player->faction, $o_achieve_type,
                                        $opponent->userid, 1);

       //kills
     if($opponent_died)
     {
           //update achievement stat tracking, store achievement data if earned
         $ach1 = $achieve_db->increment_acheivement(PVP_KILL, PVP_WIN,
                                                    $player->userid, 1);
         $achieve_db->increment_acheivement(PVP_KILL, PVP_LOSS,
                                                    $opponent->userid, 1);
         $ach = array_merge($ach, (array)$ach1);
     }
     else if($player_died)
     {
           //update achievement stat tracking, store achievement data if earned
         $ach1 = $achieve_db->increment_acheivement(PVP_KILL, PVP_LOSS,
                                                    $player->userid, 1);
         $achieve_db->increment_acheivement(PVP_KILL, PVP_WIN,
                                                    $opponent->userid, 1);
         $ach = array_merge($ach, (array)$ach1);
     }

       //update chip achievement total
     if($win)
     {
           //add player chips
         $ach2 = $achieve_db->increment_achievement(CHIP_ITEM, CHIP_TOTAL,
                                                    $player->userid, $a_chips);
         $ach = array_merge($ach, (array)$ach2);
     }
     else
     {
           //add opponent chips
         $achieve_db->increment_achievement(CHIP_ITEM, CHIP_TOTAL,
                                            $opponent->userid, $a_chips);
     }

       //create achievement output if needed
     if(isset($ach))
     {
         $popuptitle = 'Congratulations!';
         foreach($ach as $achievement)
         {
             $player->achieve_points += $achievement['ap'];
             $player->faction_points += $achievement['fp'];

             $popup .= '<div class="pvpResult">'
                  . render_achievement_notice($achievement)
                  . '</div>';
         }
     }
     

       //update databases:
     $db->update_player_db($player);
     $db->update_player_db($opponent);

     //send internal win/loss message
     //later, fb message should be sent here
     if($p_achieve_type == PVP_WIN)
     {
         $db_message->send_message($opponent->userid, $player->userid,
                                   PVP_LOSS_MESSAGE, abs($damage), $chips);
     }
     else if($p_achieve_type == PVP_LOSS)
     {
         $db_message->send_message($opponent->userid, $player->userid,
                                   PVP_WIN_MESSAGE, abs($damage), $chips);
     }
 }
 $body .= '</div>';
 $stats = render_player_data($player);
 $output = array( 'fbml_title'  => '<h1>' . $title . '</h1>',
                  'fbml_body'   => $body,
                  'playerstats' => $stats,
                  'fbml_popup'  => $popup,
                  'popuptitle'  => $popuptitle,
                  'fbml_map'    => $new_map,
                  'update_map'  => $update_map );

 echo json_encode($output);

 /**
   * Determines an item's attack and defense bonuses based on player's
   * mastery level with that item.
   *
   * @param $item standard item array from get_player_inventory,
   *              get_item_info -- must include 'mastery' column along with
   *              bonus info columns
   * @return assoc array of attack and defense bonuses:
   *         {attack, defense}
   */
 function get_bonus($item)
 {
     $attack  = 0;
     $defense = 0;
     switch((int)$item['mastery'])
     {

         case 0:
         case null:
              $attack  = $item['attack_bonus_one'];
              $defense = $item['defense_bonus_one'];
              break;
         case 1:
              $attack  = $item['attack_bonus_two'];
              $defense = $item['defense_bonus_two'];
              break;
         case 2:
              $attack  = $item['attack_bonus_three'];
              $defense = $item['defense_bonus_three'];
              break;
         default:
                //error case - should be one of the other options
              $attack  = $item['attack_bonus_one'];
              $defense = $item['defense_bonus_one'];
              break;
    }

    return array ('attack'  => $attack,
                  'defense' => $defense);
 }

 /**
   * Calculate PvP damage using exploding dice system
   *
   * @param $damage starting damage--should generally be left at 0
   * @param $roll_num tracks rolls towards max -- should usually be left at 0
   *
   * @return total damage for pvp attack
   */
 function calculate_damage($damage='0', $roll_num='0')
 {
     $MAX_NUM_ROLLS = 3; //how many rolls do we want to make
     $DIE_SIZE      = 8; //upper limit for rand
     $CUTOFF        = 1; //how many of the upper values will generate
                               //another roll

     $new_damage = mt_rand(1,$DIE_SIZE);
     $damage = $damage + $new_damage;

     if( $roll_num < $MAX_NUM_ROLLS
         && $new_damage >= ($DIE_SIZE - $CUTOFF) )
     {
         return calculate_damage($damage,$roll_num + 1);
     }
     else
     {
         return $damage;
     }
 }
 
 function calc_dmg()
 {
     $MAX_NUM_ROLLS = 3; //how many rolls do we want to make
     $DIE_SIZE      = 8; //upper limit for rand
     $CUTOFF        = 1; //how many of the upper values will generate
                               //another roll
 }

 /**
   * Generate faction result display based on pvp result and player info
   *
   * @param $fac_result faction point info array from faction_update_score
   *                    in db_access_faction
   *
   * @return text/html to include in pvp result output
   */
 function get_faction_output($fac_result, $fac_name)
 {
     $f = '';
     if($fac_result['points'] > 0)
     {
         $f = '<br /><br />Your victory has earned influence for the '
                          . $fac_name
                          . ' in this town.';
     }

     return $f;
 }
 
 /**
   * Checks if number is plural, returns s if true
   *
   * @param $number
   * @param $use_e if true, adds e to return. Default = false
   *
   * @param return plain text, either 's' or 'es'
   */
 function get_plural($number, $use_e='0')
 {
     if($use_e==true)
     {
         return $number==1 ? '' : 'es';
     }
     else
     {
         return $number==1 ? '' : 's';
     }
 }
?>