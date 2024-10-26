<?php
/**
  * Generate list of boss battles available in town and set up HTML needed to 
  *          display and launch the battle.
  *
  * @version 11 March 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  * @history
  *         created 11 march 2010
  */

require_once('../lib/config.php');
require_once('../' . LIB_PATH . '/db_access_player.php');

$player_db = new PlayerDatabase;

$townid=0;
$player_id=0;
$body = '<div id="summonMishList">';

if(isset($_POST['townid']))
{
    $town_id = $_POST['townid'];
}

if(isset($_POST['p_id']))
{
    $player_id = $_POST['p_id'];
}

//$body .= 'p=' . $player_id . ' t=' .  $town_id;

$missions = $player_db->get_summon_items($player_id, $town_id);

//$body .= ' c=' . count($missions);

if($missions)
{
    foreach($missions as $mission)
    {
          //determine if player has needed item
          //create proper button text for has/doesn't have
        if($mission['player_inv'] > 0)
        {
            //player has at least one of the summon item
            $button = 'value="Summon Boss"
                       class="fwButton"
                       onclick="runSummonMission(\'' . ROOT . HANDLER_PATH
                                   . 'boss_summon_handler.php\', '
                                   . $mission['missionid'] . ');return false;"';
        }
        else
        {
            //player doesn't have summon item
            $button = 'value="Can\'t Use"
                       disabled ="true"
                       class="fwButton_disabled"
                       onclick="return false;"';
            $message = '<br /><br />To summon this boss, you need to
                            <a href="crafting.php">craft a summon item</a>.';
        }
        $body .= '<div class="summonMish">'
                . '<h1>' . $mission['title'] . '</h1>'
                . '<div class="smDoubleWideColumn"><img src="' . ROOT . ITEM_PATH
                        . $mission['item_image'] . '"/><span>'
                        . $mission['description']
                        . $message
                        . '</span></div>'
                . '<div class="smNarrowColumn"><img src="'
                        . ROOT . MISH_IMG_PATH . 'boss/'
                        . $mission['image'] . '"/><input type="submit"
                                                         ' . $button . '></div>'
                . '</div><div class="fwClear"></div>';
    }
}

$body .= '</div>';

$output = array( 'fbml_body'    => $body );

echo json_encode($output);
?>