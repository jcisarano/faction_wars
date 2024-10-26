/**
  * ITEMS ARE ALL ORDER SENSITIVE -- ADD NEW ITEMS TO THE END OF THE LIST!
  */
/**
  * Items - Components
  */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Rawhide", "Gather \'em up, pass \'em on.", "use text here", "rawhide_64x64.png",                          0, 0, 100, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Salvaged Iron", "Gathered from spare tech lying around.", "use text here", "salvagediron_64x64.png",               0, 0, 150, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Scrap Fastener", "There\'s never enough of them.", "use text here", "scrapfasteners_64x64.png",             0, 0, 200, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Treated Wood", "Withstands the elements better than scrap.", "use text here", "treatedwood_64x64.png",                 0, 0, 250, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Frayed Cotton", "Not perfect, but it\'ll do.", "use text here", "frayedwool_64x64.png",                 0, 0, 300, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Scrap Steel", "Better than gold in the hands of a crafter.", "use text here", "test.jpg",                               0, 0, 350, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Tattered Leather", "It\'s seen better days, but you\'ve seen worse.", "use text here", "tatteredleather_64x64.png",         0, 0, 400, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Common Plastic", "It\'s like they made everything out of this stuff.", "use text here", "commonplastic_64x64.png",             0, 0, 500, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Kevlar", "Sometimes the difference between life and death.", "use text here", "kevlar_64x64.png",                            0, 0, 1000, 0, 6, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Alloy Steel", "Holds up better and lasts longer.", "use text here", "alloysteel_64x64.png",                   0, 0, 2000, 0, 6, 0, 0, 0, 0, 0, 0, 0);

/**
  * Items -  Skills Common Tier 1
  */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Armor Use: Recognize Weakness", "Your knowledge of armor will help you locate the weakness in your opponent\'s gear.", "use text here", "icon_recogweak.jpg",   5, 12, 17,  2, 9, 14, 150, 300, 600, 1, 4, 15, 10, 10, 200, 500, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Athletics: Dash", "Great for opening charges and catching your enemy with his pants down.", "use text here", "icon_dash.jpg",                      3, 10, 15, 6, 13, 18, 200, 400, 800, 1, 4, 15, 10, 10, 250, 550, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Dodge: Duck and Weave", "Your enemy can\'t hit what he can\'t... hit.", "use text here", "icon_ducknweav.jpg",          3, 10, 15, 8, 15, 20, 350, 700, 1400, 1, 4, 12, 8, 7, 300, 600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("First Aid: Staunch Wound", "A good general keeps his Clan in the battle by tending to the wounded.", "use text here", "icon_stanchwound.jpg",     4, 11, 16, 10, 17, 22, 500, 1000, 2000, 1, 4, 12, 8, 7, 400, 700, 0, 8);

/**
  * Items - Mutations Common Tier 1
  */
/* Trailer Park */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Empathic: Priority", "Give your clan the gift of healing with this mutation.", "use text here", "icon_benevolence.jpg",                      3, 10, 15, 4, 11, 16, 200, 400, 800, 0, 5, 20, 15, 10, 250, 550, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Enhancement: Reinforce", "In battle, there\'s no such thing as too much defense. Boost your armor with this.", "use text here", "icon_reinforce.jpg",                       3, 10, 15, 6, 13, 18, 300, 600, 1200, 0, 5, 20, 15, 10, 300, 500, 500, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Nano-Manipulation: Filtration", "If the enemy tries poison, this mutation will purify your blood.", "use text here", "icon_filtration.jpg",               4, 11, 16, 5, 12, 17, 400, 800, 1600, 0, 5, 15, 15, 10, 350, 500, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Telepathy: Accelerated Recovery", "Mind over medicine. Use your thoughts to help your teammates recover.", "use text here", "icon_accrecovery.jpg",            4, 11, 16, 6, 13, 18, 500, 1000, 2000, 1, 5, 15, 15, 10, 400, 600, 0, 9);

