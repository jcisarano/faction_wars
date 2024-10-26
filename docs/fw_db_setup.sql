/*
 * Set up databases and tables for Fallen Earth Faction Wars game for facebook
 *
 * @version 24 August 2009
 * @author Jason Cisarano jcisarano@icarusstudios.com
 *
 * @history
 *         created 24 August 2009
 *         added faction bonuses 21 Sept 2009
 */

--Overall database
CREATE DATABASE fe_faction_wars;

----------------------------------------------------
----------------Player tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_player_stats;
CREATE TABLE fe_faction_wars.fw_player_stats (
       userid BIGINT UNSIGNED NOT NULL PRIMARY KEY,
       isActive TINYINT DEFAULT 1,
       datein INT UNSIGNED,
       dateout INT UNSIGNED,
       lastseen INT UNSIGNED,
       player_level SMALLINT UNSIGNED DEFAULT 1,
       current_xp INT UNSIGNED DEFAULT 0,
       needed_xp INT UNSIGNED DEFAULT 25,
       xp_bonus DECIMAL(3,2),
       achieve_points SMALLINT UNSIGNED DEFAULT 0,
       ap_spent SMALLINT UNSIGNED DEFAULT 0,
       faction_points SMALLINT UNSIGNED DEFAULT 0,
       current_gamma SMALLINT UNSIGNED,
       total_gamma SMALLINT UNSIGNED,
       gamma_update_time BIGINT UNSIGNED,
       gamma_update_rate SMALLINT UNSIGNED,
       current_stamina SMALLINT UNSIGNED,
       total_stamina SMALLINT UNSIGNED,
       stam_update_time BIGINT UNSIGNED,
       stam_update_rate SMALLINT UNSIGNED,
       current_health SMALLINT UNSIGNED,
       total_health SMALLINT UNSIGNED,
       health_update_time BIGINT UNSIGNED,
       health_update_rate SMALLINT UNSIGNED,
       chips INT UNSIGNED DEFAULT 0,
       chips_bonus DECIMAL(3,2),
       name TINYTEXT,
       factionid TINYINT UNSIGNED DEFAULT NULL,
       army_size INT UNSIGNED,
       fights_won INT UNSIGNED DEFAULT 0,
       fights_lost INT UNSIGNED DEFAULT 0,
       attack SMALLINT UNSIGNED,
       adj_attack SMALLINT UNSIGNED,
       defense INT UNSIGNED,
       adj_defense INT UNSIGNED,
       deaths INT UNSIGNED DEFAULT 0,
       kills INT UNSIGNED DEFAULT 0
);

DROP TABLE IF EXISTS fe_faction_wars.fw_player_inventory;
CREATE TABLE fe_faction_wars.fw_player_inventory (
       userid BIGINT UNSIGNED NOT NULL,
       itemid INT UNSIGNED NOT NULL,
       quantity INT UNSIGNED DEFAULT 0,
       PRIMARY KEY(userid, itemid)
);

DROP TABLE IF EXISTS fe_faction_wars.fw_training;
CREATE TABLE fe_faction_wars.fw_training (
       playerid BIGINT UNSIGNED,
       itemid INT UNSIGNED,
       itemtype TINYINT UNSIGNED,
       mastery TINYINT UNSIGNED,
       PRIMARY KEY(playerid, itemid, itemtype)
);

DROP TABLE IF EXISTS fe_faction_wars.fw_player_friends;
CREATE TABLE fe_faction_wars.fw_player_friends (
       playerid BIGINT UNSIGNED,
       friendid BIGINT UNSIGNED,
       PRIMARY KEY(playerid, friendid)
);

----------------------------------------------------
----------------Mission tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_mission;
CREATE TABLE fe_faction_wars.fw_mission(
       missionid SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       title TINYTEXT,
       description TEXT,
       result_text TEXT,
       image TINYTEXT,
       chips_max SMALLINT UNSIGNED,
       chips_min SMALLINT UNSIGNED,
       xp_max MEDIUMINT UNSIGNED,
       xp_min MEDIUMINT UNSIGNED,
       energy_drain SMALLINT UNSIGNED,
       completion_one INT UNSIGNED DEFAULT 0,
       completion_two INT UNSIGNED DEFAULT 0,
       completion_three INT UNSIGNED DEFAULT 0
);

