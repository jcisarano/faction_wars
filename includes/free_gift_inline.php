<?php
/**
  * In-line include that will display player's available mystery gifts.
  * Expects these variables already initilaized:
  *         $player
  *         $player_db
  *         $db
  *         $output
  *
  * @version 15 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 15 April 2010
  */

$mystery_gifts = $player_db->get_gift_list($player->userid);
$fg_checked = false;
$fg_output = '';

if($mystery_gifts != -1)
{
    $fg_output .= '<div id="freeGiftOffer" style="border:1px solid white">';

    //build output for gifts the player has received but not yet claimed
    foreach($mystery_gifts as $gift)
    {
        $fg_output .= '<div id="gift_' . $gift['senderid']
                   . '">You have ' . $gift['count'] . ' unclaimed gifts from
                   <fb:name uid="' . $gift['senderid']
                   . '" linked="false"/>. <input type="submit"
                                                 value="Accept gift"
                                                 onclick="showTownPicker('
                                                 . $gift['senderid']
                                                 . ');return false;"
                                                 class="fwButton"/></div>';
    }
    $fg_output .= '</div>';
    
    //Build panel that lets player choose which gift she wants.
    //This is initially hidden unless the player clicks to claim a gift.
    $fg_towns = $db->get_town_info();
    $fg_output .= '<div id="giftTownList">Choose a
                     town. You\'ll receive a surprise crafting item from that town.
                   <br />';
    
    $fg_output .= '<input type="hidden" id="numTowns" value="' . count($fg_towns)
            . '" />';
    
    //Insert town names w/corresponding radio button
    foreach($fg_towns as $key=>$town)
    {
        $fg_output .= '<div class="giftTown"><input type="radio"
                    name="townid" id="town_' . ( $key - 1 ) . '" value="'
                    . $town->id . '" ';
    
        //Set default item as checked. Will be first town in list.
        if(!$fg_checked)
        {
            $fg_checked = true;
            $fg_output .= ' CHECKED ';
        }
    
        $fg_output .= '/>' . $town->name . '</div>';
    }
    $fg_checked = false;
    
    //Button that allows player to claim the gift
    //Calls js script that determines which radio button is ticked and then
    //accesses handler that awards gift.
    $fg_output .= '<input type="submit" value="Choose gift town" '
                       . ' onclick="getRandomGift(\''
                               . ROOT . HANDLER_PATH . 'free_gift_handler.php\');
                                      return false;" class="fwButton"/></div>';
}
return $fg_output;
?>