/* Dry Flats */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Patho-Transmission: Debilitating Weakness", "Make your enemies too sick to fight.", "use text here", "icon_debweakness.jpg",  6, 13, 18, 4, 11, 16, 550, 1100, 2200, 0, 5, 14, 10, 8, 400, 600, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Thermal: Scorching Rebuke", "If your enemies want to play with fire, they have to expect to get burned.", "use text here", "icon_screbuke.jpg",                     7, 14, 19, 4, 11, 16, 600, 1200, 2400, 1, 5, 14, 10, 8, 500, 700, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Telekinesis: Kinetic Shield", "Deflects a punch or a bullet. Most of the time.", "use text here", "icon_kineticshield.jpg",              4, 11, 16, 8, 15, 20, 650, 1300, 2600, 0, 5, 10, 10, 8, 600, 800, 0, 9);

/* Weapon and Armor - Trailer Park */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Lawnmower Blade", "Now it cuts more than grass.", "use text here", "FB_FW_lmblade_200x200.png", 8, 2, 250, 0, 2, 20, 15, 10, 250, 400, 550, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Chaps", "Just the thing for the survivor on the go.", "use text here", "FB_FW_chaps_200x200.png", 0, 7, 200, 0, 3, 15, 10, 10, 250, 300, 350, 0);

/* Weapon and Armor - Dry Flats */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Light Crossbow", "For skewering the enemy from a distance.", "use text here", "test.jpg", 12, 4, 400, 0, 2, 15, 12, 10, 350, 500, 700, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Ragged Wolfhide Jacket", "You needed it more than the wolf did.", "use text here", "FB_FW_wolfhide_200x200.png", 0, 3, 450, 0, 3, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Leather Pants", "Guaranteed to boost confidence and/or chafing.", "use text here", "FB_FW_leatherpants_200x200.png", 0, 10, 400, 0, 3, 0, 0, 0, 0, 0, 0, 0);

/* Weapons and Armor - Slaughterville */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Heavy Zip Gun", "For when the other guy just won\'t take a hint.", "use text here", "FB_FW_zipgun_200x200.png", 15, 5, 500, 0, 2, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Crowbar", "Pry things free or open skulls? Good for both!", "use text here", "FB_FW_crowbar_200x200.png", 14, 7, 450, 0, 2, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Baseball Bat", "Crush the ball or your enemy\'s ribs.", "use text here", "FB_FW_bat_200x200.png", 17, 6, 575, 0, 2, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Police Baton", "Once widely used by city cops.", "use text here", "FB_FW_policebaton_200x200.png", 19, 8, 650, 0, 2, 0, 0, 0, 0, 0, 0, 0);

INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Tactical Pants", "You\'ll be the envy of all the other tacticians with these bitchin\' trousers.", "use text here", "FB_FW_tactpants_200x200.png", 0, 19, 850, 0, 3, 0, 0, 0, 0, 0, 0, 0); /* moved to The Dump */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Reinforced Light Jacket", "Almost casual enough for dinner parties. But not quite.", "use text here", "FB_FW_miscvest1_200x200.png", 0, 17, 750, 0, 3, 0, 0, 0, 0, 0, 0, 0);

/* Mutations Common Tier 1 - Slaughterville */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Suppression: Denial", "This mutation removes damaging afflictions from your Clan.", "use text here", "icon_denial.jpg",            7, 14, 19, 6, 13, 18, 700, 1400, 2800, 1, 5, 12, 10, 8, 650, 850, 0, 9);

INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Sonic Influence: Insulation", "You can create shields of sonic energy so strong they might even stop a bullet.", "use text here", "icon_insulation.jpg",            6, 13, 18, 8, 15, 20, 775, 1550, 3100, 1, 5, 12, 10, 8, 700, 900, 0, 9);

INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Primal: Long Stride", "You can get around much faster on the battlefield.", "use text here", "icon_longstride.jpg",            7, 14, 19, 8, 15, 20, 825, 1650, 3300, 1, 5, 10, 8, 6, 775, 975, 0, 9);

/* Weapons and Armor - The Dump */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Magnum Rimfire Rifle", "For taking out your enemy from two towns away.", "use text here", "FB_FW_rimfire_200x200.png",            21, 0, 0, 6, 0, 0, 700, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one, price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Crude Sledge Hammer", "Great for knocking down walls or enemies.", "use text here", "FB_FW_sledge_200x200.png",            21, 0, 0, 7, 0, 0, 700, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0);

