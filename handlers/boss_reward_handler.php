<?php

/**
  * Determine rewards for this player's participation in a fight, dole them out,
  *           and build output.
  *
  * @version 21 March 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 21 March 2010
  */

include_once('../lib/config.php');
include_once( '../' . LIB_PATH . 'db_access_boss.php' );

$boss_db = new BossDatabase;

$summonerId     = 0;
$fight_complete = true;
$title          = '';
$body           = '';
$popup          = '';
$popuptitle     = '';
$participation  = '';
$is_town_owner  = false;
if(isset($_POST['summoner_id']))
{
 $summonerId = $_POST['summoner_id'];
}

if(isset($_POST['p_id']))
{
 $playerId = $_POST['p_id'];
}

if(isset($_POST['summon_id']))
{
 $summonId = $_POST['summon_id'];
}

$notActive = 0;

  //get boss fight info and verify that fight is no longer active
$fight = $boss_db->get_boss_fight($summonerId, $notActive, $summonId);
$time_remaining = ($fight[0]['completion_one'] * BOSS_TIME_UNIT)
                       - (time() - $fight[0]['datestarted']);

if($fight[0]['isActive'] == 1)
{
      //error found -- this fight isn't over yet
    $fight_complete = false;
    $title = 'Unable to collect your reward';
    $body .= '<div class="bossFightItem">It appears that this fight is still
             active. Jump back into the fray and come back once you\'ve taken
             the enemy down.</div>';
}

if($fight_complete && $fight[0]['isDefeated'] == 0)
{
      //fight timed out, boss not beaten
    $fight_complete = false;
    $img = $boss_db->get_boss_fight_text( $fight[0]['missionid'],
                                          BOSS_MISSION_LOSS_IMG );
    $text = $boss_db->get_boss_fight_text( $fight[0]['missionid'],
                                          BOSS_MISSION_LOSS );

    $title = 'Unable to collect your reward';
    $body .= '<div class="bossReward"><img src="' . ROOT . BOSS_IMG_PATH
             . $img[0]['gamestring'] . '"/><div>' 
             . $text[0]['gamestring'] .'</div>';

    $body .= showParticipation() . '</div>';
    $boss_db->set_reward_collected( $playerId,
                                    $summonerId,
                                    $summonId );
}

