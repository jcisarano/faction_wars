<?
/**
  */

include_once('lib/config.php');

require_once( LIB_PATH . 'db_connect.php');
require_once( LIB_PATH . 'db_access_metrics.php');

$db_util    = new DatabaseUtilities;
$metrics_db = new MetricsDatabase;
$output     = '';

////////////////////////Active users
$query = 'SELECT COUNT(userid) FROM ' . PLAYER_STATS . ' WHERE isActive=1';
$row = single_row_query($query);
$output .= 'Total currently active users: ' . $row['COUNT(userid)'] . ' ';

////////////////////////Inactive users
$query = 'SELECT COUNT(userid) FROM ' . PLAYER_STATS . ' WHERE isActive=0';
$row = single_row_query($query);
$output .= '<br />Total inactive users: ';
$output .= (empty($row['COUNT(userid)']))
                 ? 0
                 : $row['COUNT(userid)'] . '';

////////////////////////Avg chips
$query = 'SELECT AVG(chips) FROM ' . PLAYER_STATS;
$row = single_row_query($query);
$output .= '<br />Average cash per player: ' 
           . number_format(round($row['AVG(chips)'])) . ' chips.';

////////////////////////Highest chips
$query = 'SELECT MAX(chips) FROM ' . PLAYER_STATS;
$row = single_row_query($query);
$richest = $row['MAX(chips)'];
$output .= '<br />Richest player has ' . number_format($richest) . ' chips.';

////////////////////////Chip distribution
$NUM_SLICES = 10;
$slice = ceil($richest / $NUM_SLICES);
$left  = 0;
$right = $slice;

$output .= '<br /><table border="1"><caption>Chip distribution</caption>';
$headings = '<tr><td>Chip amounts</td>';
$values = '<tr><td>Num players</td>';
for($i=0;$i<$NUM_SLICES;$i++)
{
    $query = 'SELECT COUNT(userid) FROM ' . PLAYER_STATS //. ' GROUP BY chips HAVING '
        . ' WHERE chips >= ' . $left . ' AND chips <= ' . $right;
    $row = single_row_query($query);
    $headings .= '<td>' . number_format($left) . ' - '
                        . number_format($right).'</td>';
    $values .= '<td align="center">' . number_format($row['COUNT(userid)']) . '</td>';
    $left = $right + 1;
    $right += $slice;
}
$output .= $headings . '</tr>';
$output .= $values . '</tr>';
$output .= '</table>';

////////////////////////Faction wealth
$NUM_FACTIONS = 6;

$output .= '<br /><table border="1"><caption>Faction Wealth</caption>';
$headings = '<tr><td>Faction</td>';
$values = '<tr><td>Total chips</td>';

$query = 'SELECT SUM(chips), factionid FROM ' . PLAYER_STATS
           . ' GROUP BY factionid ORDER BY factionid';
$result = $db_util->execute_query($query);

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $headings .= '<td>' . $row['factionid'] .'</td>';
    $values .= '<td >' . number_format($row['SUM(chips)']) . '</td>';
}
$output .= $headings . '</tr>';
$output .= $values . '</tr>';
$output .= '</table>';

////////////////////////Total chips
$query = 'SELECT SUM(chips) FROM ' . PLAYER_STATS;
$row = single_row_query($query);
$output .= '<br />Total player wealth: ' . number_format($row['SUM(chips)']) . ' chips.';

////////////////////////Avg player wealth
$query = 'SELECT AVG(chips) FROM ' . PLAYER_STATS . ' WHERE isActive=1';
$row = single_row_query($query);
$query .= 'The average player has ' . $row['AVG(chips)'] . ' chips.';

////////////////////////Most frequently done mission
$query = 'SELECT itemid, pr FROM (SELECT itemid, SUM(player_reps) AS pr FROM '
       . COUNT
       . ' WHERE itemtype=1 GROUP BY itemid) AS t1 ORDER BY pr DESC LIMIT 0,1';
$row = single_row_query($query);
$output .= '<br />Most frequently run mission: ' . $row['itemid']
        . ' at ' . $row['pr'] . ' times.';

////////////////////////Least frequently done mission
$query = 'SELECT itemid, pr FROM (SELECT itemid, SUM(player_reps) AS pr FROM '
       . COUNT
       . ' WHERE itemtype=1 GROUP BY itemid) AS t1 ORDER BY pr LIMIT 0,1';
