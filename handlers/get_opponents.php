<?php
/**
  * Returns list of opponents for pvp in a given town.
  * Needed POST vars:
  *        townid, p_faction
  *        player_id, player_level
  *
  * @version 18 September 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 18 September 2009
  */


include_once('../lib/config.php');
include_once('../' . LIB_PATH . '/db_access.php');
include_once('../' . LIB_PATH . '/db_access_pvp.php');
require_once('../' . LIB_PATH . '/db_access_player.php');
include_once('../' . LIB_PATH . '/db_access_faction.php');
include_once('../' . LIB_PATH . '/faction.class.php');

$db        = new DatabaseAccess;
$fac_db    = new FactionDatabase;
$pvp       = new PvpDatabase;
$player_db = new PlayerDatabase;

$townid         = 0;
$player_faction = 0;
$player_id      = 0;
$player_level   = 1;

if(isset($_POST['townid']))
{
 $townid = $_POST['townid'];
}

if(isset($_POST['p_faction']))
{
 $player_faction = $_POST['p_faction'];
}

if(isset($_POST['player_id']))
{
 $player_id = $_POST['player_id'];
}

$player = $player_db->get_player_data($player_id);

if(isset($_POST['player_level']))
{
 $player_level = $_POST['player_level'];
}
$town = $db->get_town_info($townid);
$opponents = $pvp->get_opponent_list($player_id, 
                                  $town[$townid]->town_level,
                                  $town[$townid]->town_level + 4);

$owned_by = '.';
if($town[$townid]->owned)
{
 $faction = $fac_db->get_faction_info($town[$townid]->owner_factionid);
 $owned_by = ', owned by the '
           . $faction[$town[$townid]->owner_factionid]->faction
           . ' since ' . date( "d F Y", $town[$townid]->ownership_date) 
           . ', local time ' . date("Hi", 
                               $town[$townid]->ownership_date) . '.';
}
$output = '<p>Fighting in ' . $town[$townid]->name . $owned_by;

$output .= '<div id="opponentTable"><table><tr><th>Name</th>
                    <th>Level</th><th>Wins / Losses</th>
                    <th>Clan size</th><th>Success Chance</th>
                    <th>Faction</th></tr>';

if($opponents)
{
    foreach($opponents as $item)
    {
        $opponent = $item['opponent'];
        $faction  = $item['faction'];
        $output .= '<tr>'
                . '<td>' . $opponent->name . '</td>'
                . '<td>' . $opponent->level . '</td>'
                . '<td>' . $opponent->fights_won . '/'. $opponent->fights_lost
                         . '</td>'
                . '<td>' . $opponent->army_size . '</td>'
                . '<td>' . round(100 * ($player->adj_attack
                               / ($player->adj_attack
                                       + $opponent->adj_defense)))
                               . '%</td>'
                . '<td>' . $faction . '</td>'
                . '<td><input type="submit" value="Attack" class="fwButton"
                              onclick="handlePvp(\''
                              . ROOT . HANDLER_PATH
                              . '/pvp_handler.php\', '
                              . $player_id . ', '
                              . $opponent->userid . ', '
                              . $townid
                              . ');return false;"> </td>'
                . '</tr>';
    }
}
else
{
    $output .= '<tr><td colspan="4">No opponents found for you in this
                        town.</td></tr>';
}
$output .= '</table></div>';

echo $output;
?>