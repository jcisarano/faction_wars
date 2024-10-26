/**
  * TESTING PURPOSES
  * Init scripts for Faction Wars database
  */
  

/**
  * Sectors
  */
INSERT INTO fe_faction_wars.fw_sector (name) VALUES ("Plateau");
INSERT INTO fe_faction_wars.fw_sector (name) VALUES ("Northfields");
INSERT INTO fe_faction_wars.fw_sector (name) VALUES ("Kaibab Forest");

/**
  * Factions
  */
INSERT INTO fe_faction_wars.fw_faction (faction, description, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("CHOTA",       "As a result of extensive exposure to radiation and the Shiva Virus, there are many mutants among the CHOTA\s ranks. Whereas the Children of the Apocalypse don\'t have advanced weaponry and their numbers aren\'t very well organized, they are ferocious fighters.",       "chota_icon.gif",       2, 300, 240, 300, 1.0,  1.0,  10, 10, "chota_thumb.jpg");
INSERT INTO fe_faction_wars.fw_faction (faction, description, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Enforcer",    "Enforcers are an elite group of soldiers who have undergone extreme physical conditioning and grueling survival exercises. With their access to some of the best armor and equipment available from the remnants before the Fall, they can best enemies ten times their number. The Enforcers have an aversion to anyone with unnatural powers, and they believe law and order are the only way to rebuild civilization.",    "enforcer_icon.gif",    1, 300, 300, 240, 1.0,  1.0,  15, 10, "enforcer_thumb.jpg");
INSERT INTO fe_faction_wars.fw_faction (faction, description, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Lightbearer", "The Lightbearers\' mission to restore health and safety to humanity appeals to doctors, martial artists, philosophers, and many others who wish to protect and defend the world--including those who have been mutated by the dreaded Shiva Virus. Using Shakti\'s principles, the Lightbearers consider it their role to guide people toward self-awareness.", "lightbearer_icon.gif", 5, 300, 300, 300, 1.0,  1.0,  10, 15, "lightbearer_thumb.jpg");
INSERT INTO fe_faction_wars.fw_faction (faction, description, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Tech",        "Owning the largest crafting facilities in the Province, Techs can manufacture advanced items, armor, and firearms in larger quantities than any other group. However, they have comparably less experience in combat, wilderness survival, and diplomacy, so they tend to rely on their allies for protection.",        "tech_icon.gif",        6, 240, 300, 300, 1.0,  1.0,  10, 10, "tech_thumb.jpg");
INSERT INTO fe_faction_wars.fw_faction (faction, description, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Traveler",    "Ramblers and rogues, the Travelers just want to live to profit another day. The Travelers don\'t have much in the way of a hierarchy. Each settlement or caravan is ruled by its own leader, who chooses his own title; this leads to a variety of Kings, Emperors, Barons, Bosses, and Presidents among the Traveler settlements. They don\'t often listen to each other, but every Traveler listens to the sound of money.",    "traveler_icon.gif",    3, 300, 300, 300, 1.05, 1.0,  10, 10, "traveler_thumb.jpg");
INSERT INTO fe_faction_wars.fw_faction (faction, description, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Vista",       "Vistas are not opposed to technology in general, only to the single-minded pursuit of scientific advancement at the expense of the natural environment. This, they believe, was the impetus for the Fall of the Old World. The Vistas are not merely guerrilla warriors, but farmers, ranchers, and craftsmen. They produce most of the food consumed in the Province, and they know what plants can be used to heal and what animals produce the most virulent toxins.",       "vista_icon.gif",       4, 300, 300, 300, 1.0,  1.05, 10, 10, "vista_thumb.jpg");

/*CHOTA allies*/
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (1, 5);
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (1, 6);

/*Enforcer allies*/
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (2, 3);
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (2, 4);

/*Lightbearer allies*/
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (3, 2);
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (3, 6);

/*Tech allies*/
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (4, 2);
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (4, 5);

/*Traveler allies*/
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (5, 1);
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (5, 4);

/*Vista allies*/
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (6, 1);
INSERT INTO fe_faction_wars.fw_allies (factionid, allyid) VALUES (6, 3);


/**
  * Towns - INCOMPLETE - NEEDS DESCRIPTIONS
  */
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Trailer Park",   1,  1,  "Trailer Park description description description description description description description description", 0, 228, 161, 265, 190);
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Dry Flats",      5,  1,  "Dry Flats description description description description description description description description", 0, 177, 159, 133, 149);
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Slaughterville", 10, 1,  "Slaughterville description description description description description description description description", 0, 139, 227, 100, 227);

INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("The Dump",       15, 2,  "The Dump description description description description description description description description", 0, 165, 10, 128, 23);
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("New Gallows",    20, 2,  "New Gallows description description description description description description description description", 0, 193, 64, 156, 74);
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Tinkersdam",     25, 2, "Tinkersdam description description description description description description description description", 0, 235, 52, 245, 15);

INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Waste Farm",     30, 3, "Waste Farm description description description description description description description description", 0, 340, 10, 407, 8);
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Park City",      35, 3, "Park City description description description description description description description description", 0, 390, 88, 461, 95);
INSERT INTO fe_faction_wars.fw_town (name, town_level, sector, description, owned, hit_x, hit_y, img_x, img_y) VALUES ("Fender Gate",    40, 3, "Fender Gate description description description description description description description description", 0, 347, 57, 308, 61);


/**
  * Missions -- DUMMY FOR TESTING
  */
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Generic Mission t1a",    "Generic Mission t1a description description description description description description description description",         "Generic Mission t1a description description description description description description description description",    500,  100, 5,  2, 1);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Generic Mission t1b",    "Generic Mission t1b description description description description description description description description",         "Generic Mission t1b description description description description description description description description",    600,  50,  4,  3, 2);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Generic Mission t1c",    "Crafting Mission t1c description description description description description description description description",        "Generic Mission t1c description description description description description description description description",    700,  200, 9,  7, 2);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Gen Owned Mission t1a",  "Gen Owned Mission t1a description description description description description description description description",       "Gen Owned Mission t1a description description description description description description description description",  800,  300, 13, 9, 3);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Gen Owned Mission t1b",  "Crafting Owned Mission t1b description description description description description description description description",  "Gen Owned Mission t1b description description description description description description description description",  900,  400, 17, 12, 3);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("CHOTA Mission t1",       "CHOTA Mission t1 description description description description description description description description",            "CHOTA Mission t1 description description description description description description description description",       1000, 650, 25, 10, 4);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Enforcer Mission t1",    "Enforcer Mission t description description description description description description description description1",         "Enforcer Mission t1 description description description description description description description description",    1000, 500, 25, 10, 4);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Lightbearer Mission t1", "Lightbearer Mission t1 description description description description description description description description",      "Lightbearer Mission t1 description description description description description description description description", 1000, 500, 25, 10, 4);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Tech Mission t1",        "Tech Mission t1 description description description description description description description description",             "Tech Mission t1 description description description description description description description description",        1000, 500, 25, 10, 4);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Traveler Mission t1",    "Traveler Mission t1 description description description description description description description description",         "Traveler Mission t1 description description description description description description description description",    1000, 500, 25, 10, 4);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Vista Mission t1",       "Vista Mission t1 description description description description description description description description",            "Vista Mission t1 description description description description description description description description",       1000, 500, 25, 10, 4);

INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Generic Mission t2a",    "Generic Mission t2a description description description description description description description description",         "Generic Mission t2a description description description description description description description description",    500,  100, 5,  2, 1);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Generic Mission t2b",    "Generic Mission t2b description description description description description description description description",         "Generic Mission t2b description description description description description description description description",    600,  50,  4,  3, 2);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Generic Mission t2c",    "Crafting Mission t2c description description description description description description description description",        "Generic Mission t2c description description description description description description description description",    700,  200, 9,  7, 2);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Gen Owned Mission t2a",  "Gen Owned Mission t2a description description description description description description description description",       "Gen Owned Mission t2a description description description description description description description description",  800,  300, 13, 9, 3);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Gen Owned Mission t2b",  "Crafting Owned Mission t2b description description description description description description description description",  "Gen Owned Mission t2b description description description description description description description description",  900,  400, 17, 12, 3);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("CHOTA Mission t2",       "CHOTA Mission t2 description description description description description description description description",            "CHOTA Mission t2 description description description description description description description description",       1000, 650, 25, 10, 4);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Enforcer Mission t2",    "Enforcer Mission t2 description description description description description description description description1",        "Enforcer Mission t2 description description description description description description description description",    1000, 500, 25, 10, 5);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Lightbearer Mission t2", "Lightbearer Mission t2 description description description description description description description description",      "Lightbearer Mission t2 description description description description description description description description", 1000, 500, 25, 10, 5);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Tech Mission t2",        "Tech Mission t2 description description description description description description description description",             "Tech Mission t2 description description description description description description description description",        1000, 500, 25, 10, 5);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Traveler Mission t2",    "Traveler Mission t2 description description description description description description description description",         "Traveler Mission t2 description description description description description description description description",    1000, 500, 25, 10, 5);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, chips_max, chips_min, xp_max, xp_min, energy_drain) VALUES ("Vista Mission t2",       "Vista Mission t2 description description description description description description description description",            "Vista Mission t2 description description description description description description description description",       1000, 500, 25, 10, 5);