$row = single_row_query($query);
$output .= '<br />Least frequently run mission: ' . $row['itemid']
        . ' at ' . $row['pr'] . ' times.';

////////////////////////Players per faction
$query = 'SELECT COUNT(userid), factionid FROM ' . PLAYER_STATS
       . ' GROUP BY factionid';
$result = $db_util->execute_query($query);
$output .= '<br /><br /><table border="1"><caption>Players per faction</caption>';
$factions = '<tr>';
$players = '<tr>';
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $factions .= '<td>' . $row['factionid'] . '</td>';
    $players  .= '<td>' . $row['COUNT(userid)'] . '</td>';
}
$output .= $factions . '</tr>' . $players . '</tr>';
$output .= '</table>';

////////////////////////PvP Stats
////////////////////////Total PvP fights
////////////////////////PvP wins against clan
////////////////////////PvP losses against clan

////////////////////////avg player level on quit
$query = 'SELECT AVG(player_level) FROM ' . PLAYER_STATS . ' WHERE isActive=0';
$row = single_row_query($query);
$output .= '<br />Average player level on quit game: ';
$output .= (empty($row['AVG(player_level)'])) ? "data not available"
                                              : $row['AVG(player_level)'] ;

////////////////////////Avg player level active players
$query = 'SELECT AVG(player_level) FROM ' . PLAYER_STATS . ' WHERE isActive=1';
$row = single_row_query($query);
$output .= '<br />Active player average level: ';
$output .= (empty($row['AVG(player_level)'])) ? "data not available"
                                              : round( $row['AVG(player_level)']);
                                              
////////////////////////Highest level
$query = 'SELECT MAX(player_level) FROM ' . PLAYER_STATS;
$row = single_row_query($query);
$highest_lvl = $row['MAX(player_level)'];
$output .= '<br />Highest level player is level '
        . number_format($highest_lvl) . '.';

////////////////////////time to uninstall
$query = 'SELECT AVG(dateout-datein) FROM ' . PLAYER_STATS . ' WHERE isActive=0';
$row = single_row_query($query);
$output .= '<br />Average time to uninstall: ';
$output .= (empty($row['AVG(dateout-datein)'])) ? "data not available"
                                                : $row['AVG(dateout-datein)'];
                                                
////////////////////////Player level distribution
$NUM_SLICES = 10;

$slice = ceil($highest_lvl / $NUM_SLICES);
$left  = 0;
$right = $slice;

$output .= '<br /><br /><table border="1"><caption>Player Level Distribution</caption>';
$headings = '<tr><td>Level range</td>';
$values = '<tr><td>Num players</td>';   
for($i=0;$i<$NUM_SLICES;$i++)
{
    $query = 'SELECT COUNT(userid) FROM ' . PLAYER_STATS //. ' GROUP BY chips HAVING '
        . ' WHERE player_level >= ' . $left . ' AND player_level <= ' . $right;
    $row = single_row_query($query);  
    $headings .= '<td>' . number_format($left) . ' - '
                        . number_format($right).'</td>';  
    $values .= '<td align="center">' . number_format($row['COUNT(userid)']) . '</td>';
    $left = $right + 1;
    $right += $slice; 
}   
$output .= $headings . '</tr>';
$output .= $values . '</tr>';
$output .= '</table>';

////////////////////////Player stats: Stamina by level
$NUM_SLICES = 10;
$query = 'SELECT MAX(total_stamina) FROM ' . PLAYER_STATS;
$row = single_row_query($query);
$highest_stam = $row['MAX(total_stamina)'];

$slice = ceil($highest_stam / $NUM_SLICES);
$left  = 0;
$right = $slice;

$output .= '<br /><br /><table border="1"><caption>Snapshot of Player Stamina Distribution</caption>';
$headings = '<tr><td>Stamina range</td>';
$values = '<tr><td>Num players</td>';   
for($i=0;$i<$NUM_SLICES;$i++)
{
    $query = 'SELECT COUNT(userid) FROM ' . PLAYER_STATS //. ' GROUP BY chips HAVING '
        . ' WHERE total_stamina >= ' . $left . ' AND total_stamina <= ' . $right;
    $row = single_row_query($query);  
    $headings .= '<td>' . number_format($left) . ' - '
                        . number_format($right).'</td>';  
    $values .= '<td align="center">' . number_format($row['COUNT(userid)']) . '</td>';
    $left = $right + 1;
    $right += $slice; 
}   
$output .= $headings . '</tr>';
$output .= $values . '</tr>';
$output .= '</table>';