DROP TABLE IF EXISTS fe_faction_wars.fw_mission_reward;
CREATE TABLE fe_faction_wars.fw_mission_reward(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       itemid SMALLINT UNSIGNED,
       missionid SMALLINT UNSIGNED,
       quantity TINYINT UNSIGNED,
       chance TINYINT UNSIGNED DEFAULT 100
);

DROP TABLE IF EXISTS fe_faction_wars.fw_mission_ingredient;
CREATE TABLE fe_faction_wars.fw_mission_ingredient(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       itemid SMALLINT UNSIGNED,
       missionid SMALLINT UNSIGNED,
       quantity TINYINT UNSIGNED
);

----------------------------------------------------
----------------Faction tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_faction;
CREATE TABLE fe_faction_wars.fw_faction(
       id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       faction TINYTEXT,
       description TEXT,
       description_2 TEXT,
       image VARCHAR(32),
       enemyid SMALLINT UNSIGNED,
       gamma_update_rate SMALLINT UNSIGNED,
       stamina_update_rate SMALLINT UNSIGNED,
       health_update_rate SMALLINT UNSIGNED,
       chips_bonus DECIMAL(3,2),
       xp_bonus DECIMAL (3,2),
       start_attack TINYINT UNSIGNED,
       start_defense TINYINT UNSIGNED,
	   thumb VARCHAR(32)
);

DROP TABLE IF EXISTS fe_faction_wars.fw_allies;
CREATE TABLE fe_faction_wars.fw_allies(
       id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       factionid SMALLINT UNSIGNED,
       allyid SMALLINT UNSIGNED
);

DROP TABLE IF EXISTS fe_faction_wars.fw_faction_scores;
CREATE TABLE fe_faction_wars.fw_faction_scores(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid SMALLINT UNSIGNED,
       factionid SMALLINT UNSIGNED,
       score BIGINT DEFAULT 0
);

DROP TABLE IF EXISTS fe_faction_wars.fw_faction_item;
CREATE TABLE fe_faction_wars.fw_faction_items(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       itemid  INT UNSIGNED,
       townid INT UNSIGNED,
       factionid  SMALLINT UNSIGNED,
       fp_price INT UNSIGNED,
       available TINYINT DEFAULT 0
);

DROP TABLE IF EXISTS fe_faction_wars.fw_fp_perk;
CREATE TABLE fe_faction_wars.fw_fp_perk(
       id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       name VARCHAR(32),
       description TINYTEXT,
       fp_price INT UNSIGNED,
       perk_type TINYINT UNSIGNED DEFAULT 1,
       image TINYTEXT
);

----------------------------------------------------
----------------Town tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_town;
CREATE TABLE fe_faction_wars.fw_town(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       name TINYTEXT,
       town_level TINYINT DEFAULT 0,
       sector TINYTEXT,
       description TEXT,
       image VARCHAR(32) DEFAULT 'test.jpg',
       owned TINYINT DEFAULT 0,
       ownership_date INT UNSIGNED DEFAULT 0,
       owner_factionid TINYINT DEFAULT NULL,
       hit_x SMALLINT DEFAULT 0,
       hit_y SMALLINT DEFAULT 0,
       img_x SMALLINT DEFAULT 0,
       img_y SMALLINT DEFAULT 0
);

--Always displays
DROP TABLE IF EXISTS fe_faction_wars.fw_town_mission;
CREATE TABLE fe_faction_wars.fw_town_mission(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid INT UNSIGNED,
       missionid INT UNSIGNED
);

--Displays when a town is owned by a particular faction
DROP TABLE IF EXISTS fe_faction_wars.fw_faction_mission;
CREATE TABLE fe_faction_wars.fw_faction_mission(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid INT UNSIGNED,
       missionid INT UNSIGNED,
       factionid SMALLINT UNSIGNED
);