if($fight_complete)
{
      //get fight info
    $participation =  $boss_db->get_boss_fight_participation($playerId,
                                $summonerId, 0, $summonId);
    $fight_info = $boss_db->get_boss_fight($summonerId, 0, $summonId);

      //determine this player's participation in the fight
    $percent_dmg = (100 * $participation[0]['dmg'])
                          / $fight_info[0]['boss_start_hp'];
    $percent_dmg = round($percent_dmg);
    
    
    $img = $boss_db->get_boss_fight_text( $fight[0]['missionid'],
                                          BOSS_MISSION_WIN_IMG );
    $gamestrings = $boss_db->get_boss_fight_text( $fight[0]['missionid'],
                                                  BOSS_MISSION );

    $body = '<div class="bossReward">';
      //get treasure table for this boss
      //mish data used to get treasure table
    require_once('../' . LIB_PATH . 'db_access.php');
    $db = new DatabaseAccess;
    $mish = $db->get_mission_data($fight_info[0]['missionid'], $playerId);

      //depends on each boss being in only one town -- if more boss is
      //attached to more than one town, this will sometimes break
    $townId = $boss_db->get_summon_town($fight_info[0]['missionid']);
    $town = $db->get_town_info($townId[0]);

    require_once('../' . LIB_PATH . 'db_access_player.php');
    $player_db = new PlayerDatabase;
    $player = $player_db->get_player_data($playerId);

    $is_town_owner = ($player->faction
                      == $town[$townId[0]]->owner_factionid);

    $loot = null;
      //compare each potential item to the amt of dmg the player did
      //and add appropriate items to the loot list
    if($mish->treasure_table) //make sure there is at least one item
    {
        //determine which items are won based on percentage damage done
        foreach($mish->treasure_table as $t)
        {
            if($percent_dmg >= $t['chance']) //is player eligible for this?
            {
                  //stacking procedure for existing items
                if(!array_key_exists($t['name'], (array)$loot))
                {
                    //not already one of these in the list, add a new item
                    $loot[$t['name']] = $t;
                }
                else
                {
                      //already awarded at least one, so stack 'em
                    $loot[$t['name']]['quantity'] += $t['quantity'];
                }

            }
        }
    }

      //add loot to player's inventory, if there is any
    if($loot)
    {
          //add items to player's inventory
        $e = $db->give_item_list($playerId, $loot);

        if($e)
        {
            //error adding loot, output error message
            $body .= $e;
        }
        else
        {
            //build and return reward message
            $title = $mish->title . ' defeated';
            $body .= '<img src="' . ROOT . BOSS_IMG_PATH 
                                  . $img[0]['gamestring'] . '">'
                  . '<div>' . $gamestrings[count($gamestrings)-1]['gamestring']
                            . '</div>'
                  . '<ul><li>Loot scavenged from the corpse:</li>';

            foreach($loot as $l)
            {
                $body .= '<li>' . $l['quantity'] . 'x ' . $l['name']
                      . '</li>';
            }
            $body .= '</ul>';

            if(!$is_town_owner)
            {
                $body .= '<div>You also earned influence for the '
                      . $player->faction_name . ' in '
                      . $town[$townId[0]]->name . '.</div>';
            }

            $body .= showParticipation();
            $body .= '</div>'; //end body
        }
    }
    else
    {
          //player didn't qualify for any items
        $title = 'No awards earned';
        $body .= '<img src="' . ROOT . BOSS_IMG_PATH . $mish->image . '">';
        $body .= '<div>You need to participate more in the fight if you want
                           to walk away with any loot.</div>';
    }

    $ach = null;
      //if player participated at all, update achievement and town
    if( $participation[0]['dmg'] > 0 )
    {
          //achievement count
        require_once('../' . LIB_PATH . 'db_access_achievement.php');
        $achieve_db = new AchievementDatabase;
          //add points to player's achievement tracking
        $add = 1; //(one mission completed)
          //use missionid and MISSION constant because boss kills are just
          //special-case missions
        $ach = $achieve_db->increment_achievement($fight[0]['missionid'],
                                                  MISSION, $playerId,
                                                  $add);

          //if player's fac isn't already owner of town
          //(town owner can't earn points towards winning town again)
        if(!$is_town_owner)
        {
              //player earns faction influence in town
              //calc amount - equals amount of stamina spent
            $influence = $fight_info[0]['energy_drain']
                         * $participation[0]['clicks'];

            include('../' . LIB_PATH . 'db_access_faction.php');
            $fac_db = new FactionDatabase;
            //add to db
            $facresult = $fac_db->update_faction_score( $town[$townId[0]]->id,
                                   $player->faction, $influence);
        }

    }

    //if any achievements earned, create output for them
    if($ach != null)
    {
        $popuptitle = 'Congratulations!';
        foreach($ach as $achievement)
        {
            $player->achieve_points += $achievement['ap'];
            $player->faction_points += $achievement['fp'];
            $popup .= '<div class="mishResult">'
                   . render_achievement_notice($achievement)
                   . '</div>';
        }
    }

       //set reward as collected
    $boss_db->set_reward_collected( $playerId,
                                    $summonerId,
                                    $summonId );
}

//$body = '<div><h1>' . $title . '</h1>' . $body . '</div>';
$output = array( 'fbml_title'    => '<h1>' . $title . '</h1>',
                 'fbml_body'    =>  $body,
                 'fbml_popup'   => $popup,
                 'popuptitle'   => $popuptitle );
//echo $body;
echo json_encode($output);


function showParticipation()
{
    include ('../' . LIB_PATH . 'utilities.class.php');
    $utilities = new Utilities;

    global $boss_db, $summoner_id, $fight;

    $helpers = $boss_db->get_boss_fight_participation(-1, $summoner_id, -1,
                                                     $fight[0]['summonid']);
    $p = '<h1>Fight history:</h1>';
    if($helpers)
    {
        foreach($helpers as $h)
        {
            $point_pl = $utilities->get_plural($h['dmg']);
            $click_pl = $utilities->get_plural($h['clicks']);
    
            $p .= '<div class="bossPal"><fb:name uid="' . $h['playerid']
                  . '" linked="false" capitalize="true"/> did ' . $h['dmg']
                  . ' point' . $point_pl . ' of damage with ' . $h['clicks']
                  . ' hit' . $click_pl . '.</div>';
        }
    }

    //$p .= '</div>';
    
    return $p;
}
?>