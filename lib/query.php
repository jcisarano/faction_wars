<?php
include 'config.php';
$userid = 1407955289;
$playerid = $userid;
$itemid = 1;
$quantity = 1;

if($userid != 0)
{
    //inner join- used to select from first two tables
    //left join- gives precedence to first results, if nothing found
    //in player_inv, that line is still returned
    $query = 'SELECT ' . ITEM . '.*, ' . PLAYER_INV . '.quantity,'
           . ' player_reps, mastery'
           . ' FROM (' . TOWN_ITEM . ' INNER JOIN '
           . ITEM . ' ON ' . ITEM . '.id=' . TOWN_ITEM
           . '.itemid' . ' AND ' . TOWN_ITEM . '.townid=' . $townid;
     if ($type != '0')
     {
         $query .= ' AND ' . ITEM . '.item_type=' . $type;
     }

     $query .= ')';
     $query .= ' LEFT JOIN ' . PLAYER_INV . ' ON ' . PLAYER_INV
         . '.itemid=' . TOWN_ITEM . '.itemid AND ' . PLAYER_INV
         . '.userid=' . $userid;
     $query .= ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' 
         . ITEM . '.id AND ' . COUNT . '.itemtype='
         . ITEM . '.trainingtype AND ' . COUNT . '.playerid=' . $userid;
     $query .= ' LEFT JOIN ' . MISH_COMPLETION . ' ON '
         . MISH_COMPLETION . '.playerid=' . $userid . ' AND '
         . MISH_COMPLETION . '.itemid=' . ITEM . '.id AND '
         . MISH_COMPLETION . '.itemtype=' . ITEM . '.trainingtype';
}
else
{
    $query = 'SELECT ' . ITEM . '.* ' . ' FROM ' . TOWN_ITEM . ', '
         . ITEM . ' WHERE ' . ITEM . '.id=' . TOWN_ITEM . '.itemid'
         . ' AND ' . TOWN_ITEM . '.townid=' . $townid;
    if ($type != '0')
    {
        $query .= ' AND ' . ITEM . '.item_type=' . $type;
    }
}

echo  $query;

        $query = 'SELECT ' . ITEM . '.*, player_reps, mastery, update_time FROM '
            . ITEM
            . ' LEFT JOIN ' . COUNT . ' ON ' . COUNT . '.itemid=' . ITEM
            . '.id AND ' . COUNT . '.itemtype=' . ITEM . '.trainingtype AND '
            . COUNT . '.playerid=' . $userid
            . ' LEFT JOIN ' . MISH_COMPLETION . ' ON ' . MISH_COMPLETION
            . '.itemid=' . ITEM . '.id AND ' . MISH_COMPLETION . '.itemtype='
            . ITEM . '.trainingtype AND ' . MISH_COMPLETION . '.playerid='
            . $userid
            . ' LEFT JOIN ' . ITEM_UPDATE . ' ON ' . ITEM_UPDATE . '.itemid='
            . ITEM . '.id AND ' . ITEM_UPDATE . '.userid=' . $userid
            . ' WHERE ' . ITEM . '.id=' . $itemid;
echo '<br /><br />' . $query;

        $query = 'INSERT INTO ' . METRICS . ' (metricid, identifier, param_one,
                                               param_two, param_three) VALUES '
            . ' ( ' . $metricid . ', ' . $identifier . ', ' . $param1 . ', '
                   . $param2 . ', ' . $param3
            . ' ) ON DUPLICATE KEY UPDATE '
            . '  param_one   = param_one + ' . $param1
            . ',  param_two   = param_two + ' . $param2
            . ', param_three = param_three + ' . $param3;
echo '<br /><br />' . $query;

        $query = 'SELECT * FROM ' . METRICS . ' WHERE metricid=' . $metricid;
        if(!empty($identifier))
        {
            $query .= ' AND identifier=' . $identifier;
        }
echo '<br /><br />' . $query;

        $query = 'UPDATE ' . PLAYER_STATS . ' SET isActive=0, dateout=' . time()
               . ' WHERE userid=' . $userid;
echo '<br /><br />' . $query;

            $query = 'SELECT param_one, param_two, identifier FROM ' . METRICS
                   . ' WHERE metricid=' . $type
                   . ' AND identifier=' . $identifier;
echo '<br /><br />' . $query;

$time = time();
$townid = 1;
$query = 'INSERT INTO ' . METRICS
               . ' (metricid, identifier, param_one, param_two, param_three) VALUES '
               . ' ('. TOWN_TIME .', '. $townid  . ', 0, 1, ' . $time .')'
               . ' ON DUPLICATE KEY UPDATE '
               . ' param_one=param_one+' . $time . '-param_three,'
               . ' param_two=param_two+1,'
               . ' param_three=' . $time;
echo '<br /><br />' . $query;

        $query = 'SELECT param_three FROM ' . METRICS
            . ' WHERE metricid=' . TOWN_TIME
            . ' AND identifier=' . $townid;
echo '<br /><br />' . $query;

                    $query = 'SELECT ' . ACHIEVEMENT . '.achievementid,
                        player_reps, needed FROM ' . ACHIEVE_COUNT
                        . ' INNER JOIN ' . ACHIEVEMENT . ' ON ' . ACHIEVEMENT
                        . '.achievementid=' . ACHIEVE_COUNT
                        . '.achievementid LEFT JOIN ' . COUNT . ' ON '
                        . ACHIEVE_COUNT . '.itemid=' . COUNT . '.itemid AND '
                        . ACHIEVE_COUNT . '.itemtype=' . COUNT
                        . '.itemtype AND ' . COUNT . '.playerid=' . $userid
                        . ' WHERE ' . ACHIEVE_COUNT . '.achievementid='
                        . $row['achievementid'];
echo '<br /><br />' . $query;

         $query = 'INSERT INTO ' . PLAYER_STATS
                . '(userid, current_gamma, total_gamma,
                            current_stamina, total_stamina,
                            current_health, total_health) VALUES ('
                . $userid . ', '
                . GAMMA_START   . ', ' . GAMMA_START   . ', '
                . STAMINA_START . ', ' . STAMINA_START . ', '
                . HEALTH_START  . ', ' . HEALTH_START
                . ') ON DUPLICATE KEY UPDATE'
                . ' factionid=' . $factionid
                . ', datein=' . time()
                . ', xp_bonus="' . $fac[$factionid]->xp_bonus
                . '", gamma_update_rate="' . $fac[$factionid]->gamma_update_rate
                . '", stam_update_rate="' . $fac[$factionid]->stam_update_rate
                . '", health_update_rate="' . $fac[$factionid]->health_update_rate
                . '", chips_bonus="' . $fac[$factionid]->chips_bonus
                . '", factionid="' . $factionid
                . '", attack="' . $fac[$factionid]->start_attack
                . '", defense="' . $fac[$factionid]->start_defense . '"';
echo '<br /><br />' . $query;

        $query .= 'UPDATE ' . FAC_SCORES
               . ' SET score=0 WHERE score<0;';
echo '<br /><br />' . $query;

?>