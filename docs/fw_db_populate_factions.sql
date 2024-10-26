/**
  * Factions
  * FACTIONS ARE ORDER SENSITIVE - DO NOT CHANGE THIS ORDER W/O CHANGING DEPENDENT TABLES
  */
INSERT INTO fw_faction (faction, description, description_2, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("CHOTA",       "As a result of extensive exposure to radiation and the Shiva Virus, there are many mutants among the CHOTA\s ranks. Whereas the Children of the Apocalypse don\'t have advanced weaponry and their numbers aren\'t very well organized, they are ferocious fighters.", "CHOTA recover quickly from head-to-head combat, so they can brawl more frequently.",       "chota_icon.gif",       2, 300, 240, 180, 1.0,  1.0,  10, 10, "chota_thumb.jpg");
INSERT INTO fw_faction (faction, description, description_2, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Enforcer",    "Enforcers are an elite group of soldiers who have undergone extreme physical conditioning and grueling survival exercises. With their access to some of the best armor and equipment available from the remnants before the Fall, they can best enemies ten times their number. The Enforcers have an aversion to anyone with unnatural powers, and they believe law and order are the only way to rebuild civilization.", "Enforcers regenerate health more quickly than other factions. They also start out with better attack abilities for brawling.",    "enforcer_icon.gif",    1, 300, 300, 120, 1.0,  1.0,  15, 10, "enforcer_thumb.jpg");
INSERT INTO fw_faction (faction, description, description_2, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Lightbearer", "The Lightbearers\' mission to restore health and safety to humanity appeals to doctors, martial artists, philosophers, and many others who wish to protect and defend the world--including those who have been mutated by the dreaded Shiva Virus. Using Shakti\'s principles, the Lightbearers consider it their role to guide people toward self-awareness.", "Lightbearers have a better starting defenses in brawls with other factions.", "lightbearer_icon.gif", 5, 300, 300, 180, 1.0,  1.0,  10, 15, "lightbearer_thumb.jpg");
INSERT INTO fw_faction (faction, description, description_2, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Tech",        "Owning the largest crafting facilities in the Province, Techs can manufacture advanced items, armor, and firearms in larger quantities than any other group. However, they have comparably less experience in combat, wilderness survival, and diplomacy, so they tend to rely on their allies for protection.", "Techs regenerate gamma quickly and can therefore go out on more missions than other factions.",        "tech_icon.gif",        6, 240, 300, 180, 1.0,  1.0,  10, 10, "tech_thumb.jpg");
INSERT INTO fw_faction (faction, description, description_2, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Traveler",    "Ramblers and rogues, the Travelers just want to live to profit another day. The Travelers don\'t have much in the way of a hierarchy. Each settlement or caravan is ruled by its own leader, who chooses his own title; this leads to a variety of Kings, Emperors, Barons, Bosses, and Presidents among the Traveler settlements. They don\'t often listen to each other, but every Traveler listens to the sound of money.", "Travelers earn more chips in missions and brawls than members of other factions.",    "traveler_icon.gif",    3, 300, 300, 180, 1.05, 1.0,  10, 10, "traveler_thumb.jpg");
INSERT INTO fw_faction (faction, description, description_2, image, enemyid, gamma_update_rate, stamina_update_rate, health_update_rate, chips_bonus, xp_bonus, start_attack, start_defense, thumb) VALUES ("Vista",       "Vistas are not opposed to technology in general, only to the single-minded pursuit of scientific advancement at the expense of the natural environment. This, they believe, was the impetus for the Fall of the Old World. The Vistas are not merely guerrilla warriors, but farmers, ranchers, and craftsmen. They produce most of the food consumed in the Province, and they know what plants can be used to heal and what animals produce the most virulent toxins.", "Vistas earn experience points faster than other factions.",       "vista_icon.gif",       4, 300, 300, 180, 1.0,  1.05, 10, 10, "vista_thumb.jpg");

/*CHOTA allies*/
INSERT INTO fw_allies (factionid, allyid) VALUES (1, 5);
INSERT INTO fw_allies (factionid, allyid) VALUES (1, 6);

/*Enforcer allies*/
INSERT INTO fw_allies (factionid, allyid) VALUES (2, 3);
INSERT INTO fw_allies (factionid, allyid) VALUES (2, 4);

/*Lightbearer allies*/
INSERT INTO fw_allies (factionid, allyid) VALUES (3, 2);
INSERT INTO fw_allies (factionid, allyid) VALUES (3, 6);

/*Tech allies*/
INSERT INTO fw_allies (factionid, allyid) VALUES (4, 2);
INSERT INTO fw_allies (factionid, allyid) VALUES (4, 5);

/*Traveler allies*/
INSERT INTO fw_allies (factionid, allyid) VALUES (5, 1);
INSERT INTO fw_allies (factionid, allyid) VALUES (5, 4);

/*Vista allies*/
INSERT INTO fw_allies (factionid, allyid) VALUES (6, 1);
INSERT INTO fw_allies (factionid, allyid) VALUES (6, 3);

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