////////////////////////Player stats: Gamma by level
$NUM_SLICES = 10;
$query = 'SELECT MAX(total_gamma) FROM ' . PLAYER_STATS;
$row = single_row_query($query);
$highest_gam = $row['MAX(total_gamma)'];

$slice = ceil($highest_gam / $NUM_SLICES);
$left  = 0;
$right = $slice;

$output .= '<br /><br /><table border="1"><caption>Snapshot of Player Gamma Distribution</caption>';
$headings = '<tr><td>Gamma range</td>';
$values = '<tr><td>Num players</td>';   
for($i=0;$i<$NUM_SLICES;$i++)
{
    $query = 'SELECT COUNT(userid) FROM ' . PLAYER_STATS //. ' GROUP BY chips HAVING '
        . ' WHERE total_gamma >= ' . $left . ' AND total_gamma <= ' . $right;
    $row = single_row_query($query);  
    $headings .= '<td>' . number_format($left) . ' - '
                        . number_format($right).'</td>';  
    $values .= '<td align="center">' . number_format($row['COUNT(userid)']) . '</td>';
    $left = $right + 1;
    $right += $slice; 
}   
$output .= $headings . '</tr>';
$output .= $values . '</tr>';
$output .= '</table>';



////////////////////////Level up time
$result = $metrics_db->get_metric_avg(TIME_TO_LEVEL);
$headings = '<tr><td>Level</td>';
$values = '<tr><td>Time (hh:mm:ss)</td>';
$output .= '<br /><br /><table border="1"><caption>Avg time to level</caption>';
foreach ($result as $r)
{
    $headings .= '<td>' . $r['identifier'] . '</td>';
    $values  .= '<td>' . sec_to_time($r['avg']) . '</td>';
}
$output .= $headings . '</tr>' . $values . '</tr>';
$output .= '</table>';
  
////////////////////////Cash on level
$result = $metrics_db->get_metric_avg(CASH_ON_LEVEL);
$headings = '<tr><td>Level</td>';
$values = '<tr><td>Chips</td>';
$output .= '<br /><br /><table border="1"><caption>Avg cash on level up</caption>';
foreach ($result as $r)
{
    $headings .= '<td>' . $r['identifier'] . '</td>';
    $values  .= '<td>' . number_format(round($r['avg'])) . '</td>';
}
$output .= $headings . '</tr>' . $values . '</tr>';
$output .= '</table>';

////////////////////////Town turnover
/*
$result = $metrics_db->get_metric_avg(TOWN_TIME);
$headings = '<tr><td>Town</td>';
$values = '<tr><td>Time (hh:mm:ss)</td>';
$output .= '<br /><br /><table border="1"><caption>Avg time to town turnover</caption>';
foreach ($result as $r)
{
    $headings .= '<td>' . $r['identifier'] . '</td>';
    $values  .= '<td>' . sec_to_time($r['avg']) . '</td>';
}
$output .= $headings . '</tr>' . $values . '</tr>';
$output .= '</table>';
*/

////////////////////////Item ownership
$query = 'SELECT SUM(quantity), itemid FROM ' .PLAYER_INV . ' GROUP BY itemid';
$result = $db_util->execute_query($query);
$headings = '<tr><td>Item</td>';
$values = '<tr><td>Total ownership</td>';
$output .= '<br /><br /><table border="1"><caption>Total player inventory by item</caption>';
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $headings .= '<td>' . $row['itemid'] . '</td>';
    $values  .= '<td>' . number_format($row['SUM(quantity)']) . '</td>';
}
$output .= $headings . '</tr>' . $values . '</tr>';
$output .= '</table>';


echo $output;
 
/**
  * Helper function to make it simpler to execute query when only 1 
  *        row is expected as result.
  *
  */
function single_row_query($sQuery)
{
    global $db_util;

    $result = $db_util->execute_query($sQuery);
    $srow = mysql_fetch_array($result, MYSQL_ASSOC);

    return $srow;
}

function sec_to_time($seconds) {
    $hours = floor($seconds / 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60; 

    return sprintf("%d:%02d:%02d", $hours, $minutes, $seconds); 
}
?>