/** Skills - The Dump **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Armor use: Dreadnaught", "A defensive tactic that makes you an unstoppable tank on the battlefield.", "use text here", "icon_dreadnought.jpg",   8, 15, 22,  19, 26, 34, 0, 0, 0, 0, 4, 12, 8, 6, 780, 1020, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Athletics: Second Wind", "When your opponent thinks you\'re down, that\'s when you stab him in the back.", "use text here", "icon_secondwind.jpg",   19, 26, 34,  8, 15, 22, 0, 0, 0, 0, 4, 12, 8, 6, 780, 1020, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Dodge: Smoke Screen", "If your opponent can\'t see you, he won\'t know what\'s coming.", "use text here", "icon_smokescreen.jpg",   8, 15, 22,  19, 26, 34, 0, 0, 0, 0, 4, 12, 8, 6, 780, 1020, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("First Aid: Resuscitation", "It\'s just a flesh wound. Get your grunts back up and in the fight.", "use text here", "icon_resuscitate.jpg",   8, 15, 22,  19, 26, 34, 0, 0, 0, 0, 4, 12, 8, 6, 780, 1020, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Group Tactics: Offensive Coordination", "Outmaneuver your enemy and the battle is yours.", "use text here", "icon_offcoord.jpg",   19, 26, 34,  8, 15, 22, 0, 0, 0, 0, 4, 12, 8, 6, 780, 1020, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Melee: Lingering Wound", "If placed correctly, the smallest wound can topple the largest foe.", "use text here", "icon_lingeringwound.jpg",   19, 26, 34,  8, 15, 22, 0, 0, 0, 0, 4, 12, 8, 6, 780, 1020, 0, 8);

/** Mutations - The Dump **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Empathic: Sympathy Pains", "If anyone dares to hit you, they\'ll feel the pain.", "use text here", "icon_sympathypains.jpg",   19, 26, 34,  8, 15, 22, 0, 0, 0, 0, 5, 12, 8, 6, 780, 1020, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Enhancement: Dissolve", "A mutation that lets you deploy acid as a means of \'creative discouragement.\'", "use text here", "icon_dissolve.jpg",   19, 26, 34,  8, 15, 22, 0, 0, 0, 0, 5, 12, 8, 6, 780, 1020, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Nano-Manipulation: Reconstruction", "You decide who lives and who dies.", "use text here", "icon_reconstruction.jpg",   8, 15, 22,  19, 26, 34, 0, 0, 0, 0, 5, 12, 8, 6, 780, 1020, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Telepathy: Psionic Shock", "Give them a blast of mind bullets.", "use text here", "icon_psionicshock.jpg",   19, 26, 34,  8, 15, 22, 0, 0, 0, 0, 5, 12, 8, 6, 780, 1020, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Suppression: Sap Stamina", "Your enemies won\'t be able to stand against you. Literally.", "use text here", "icon_sapstamina.jpg",   8, 15, 22,  19, 26, 34, 0, 0, 0, 0, 5, 12, 8, 6, 780, 1020, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Primal: Missing Link", "You\'re a real animal on the battlefield.", "use text here", "icon_missinglink.jpg",   8, 15, 22,  19, 26, 34, 0, 0, 0, 0, 5, 12, 8, 6, 780, 1020, 0, 9);

/** Weapons - New Gallows **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Child's Tomahawk", "A Child\'s worth is judged by their weapon.", "use text here", "FB_FW_chtctoma_200x200.png", 28, 12, 2500, 0, 2, 20, 15, 10, 250, 400, 550, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Recruit Battle Rifle", "A good old-fashioned game changer.", "use text here", "FB_FW_enfrifle1_200x200.png", 28, 12, 2500, 0, 2, 20, 15, 10, 250, 400, 550, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Initiate's Staff", "The path to enlightenment is filled with obstacles.", "use text here", "FB_FW_lbstaff_200x200.png", 28, 12, 2500, 0, 2, 20, 15, 10, 250, 400, 550, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Wanderer's Pistol", "Always good for getting your point across.", "use text here", "FB_FW_travwander_200x200.png", 28, 12, 2500, 0, 2, 20, 15, 10, 250, 400, 550, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Student Pistol", "Great for when you subdue specimens.", "use text here", "FB_FW_techstudent_200x200.png", 28, 12, 2500, 0, 2, 20, 15, 10, 250, 400, 550, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Greenhorn's Knife", "Every Vista needs a survival knife.", "use text here", "FB_FW_vistgrnhrn_200x200.png", 28, 12, 2500, 0, 2, 20, 15, 10, 250, 400, 550, 0);

/** Armor - Tinkersdam **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Plated Light Jacket", "Looks like a dinner jacket, clanks like a tank.", "use text here", "FB_FW_athltunic_200x200.png", 0, 23, 1100, 0, 3, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Shell Armor", "Hastily patched together from the hide of a giant scorpion.", "use text here", "FB_FW_shellarmor_200x200.png", 0, 23, 1100, 0, 3, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Work Boots", "Not for the lazy!", "use text here", "test.jpg", 0, 23, 1100, 0, 3, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Militia Helmet", "Just the thing for today\'s guerilla warrior.", "use text here", "FB_FW_militaryhelm_200x200.png", 0, 23, 1100, 0, 3, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Hard Hat", "The perfect complement to a hard head.", "use text here", "FB_FW_hardhat_200x200.png", 0, 23, 1100, 0, 3, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Battle Helmet", "Scarred, marred, and partially charred. It\'s perfect!", "use text here", "FB_FW_battlehelm_200x200.png", 0, 23, 1100, 0, 3, 0, 0, 0, 0, 0, 0, 0);

/** Mutations - Tinkersdam **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Empathic: Restoration", "If a member of your team is down, you can help them back up. With your mind.", "use text here", "icon_restoration.jpg",   10, 17, 24,  25, 32, 39, 1000, 2100, 3900, 0, 5, 12, 10, 8, 1200, 2000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Enhancement: Regenerate", "This mutation boosts your natural recovery rate on the battlefield.", "use text here", "icon_regenerate.jpg",   11, 18, 25,  27, 34, 41, 1100, 2300, 4700, 0, 5, 14, 12, 10, 1700, 2900, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Nano-Manipulation: Cannibalize", "Drain an enemy\'s strength to add to your own.", "use text here", "icon_cannibal.jpg",   30, 37, 43,  12, 19, 36, 1300, 2800, 5100, 1, 5, 10, 8, 6, 2100, 3800, 0, 9);



/** Skills - Tinkersdam **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Group Tactics: Rally", "Bring your troops back together for a renewed assault.", "use text here", "icon_rally.jpg",   22, 29, 36,  20, 27, 34, 1200, 2500, 4000, 1, 4, 12, 10, 8, 1400, 2600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Melee: Payback", "Put your enemy on the ground where he belongs.", "use text here", "icon_knockdown.jpg",   15, 22, 29,  29, 36, 43, 1400, 2700, 4200, 1, 4, 12, 10, 8, 1500, 2800, 0, 8);

/** Weapons and Armor - Waste Farm **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Cleaver", "Chop meat. Doesn\'t matter whose.", "use text here", "FB_FW_cleaver_200x200.png", 32, 10, 2700, 0, 2, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("War Axe", "The chrome is still shiny on this one.", "use text here", "FB_FW_waraxe_200x200.png", 33, 14, 2800, 0, 2, 0);

INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("GA-17 .38 Service Revolver", "A great gun with a great round of ammo.", "use text here", "FB_FW_GA17.38_200x200.png", 38, 12, 3000, 0, 2, 0);

INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Riot Vest", "For the discerning rioter.", "use text here", "FB_FW_athltunic_200x200.png", 0, 31, 1700, 0, 3, 0);

/** Skills - Waste Farm **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Pistol: Pistol Whip", "Who needs bullets?", "use text here", "icon_pistolwhip.jpg",   23, 30, 37,  17, 24, 31, 1600, 3100, 6400, 0, 4, 10, 8, 6, 1800, 3700, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Rifle: Rifle Smash", "Save the ammo for someone who deserves it.", "use text here", "icon_riflesmash.jpg",   27, 34, 41,  17, 24, 31, 1700, 3300, 6900, 0, 4, 9, 7, 5, 2100, 4500, 0, 8);

/** Mutations - Waste Farm **/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Telekinesis: Forced Restraint", "Immobilize your enemy and turn them into a target dummy.", "use text here", "icon_forcedrestraint.jpg",   35, 42, 49,  14, 21, 28, 1900, 4300, 8800, 1, 5, 9, 7, 5, 2700, 5900, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Suppression: Siphon Energy", "What\'s theirs is yours, as long as it\'s their energy.", "use text here", "icon_siphonenergy.jpg",   37, 44, 51,  16, 23, 30, 2200, 4400, 8900, 0, 5, 10, 8, 5, 3000, 6600, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Sonic Influence: Rending Vibration", "Use a sonic blast to decimate a single target on the battlefield.", "use text here", "icon_rendingvibration.jpg",   40, 47, 54,  14, 21, 28, 2400, 5200, 10700, 1, 5, 8, 6, 4, 3300, 7100, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Primal: Beast Might", "Increase your strength and endurance and let your enemies pay the price.", "use text here", "icon_beastmight.jpg",   43, 50, 57,  18, 25, 32, 2600, 5300, 10600, 1, 5, 7, 6, 5, 3400, 6800, 0, 9);

