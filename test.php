<?php
echo 'start<br />';
$townid=1;
$userid = 1407955289;

include_once('lib/config.php');
include_once(LIB_PATH . 'db_access_player.php');
echo 'userid=' . $userid . '<br />';
$player_db = new PlayerDatabase;
//$player_db->set_gift_time($userid, $userid);
$senderid=mt_rand(0,3);
echo 'sender=' . $senderid . '<br />'; /**
$player_db->send_free_gift($senderid, $userid);
$gift_info = $player_db->get_free_gift_info($userid, $userid);

if(is_array($gift_info) || $gift_info == -1)
{
    echo 'You may send a gift.<br />';
}
else
{
    echo 'No gift sending for you.<br />';
}
*/
//$userid = 631564649;
$senderid = 1407955289;

$gift_info = $player_db->get_free_gift_info($userid,$senderid,1);
echo 'claimed: ' . implode(", " , $gift_info) . '<br />';

$gift_info = $player_db->get_free_gift_info($senderid, $userid);
echo 'unclaimed: ' . implode(", " , $gift_info) . '<br />';

echo '<br />Gift list:<br />';
$gift_list = $player_db->get_gift_list($userid);
foreach($gift_list as $key => $gift)
{
    echo $key . ': ' . implode(", " , $gift) . '<br />';
}


//$player_db->set_free_gift_claimed($senderid, $userid, $gift_info['oldest']);

$gift_info = $player_db->get_free_gift_info($senderid, $userid);

echo 'Info after: ' .implode("," , $gift_info) . '<br />';
/*
$last_gift_time = $player_db->get_gift_time($userid, $userid);
//$curr_time = time();
$gift_interval  = time() - $last_gift_time;

echo 'time ' . $last_gift_time . '<br />';
echo 'interval ' . $gift_interval . '<br />';

//$gift_recharge = 24*60*60;//once daily
$gift_recharge = 2*60;//short for testing purposes

if($last_gift_time == -1 || ($gift_interval >= $gift_recharge
                              && $last_gift_time != -1))
{
    echo 'good time';

}
else
{
    echo 'disappointment';
} */
echo '<br />Summon mish list:<br />';
$summon_mish = $player_db->get_summon_items($userid);
foreach($summon_mish as $key => $sm )
{
    echo $key . ': ' . implode(", ", $sm) . '<br />';
}

include_once( LIB_PATH . 'db_access_boss.php');
$boss_db = new BossDatabase;
/*
echo '<br />Boss result: ' . $boss_db->set_new_boss_fight($userid, mt_rand(100,125), 10000) . '<br />';

echo 'Active boss fights found: <br />';
$fights = $boss_db->get_boss_fight($userid);

foreach($fights as $key => $f )
{
    echo $key . ': ' . implode(", ", $f) . '<br />';
}

echo 'Unclaimed boss fights found: <br />';
$fights = $boss_db->get_completed_fights($userid);

foreach($fights as $key => $f )
{
    echo $key . ': ' . implode(", ", $f) . '<br />';
}

$dmg = $boss_db->set_boss_fight_participation(($userid), ($userid), mt_rand(0,500));
echo 'Damage result: ' . implode(', ', $dmg) . '<br />';

echo 'Active boss fights update: <br />';
$fights = $boss_db->get_boss_fight($userid);
foreach($fights as $key => $f )
{
    echo $key . ': ' . implode(", ", $f) . '<br />';
}

echo 'Setting a reward complete . . .<br />';
$boss_db->collect_boss_fight_reward($userid, $userid, 7);
echo 'Current player participation:<br />';
$part = $boss_db->get_boss_fight_participation($userid);
foreach($part as $key=>$p)
{
    echo $key . ': ' . implode(", ", $p) . '<br />';
}


include_once( LIB_PATH . 'db_access_boss.php');
$boss_db = new BossDatabase;
$gamestrings = $boss_db->get_boss_fight_text( 127,
                                              BOSS_MISSION );
                                              
echo 'Gamestrings: ';
foreach($gamestrings as $key=>$g)
{
    echo $key . ': ' . implode(', ', $g) . '<br />';
}
*/

echo $boss_db->set_reward_collected(1407955289, 1407955289, 62);
//echo FREE_GIFT_COOLDOWN;
echo '<br />done';
?>