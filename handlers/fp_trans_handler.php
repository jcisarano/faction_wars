<?php
/**
  * FP Transaction Handler - handles purchases of items and perks for faction
  * points.
  * @version 20 October 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 20 October 2009
  */

include_once('../lib/config.php');

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

//require_once('../' . FB_PATH  . 'facebook.php');
require_once('../' . LIB_PATH . 'db_access.php');
require_once('../' . LIB_PATH . 'db_access_player.php');
require_once('../' . LIB_PATH . 'db_access_fp.php');
require_once('../' . LIB_PATH . 'display.php');

$db = new DatabaseAccess;
$player_db = new PlayerDatabase;
$fp_db = new FacPointDatabase;

$item_id    = 0;
$player_id  = 0;
$town_id    = 0;
$player_fac = 0;
$type       = ''; //purchase = 1, perk = 2
$price      = 0;
$quantity   = 0;
$fail       = false;
$new_name   = '';

//for text output to fbjs dialog popup
$title      = '';
$body       = '';
$stats      = '';
$output     = '';

//get item and player info
if(isset($_POST['itemid']))
{
  $item_id = $_POST['itemid'];
}

if(isset($_POST['townid']))
{
  $town_id = $_POST['townid'];
}

if(isset($_POST['p_faction']))
{
  $player_fac = $_POST['p_faction'];
}

if(isset($_POST['type']))
{
  $type = $_POST['type'];
}

if(isset($_POST['fb_sig_user']))
{
  $player_id = $_POST['fb_sig_user'];
}

if(isset($_POST['quantity']))
{
  $quantity = $_POST['quantity'];
}

if(isset($_POST['name']))
{
    $new_name = $_POST['name'];
}

$player = $player_db->get_player_data($player_id);

