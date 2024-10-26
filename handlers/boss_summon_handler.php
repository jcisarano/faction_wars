<?php
/**
  * Handle one-time-use summon items. Set up boss battle.
  *
  * @version 11 March 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  * @history
  *         created 11 march 2010
  */
require_once('../lib/config.php');
require_once('../' . LIB_PATH . '/db_access_player.php');
//require_once('../' . LIB_PATH . '/db_access.php');

$player_db = new PlayerDatabase;
//$db = new DatabaseAccess;

//grab incoming infomation: playerid, townid, itemid
$townid    = 0;
$player_id = 0;
$verified  = false;

$title = '';
$body  = '';

if(isset($_POST['townid']))
{
    $town_id = $_POST['townid'];
}

if(isset($_POST['p_id']))
{
    $player_id = $_POST['p_id'];
}

if(isset($_POST['mission_id']))
{
    $mission_id = $_POST['mission_id'];
}

//verify player info: does player really have the needed item?
$missions = $player_db->get_summon_items($player_id, $town_id);
foreach($missions as $m)
{
    if($m['missionid'] == $mission_id)
    {
        if($m['player_inv'] > 0)
        {
            $mission  = $m;
            $verified = true;
        }
        else
        {
            //item not found, call a chump a chump
            $title = 'Error in handling mission';
            $body  = 'Couldn\'t summon this boss. Please refresh the page and 
                                try again.';
        }

        break; //only one should match mission id, break out of loop
    }
}

if($verified)
{
    //set up boss battle params, save to db
    include_once('../' . LIB_PATH . '/db_access_boss.php');
    $boss_db = new BossDatabase;
    $success = $boss_db->set_new_boss_fight($player_id, $mission_id,
                                             $mission['completion_two']);
    
    //base results on whether we were able to actually set up the boss fight
    //or not
    if($success)
    {
          //generate success output
        $title = $mission['title'];
        $body = '<div id="summonMishList"><div class="summonMish"><h1>'
              . $mission['title'] . '</h1><div class="smFullColumn">'
              . $mission['result_text']
              . '</div></div><div class="fwClear"></div>';

          //spend summon item
        require_once('../' . LIB_PATH . '/db_access.php');
        $db = new DatabaseAccess;
        $db->spend_mission_items($mission_id, $player_id);
    }
    else
    {
        //generate failure message
        $title = 'Couldn\'t Summon Boss';
        $body = '<div id="summonMishList"><div class="summonMish">
                 <h1>Couldn\'t Summon Boss</h1>
                 <div class="summonFail">You can only have one boss
                      fight active at a time.</div></div></div>
                      <div class="fwClear"></div>';
    }
}

$body .= '</div>';

  //output array to be parsed by fbjs in mission.php
$output = array( 'fbml_title'   => '<h1>' . $title . '</h1>',
                 'fbml_body'    =>  $body );

echo json_encode($output);
?>