/*Weapons and Armor - Park City */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Riot Helmet", "No more acid-in-the-eyes with THIS baby.", "use text here", "FB_FW_riothelm_200x200.png", 0, 31, 1700, 0, 3, 0);

/*Skills - Park City */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Pistol: Desperado", "A gun in each hand kills two enemies for the price of one thought.", "use text here", "icon_desperado.jpg",   31, 38, 45,  29, 36, 43, 2200, 4300, 9000, 0, 4, 7, 5, 3, 3500, 7600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Rifle: Precise Aim", "One bullet. One enemy. No problem.", "use text here", "icon_preciseaim.jpg",   38, 45, 52,  22, 29, 36, 2200, 4300, 9000, 0, 5, 7, 4, 3, 3500, 7600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Armor use: Efficiency and Equilibrium", "The skill isn\'t strapping on the armor. The skill is knowing how to fight once it\'s on.", "use text here", "icon_eff&equil.jpg",   35, 42, 49,  25, 32, 39, 2200, 4300, 9000, 0, 4, 7, 5, 3, 3500, 7600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Athletics: Fitness", "You can fight longer and harder than any normal person.", "use text here", "icon_fitness.jpg",   35, 42, 49,  25, 32, 39, 2200, 4300, 9000, 0, 4, 7, 5, 3, 3500, 7600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Dodge: Autumn Leaves", "You\'re so hard to hit that some enemies think you\'re a ghost.", "use text here", "icon_autumnleaves.jpg",   25, 32, 39,  35, 42, 49, 2200, 4300, 9000, 0, 4, 7, 5, 3, 3500, 7600, 0, 8);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Group Tactics: Give \‘em Hell", "No mercy, no quarter. Your troops have become an overwhelming force.", "use text here", "icon_giveemhell.jpg",   40, 47, 54,  20, 27, 34, 2200, 4300, 9000, 0, 4, 7, 5, 3, 3500, 7600, 0, 8);