--Displays when a town is owned by any faction
--not faction-specific
DROP TABLE IF EXISTS fe_faction_wars.fw_owned_town_mission;
CREATE TABLE fe_faction_wars.fw_owned_town_mission(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid INT UNSIGNED,
       missionid INT UNSIGNED
);

--Sector name and id
DROP TABLE IF EXISTS fe_faction_wars.fw_sector;
CREATE TABLE fe_faction_wars.fw_sector(
       id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       name TINYTEXT
);

----------------------------------------------------
----------------Item tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_item;
CREATE TABLE fe_faction_wars.fw_item(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       name VARCHAR(32),
       description TEXT,
       use_text TEXT,
       image VARCHAR(32),
       attack_bonus_one SMALLINT,
       attack_bonus_two SMALLINT,
       attack_bonus_three SMALLINT,
       defense_bonus_one SMALLINT,
       defense_bonus_two SMALLINT,
       defense_bonus_three SMALLINT,
       price_one INT UNSIGNED DEFAULT 0,
       price_two INT UNSIGNED DEFAULT 0,
       price_three INT UNSIGNED DEFAULT 0,
       purchasable TINYINT UNSIGNED DEFAULT 1,
       vendable TINYINT UNSIGNED DEFAULT 1,
       item_type SMALLINT UNSIGNED,
       completion_one TINYINT UNSIGNED DEFAULT 0,
       completion_two TINYINT UNSIGNED DEFAULT 0,
       completion_three TINYINT UNSIGNED DEFAULT 0,
       upgrade_price_one INT UNSIGNED DEFAULT 0,
       upgrade_price_two INT UNSIGNED DEFAULT 0,
       upgrade_price_three INT UNSIGNED DEFAULT 0,
       trainingtype TINYINT UNSIGNED
);

DROP TABLE IF EXISTS fe_faction_wars.fw_town_item;
CREATE TABLE fe_faction_wars.fw_town_item(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       itemid INT UNSIGNED,
       townid INT UNSIGNED
);

DROP TABLE IF EXISTS fe_faction_wars.fw_item_update;
CREATE TABLE fe_faction_wars.fw_item_update(
       itemid INT UNSIGNED NOT NULL,
       userid BIGINT UNSIGNED NOT NULL,
       update_time BIGINT UNSIGNED DEFAULT 0,
       PRIMARY KEY(itemid, userid)
);

----------------------------------------------------
----------------Achievement tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_achievement;
CREATE TABLE fe_faction_wars.fw_achievement(
       achievementid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       name VARCHAR(64),
       description TEXT,
       needed SMALLINT UNSIGNED,
       achievement_type TINYINT UNSIGNED DEFAULT 0,
       image VARCHAR(32) DEFAULT 'test.jpg',
       category TINYINT DEFAULT 0
);


DROP TABLE IF EXISTS fe_faction_wars.fw_count;
CREATE TABLE fe_faction_wars.fw_count(
       itemid INT UNSIGNED NOT NULL,
       itemtype TINYINT UNSIGNED NOT NULL,
       player_reps INT UNSIGNED,
       playerid BIGINT UNSIGNED NOT NULL,
       PRIMARY KEY(itemid, itemtype, playerid)
);

DROP TABLE IF EXISTS fe_faction_wars.fw_achievement_count;
CREATE TABLE fe_faction_wars.fw_achievement_count(
       achievementid INT UNSIGNED NOT NULL,
       itemid INT UNSIGNED NOT NULL,
       itemtype TINYINT UNSIGNED NOT NULL,
       PRIMARY KEY(itemid, itemtype, achievementid)
);

DROP TABLE IF EXISTS fe_faction_wars.fw_player_achievement;
CREATE TABLE fe_faction_wars.fw_player_achievement(
       achievementid INT UNSIGNED NOT NULL,
       playerid BIGINT UNSIGNED NOT NULL,
       date_won INT UNSIGNED DEFAULT NULL,
       PRIMARY KEY(achievementid, playerid)
);

