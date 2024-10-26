<?php

     /**
       * Mission update for FE faction wars. Grabs info from db, returns markup
       * for display in browser.
       *
       * @version 28 August 2009
       * @author Jason Cisarano jcisarano@icarusstudios.com
       *
       * @history
       *         created 28 August 2009
       */

     include_once('../lib/config.php');
     include_once('../' . LIB_PATH . '/db_access.php');
     include_once('../' . LIB_PATH . '/db_access_player.php');

     $db        = new DatabaseAccess;
     $player_db = new PlayerDatabase;

     $townid         =0;
     $playerid       =0;
     $player_faction =0;

     if(isset($_POST['townid']))
     {
         $townid = $_POST['townid'];
     }

     if(isset($_POST['p_faction']))
     {
         $player_faction = $_POST['p_faction'];
     }

     if(isset($_POST['p_id']))
     {
         $playerid = $_POST['p_id'];
     }

     $player = $player_db->get_player_data($playerid);
     $town   = $db->get_town_info($townid);

     $missions = $db->get_gen_town_missions($townid, $playerid);
     $missions = array_merge( (array)$missions,
                              (array)$db->get_owned_town_missions(
                                                   $townid,
                                                   $player_faction,
                                                   $playerid));
     $missions = array_merge( (array)$missions,
                              (array)$db->get_faction_missions(
                                                   $townid,
                                                   $player_faction,
                                                   $playerid));

     $output = '<div id="missions">';
     $output .= '<br /><h1 style="text-align:center;">Available missions
                in ' . $town[$townid]->name . '</h1>';

     if($missions)
     {
         foreach($missions as $key=>$mish)
         {
               //set amount for mission completion
             switch((int)$mish->player_mastery)
             {
                  case 0:
                  case null:
                      $bump = $mish->completion_one;
                      break;
                  case 1:
                      $bump = $mish->completion_two;
                      break;
                  case 2:
                      $bump = $mish->completion_three;
                      break;
                  default:
                      $bump = 0;
                      break;
             }

             $button = '<input type="submit" value="Run mission"
                          class="fwButton"'
                . 'onClick="runMission(\''
                . ROOT . HANDLER_PATH . '/mission_handler.php\', '
                . $mish->id .', '. $townid . ', \'progress_'
                . $mish->id
                . '\', \'mastery_' . $mish->id .'\', \'earn_'
                   . $mish->id . '\')" />';

             $output .= '<div class="mission"><div class="mishTitle">
                     <div class="mishTitleLeft"><h1>' . $mish->title . '</h1>';
                //mission completion bar with percent bump
             if((int)$mish->player_mastery<MAX_UPGRADE)//3 levels maximum
             {
                 $output .= 'Level: <span id="mastery_'
                     . $mish->id . '">' . ((int)$mish->player_mastery + 1 )
                     . '</span> '
                     . ' Earn: <span id="earn_' . $mish->id . '">'
                     . $bump . '</span>%</div>'
                     . '<div class="mishTitleRight">' . $button . '</div>'
                     . '<div class="fwClear"></div>'
                     . '<div class="progressBarFrame"><div id="progress_'
                     . $mish->id . '" style="width:'
                     . max(0, (int)$mish->player_progress%100)
                     . '%;height:100%;"></div></div>';
             }
             else
             {
                   //mission complete bar
                 $output .= 'Level: <span id="mastery_'
                     . $mish->id . '">' . ((int)$mish->player_mastery + 1 )
                     . '</span> '
                     .  ' Mastered</div>'
                     . '<div class="mishTitleRight">' . $button . '</div>'
                     . '<div class="fwClear"></div>'
                     . '<div class="progressBarFrame"><div id="progress_'
                     . $mish->id . '" style="width:100%;"></div></div>';

             }
             $output .= '<a onclick="showPopup(\'mishBody_' . $key
                     . '\');return false;" class="infoLink">More info</a>'
                     . '</div>';

               //picture and button in 1st column
             $output .= '<div id="mishBody_' . $key . '" style="display:none;">
                        <div class="mishNarrowColumn"><img src="'
                . ROOT . MISH_IMG_PATH . $mish->image . '" /> '
                . '</div>';

               //mission description
             $output .= '<div class="mishWideColumn">' . $mish->description
                . '</div>';

               //rewards and ingredients
             $output .= '<div class="mishWideColumn"><span class="reward">
                Rewards:</span> <br />'
                . $mish->chips_min . ' - '. $mish->chips_max
                . ' chips<br />' . $mish->xp_min . ' - '
                . $mish->xp_max . ' experience<br />';

               //rewards
             if($mish->treasure_table)
             {
                 foreach($mish->treasure_table as $treasure)
                 {
                     if($treasure['item_type'] != NOTHING)
                     {
                         $output .= $treasure['name'] . ' x'
                                 . $treasure['quantity']
                                 . ' (' . $treasure['chance'] . '% chance) <br />';
                     }
                 }
             }
             if($player->current_gamma < $mish->energy_drain)
             {
                 $class = 'insufficient';
             }
             else
             {
                 $class = 'complete';
             }

               //ingredients
             $output .= '<br /><span class="reward">Requirements:</span><br />
                <span class="' . $class . '">' . $mish->energy_drain
                . ' Gamma</span><br />';
                if($mish->ingredients)
                {
                    foreach($mish->ingredients as $ingredient)
                    {
                        $player_has = $player_db->player_has_item($playerid,
                                                       $ingredient['itemid'],
                                                       $ingredient['quantity']);
                        if($player_has < $ingredient['quantity'])
                        {
                            $class = 'insufficientMishImg';
                        }
                        else
                        {
                            $class = 'completeMishImg';
                        }

                        $output .= '<img src="' . ROOT . ITEM_PATH
                                . $ingredient['image']
                                . '" title="'
                                . $ingredient['name'] . ' x'
                                . $ingredient['quantity'] . ' (Have: '
                                . max(0, $player_has) . ')"'
                                . 'class="' . $class . '"/>';
                    }
                }
             $output .= '</div><a onclick="hidePopup(\'mishBody_' . $key
                     . '\');return false;">Close</a></div></div>';
             $output .= '<div class="clearDiv"></div>';
         }
     }
     $output .='</div>';

     echo $output;

?>