/*Mutations - Fender Gate */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Primal: Wild Heart", "You\'ll be the first on the battlefield and the last to walk off.", "use text here", "icon_wildheart.jpg",   40, 47, 54,  30, 37, 44, 2900, 6000, 11900, 0, 5, 6, 5, 2, 4200, 11000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Suppression: Energy Blitz", "You\'ll love the smell of charred enemies in the morning.", "use text here", "icon_energyblitz.jpg",   45, 52, 59,  25, 32, 39, 2900, 6000, 11900, 0, 5, 6, 4, 2, 4200, 11000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Telekinesis: Repel", "The enemy will see the strength of your resolve and collapse before your power.", "use text here", "icon_repel.jpg",   35, 42, 49,  35, 42, 49, 2900, 6000, 11900, 0, 5, 6, 4, 2, 4200, 11000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Enhancement: Calibration", "A little armor goes a long way, and this mutation helps it go even further.", "use text here", "icon_calibration.jpg",   35, 42, 49,  35, 42, 49, 2900, 6000, 11900, 0, 5, 6, 4, 2, 4200, 11000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Thermal Control: Molotov Mutation", "Educate your enemy on the combustibility of the human body.", "use text here", "icon_moltov.jpg",   45, 52, 59,  25, 32, 39, 2900, 6000, 11900, 0, 5, 6, 4, 2, 4200, 11000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Sonic Influence: Sonic Lance", "A heavy-duty sound attack on a single enemy.", "use text here", "icon_soniclance.jpg",   50, 57, 64,  20, 27, 34, 2900, 6000, 11900, 0, 5, 6, 4, 2, 4200, 11000, 0, 9);

