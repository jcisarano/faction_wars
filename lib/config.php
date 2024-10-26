<?php

     //$USE_DATA_API = 0;
     //$USE_JS = 0;
     //$USE_AJAX = 0;

     $facebook_config['api_key'] = 'XXXX';
     $facebook_config['secret'] = 'YYYY';
     $facebook_config['debug'] = 1;
	 
	 if(!defined('PAGE_ID'))
	 {
         define('PAGE_ID', 0000);
	 }
	 
	 if(!defined('VERSION'))
	 {
         define('VERSION', 1.0); //for CSS and JS cacheing
     }

     if(!defined('FB_PATH'))
	 {
         define('FB_PATH', '../facebook/');
     }
     if(!defined('ROOT'))
	 {
         define('ROOT', 'http://facebook.fallenearth.com/faction_wars/');
     }
     if(!defined('STYLE'))
	 {
         define('STYLE', 'css/');
     }
     if(!defined('LIB_PATH'))
	 {
         define('LIB_PATH', 'lib/');
     }
     if(!defined('IMG_PATH'))
	 {
         define('IMG_PATH', 'images/');
     }
     if(!defined('LAYOUT_PATH'))
	 {
         define('LAYOUT_PATH', 'images/layout/');
     }
     if(!defined('FAC_IMG_PATH'))
	 {
         define('FAC_IMG_PATH', 'images/factions/');
     }
     if(!defined('TOWN_IMG_PATH'))
	 {
         define('TOWN_IMG_PATH', 'images/towns/');
     }
     if(!defined('ACH_IMG_PATH'))
	 {
         define('ACH_IMG_PATH', 'images/achievements/');
     }
	 if(!defined('MISH_IMG_PATH'))
	 {
         define('MISH_IMG_PATH','images/missions/');
     }
	 if(!defined('BOSS_IMG_PATH'))
	 {
         define('BOSS_IMG_PATH', 'images/missions/boss/');
     }
     if(!defined('HANDLER_PATH'))
	 {
         define('HANDLER_PATH', 'handlers/');
     }
     if(!defined('ITEM_PATH'))
	 {
         define('ITEM_PATH', 'images/items/');
     }
     if(!defined('JS_PATH'))
	 {
         define('JS_PATH', 'js/');
     }
     if(!defined('GEN_PATH'))
	 {
         define('GEN_PATH', 'images/general/');
     }
     if(!defined('FE_HOME'))
	 {
         define('FE_HOME', 'http://www.fallenearth.com');
     }
     if(!defined('ICARUS_HOME'))
	 {
         define('ICARUS_HOME', 'http://www.icarusstudios.com/');
     }
     if(!defined('CANVAS_PATH'))
	 {
         define('CANVAS_PATH', 'http://apps.facebook.com/fwarstest/');
     }
	 if(!defined('INCLUDE_PATH'))
	 {
	     define('INCLUDE_PATH', 'includes/');
	 }
	 if(!defined('CHANNEL_PATH'))
	 {
         define('CHANNEL_PATH', '/channel/xd_reciever.htm');
     }


     if(!defined('GAMMA_RECHARGE'))
	 {
         define('GAMMA_RECHARGE', 300);
     }
     if(!defined('STAMINA_RECHARGE'))
	 {
         define('STAMINA_RECHARGE', 300);
     }
     if(!defined('HEALTH_RECHARGE'))
	 {
         define('HEALTH_RECHARGE', 300);
     }

     if(!defined('GAMMA_START'))
	 {
         define('GAMMA_START', 20);
     }
     if(!defined('STAMINA_START'))
	 {
         define('STAMINA_START', 5);
     }
     if(!defined('HEALTH_START'))
	 {
         define('HEALTH_START', 100);
     }
     if(!defined('MIN_HEALTH'))
	 {
         define('MIN_HEALTH', 20); //Min health for PvP purposes
     }
     if(!defined('STAM_COST'))
	 {
         define('STAM_COST', '1'); //pvp costs one stamina point
     }
     if(!defined('HEALTH_POINT_COST'))
	 {
         define('HEALTH_POINT_COST', '50'); //health point base cost per point
     }
	 

     if(!defined('PLAYER_STATS'))
	 {
         define('PLAYER_STATS', 'fw_player_stats');
     }
     if(!defined('FACTION'))
	 {
         define('FACTION', 'fw_faction');
     }
     if(!defined('FAC_SCORES'))
	 {
         define('FAC_SCORES', 'fw_faction_scores');
     }
     if(!defined('ALLIES'))
	 {
         define('ALLIES', 'fw_allies');
     }
     if(!defined('PLAYER_INV'))
	 {
         define('PLAYER_INV', 'fw_player_inventory');
     }
     if(!defined('ITEM'))
	 {
         define('ITEM', 'fw_item');
     }
     if(!defined('ITEM_UPDATE'))
	 {
         define('ITEM_UPDATE', 'fw_item_update');
     }
     if(!defined('TOWN'))
	 {
         define('TOWN', 'fw_town');
     }
     if(!defined('TOWN_ITEM'))
	 {
         define('TOWN_ITEM', 'fw_town_item');
     }
	 if(!defined('SECTOR'))
	 {
         define('SECTOR', 'fw_sector');
     }
     if(!defined('MISH_INGRED'))
	 {
         define('MISH_INGRED', 'fw_mission_ingredient');
     }
	 if(!defined('MISH_REWARD'))
	 {
         define('MISH_REWARD', 'fw_mission_reward');
     }
     if(!defined('MISH'))
	 {
         define('MISH', 'fw_mission');
     }
     if(!defined('TOWN_MISH'))
	 {
         define('TOWN_MISH', 'fw_town_mission');
     }
     if(!defined('OWNED_TOWN'))
	 {
         define('OWNED_TOWN', 'fw_owned_town_mission');
     }
     if(!defined('FAC_MISH'))
	 {
         define('FAC_MISH', 'fw_faction_mission');
     }
	 if(!defined('FAC_ITEM'))
	 {
         define('FAC_ITEM', 'fw_faction_items');
     }
     if(!defined('PERK'))
	 {
         define('PERK', 'fw_fp_perk');
     }
     if(!defined('FRIENDS'))
	 {
         define('FRIENDS', 'fw_player_friends');
     }

       //achievement tables
     if(!defined('ACHIEVEMENT'))
	 {
         define('ACHIEVEMENT',    'fw_achievement');
     }
     if(!defined('PLAYER_ACHIEVE'))
	 {
         define('PLAYER_ACHIEVE', 'fw_player_achievement');
     }
     if(!defined('COUNT'))
	 {
         define('COUNT',          'fw_count');
     }
     if(!defined('ACHIEVE_COUNT'))
	 {
         define('ACHIEVE_COUNT',  'fw_achievement_count');
     }
     if(!defined('MISH_COMPLETION'))
	 {
         define('MISH_COMPLETION', 'fw_training');
     }
	 if(!defined('MESSAGE_QUEUE'))
	 {
         define('MESSAGE_QUEUE', 'fw_message_queue');
     }
	 if(!defined('CRAFTING'))
	 {
         define('CRAFTING', 'fw_crafting');
     }
	 if(!defined('SUMMON_CRAFTING'))
	 {
         define('SUMMON_CRAFTING', 'fw_craft_summon_item');
     }
	 if(!defined('SUMMON_MISH'))
	 {
         define('SUMMON_MISH', 'fw_summon_mission');
     }
	 if(!defined('BOSS_FIGHTS'))
	 {
         define('BOSS_FIGHTS', 'fw_current_summon');
     }
	 if(!defined('BOSS_DMG'))
	 {
         define('BOSS_DMG', 'fw_summon_participation');
     }
	 if(!defined('STRINGS'))
	 {
         define('STRINGS', 'fw_gamestrings');
     }


	 if(!defined('BOSS_TIME_UNIT'))
	 {
         define('BOSS_TIME_UNIT',  7200);//base unit for amt secods boss fight is active
     }

	 if(!defined('FREE_GIFT'))
	 {
         define('FREE_GIFT',       'fw_free_gift');//free gift times and inventory
     }
	 //$gt = 24 * 60 * 60;
	 $gt = 2 * 60; //gift time -- how long the gift will take to recycle in seconds
     if(!defined('FREE_GIFT_COOLDOWN'))
	 {
         define('FREE_GIFT_COOLDOWN', $gt);
     }
	 if(!defined('CLAIM_FREE_GIFT'))
	 {
         define('CLAIM_FREE_GIFT',   '1');
     }
	 if(!defined('SEND_FREE_GIFT'))
	 {
         define('SEND_FREE_GIFT',    '2');
     }

     if(!defined('METRICS'))
	 {
         define('METRICS', 'fw_metrics');
     }

       //achievement constants used in fw_count
	 if(!defined('MISSION'))
	 {
         define('MISSION',          '1'); //tracking mission completion
     }
	 if(!defined('BUY'))
	 {
         define('BUY',              '2'); //items bought
     }
	 if(!defined('SELL'))
	 {
         define('SELL',             '3'); //items sold
     }
	 if(!defined('PVP_WIN'))
	 {
         define('PVP_WIN',          '4');
     }
	 if(!defined('PVP_LOSS'))
	 {
         define('PVP_LOSS',         '5');
     }
	 if(!defined('MISSION_MASTERY'))
	 {
         define('MISSION_MASTERY',  '6'); //for each mission
     }
	 if(!defined('CHIP_TOTAL'))
	 {
         define('CHIP_TOTAL',       '7');
     }
	 if(!defined('SKILL_MASTERY'))
	 {
         define('SKILL_MASTERY',    '8');
     }
	 if(!defined('MUTE_MASTERY'))
	 {
         define('MUTE_MASTERY',     '9');
     }
	 if(!defined('PVP_KILL'))
	 {
         define('PVP_KILL',         '10');
	 }
	 if(!defined('CRAFT'))
	 {
         define('CRAFT',            '11');
	 }
	 if(!defined('CHIP_ITEM'))
	 {
         define('CHIP_ITEM',        '1'); //for itemid in fw_count
     }

       //pvp rewards
	 if(!defined('BASE_XP'))
	 {
         define('BASE_XP',    5); //xp reward for PvP
	 }
	 if(!defined('BASE_CHIPS'))
	 {
         define('BASE_CHIPS', 5); //cash reward for PvP
	 }
	 if(!defined('BASE_FAC'))
	 {
         define('BASE_FAC',   10); //town points for faction award in PvP
     }
	 if(!defined('TOWN_FAC_THRESHOLD'))
	 {
         define('TOWN_FAC_THRESHOLD', 100);
	 }
	 if(!defined('TOWN_TIME_THRESHOLD'))
	 {
         define('TOWN_TIME_THRESHOLD', 120);//time between turnovers
     }

	 if(!defined('FAC_REW'))
	 {
         define('FAC_REW', 1); //faction point reward for level up
	 }
	 if(!defined('AP_REW'))
	 {
         define('AP_REW', 5); //ap awarded for level up
	 }
	 if(!defined('AP_REW_MISH'))
	 {
         define('AP_REW_MISH', 1); //ap reward for single mish mastery
     }

	 if(!defined('SALE_PRICE_MULT'))
	 {
         define('SALE_PRICE_MULT', 0.25); //price multiplier for when player sells item, mutation, etc
     }

        //reward multipliers for PvP
	 if(!defined('ALLY_MULT'))
	 {
         define('ALLY_MULT', .75); //ally of player's faction
     }
	 if(!defined('OWN_FAC_MULT'))
	 {
         define('OWN_FAC_MULT', .5); //player's faction
     }
	 if(!defined('ARCHENEMY_MULT'))
	 {
         define('ARCHENEMY_MULT', 1.25); //opposite faction on wheel
     }
	 if(!defined('ENEMY_MULT'))
	 {
         define('ENEMY_MULT', 1); //ally of archenemy faction
     }

       //item types used in fw_training, etc
	 if(!defined('WEAPON'))
	 {
         define('WEAPON', '2');
     }
	 if(!defined('ARMOR'))
	 {
         define('ARMOR', '3');
     }
	 if(!defined('SKILL'))
	 {
         define('SKILL', '4');
     }
	 if(!defined('MUTATION'))
	 {
         define('MUTATION', '5');
     }
	 if(!defined('SCRAP'))
	 {
         define('SCRAP', '6');
     }
	 if(!defined('NOTHING'))
	 {
         define('NOTHING', '7');
	 }
	 if(!defined('SUMMON_INGRED'))
	 {
         define('SUMMON_INGRED', '8');
	 }
	 if(!defined('SUMMON_ITEM'))
	 {
         define('SUMMON_ITEM', '9');
     }
      if(!defined('BOSS_MISSION'))
	 {
         define('BOSS_MISSION', '10');
     }
      if(!defined('BOSS_MISSION_LOSS'))
	 {
         define('BOSS_MISSION_LOSS', '11');
     }
      if(!defined('BOSS_MISSION_LOSS_IMG'))
	 {
         define('BOSS_MISSION_LOSS_IMG', '12');
     }
      if(!defined('BOSS_MISSION_WIN_IMG'))
	 {
         define('BOSS_MISSION_WIN_IMG', '13');
     }
	 

       //achievement types
	 if(!defined('SIMPLE_ACHIEVEMENT'))
	 {
         define('SIMPLE_ACHIEVEMENT', '0');
     }
	 if(!defined('SUM_ACHIEVEMENT'))
	 {
         define('SUM_ACHIEVEMENT', '1');
     }
	 if(!defined('AGGREGATE_ACHIEVEMENT'))
	 {
         define('AGGREGATE_ACHIEVEMENT', '2');
     }
	 
	   //messge types
	 if(!defined('GIFT_MESSAGE'))
	 {
         define('GIFT_MESSAGE',     0);
	 }
	 if(!defined('SYSTEM_MESSAGE'))
	 {
         define('SYSTEM_MESSAGE',   1);
	 }
	 if(!defined('PVP_LOSS_MESSAGE'))
	 {
         define('PVP_LOSS_MESSAGE', 2);
     }
	 if(!defined('PVP_WIN_MESSAGE'))
	 {
         define('PVP_WIN_MESSAGE',  3);
     }

	   //max upgrade number for missions, skills, mutations
	 if(!defined('MAX_UPGRADE'))
	 {
         define('MAX_UPGRADE', 2);
     }

	   //metrics constants
	 if(!defined('TIME_TO_LEVEL'))
	 {
         define('TIME_TO_LEVEL', '1');
	 }
	 if(!defined('CASH_ON_LEVEL'))
	 {
         define('CASH_ON_LEVEL', '2');
	 }
	 if(!defined('TOWN_TIME'))
	 {
         define('TOWN_TIME',     '3');
	 }
	 if(!defined('TOWN_FAC'))
	 {
         define('TOWN_FAC',      '4');
     }
?>