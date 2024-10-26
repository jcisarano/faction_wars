<?php
 /**
   * Merchant backend script. Grabs item information from db based on
   * current town, returns markup for inclusion in web page.
   *
   * @version 20 November 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         created 15 September 2009
   *         add mission mastery 20 November 2009
   *         add support for button update 8 feb 2010
   */

 require_once('../lib/config.php');
 require_once('../' . LIB_PATH . '/db_access.php');

 $db = new DatabaseAccess;
 
 $townid         = 0;
 $player_faction = 0;
 $player_id      = 0;
 $output         = '';

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
     $player_id = $_POST['p_id'];
 }

 $items = $db->get_town_items( $townid, $player_id);
 
 foreach($items as $item)
 {
     if( ($item['item_type'] != SKILL && $item['item_type'] != MUTATION)
         || $item['purchasable']
         || $item['quantity'] > 0 )
     {
     switch((int)$item['mastery'])
     {
         case 0:
         case null:
             $bump = $item['completion_one'];
             $attack = $item['attack_bonus_one'];
             $defense = $item['defense_bonus_one'];
             $price = $item['price_one'];
             break;
         case 1:
             $bump = $item['completion_two'];
             $attack = $item['attack_bonus_two'];
             $defense = $item['defense_bonus_two'];
             $price = $item['price_two'];
             break;
         case 2:
             $bump = $item['completion_three'];
             $attack = $item['attack_bonus_three'];
             $defense = $item['defense_bonus_three'];
             $price = $item['price_three'];
             break;
         default:
             $bump = 0;
             break;
    }
     $output .= '<div class="item"><div class="itemTitle">'
         . '<h1>' . $item['name'];

     switch((int)$item['item_type'])
     {
         case WEAPON:
              $output .= ' - Weapon';
              break;
         case ARMOR:
              $output .= ' - Armor';
              break;
         case SKILL:
              $output .= ' - Skill';
              break;
         case MUTATION:
              $output .= ' - Mutation';
              break;
         case SCRAP:
              $output .= ' - Component';
              break;
     }

     $output .= '</h1>';

     if($item['item_type'] == SKILL || $item['item_type'] == MUTATION )
     {
         //only certain types of items can be improved
         if($item['mastery']<MAX_UPGRADE)//3 levels max
         {
             $output .= 'Level: <span id="mastery_' . $item['id'] . '">'
                 . (1 + (int)$item['mastery']) . '</span>'
                 . '  Earn: <span id="delta_' . $item['id'] . '">' . $bump
                 . '</span>%'
                 . '<div class="progressBarFrame"><div id="progress_'
                     . $item['id'] . '" style="width:'
                     . max(0, (int)$item['player_reps']%100)
                     . '%;height:100%;"></div></div>';
         }
         else
         {
             //different output if levels maxed out 
             //progress bar sticks at 100%
             $output .= 'Level: <span id="mastery_' . $item['id'] . '">'
                 . (1 + (int)$item['mastery']) . '</span>'
                 . '  Earn: <span id="delta_' . $item['id'] . '">0</span>%'
                 . '<div class="progressBarFrame"><div id="progress_'
                     . $item['id'] . '" style="width:100%"></div></div>';
         }
     }
     $output .='</div>';//end itemtitle

     $output .= '<div class="itemColumn"><img src="' . ROOT . ITEM_PATH
                                                     . $item['image']
                                                     . '" /></div>';
     $output .= '<div class="itemDescColumn">' . $item['description'] .'</div>';
     $output .= '<div class="itemColumn">'
             . 'Attack: <span id="attack_' . $item['id'] . '">' . $attack 
                        . '</span><br />'
             . 'Defense: <span id="defense_' . $item['id'] . '">' . $defense 
                        .'</span><br />';
      if($item['purchasable']) //some items can't be bought
     {
         $output .= 'Cost: <span id="cost_' . $item['id'] . '">'
                        . number_format($price) . '</span><br />';
     }
     $output .= 'Sale price: <span id="salep_"' . $item['id'] . '">'
                        . number_format(ceil($price * SALE_PRICE_MULT))
                         . '</span><br />' 
             . 'Owned: <span id="item_'. $item['id']  .'">'
                       . ($item['quantity'] ? number_format($item['quantity']) 
                                            : 0)
                       . '</span><br />'
             .'</div>';

     $output .= '<div class="itemColumn">';

     if($item['purchasable']) //some items can't be bought
     {
         $output .= '<select id="buy_select_' . $item['id'] . '">'
             . '<option selected value=1>1</option>'
             . '<option value=2>2</option>'
             . '<option value=3>3</option>'
             . '<option value=4>4</option>'
             . '<option value=5>5</option>'
             . '<option value=10>10</option>'
             . '<option value=15>15</option>'
             . '</select>'
             . '<input type="submit" value="Buy" class="fwButton"
                       onclick="handleTransaction(\''
                              . ROOT . HANDLER_PATH
                              . 'transaction_handler.php\','
                              . $item['id'] .', '
                              . $player_id . ', '
                              . $player_faction . ', '
                              . $townid
                              . ', \'buy\', \'item_'
                              . $item['id'] . '\');return false;" /><br />';
     }
     else
     {
         $output .= '<input type="submit" value="Can\'t Buy"
             disabled ="true" class="fwButton_disabled" onclick="";
             return false; />';
     }

     if($item['vendable']) //some items can't be sold
     {
         $output .= '<select id="sell_select_' . $item['id'] . '">'
             . '<option selected value=1>1</option>'
             . '<option value=2>2</option>'
             . '<option value=3>3</option>'
             . '<option value=4>4</option>'
             . '<option value=5>5</option>'
             . '<option value=10>10</option>'
             . '<option value=15>15</option>'
             . '</select>'
             . '<input type="submit" value="Sell"  class="fwButton"
                    onclick="handleTransaction(\''
                    . ROOT . HANDLER_PATH
                    . 'transaction_handler.php\','
                    . $item['id'] .', '
                    . $player_id . ', '
                    . $player_faction . ', '
                    . $townid
                    . ', \'sell\', \'item_'
                    . $item['id'] . '\');return false;" /><br />';
     }
     else
     {
         $output .= '<input type="submit" value="Can\'t Sell"
             disabled ="true" class="fwButton_disabled" onclick="";
             return false; />';
     }
     if($item['item_type'] == SKILL || $item['item_type'] == MUTATION )
     {
           //only skills and mutes can be improved
         if($item['quantity'] > 0 && $item['mastery'] < MAX_UPGRADE )
         {
             $output .= '<input type="submit" value="Improve"
                            id="button_' . $item['id']. '"
                            class="fwButton"
                            onclick="handleUpgrade(\''
             . ROOT . HANDLER_PATH . 'upgrade_handler.php\', ' . $item['id']
             . ')";return false; />';
         }
         else
         {
             $output .= '<input type="submit" value="Can\'t Improve"
                        disabled ="true" id="button_' . $item['id']. '"
                        class="fwButton_disabled" onclick="";
                                                  return false; />';
         }
     }
     $output .= '</div>'; //end button column
     $output .= '</div>'; //end item
     }
 }

 echo $output;
?>