/*Weapons Fender Gate */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Warrior\'s Mace", "Create not works of art, but weapons of death, for it is truly the more creative endeavor.", "use text here", "FB_FW_chotmace_200x200.png", 43, 27, 3100, 0, 2, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Corporal Battle Rifle", "Versatile, volatile, and extremely violent.", "use text here", "FB_FW_enfrifle2_200x200.png", 49, 21, 3100, 0, 2, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Acolyte\'s Sword", "The Zen of the Blade starts with the sword.", "use text here", "FB_FW_lbsword_200x200.png", 45, 25, 3100, 0, 2, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Technician Pistol", "The equation of sum gain requires more force than resistance.", "use text here", "FB_FW_techtech_200x200.png", 45, 25, 3100, 0, 2, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Muscle\'s Pistol", "Your turf doesn\'t defend itself.", "use text here", "FB_FW_travmuscle_200x200.png", 45, 25, 3100, 0, 2, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Vista\'s Knife", "Now this is a knife!", "use text here", "FB_FW_vistasknife_200x200.png", 43, 27, 3100, 0, 2, 0);

/*Armor Fender Gate*/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Military Plate", "Gives you an odd urge to buzz all your hair off.", "use text here", "FB_FW_milplate_200x200.png", 0, 36, 2200, 0, 3, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Liberty Vest Mk 2", "Stops 100% more bullets than Mk 1.", "use text here", "FB_FW_libertyMk2_200x200.png", 0, 36, 2200, 0, 3, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Tactical Boots", "For careful tactical footwork.", "use text here", "FB_FW_tactboots_200x200.png", 0, 36, 2200, 0, 3, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Assault Helmet", "Has the words \'Do Unto Others\' carved inside it.", "use text here", "FB_FW_assaulthelm_200x200.png", 0, 36, 2200, 0, 3, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Breastplate", "Equally suitable for men or women.", "use text here", "FB_FW_breastplate_200x200.png", 0, 36, 2200, 0, 3, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, trainingtype) VALUES ("Combat Plate", "Great for fighting -- as opposed to the less popular \'macrame plate.\'", "use text here", "FB_FW_combatplate_200x200.png", 0, 36, 2200, 0, 3, 0);

/*Mutations - Park City */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Telepathy: Mind over Matter", "This mutation gives your entire team a health boost on the battlefield.", "use text here", "icon_mindovermatter.jpg",   32, 39, 46,  13, 20, 27, 2400, 4100, 7400, 1, 5, 11, 9, 7, 3300, 13000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Patho-Transmission: Shaking Plague", "Give your enemies a sickness. There\'s a reason it\'s not called the \'happy plague.\'", "use text here", "icon_shakingplague.jpg",   34, 41, 48,  11, 18, 25, 2600, 4300, 8400, 1, 5, 10, 8, 6, 3350, 11000, 0, 9);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, attack_bonus_two, attack_bonus_three, defense_bonus_one, defense_bonus_two, defense_bonus_three, price_one,  price_two, price_three, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Thermal Control: Regenerative Fever", "You can burn the sickness out of your body and get back on the battlefield.", "use text here", "icon_regenfever.jpg",   10, 17, 24,  33, 40, 47, 2800, 5900, 8100, 1, 5, 9, 7, 5, 3350, 11000, 0, 9);

INSERT INTO fw_item (name, item_type) VALUES ("Nothing", 7);