switch($type)
{
    case 0: //item purchase
         //attempt purchase
         $item = $fp_db->get_fp_items($item_id);

         $price = $item[0]['fp_price'] * $quantity;
         if($price <= $player->faction_points)
         {
             //player has enough fp, allow purchase
             $fp_db->give_fp_item($player->userid, $item[0]['id'], $quantity);
             //update player fp
             $player->faction_points -= $price;
             //set new player values in db
             $player_db->update_player_db($player);
             //generate success message
             $title = 'Purchase completed';
             $body = '<p>You bought ' . $quantity . ' ' . $item[0]['name'] 
                 . '. Total price: '
                 . $price . ' faction point(s).</p>';
             //generate playerstats
         }
         else
         {
             //price fail
             $title = 'Transaction fail';
             $body = '<p>You don\'t have the ' . $price
                 . ' faction points needed. You currently have '
                 . $player->faction_points. 'points.</p>';
         }
         break;

    case 1: //perk purchase
         //get item info
         $item = $fp_db->get_perks($item_id);
         //$item[0] = $fp_db->get_fp_items($item_id);
         if($item[0]['fp_price']<=$player->faction_points)
         {
             switch($item_id)
             {

                     case 1: //buy gamma
                          if($player->max_gamma <= $player->current_gamma)
                          {
                              $title = 'Transaction failed';
                              $body =  '<p>Your gamma is already full.</p>';
                              break;
                          }
                          $d = $player->max_gamma - $player->current_gamma;
                            //add gamma
                          $player->current_gamma = $player->max_gamma;
                            //spend fp
                          $player->faction_points -= $item[0]['fp_price'];
                            //set changes in db
                          $player_db->update_player_db($player);
                            //build success message
                          $title = 'Purchase completed';
                           $body = '<p>You received ' . $d
                               . ' gamma points.</p>';
                          break;

                     case 2: //buy stamina
                          if($player->max_stamina <= $player->current_stamina)
                          {
                              $title = 'Transaction failed';
                              $body =  '<p>Your stamina is already full.</p>';
                              break;
                          }
                          $d = $player->max_stamina - $player->current_stamina;
                            //award stamina, spend fp
                          $player->current_stamina = $player->max_stamina;
                          $player->faction_points -= $item[0]['fp_price'];
                            //set changes in db
                          $player_db->update_player_db($player);
                            //build success message
                          $title = 'Purchase completed';
                          $body = '<p>You received ' . $d
                               . ' stamina points.</p>';
                          break;
                          
                     case 3: //buy health 
                          if($player->max_health <= $player->current_health)
                          {
                              $title = 'Transaction failed';
                              $body =  '<p>Your health is already full.</p>';
                              break;
                          }
                          $d = $player->max_health - $player->current_health;
                            //award health, spend fp
                          $player->current_health = $player->max_health;
                          $player->faction_points -= $item[0]['fp_price'];
                            //set changes in db
                          $player_db->update_player_db($player);
                            //build success message
                          $title = 'Purchase completed';
                          $body = '<p>You received ' . $d
                               . ' health points.</p>';
                          break;

                     case 4: //buy achievement points
                          $ap = 10; //achievement points to add
                          $player->achieve_points += $ap;
                          $player->faction_points -= $item[0]['fp_price'];
                          $player_db->update_player_db($player);
                          $title = 'Purchase completed';
                          $body = '<p>You received ' . $ap
                              . ' achievement points. You now have '
                              . $player->achieve_points . ' AP.</p>';
                          break;

                     case 5: //change gamma regen time
                          $amount = 2;
                          $old = $player->gamma_update_rate;
                          $player->gamma_update_rate =
                              max( 150, //2:30 min time
                                   $player->gamma_update_rate - $amount);

                            //be sure a change was made
                          if($old != $player->gamma_update_rate)
                          {
                                //spend faction points
                              $player->faction_points -= $item[0]['fp_price'];
                                //save new values
                              $player_db->update_player_db($player);
                                //generate success message
                              $title = 'Purchase completed';
                              $body = '<p>Your gamma recharge is now '
                                  . format_time( $player->gamma_update_rate )
                                  . ' (min:sec).</p>';
                          }
                          else
                          {
                              //generate fail message
                              $title = 'Transaction failed';
                              $body = '<p>Your gamma recharge is already at the
                                               minimum allowed.</p>';
                          }
                          break;
                     case 6: //change stamina regen time
                          $amount = 2;
                          $old = $player->stam_update_rate;
                          $player->stam_update_rate =
                              max( 150, //2:30 min time
                                   $player->stam_update_rate - $amount);
                            //be sure a change was made
                          if($old != $player->stam_update_rate)
                          {
                                //spend faction points
                              $player->faction_points -= $item[0]['fp_price'];
                                //save new values
                              $player_db->update_player_db($player);
                                //generate success message
                              $title = 'Purchase completed';
                              $body = '<p>Your stamina recharge is now '
                                  . format_time( $player->stam_update_rate )
                                  . ' (min:sec).</p>';
                          }
                          else
                          {
                                //generate failure message
                              $title = 'Transaction failed';
                              $body = '<p>Your stamina recharge is already at the
                                               minimum allowed.</p>';
                          }
                          break;
                     case 7: //change player's faction
                            //send back form with factions to pick
                          $title = '<p>Choose your faction:</p>';
                          $body = change_faction($player, $item[0]['id']);
                          break;
                     case 8: //change character's name
                            //create and return form with blank for new name
                          $title = 'Enter a new name';
                          $body = change_name($player, $item[0]['id']);
                          break;
                     case 9: //stat respec
                            //get faction info
                          include_once('../' . LIB_PATH . 'db_access_faction.php');
                          $fac_db = new FactionDatabase;
                          $factions = $fac_db->get_faction_info();

                            //reset stats to faction defaults
                          //$player->xp_bonus
                             // = $factions[$player->faction]->xp_bonus;
                          //$player->gamma_update_rate
                            //  = $factions[$player->faction]->
                              //    gamma_update_rate;
                          //$player->stam_update_rate
                            //  = $factions[$player->faction]->stam_update_rate;
                          //$player->health_update_rate
                            //  = $factions[$player->faction]->
                              //    health_update_rate;
                          //$player->chips_bonus
                            //  = $factions[$player->faction]->chips_bonus;
                          $player->attack
                              = $factions[$player->faction]->start_attack;
                          $player->defense
                              = $factions[$player->faction]->start_defense;
                          $player->current_gamma = GAMMA_START;
                          $player->max_gamma = GAMMA_START;
                          $player->current_stamina = STAMINA_START;
                          $player->max_stamina = STAMINA_START;
                          $player->current_health = HEALTH_START;
                          $player->max_health = HEALTH_START;

                          //add spent ap to current ap
                          $player->achieve_points += $player->ap_spent;
                          //set spent ap to zero
                          $player->ap_spent = 0;
                            //charge for change
                          $player->faction_points -= $item[0]['fp_price'];
                            //save new values
                          $player_db->update_player_db($player);

                          $title = 'Stat reset complete';
                          $body = '<p>Your stats have been reset to your faction defaults and you have regained all your spent AP. Go home to spend them.</p>';
                          break;
             }
         }
         else
         {

                //price fail
             $title = 'Transaction fail';
             $body = '<p>You don\'t have the ' . $price
                 . ' faction points needed. You currently have '
                 . $player->faction_points. ' points.</p>';
         }

         break;//end case 2, perks
    case 2: //set new user faction
         $item = $fp_db->get_perks($item_id);
           //debit faction points charge
         $player->faction_points -= $item[0]['fp_price'];
           //do any other penalties
           //set new faction
         $player->faction = $player_fac;
           //set changes in db
         $player_db->update_player_db($player);

         include_once('../' . LIB_PATH . 'db_access_faction.php');
         $fac_db = new FactionDatabase;
         $factions = $fac_db->get_faction_info();

         $title = 'Faction changed';
         $body = '<p>Your new faction is ' . $factions[$player_fac]->faction
         . '.</p>';
         break;
    case 3: //set new user name
           //clean up name before entering to db
         include_once('../' . LIB_PATH . 'db_connect.php');
         $db_util = new DatabaseUtilities;
         if( $new_name != '')
         {
             //$new_name = $db_util->real_escape($name);
             $item = $fp_db->get_perks($item_id);
             $player->faction_points -= $item[0]['fp_price'];
             $player->name = $new_name;
             $player_db->update_player_db($player);

             $title = 'Name changed';
             $body = '<p>Welcome to the apocalypse, ' . $player->name . '.</p>';
         }
         else
         {
             //no name entered, handle it
             $title = 'Name not changed';
             $body = '<p>Enter a valid name in the space provided.</p>';
         }

         break;
}