INSERT INTO fe_faction_wars.fw_town_mission (townid, missionid) VALUES (1,1);
INSERT INTO fe_faction_wars.fw_town_mission (townid, missionid) VALUES (1,2);
INSERT INTO fe_faction_wars.fw_town_mission (townid, missionid) VALUES (1,3);

INSERT INTO fe_faction_wars.fw_town_mission (townid, missionid) VALUES (2,12);
INSERT INTO fe_faction_wars.fw_town_mission (townid, missionid) VALUES (2,13);
INSERT INTO fe_faction_wars.fw_town_mission (townid, missionid) VALUES (2,14);

/**
  * Items -- DUMMY FOR TESTING
  */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus, defense_bonus, price, item_type) VALUES ("item1", "item1 description item1 description item1 description item1 description ", "you used item1 you used item1 you used item1 you used item1 ", "test.jpg", 0, 0, 100, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus, defense_bonus, price, item_type) VALUES ("item2", "item2 description item2 description item2 description item2 description ", "you used item2 you used item2 you used item2 you used item2 ", "test.jpg", 0, 0, 200, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus, defense_bonus, price, item_type) VALUES ("item3", "item3 description item3 description item3 description item3 description ", "you used item3 you used item3 you used item3 you used item3 ", "test.jpg", 0, 0, 300, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus, defense_bonus, price, item_type) VALUES ("item4", "item4 description item4 description item4 description item4 description ", "you used item4 you used item4 you used item4 you used item4 ", "test.jpg", 0, 0, 400, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus, defense_bonus, price, item_type) VALUES ("item5", "item5 description item5 description item5 description item5 description ", "you used item5 you used item5 you used item5 you used item5 ", "test.jpg", 0, 0, 500, 0);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,1,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,1,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,2,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,2,1);

INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES ();

INSERT INTO fw_player_inventory (itemid, userid, quantity) VALUES (1,17,1);
INSERT INTO fw_player_inventory (itemid, userid, quantity) VALUES (2,17,2);

INSERT INTO fw_mission_reward(itemid, missionid, quantity) VALUES (3, 1, 1);
INSERT INTO fw_mission_reward(itemid, missionid, quantity) VALUES (3, 2, 2);

INSERT INTO fw_town_item (townid, itemid) VALUES (1,1);
INSERT INTO fw_town_item (townid, itemid) VALUES (1,2);
INSERT INTO fw_town_item (townid, itemid) VALUES (2,1);
INSERT INTO fw_town_item (townid, itemid) VALUES (2,2);
INSERT INTO fw_town_item (townid, itemid) VALUES (2,3);
INSERT INTO fw_town_item (townid, itemid) VALUES (3,3);
INSERT INTO fw_town_item (townid, itemid) VALUES (3,4);
INSERT INTO fw_town_item (townid, itemid) VALUES (3,5);

/**
  * FACTION POINTS
  */
INSERT INTO fw_faction_scores (townid, factionid) VALUES (1, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (1, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (1, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (1, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (1, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (1, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (2, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (2, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (2, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (2, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (2, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (2, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (3, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (3, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (3, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (3, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (3, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (3, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (4, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (4, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (4, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (4, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (4, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (4, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (5, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (5, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (5, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (5, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (5, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (5, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (6, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (6, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (6, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (6, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (6, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (6, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (7, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (7, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (7, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (7, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (7, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (7, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (8, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (8, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (8, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (8, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (8, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (8, 6);

INSERT INTO fw_faction_scores (townid, factionid) VALUES (9, 1);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (9, 2);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (9, 3);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (9, 4);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (9, 5);
INSERT INTO fw_faction_scores (townid, factionid) VALUES (9, 6);

/*
 * TEST CHARACTERS
 */
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (10, 1, 3, 20, 20, 5, 5, 100, 100, "Bad Tommy", 3, 1, 10, 10);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES 
                            (11, 1, 4, 20, 20, 5, 5, 100, 100, "Good Tommy", 2, 1, 12, 12);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (12, 1, 4, 20, 20, 5, 5, 100, 100, "Boggs the Rat", 5, 0, 9, 9);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (13, 1, 5, 20, 20, 5, 5, 100, 100, "Dexter", 1, 3, 15, 7);
                            
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (31, 1, 6, 20, 20, 5, 5, 100, 100, "Naramore", 1, 4, 20, 20);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (32, 1, 7, 20, 20, 5, 5, 100, 100, "Le Scouranec", 2, 17, 25, 25);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (33, 1, 8, 20, 20, 5, 5, 100, 100, "Stolz", 3, 9, 30, 30);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (34, 1, 8, 20, 20, 5, 5, 100, 100, "Glass", 4, 31, 35, 35);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (35, 1, 9, 20, 20, 5, 5, 100, 100, "Gerner", 5, 5, 40, 40);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (36, 1, 10, 20, 20, 5, 5, 100, 100, "Peachpit", 6, 55, 45, 45);

INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (37, 1, 11, 20, 20, 5, 5, 100, 100, "Thomson", 1, 11, 50, 50);
                            
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (38, 1, 12, 20, 20, 5, 5, 100, 100, "Irish", 2, 13, 55, 55);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (40, 1, 15, 20, 20, 5, 5, 120, 120, "Harry", 6, 10, 10, 50);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (41, 1, 16, 20, 20, 5, 5, 100, 100, "Rita", 6, 3, 10, 70);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (42, 1, 17, 20, 20, 5, 5, 120, 120, "Angel", 2, 30, 30, 30);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (43, 1, 18, 20, 20, 5, 5, 100, 100, "Quinn", 1, 1, 10, 80);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (44, 1, 19, 20, 20, 5, 5, 100, 100, "Mfn Doakes", 2, 1, 10, 100);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (45, 1, 20, 20, 20, 5, 5, 160, 160, "Masuka", 3, 1, 20, 40);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (46, 1, 21, 20, 20, 5, 5, 100, 100, "Biney", 4, 1, 10, 105);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (47, 1, 22, 20, 20, 5, 5, 100, 100, "Debra", 5, 1, 15, 90);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (48, 1, 23, 20, 20, 5, 5, 100, 100, "Trinity", 5, 1, 10, 80);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (49, 1, 24, 20, 20, 5, 5, 130, 130, "Chatham", 4, 1, 80, 10);
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (50, 1, 25, 50, 50, 25, 25, 300, 300, "Tara", 1, 5, 500, 500); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (51, 1, 26, 50, 50, 25, 25, 300, 300, "Raquel", 2, 6, 510, 510); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (52, 1, 27, 50, 50, 25, 25, 300, 300, "Apollo", 3, 5, 520, 520); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (53, 1, 28, 50, 50, 25, 25, 300, 300, "Colin", 4, 4, 530, 530); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (54, 1, 29, 50, 50, 25, 25, 300, 300, "Nate", 5, 5, 540, 540); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (55, 1, 30, 50, 50, 25, 25, 300, 300, "Parker", 6, 6, 550, 550); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (56, 1, 31, 50, 50, 25, 25, 300, 300, "Sterling", 1, 7, 560, 560); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (57, 1, 32, 50, 50, 25, 25, 300, 300, "Eliot", 2, 6, 570, 570); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (58, 1, 33, 50, 50, 25, 25, 300, 300, "Sophie", 3, 5, 580, 580); 
INSERT INTO fw_player_stats (userid, isActive, player_level, current_gamma, total_gamma, current_stamina, total_stamina, current_health, total_health, name, factionid, army_size, attack, defense ) VALUES
                            (59, 1, 34, 50, 50, 25, 25, 300, 300, "Hardison", 4, 4, 590, 590); 
                            

/*
 * Achievements -- Samples for testing
 */
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed) VALUES ("Brawler", "Win 10 fights against CHOTA.", 10);
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed) VALUES ("Brawler 2", "Win 25 fights against CHOTA.", 25);
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed) VALUES ("Vendor", "Sell 10 salvage items.", 10);
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed) VALUES ("Backstabber", "Win 10 fights against members of your own faction.", 10);
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed) VALUES ("Patriot", "Win 10 fights against your archenemy faction.", 10);

/*sum*/
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed, achievement_type) VALUES ("Dominator", "Win 100 fights.", 100, 1);

/*aggregate*/
INSERT INTO fe_faction_wars.fw_achievement (name, description, needed, achievement_type) VALUES ("Griefer", "Win 10 fights against members of EVERY faction--including your own.", 10, 2);

/*
 * Kill CHOTA hookup
 */
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (1, 1, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (2, 1, 4);

/* dominator hookup */
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (6, 1, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (6, 2, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (6, 3, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (6, 4, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (6, 5, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (6, 6, 4);

/* griefer hookup */
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (7, 1, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (7, 2, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (7, 3, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (7, 4, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (7, 5, 4);
INSERT INTO fw_achievement_count (achievementid, itemid, itemtype) VALUES (7, 6, 4);


/*
 * Achievement results for testing
 */
INSERT INTO fw_player_achievement (achievementid, playerid) VALUES (1, 1407955289);
INSERT INTO fw_player_achievement (achievementid, playerid) VALUES (3, 1407955289);
INSERT INTO fw_player_achievement (achievementid, playerid) VALUES (2, 17);
INSERT INTO fw_player_achievement (achievementid, playerid) VALUES (3, 21);
INSERT INTO fw_player_achievement (achievementid, playerid) VALUES (4, 1407955289);

INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (1407955289, 1, 1, 2);
INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (1407955289, 2, 1, 1);
INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (1407955289, 1, 2, 3);
INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (7, 1, 1, 2);
INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (11, 1, 1, 2);
INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (12, 1, 1, 2);
INSERT INTO fw_training (playerid, itemid, itemtype, mastery) VALUES (7, 2, 1, 2);

/*
 * Fake faction point sales items for testing
 */
INSERT INTO fw_faction_item (itemid, townid, factionid, fp_price, available) VALUES (5, 0, 2, 1, 1);
INSERT INTO fw_faction_item (itemid, townid, factionid, fp_price, available) VALUES (22, 0, 5, 3, 1);
INSERT INTO fw_faction_item (itemid, townid, factionid, fp_price, available) VALUES (1, 0, 0, 2, 0);
INSERT INTO fw_faction_item (itemid, townid, factionid, fp_price, available) VALUES (11, 0, 1, 2, 1);

/*
 * Faction point perks
 */
INSERT INTO fw_fp_perk (name, description, fp_price) VALUES ("Refill Gamma", "Keep running missions by spending faction points.", 1);
INSERT INTO fw_fp_perk (name, description, fp_price) VALUES ("Refill Stamina", "Jump back into the fight by spending faction points", 1);
INSERT INTO fw_fp_perk (name, description, fp_price) VALUES ("Buy achievement points", "Improve your stats.", 1);
INSERT INTO fw_fp_perk (name, description, fp_price) VALUES ("Shorten gamma recharge", "Recover faster after running missions", 2);
INSERT INTO fw_fp_perk (name, description, fp_price) VALUES ("Shorten stamina recharge", "Recover faster after fights", 3);
INSERT INTO fw_fp_perk (name, description, fp_price) VALUES ("Change faction", "Leave your friends, make new ones.", 4);