/** BOSS ITEMS **/
/** CRAFTING Ingredients*/
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Clan Rally Flag", "Your Clan will be there when the chips are down.", "use text here", "boss_3_comp_3.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Reinforcement Radio", "The best way to keep in touch in any life and death situation.", "use text here", "boss_2_comp_2.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Tactical Plans", "Probably won\'t survive contact with the enemy, but nobody ever won a battle without one.", "use text here", "boss_3_comp_3.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Prairie Chicken Feathers", "Freshly plucked from this morning\'s breakfast. Add these to a little mud and some chicken wire, and you\'ll have a nest fit for Old Willy.", "use text here", "boss_1_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Sandworm Bladders", "The locals met Thunder while thinning the sandworm population. If Thunder is protecting the herd, maybe some spilled sandworm juice will bring him right to you. ", "use text here", "boss_2_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("White Crow Badges", "If you\'ve got this badge, then there must be one less White Crow soldier that needed it. ", "use text here", "boss_3_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Blood Samples", "For immortal creatures of legend, these vampires still bleed just like everything else. And if it bleeds. . .", "use text here", "boss_4_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Fangs", "Without these, a vampire is just some guy who can\'t get a tan.", "use text here", "boss_4_comp_2.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Bait Cows", "One of the best cows in the Sector. Perfect to lure a livestock-munching monster.", "use text here", "boss_5_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Honey Pots", "If you\'re lucky, Ursaline will get his head stuck in one of these.", "use text here", "boss_6_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Picnic Baskets", "The biggest question about Ursaline is exactly how smart he is. Smarter than average?", "use text here", "boss_6_comp_2.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Tracks", "You\'re tracking Pamela Hunter across the desert to find her lab.", "use text here", "boss_7_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Locked Briefcase", "Filled with the goods you\'ll need to get your hands on a Brigg\'s Point access card.", "use text here", "boss_8_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Radioactive Material", "This gunk seems to attract grendels. If you put enough of it together, you should get the patriarch.", "use text here", "boss_9_comp_1.jpg",                          0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0);

/** BOSS CRAFTING REWARDS (SUMMON ITEMS) */
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Huge Fake Chicken Nest", "description here", "use text here", "boss_1_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Sandworm Juice", "description here", "use text here", "boss_2_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Cage Key", "description here", "use text here", "boss_3_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Mausoleum Key", "description here", "use text here", "boss_4_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Hunting Stand", "description here", "use text here", "boss_5_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Operation: Bear Food", "description here", "use text here", "boss_6_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Lab Access Code", "description here", "use text here", "boss_7_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Brigg\'s Point Access Card", "description here", "use text here", "boss_8_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO fw_item (name, description, use_text, image, attack_bonus_one, defense_bonus_one, price_one, purchasable, item_type, completion_one, completion_two, completion_three, upgrade_price_one, upgrade_price_two, upgrade_price_three, trainingtype) VALUES ("Toxic Snack", "description here", "use text here", "boss_9_item.jpg",                          0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0);

/* Town items - Town 1 */
/* Scrap */
INSERT INTO fw_town_item (itemid, townid) VALUES (1,1);
INSERT INTO fw_town_item (itemid, townid) VALUES (2,1);
/* Weapons */
INSERT INTO fw_town_item (itemid, townid) VALUES (22,1);
/* Armor */
INSERT INTO fw_town_item (itemid, townid) VALUES (23,1);
/* Skills */
INSERT INTO fw_town_item (itemid, townid) VALUES (11,1);
INSERT INTO fw_town_item (itemid, townid) VALUES (12,1);
/* Mutations */
INSERT INTO fw_town_item (itemid, townid) VALUES (15,1);
INSERT INTO fw_town_item (itemid, townid) VALUES (16,1);
INSERT INTO fw_town_item (itemid, townid) VALUES (17,1);
INSERT INTO fw_town_item (itemid, townid) VALUES (18,1);

/* Town items - Town 2  - Dry Flats*/
/* Scrap */
INSERT INTO fw_town_item (itemid, townid) VALUES (3,2);
INSERT INTO fw_town_item (itemid, townid) VALUES (4,2);
/* Weapons */
INSERT INTO fw_town_item (itemid, townid) VALUES (24,2);
/* Armor */
INSERT INTO fw_town_item (itemid, townid) VALUES (25,2);
INSERT INTO fw_town_item (itemid, townid) VALUES (26,2);
/* Skills */
INSERT INTO fw_town_item (itemid, townid) VALUES (13,2);
INSERT INTO fw_town_item (itemid, townid) VALUES (14,2);
/* Mutations */
INSERT INTO fw_town_item (itemid, townid) VALUES (19,2);
INSERT INTO fw_town_item (itemid, townid) VALUES (20,2);
INSERT INTO fw_town_item (itemid, townid) VALUES (21,2);