$stats = render_player_data($player);
  //output array to be parsed by fbjs in mission.php
$output = array( 'title'        => $title,
                 'player_stats' => $stats,
                 'fbml_body'    => $body,
                 'new_fp'       => $player->faction_points);

echo json_encode($output);

/**
  * display needed to change character's faction
  * @param $player player object
  * @param $type
  * @return html
  */
function change_faction($player, $type)
{
      //need faction info for display
    include_once( '../' . LIB_PATH . 'db_access_faction.php');
    $fac_db = new FactionDatabase;
    $factions = $fac_db->get_faction_info();

      //style specific to this form
    $char_form .='<style>' . htmlentities( file_get_contents( '../'
        . STYLE . 'fw_char_style.css', true)) . '</style>';

      //num factions needed in main page for loop
    $char_form .= '<form><input type="hidden" id="numFactions" value="'
        . count($factions) .'">';
    foreach($factions as $faction)
    {
        $char_form .= '<div class="pickFaction">'
            . '<img src="' . ROOT . IMG_PATH . $faction->image
                           . '" width="150px">'
            . '<br /><input type="radio"
                            name="faction" id="fac_' . $faction->id
                            . '" value="'
                            . $faction->faction . '"';
                            if(!$checked) //set first one as selected
                            {
                                $checked = true;
                                $char_form .= ' CHECKED ';
                            }
            $char_form .= '>'
            . '<h1>' . $faction->faction . '</h1> '
            . '<p>' . $faction->description . '</p>'
            . '<p>describe faction bonuses</p>'
            . '</div>';
    }
    $char_form .= '<div class="clearDiv"></div>';
    $char_form .= '<br /><input type="submit" value="Choose faction"
        onclick="changeFac(\''
            . ROOT . HANDLER_PATH . 'fp_trans_handler.php\', '
            . $player->userid . ', ' . $type . ');return false;">'
        . '</form>';

    //return 'hello';
    return $char_form;
}

/**
  * display needed to change character's name
  * @param $player player object
  * @param $type
  * @return html
  */
function change_name($player, $type)
{
      //style specific to this form
    $char_form .='<style>' . htmlentities( file_get_contents( '../'
        . STYLE . 'fw_char_style.css', true)) . '</style>';

    $char_form .= '<form>Choose your character\'s name:
                   <input type="text" name="charName" id="newName"
                                      style="color:#000;">';
    $char_form .= '<br /><input type="submit" value="Change name"
        onclick="changeName(\''
            . ROOT . HANDLER_PATH . 'fp_trans_handler.php\', '
            . $player->userid . ', ' . $type . ');return false;">'
        . '</form>';

    //return 'hello';
    return $char_form;

}
?>