----------------------------------------------------
----------------Messaging tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_message_queue;
CREATE TABLE fe_faction_wars.fw_message_queue(
       messageid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       recipientid BIGINT UNSIGNED,
       senderid BIGINT UNSIGNED,
       message_type TINYINT UNSIGNED,
       datein INT UNSIGNED,
       dateread INT UNSIGNED DEFAULT NULL,
       dateFbPosted INT UNSIGNED DEFAULT 0,
       param_one VARCHAR(255),
       param_two VARCHAR(255),
       param_three VARCHAR(255)
);

----------------------------------------------------
----------------Crafting tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_crafting;
CREATE TABLE fe_faction_wars.fw_crafting(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid INT UNSIGNED,
       missionid INT UNSIGNED
);

----------------------------------------------------
----------------Gifting tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_free_gift;
CREATE TABLE fe_faction_wars.fw_free_gift(
       giftkey BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       senderid BIGINT UNSIGNED,
       recipientid BIGINT UNSIGNED,
       datesent BIGINT UNSIGNED,
       itemid INT UNSIGNED,
       isClaimed TINYINT UNSIGNED DEFAULT 0
);

--Monster summons missions each associated with one town
--town may have more than one
DROP TABLE IF EXISTS fe_faction_wars.fw_craft_summon_item;
CREATE TABLE fe_faction_wars.fw_craft_summon_item(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid INT UNSIGNED,
       missionid INT UNSIGNED
);


----------------------------------------------------
----------------Boss fight tables
----------------------------------------------------
--Stores list of missions used to activate summon items
DROP TABLE IF EXISTS fe_faction_wars.fw_summon_mission;
CREATE TABLE fe_faction_wars.fw_summon_mission(
       id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
       townid INT UNSIGNED,
       missionid INT UNSIGNED
);

--Track boss fights - each player may have only one active at a time
DROP TABLE IF EXISTS fe_faction_wars.fw_current_summon;
CREATE TABLE fe_faction_wars.fw_current_summon(
       summonid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       playerid BIGINT UNSIGNED NOT NULL,
       missionid INT UNSIGNED NOT NULL,
       boss_start_hp INT UNSIGNED,
       boss_hp INT UNSIGNED,
       datestarted BIGINT UNSIGNED NOT NULL,
       isActive TINYINT,
       isDefeated TINYINT DEFAULT 0,
       dateEnded BIGINT UNSIGNED
);

--Track individual participation in a boss fight: damage done, reward collection
DROP TABLE IF EXISTS fe_faction_wars.fw_summon_participation;
CREATE TABLE fe_faction_wars.fw_summon_participation(
       summonid INT UNSIGNED NOT NULL,
       summon_playerid BIGINT UNSIGNED NOT NULL,
       playerid BIGINT UNSIGNED NOT NULL,
       dmg INT UNSIGNED,
       clicks SMALLINT UNSIGNED,
       isRewardCollected TINYINT DEFAULT 0,
       dateCollected BIGINT UNSIGNED,
       PRIMARY KEY(summon_playerid, playerid, summonid)
);

--Space for extended text strings for boss fights, etc
DROP TABLE IF EXISTS fe_faction_wars.fw_gamestrings;
CREATE TABLE fe_faction_wars.fw_gamestrings(
       stringid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       itemid INT UNSIGNED NOT NULL,
       itemtype INT UNSIGNED NOT NULL,
       gamestring TEXT
);

----------------------------------------------------
----------------Metrics tables
----------------------------------------------------
DROP TABLE IF EXISTS fe_faction_wars.fw_metrics;
CREATE TABLE fe_faction_wars.fw_metrics(
       metricid INT UNSIGNED,
       identifier INT UNSIGNED,
       param_one BIGINT,
       param_two BIGINT,
       param_three BIGINT,
       PRIMARY KEY(metricid, identifier)
);