/*Town items Town 3 - Slaughterville */
/* Scrap */
INSERT INTO fw_town_item (itemid, townid) VALUES (5,3);
/* Weapons */
INSERT INTO fw_town_item (itemid, townid) VALUES (27,3);
/*INSERT INTO fw_town_item (itemid, townid) VALUES (28,3);
INSERT INTO fw_town_item (itemid, townid) VALUES (29,3);*/
INSERT INTO fw_town_item (itemid, townid) VALUES (30,3);
/* Armor */
INSERT INTO fw_town_item (itemid, townid) VALUES (32,3);
/* Skills - none*/
/* Mutations */
INSERT INTO fw_town_item (itemid, townid) VALUES (33,3);
INSERT INTO fw_town_item (itemid, townid) VALUES (34,3);
INSERT INTO fw_town_item (itemid, townid) VALUES (35,3);

/** Town 4 Items - The Dump */
/* Scrap */
INSERT INTO fw_town_item (itemid, townid) VALUES (6,4);
/* Armor */
INSERT INTO fw_town_item (itemid, townid) VALUES (31,4);
/* Skills */
INSERT INTO fw_town_item (itemid, townid) VALUES (38,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (39,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (40,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (41,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (42,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (43,4);
/* Mutations */
INSERT INTO fw_town_item (itemid, townid) VALUES (44,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (45,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (46,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (47,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (48,4);
INSERT INTO fw_town_item (itemid, townid) VALUES (49,4);

/** Town 5 Items - New Gallows */
/** Scrap **/
INSERT INTO fw_town_item (itemid, townid) VALUES (7,5);

/**Weapons**/
INSERT INTO fw_town_item (itemid, townid) VALUES (36,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (37,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (50,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (51,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (52,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (53,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (54,5);
INSERT INTO fw_town_item (itemid, townid) VALUES (55,5);

/** Town 6 Items - Tinkersdam */
/** Scrap **/
INSERT INTO fw_town_item (itemid, townid) VALUES (8,6);
/* Armor */
INSERT INTO fw_town_item (itemid, townid) VALUES (56,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (57,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (58,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (59,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (60,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (61,6);

/* Skills */
INSERT INTO fw_town_item (itemid, townid) VALUES (65,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (66,6);

/* Mutations */
INSERT INTO fw_town_item (itemid, townid) VALUES (62,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (63,6);
INSERT INTO fw_town_item (itemid, townid) VALUES (64,6);

/** Town 7 Items - Waste Farm **/
/** Scrap **/
INSERT INTO fw_town_item (itemid, townid) VALUES (10,7);
/*Weapons*/
INSERT INTO fw_town_item (itemid, townid) VALUES (67,7);
INSERT INTO fw_town_item (itemid, townid) VALUES (68,7);

/*Armor*/
INSERT INTO fw_town_item (itemid, townid) VALUES (70,7);
INSERT INTO fw_town_item (itemid, townid) VALUES (71,7);
/*Skills*/
INSERT INTO fw_town_item (itemid, townid) VALUES (72,7);
INSERT INTO fw_town_item (itemid, townid) VALUES (73,7);
/*Mutations*/
INSERT INTO fw_town_item (itemid, townid) VALUES (74,7);
INSERT INTO fw_town_item (itemid, townid) VALUES (75,7);
INSERT INTO fw_town_item (itemid, townid) VALUES (76,7);
INSERT INTO fw_town_item (itemid, townid) VALUES (77,7);

/**Town 8 items - Park City **/
/** Scrap **/
INSERT INTO fw_town_item (itemid, townid) VALUES (9,8);
/*Armor & Weapons*/
INSERT INTO fw_town_item (itemid, townid) VALUES (69,8);
/*Skills*/
INSERT INTO fw_town_item (itemid, townid) VALUES (78,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (79,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (80,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (81,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (82,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (83,8);
/*Mutations*/
INSERT INTO fw_town_item (itemid, townid) VALUES (102,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (103,8);
INSERT INTO fw_town_item (itemid, townid) VALUES (104,8);


/**Town 9 Items - Fender Gate*/
/*Weapons*/
INSERT INTO fw_town_item (itemid, townid) VALUES (90,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (91,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (92,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (93,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (94,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (95,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (96,9);

/*Armor*/
INSERT INTO fw_town_item (itemid, townid) VALUES (97,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (98,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (99,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (100,9);

/*Mutations*/
INSERT INTO fw_town_item (itemid, townid) VALUES (85,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (86,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (87,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (88,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (89,9);
INSERT INTO fw_town_item (itemid, townid) VALUES (101,9);


