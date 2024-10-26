<?php
/**
  * Inline include that updates town ownership status if needed.
  *
  * @version 16 February 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  * @history
  *         created 16 February 2009
  */
require_once (LIB_PATH . 'db_access_faction.php');
require_once (LIB_PATH . 'db_access.php');

$t_fac_db = new FactionDatabase;
$t_db     = new DatabaseAccess;

$town_id = '1';//currently assume starting town

$curr_time = time();

$town       = $t_db->get_town_info($town_id);
$time_diff  = $curr_time - $town[$town_id]->ownership_date;

//echo '<span style="color:#000;">[town_ownership_inline.php]diff=' . $time_diff . ' name='
//                                       . $town[$town_id]->name;

if($time_diff >= TOWN_TIME_THRESHOLD)
{
      //find new owner, set changes to db
    $t_fac_db->set_faction_owner($town_id);

    $count_time = TOWN_TIME_THRESHOLD;
    //echo ' new fac set';
}
else
{
    $count_time = TOWN_TIME_THRESHOLD - $time_diff;
}
//echo '</span>';
?>