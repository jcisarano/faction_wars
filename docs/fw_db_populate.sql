/**
  * Init scripts for Faction Wars database
  * 19 October 2009
  */


/**
  * Sectors - SECTORS ARE ORDER SENSITIVE - DO NOT CHANGE THIS LIST W/O CHANGING DEPENDENT TABLES
  */

INSERT INTO fw_sector (name) VALUES ("Plateau");
INSERT INTO fw_sector (name) VALUES ("Northfields");
INSERT INTO fw_sector (name) VALUES ("Kaibab Forest");

/**
  * Towns - INCOMPLETE - NEED DESCRIPTIONS
  * TOWNS ARE ORDER SENSITIVE - DO NOT CHANGE THIS ORDER WITHOUT CHANGING DEPENDENT TABLES!!!
  */
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Trailer Park",   1,  1,  "While no one wants the people of Trailer Park, the denizens of the province at least find their sludge useful. This sandy spackle-like substance is dredged from the earth by an old-style oil derrick and then gets sold to settlements like Pass Chris and Murphy, who use it as insulation and cistern-sealant.", "trailerpark_120x120.jpg", 0, 228, 161, 240, 190);
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Dry Flats",      5,  1,  "An abandoned GlobalTech security outpost sat unmolested for years in middle of this dusty field until members of the opposing factions began delving into the facility\'s secrets. No one is willing to leave the area without a fight, for a pre-war weapons stash is rumored to be buried beneath the years of neglect.", "dryflats_120x120.jpg", 0, 177, 159, 125, 149);
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Slaughterville", 10, 1,  "In the waning years of the Grand Canyon province, GlobalTech imported far more material than it exported. The massive influx of spare shipping containers were dumped in the area that would become Slaughterville. This mountain of scrap has grown into a focal point for faction warfare where a deadly game of cat and mouse between the factions thrives, with a fortune in salvage as the prize.", "slaughterville_120x120.jpg", 0, 139, 227, 100, 227);

INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("The Dump",       15, 2,  "Originally nothing more than a Union trash pit, this area grew to proper noun status as other towns joined in the dumping and this area became the central garbage-disposal location for the sector. When a group of scavengers discovered a Pre Fall landfill underneath the more recent garbage, the premium junk hidden in the Dump aroused the attention of every faction in the sector, and the settlement has since become a point of inter faction conflict.", "thedump_120x120.jpg", 0, 165, 10, 128, 15);
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("New Gallows",    20, 2,  "New Gallows is built on what once was a country club and golf course, though the sand traps are now home to hermit crabs and the water holes have become swamps. The clubhouse is the main gathering area for the town for people of influence. Centrally located, New Gallows has become a trading hot spot. Merchants set up shop on the golf course, using tents and tables to show off their wares.", "newgallows_120x120.jpg", 0, 193, 64, 174, 90);
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Tinkersdam",     25, 2, "Recently built around the more industrial part of what would have been the Northfields suburb, Tinkersdam has one of the few water treatment plants in the sector. A band of settlers led by Emilia Jenner drove out the Throwbacks and other mutant creatures that had been living in the area in order to get access to the water treatment and other industrial plants in the area.", "tinkersdam_120x120.jpg", 0, 235, 52, 238, 9);

INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Waste Farm",     30, 3, "Using waste from local livestock as raw materials to produce methane, Waste Farm has become the largest power production facility in the sector. This combination of fuel and fertilizer makes Waste Farm an attractive target for each faction, and some townspeople feel the protection of a faction would be useful. For the most part, Waste Farm has a strong sense of independence and would prefer to remain independent.", "wastefarm_120x120.jpg", 0, 340, 10, 407, 8);
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Park City",      35, 3, "Anna Beth Romero searched the forest for an isolated campground where she could raise her son Andre. Overgrown with Hydra Weed and shrubs, only a few cabins were still usable. She traded food and medicine to hire people to help her clear the overgrowth and repair the ruined housing. It was only after they finished clearing the outskirts that they realized the true value of the campground. Hidden beneath the log cabins was a sealed GlobalTech bunker.", "parkcity_120x120.jpg", 0, 390, 88, 461, 95);
INSERT INTO fw_town (name, town_level, sector, description, image, owned, hit_x, hit_y, img_x, img_y) VALUES ("Fender Gate",    40, 3, "An old junkyard turned into a salvager settlement, Fender Gate is mainly inhabited by scavengers and inventors with no place to go and with too much independence to join the Techs. While not well supplied, they are good at making do with little. The settlement is a common target of the Vistas and the CHOTA since it does not enjoy the protection of the Techs.", "fendergate_120x120.jpg", 0, 347, 57, 339, 79);

/***********************************
**** MISSIONS ARE ORDER SENSITIVE - DO NOT CHANGE THE ORDER OF EXISTING MISSIONS
************************************/
/**
  * Town 1 - Trailer Park - General mission descriptions
  */
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Murphy\'s Law",             "Night Wolf bandits overran a town not far from here. My beloved grew up in Murphy. He died trying to defend it from those animals. I want him avenged. Go and kill the occupiers.",                                       "You honor his memory with your service. The more Night Wolves you kill, the better I feel.",  "tp_gen_murph.jpg",  150,  50, 1,  1, 1, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Friends in Need",           "I just got word that some settlers up in the hills near here are hunkered down, under siege from a bunch of persistent throwbacks. How about culling the throwbacks around that camp?",                              "I always find it\'s true that if you do a good turn for folks, it comes back to you three-fold, someday.", "tp_gen_frien.jpg",    200,  150, 2,  1, 2, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Blunt Objects",             "If we\'re going to keep holding our own against those Diggers from Terrance that Jacob Phillips and his Gully Dog minions unleashed... well--not to put too fine a point on it, but: We need weapons, or we\'re dead.",                      "Great job! I\'ll make sure to distribute these to our defenders. If you want to make more, I won\'t turn them down.", "tp_gen_blunt.jpg",    300,  200, 3,  2, 3, 15, 10, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Careful Observation",       "That bunker contains some valuable scientific research, but the whole place has been infested with throwbacks. You appear capable, though. Get the research material for me, and you\'ll be duly compensated.",            "Nicely done. Sorry about all the trouble with the throwbacks. You\'re probably wondering exactly what it is you\'ve brought to me, yes? Well, that\'s called a \'memory disk,\' and don\'t you worry about it anymore. I\'ll just take it from here.", "tp_own_caref.jpg",   300,  200, 5,  3, 4, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Free Your Mind",            "Ya feel it, don\'t ya? The mind-control beams from the old GlobalTech spy satellites! They\'re... in... my... HEAD! The voices talk to me. I need a helmet to block out those mind-control beams, man.",                     "Whew! Just in time, man. Just in time. The voices... they were telling me... THINGS, man. STUFF! They wanted me to DO bad things to people. And sheep. SHEEP, man! What kind of crazy nonsense is that? SHEEP!",  "tp_own_freey.jpg",  700,  500, 4,  3, 5, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Taking Out the Trash",      "Blight Wolves! Those horrible, nasty freaks. There are some of them prowling out near the graveyard. I can\'t drag the corpses out if they\'re there. Can you take care of them for me?",         "Thanks. I get in a lot of trouble when I let the bodies stack up around here.",   "tp_own_takin.jpg", 400,  250, 6,  3, 5, 15, 10, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Hoffa Bunker",          "Long time ago, back before the Fall, there was this guy: President of the United States. Name was Jimmy Hoffa. Hoffa kept a bunker out here near the Grand Canyon, which he stashed full of Andy Warhol\'s never-ending soup supply. I really, really, REALLY like soup. You should go and take a look at the place!",         "You sure killed a lot of throwbacks. But where\'s my soup?! Aw, all right; I\'ll pay you anyway... this time.",  "tp_fac_theho.jpg",  1000,  800, 7,  5, 7, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Overcome But Half His Foe", "A Tech caravan bringing a shipment of steel for the Enforcers was attacked by raiders. Naturally, we want what we paid for.",                                                                                             "Excellent. We can put this to use by making guns, armor, and bullets.",  "tp_fac_overc.jpg",  1000,  800, 7,  5, 7, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Heal the Blows of Sound",   "Some wounded survivors of the caravan that was attacked by raiders still remain. Gather healing balms from plants in the area, so that we may treat their wounds.",                                                                         "My thanks. We will put these balms to good use.",  "tp_fac_healt.jpg",  1000,  800, 7,  5, 7, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Make Science Not War",      "Most of my colleagues are stuck dealing with the fighting between the town and the raiders, but I\'m far more interested in the infected that have been spotted to the north. Get me some samples of their flesh so I can study them.",                                                       "Interesting! These readings aren\'t at all what I expected. I\'d like to determine the pathogen that causes the infection, but some elements of my research are lacking.",  "tp_fac_makes.jpg",  1000,  800, 7,  5, 7, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Like An Unwelcome Guest",   "Our lost caravan carried an important shipment of scrap plastic. We definitely want to get back as much of that shipment as we can. Definitely. You look like you can handle yourself. Maybe take a run down to the salvage site to see what you can scrounge up?",                                    "Definitely what we needed! Thanks. That\'ll keep the boss off my back a little longer.", "tp_fac_likea.jpg",   1000,  800, 7,  5, 7, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Pecking Order",             "I\'m the one who trains the local dogs, coyotes, and wolves to be Vista companions. I\'ve been training them out in the field, but they get too distracted by those horrible prairie chickens. Could you go out and kill some prairie chickens for me?",                                      "Thanks; this should simplify training a bit.",  "tp_fac_pecki.jpg",  1000,  800, 7,  5, 7, 15, 10, 5);

/**
  * Town 2 - Dry Flats - Mission description
  */
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Not like the Old Days",     "Looks like one of my injector tubes blew out. I hoped I wouldn\'t need any more supplies before I got another shipment. Could you go ransack one of the Judge camps and see if you can find something that resembles an injector?",                         "Son of a bitch! Look at that. You found the injector tube, and it\'s intact. If there are such things as miracles, this would be one.",  "df_gen_notli.jpg",    3500,  1500, 4,  2, 4, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("This Means War!",           "These Blade Dancers are raiding our shipments, killing our men, scaring away visitors, and generally wreaking havoc. It\'s time to put a stop to it.",                                                                                                               "Job well done. That should show those bastards.",                                                                                       "df_gen_thism.jpg",    6500,  3500, 5,  4, 5, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Minimal Protection",        "So, I\'m trying to run an outfitter shop here, and someone comes along and kills my damn tailor. He owed some guy named Ricky money, and he was always hounding me to buy stuff off of him. I need some new skullcaps, vests, and athletic shoes... Bring me a few.",  "This looks really nice.",                                                                                                               "df_gen_minim.jpg",    2500,  1500, 3,  2, 3, 15, 10, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("It\'s All About the Pain",       "Those damn Blade Dancers! They wrecked our farm, killed our farmhands, and did you see what they did to Brad!? They\'re gonna pay I tell you-once we\'re back on our feet... Hey, I don\'t suppose you\'d like to earn a few chips?",            "So, you hurt them. Hurt them a lot, I hope! I don\'t know if it makes me feel better, but hopefully that will teach those bastards a lesson. You don\'t mess with me, and you definitely don\'t hurt my Brad.", "df_own_itsal.jpg",   8750,  6000, 7,  5, 6, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("All Sides",            "My son here says that he and his boys were out hunting when they were jumped by a bunch of no-good filthy giant spiders. He came back, but none of his buddies have returned. Could you go out and make sure that those boys come back safe?",                     "I can\'t believe you were able to save \'em all, considering. You\'re quite a scrapper.",  "df_own_allsi.jpg",  10000,  8000, 10,  7, 8, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Zombie Apocalypse Plan",      "Some old LifeNet facility in Terance went crazy and started spewing out zombies. Tore up the town! Those zombies are going to run out of fresh brains in Terance and then they\'re going to come here. We\'ve gotta be ready! We need to start making some crossbows!",         "This is a good start, but it\'s not enough. Not nearly enough.",   "df_own_zombi.jpg", 4000,  200, 4,  2, 5, 15, 10, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Hang \'Em High",      "We\'ve got poachers killing prairie chickens in our hunting areas. Resources are scarce enough in the Province; we can\'t afford to lose the eggs and meat from those birds. I\'ll point you in the direction of the nests, but you might have to look around a bit for the poachers.",         "Impressive. People with your skills are a valuable asset around here.",   "df_fac_hange.jpg", 12000,  7000, 10,  8, 10, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Did Someone Call for Backup?",      "All right, I\'ve got men ready to attack the Gully Dog camp. Not all of them are willing, but they\'ll get over it. Make a mess of the place, Recruit. If it keeps the raiders at bay, I\'m all for it.",         "The men have done their job. Hopefully, you\'ve done yours.",   "df_fac_didso.jpg", 12000,  7000, 10,  8, 10, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Charging Forward",      "Master Solomon has asked me to retrieve an old battery from some ruins to the southwest. Unfortunately, some rather aggressive Survivalists have become very possessive of the area. They might try to scare you off. You\'ll want to be extra careful.",         "You have been most kind.",   "df_fac_charg.jpg", 12000,  7000, 10,  8, 10, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Either Ore",      "Hey there, stranger. I\'ve seen you around. You interested in making some chips? I can\'t get away from my experiment here, and I need someone to go get a couple of ore samples for me. One of the foremen left them down in the old bunker and he can\'t spare any hands to bring \'em up. Interested?",         "Great! These are excellent samples.",   "df_fac_eithe.jpg", 12000,  7000, 10,  8, 10, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("War and Pieces of Junk",      "War is a beautiful thing. There are always people in need, and since I\'m here to provide, that makes me a happy guy. There\'s a problem, though; my stock is running a bit low since my last scavenging team got caught and executed by Gaunt\'s retards. You look a bit tougher than they did, though, so maybe you\'d like a job? Good pay. You in? I\'ll cut you a good deal for any salvage you can bring me. ",         "Nice, nice. Here\'s your fee, pal; keep bringing me the goods.",   "df_fac_waran.jpg", 12000,  7000, 10,  8, 10, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("I Speak for the Trees",      "The more trees, the better, you know? That goes without saying. Well, we were trying to start a fruit tree orchard just outside of town, but a group of brain-addled \'survivalists\' stole the seeds, if you can believe that. If you really want to prove something to us, you\'ll go out there and kill some of them. That will teach the rest to keep away.",         "Thank you so much. Many years of work have been destroyed, but hopefully we\'ll be able to replant and repair what they\'ve done. Eventually.",   "df_fac_ispea.jpg", 12000,  7000, 10,  8, 10, 15, 12, 10);

/**
  * Town 3 - Slaughterville - Mission Descriptions
  */
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Paper Chase",      "I\'m trying to gather more books for the library that we\'re starting here. There was a farmer, Jake Benson, who lived nearby. He borrowed books all the time. Unfortunately, he was killed in a Blade Dancer raid a few weeks ago. If you can recover any of the books, I\'ll make it worth your time. I\'ve some piles of junk around here that you might find useful.",         "Great! Only a couple of pages seem to be torn out, so it isn\'t too much of a loss. At least we have some new titles. Thanks again for the additions!",   "sl_gen_thepa.jpg", 7000,  6000, 9,  7, 8, 20, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Too Quiet",      "Our last hunting party never returned.  Too many people work to bring down the world around us. It is... unnecessary. All we must do is survive. I do not need you to hunt for us-we\'re not lazy-but I must know what killed the hunters. If you could, go to the forest southwest of here and search for some sign of the hunting party.",         "This looks like what\'s left of the hunting party.",   "sl_gen_tooqu.jpg", 7000,  6000, 9,  7, 8, 12, 10, 8 );
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The First of All Liberties",      "We didn\'t have many people left in Terance after those Diggers came pouring out of the old LifeNet facility. A lot of people died, but some fled here with us. Our people are hungry, hurt, and demoralized. Maybe you can help. We\'re short on medics. Take those fronds and mix them with a bit of water to make the medicine for our wounded folks.",         "It\'s damned stinky, but it can work some real wonders.",   "sl_gen_thefi.jpg", 2500,  1000, 6,  5, 7, 12, 10, 8);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Mine!",      "Them scavengers are out to steal my stuff again. Whole bunch of \'em have been hanging around all day, I hear, casting covetous eyes on my mining equipment. You seem a likely young person; you go run \'em off my shed, and you can make a few chips. It\'s down in the quarry.",         "Nice work. That\'ll teach \'em to mess with me.",   "sl_own_mine.jpg", 12000,  8500, 10,  8, 9, 15, 10, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Thirsty Work",      "Hey there, you look bored. I bet you\'re just itchin\' for a reason to leave this backwater town. I\'ve got a new batch of brew here! If you\'ve got some time on your hands, go grab the crate over there on the counter behind the bar and take it to old Billy Bob Swayhill over in Trailer Park.",         "See?  Easy chips.  Just come on back to me when you\'re ready to make another delivery.",   "sl_own_thirs.jpg", 10000,  8000, 10,  6, 10, 10, 8, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Crash of Guns",      "We\'ve got to step up our efforts against the Diggers and the Gully Dog bandits. That means we should throw together some ranged weapons-anything we can get our hands on.",         "These are going to come in handy! Well done.",   "sl_own_thecr.jpg", 4000,  2000, 8,  7, 9, 12, 10, 8);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Artifice of Eternity",      "Behold! One who\'s not fearful of the Quiet Ones\' ways. A problem. Warchief missing. Times chaotic. Dangerous for Quiet Ones. Upon our heads wrath will descend. Or a new Warchief to hail? Prepared all must be.",         "The weapons\' spirits shout to me. We will give them bodies with what you have brought.",   "sl_fac_thear.jpg", 15000,  8000, 12,  10, 14, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Tap Runneth Dry",     "Those Enforcers sure are a thirsty bunch. They had a party in here the other night... for Sergeant Henderson\'s birthday or something... and damn near drank the place dry. I need some new beer in here, pronto!",         "That oughtta keep the Enforcers happy until I get my regular stock back in. As long as they don\'t have another party like that.",   "sl_fac_theta.jpg", 15000,  8000, 12,  10, 14, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("War on the Homefront",      "We have worked hard to build a life here, but we owe much to the aid of our allies, the Vistas. There are some here who would destroy the friendships we all have worked hard to build. I will not let that happen. We must strengthen the ties with our allies, not alienate them though petty fighting.",         "You here to talk or to fight? Grab a weapon and get to it.",   "sl_fac_waron.jpg", 15000,  8000, 12,  10, 14, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Big-Assquatch",      "You in the mood for something dangerous? Yeah? Well, there\'s a bounty out for this freakin\' huge sasquatch that\'s decided to move in to the canyon south of town, past the wrecked LifeNet pod.",         "You have earned this bounty.",   "sl_fac_bigas.jpg", 15000,  8000, 12,  10, 14, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Roar of Conflict",      "I bet you\'re plenty capable! Especially when it comes to dangerous work. I can tell just by looking at you. You must get high-risk work all the time! Anyway, I make stuff. Some of the stuff I make requires hides from the wild lizards around here. Skin them for their hides, and I\'ll make it worth your while.",         "Excellent quality! You\'ve got a real eye for this work.",   "sl_fac_roaro.jpg", 15000,  8000, 12,  10, 14, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Building Fences",      "Right now I really need some wood and nails to finish this fence. We have to keep the prarie chickens out, so we\'re just going to fence it off. Do you think you could rummage up some supplies for us?",         "Thanks. These will do just fine. You\'ve been a big help.",   "sl_fac_build.jpg", 15000,  8000, 12,  10, 14, 15, 12, 10);


/** Town 4 The Dump Mission Descriptions **/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Dai\'s Suspicions",      "If you\'re not too busy, I need your help. One of my guards is late coming back from his patrol around the Dump\'s outer wall. His name is Quentin Boswell. Yeah, he\'s a Retainer, but he\'s been around long enough to remember the Dump before the Retainers screwed everything up. Head down to the landfill and find out what\'s taking him so long.",         "You defeated a roving band of CoGs, but you didn\'t find Quentin.",   "td_gen_daiss.jpg", 8000,  6000, 11,  8, 10, 15, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Dai\'s Suspicions 2",      "CoGs left the Dump to attack you? That\'s strange... They\'re generally so concerned with defending their piles of trashed computers that they don\'t go far. Now I\'m a lot more worried about Quentin.",         "The corpse is wearing a shirt with \'Quentin\' stitched on the front. He looks as though he got beaten to death. Also, his foot and arm have been removed. Quentin didn\'t deserve that kind of end. No one does, though. It must have been the CoGs.",   "td_gen_daiss_2.jpg", 8500,  6500, 7,  6, 7, 10, 8, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Steel and Leather: That's Hot",      "You\'re not satisfied with the things our merchants have to sell, are you? Don\'t you want to do something about that? Wouldn\'t you rather have the security of some no-nonsense metal plates between you and a raider\'s two by four? Why don\'t you bring me the frayed cotton and scrap fasteners I\'ll need?",         "What have we here? Is it a sack full of steel and leather? Do you have a few moments to wait while I put this armor together?",   "td_gen_steel.jpg", 5000,  3000, 8, 6, 9, 13, 11, 9);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Repay the Devil",      "Is there any corner of the Northfields that isn\'t polluted with the Devil\'s Own? They may not be our worst problem, but there are plenty of shipments that don\'t make it to us because of them. You\'ll find a number of them north of here. Remove some of them from the equation, and the fortunes of the entire town will improve.",         "Honestly, with a group like the Devil\'s Own, ten is just a good start. While you\'re out there working on the next ten, I\'ll lure some commerce into town.",   "td_own_repay.jpg", 8000,  6500, 11, 8, 8, 20, 15, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Scurvy. You\'re Kidding, Right?",      "Your people really busted their asses to get our guards on your side, but now our guards need some help. We haven\'t had fresh food for them in... far too long. My toughest guys can\'t fight or even walk around much, they\'re so sick. Do you know what happens to a man as he dies of scurvy? Because I wish I could forget.",         "I can\'t tell you how much I appreciate this. Believe me, these guards were ready to fight for anyone with an orange grove. But we still don\'t have enough Northfields Lemons-that\'s only enough to help a few of these guys.",   "td_own_scurv.jpg", 10000,  8000, 10, 9, 10, 10, 8, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Recycled Upholstery",      "Would you like a chance to buy some better clothing? Maybe even something to protect you from the, ah, slings and arrows, eh? Aren\'t there a lot of bodies in the Dump covered in leather and synthetic cloth? Do you realize what kinds of great things our merchants could make with that?",         "Well, isn\'t this just the thing? But you didn\'t think that would be enough, did you? Why don\'t you bring me more like it?",   "td_own_recyc.jpg", 5500,  2500, 8, 6, 9, 20, 15, 10);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("How CHOTA Persuade",      "I hope you\'re as badass as I\'ve heard, because if not, you probably won\'t survive the task I have for you. You\'re going to prove to the people of this town that the Children aren\'t scared of anything, not even the Union\'s Retainers. You\'ll need one of the townsfolk to witness your courage. I\'ve told Dai Wong what you\'re going to do, so he\'ll take care of the rest.",         "So you\'re the one, huh? You must be insane. I mean, really. The Retainers have actual guns, you know, not the peashooters you saw down in the Plateau.",   "td_fac_howch.jpg", 15000,  11000, 17, 13, 15, 20, 15, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Buried Deep",      "The people fighting the Union\'s control of the Northfields just seem to... disappear. Everyone knows it isn\'t safe to travel anymore, though, so people just assume that the missing person ran afoul of the CHOTA or a hungry ant swarm. But I don\'t think that\'s what happened to Bill Walker. I can\'t prove anything, but do me a favor and keep an eye out for any freshly buried bodies.",         "So he really was buried here? Aw, dammit. I really wanted to be wrong... Poor Bill.",   "td_fac_burie.jpg", 15000,  11000, 17, 13, 15, 20, 15, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Kanal and the CoGs",      "The CoGs may be the most tragically damaged people in all of the Grand Canyon Province. Before the Fall, we could have treated their mental illnesses with medicine and therapy, keeping them from threatening innocent people. We can\'t round them up for treatment, now. Nor do we have the medicine or expertise to help them. But we can\'t let them hurt innocent people, so they must be eliminated.",         "It is as I said: tragic. But there are some sick people whom we cannot afford to heal. More CoGs will take the place of the fallen, and they too will threaten the people of the Dump.",   "td_fac_kanal.jpg", 15000,  11000, 17, 13, 15, 20, 15, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Computer Reconstruction",      "We\'ve done everything in our power to relearn computer production and maintenance since the Fall. They weren\'t really meant to be made by hand, but we haven\'t had a lot of options. We\'re paying the Travelers to do the dangerous stuff; now I just need you to salvage as many monitors as you can from the hermit crabs. You\'ll have to kill the crabs, of course-just try not to damage the monitors!",         "I don\'t know if we\'ll get any use out of these, but that\'s more a matter of corrosion and blood than anything you did. It\'s a good start, anyway, but the job isn\'t done.",   "td_fac_compu.jpg", 15000,  11000, 17, 13, 15, 20, 15, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Thuggery at the Dump",      "Load up your peashooter, will ya? There are more Union thugs to fight in the Dump, and you\'re just the clone for the job.",         "That\'s the way you do it, yeah! Business isn\'t quite rolling in yet, though, so maybe you want to take down ten more?",   "td_fac_thugg.jpg", 15000,  11000, 17, 13, 15, 20, 15, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Towers Crumble",      "The Techs are at it again! They\'re doing everything in their power to rebuild the machines that polluted the world, and they\'re starting with electronics. We\'ve got a chance to stop them here, because all of their supplies are coming from the Dump. This jug is full of saltwater. All you need to do is pour it on the computers over in the CoG quarter of the Dump. ",         "You emptied the jug of saltwater over the computers.",   "td_fac_tower.jpg", 15000,  11000, 17, 13, 15, 20, 15, 10);

/** Town 5 New Gallows Mission Descriptions **/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Howls in the Night",      "My wife got herself killed a while back. She was out gathering food for us to eat, seein\' as how we was starved at the time. I told her over and over again that it was too dangerous. Too many damned wolves. I went out and tried to find her, and the sons of bitches were still gnawing on what was left of her. Clone, could you avenge my Emma?",         "I don\'t reckon it brings Emma back to me, but I gotta say it makes me feel a little better to hear fewer howls in the night.",   "ng_gen_howls.jpg", 8000,  6000, 8, 6, 10, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Little Things",      "With the Devil\'s Own on our doorsteps, raiding caravans and disrupting trade, it\'s difficult to acquire chemicals and other goods needed to keep the clinic functional. Will you help find the things we need to supply the clinic?",         "We know the worth of water when the well is dry. You have our gratitude.",   "ng_gen_littl.jpg", 10000,  8000, 10, 8, 12, 14, 10, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Within the Woods",      "I need a toolmaker. I can probably handle most of what I need to build, but if you\'d do me the honor of either making or buying me a couple of carpenter hammers, I\'ve got a few chips and old books laying around that I can barter.",         "Mighty fine work, these are. Did you make them yourself? No matter... It\'s good, no matter where they came from.",   "ng_gen_withi.jpg", 9000,  8000, 11, 9, 15, 13, 9, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Tending Old Wounds",      "Any person, mutant or not, has the right to medical treatment, so our clinic DOES treat non-mutated humans. That means most of the time, there\'s a long wait, plus we\'re not equipped to handle emergencies. Could you help tend wounds?", "I heard you stitched up wounds like a master. Maybe I could learn a thing or two from you.",   "ng_own_tendi.jpg", 13000,  10000, 12, 8, 11, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Hard-Target Search",      "We\'re up to our asses and elbows in Devil\'s Own bandits around these parts. They\'re bad, all right. But the way I got it reckoned, the people who help those sorry sumbitches are a thousand times worse. So, you want to make the Province a safer place? Help hunt down and kill the varmints who scout and report to the damned Devils whenever we start moving goods out of town.", "Good work. One less person to sell out decent folk to the Devil\'s Own.",   "ng_own_hardt.jpg", 12000,  9000, 13, 10, 13, 14, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Shielding the Apocalypse",      "Hope you have some skill in crafting armor, because otherwise you\'re a useless scrap of clone-meat to me. Make it or buy it, I couldn\'t care less, but I need four pieces of Padded Shoulder armor so I can defend New Gallows. Hiding from bullets just takes too much time away from cutting off heads.", "You did well. This armor is going to catch a lot of abuse, so I hope you damn well made it right, or bought it from someone who did. If it fails, we fail, and that isn\'t an option.",   "ng_own_shiel.jpg", 12000,  7000, 13, 10, 13, 14, 10, 8);


INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Mutants Come Home",      "Now that we control New Gallows we must make it truly ours. We must let the mutants know that the CHOTA rule here, and that New Gallows is safe for them. If you are truly one of us, then go and tell Preston, the leader of Preston\'s Pariahs, that his people may now come to New Gallows. Tell him that it is safe here and that they are welcome.", "The CHOTA shall rule New Gallows forever!",   "ng_fac_mutan.jpg", 15000,  12000, 20, 15, 18, 18, 14, 11);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Defend the Defenders",      "You\'ve probably heard that we\'re working with the Techs to build a supply depot a short way outside of town. Damn Vistas and CHOTA keep trying to sabotage the place. In fact, I just got word that there\'s another attack underway. We need help out there, pronto!", "That looks to be the end of it. Better report back to Lt. Sternberg.",   "ng_fac_defen.jpg", 15000,  12000, 20, 15, 18, 18, 14, 11);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Singing Steel",      "We are philosophers; we are poets. We are negotiators; we are healers. On top of everything, however, we are warriors. Even those who believe in promoting peace must be prepared for war. Would you like to test your skills? Find and defeat my three students.", "You\'ve done very well. You deserve to be rewarded.",   "ng_fac_singi.jpg", 15000,  12000, 20, 15, 18, 18, 14, 11);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Rebuilding",      "We may have control, but New Gallows is a disaster. I think we can get this place in shape, but it\'s going to take supplies. We have everything we need out at the supply depot. Can you give this order to Trace Percy? He should be able to come up with what I need. Be careful, though. The Vistas and the CHOTA have taken a dislike to the depot and they\'ve been known to attack it from time to time.", "Percy wants payment, aye? Hmm... Well, I suppose I can help him out. Just tell him not to make this a regular thing, okay? We\'ve only got so much here.",   "ng_fac_rebui.jpg", 15000,  12000, 20, 15, 18, 18, 14, 11);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Bring on the Storm",      "We done good, real good. Before we took control, though, we had a regular drop-off point for supplies on the edge of the green. That stash would do us handy until we can get the supply lines running. Think you can make a quick run out there and pick up the stash? Here, I\'ll draw you a map.", "You\'ve gathered the stash of supplies.",   "ng_fac_bring.jpg", 15000,  12000, 20, 15, 18, 18, 14, 11);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Making Good from Bad",      "Those rotten Techs have uncovered a lot of useful materials. Since the damage has already been done, we might as well do what we can to recycle the debris from the old relay station. See what you can find lying around, and I\'ll make sure it\'s put to good use. Just make sure you don\'t cause any more damage while you\'re digging around.", "Good job! I\'m sure this stuff is useful. Maybe if people had really taken recycling seriously sooner... Well, anyway-thanks!",   "ng_fac_makin.jpg", 15000,  12000, 20, 15, 18, 18, 14, 11);

/** Tinkersdam mission descriptions **/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Public Works Fund",      "We\'ve been struggling to make this a place where merchants and artisans can work in peace, but we need a regular source of clean water. I requisitioned the parts for our purification plant, but the Union refuses to \'condone the faction war\' by supporting areas under faction oppression. The White Crow have a camp near here. If you grab some of their gear, we could sell it and fund our projects.", "I wonder where they get all this stuff. I didn\'t think raiding was this profitable.",   "ti_gen_publi.jpg", 16000,  12000, 15, 10, 15, 8, 6, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("To Your Health!",      "I need you to go outside of town and make sure the pumps are working. All of the water comes from underground springs, so if those pumps get jammed, we run the risk of a major clog. The pumps are just outside of town. Good luck.", "Check it out! Clean water! Here, the first drink\'s for you.",   "ti_gen_toyou.jpg", 16000,  10000, 20, 14, 18, 10, 8, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Feeding the Weak",      "People are leaving here in droves because the White Crows have been wreaking havoc. Most days, you can\'t even find a decent meal. You know, sometimes I envy you clones, because you\'re not in any real danger. Not like the rest of us, whose lives matter \'cause we\'ve only got one. Do you think you could help us find some food?", "Oh my! That\'s more than I could have hoped for. This should keep us going for a while longer. I\'m going to get busy cooking, and we\'ll have a feast tonight!",   "ti_gen_feedi.jpg", 13000,  8000, 14, 10, 15, 9, 7, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("I Don't Give A...",      "My bottom line here is keeping the people of Tinkersdam safe. We\'re merchants and manufacturers, just trying to make a living. You want our help, you\'ve got to protect the town, and watch out for those \'acceptable losses.\' We\'re not too big on that concept around here. Our east wall is constantly under attack from throwbacks.", "Well, you might be worth our time, after all.",   "ti_own_idont.jpg", 17000,  12000, 20, 16, 18, 11, 9, 7);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Transmission Jam",      "There\'re these plants that grow outside town, and they\'ve got these big fleshy leaves on \'em. You can squish those leaves up and make a really tasty jam out of \'em. Plus, you can use that jam as a really handy lube for machine parts. \'Course it smells worse than a dead skunk... Go and get me some leaves, and I\'ll pay you for your time. Sound good?", "Perfect. Thank you! These\'ll mush up real nice!",   "ti_own_trans.jpg", 18000,  13000, 22, 18, 20, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Mechanical Advantage",      "We need parts to fix our weapons. Scrap gears, in fact. Buy \'em, make \'em, borrow \'em, or steal \'em-just bring \'em to me.", "Keep bringing \'em in. The more we fight, the more repairs we need.",   "ti_own_mecha.jpg", 12000,  9000, 14, 10, 16, 8, 6, 4);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Substitute Teaching",      "The people here are weak, but we will fix that. Warlord Fracture has sent one of his strongest Oathtakers to train the guards here and make them into warriors. Make sure she gets to the town safely.", "Now that the guard is here, the strength of the town will grow.",   "ti_fac_subst.jpg", 16000,  12000, 22, 16, 22, 14, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Keep the Roads Safe",      "I have your orders, soldier. Bailey James is one of our couriers for this settlement. He\'s widely known to work with us, though, and he\'s liable to get shot if he enters the hot zone without an obvious escort. That\'s your job. Get him to Emilia Jenner. You will be contributing to our control of the local political process. Return to me when you\'re done.", "You reached the courier\'s destination; he slipped away to safety while waiting for a chance to speak with Emilia.",   "ti_fac_keept.jpg", 16000,  12000, 22, 16, 22, 14, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Tinkersdam Blockade",      "Despite the amount of time we\'ve spent trying to keep those lying, cheating Travelers out of Tinkersdam, they still sneak on through. Our... scouts... have seen a badly disguised Traveler heading toward town. Intercept him and make sure he doesn\'t get there.", "Everyone will sleep easier without having to worry about the spies in town.",   "ti_fac_tinke.jpg", 16000,  12000, 22, 16, 22, 14, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("High Demand for Widgets",      "This is ridiculous! Can you believe they expect us to do any work? There\'s nothing here. In order to make anything of this, we\'re going to need batteries. The White Crow are usually good for carrying around supplies like that. But the White Crow certainly won\'t just hand over the batteries, so I hope the sight of blood doesn\'t bother you.", "Heh. Makes me wonder what else we could get from them. At least this brings some civilization to this place.",   "ti_fac_highd.jpg", 16000,  12000, 22, 16, 22, 14, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("No Such Thing as Safe",      "Even as we speak, our enemies plot against us. That\'s hardly anything new! They\'re jealous of our wealth and connections. And you\'re the one to do something about it. They\'re never safe from us. Never. I want you to find and kill the \'advisor\' who\'s waiting to meet with the town elders.", "You took out the advisor? Excellent. Now all interested parties will remember that we\'re in charge around here and there\'s nothing they can do about it. I\'m sure someone with skills like yours will go far with the Travelers.",   "ti_fac_nosuc.jpg", 16000,  12000, 22, 16, 22, 14, 12, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Toxic City",      "We have promised to help clean up Tinkersdam and make it a place of sustainable growth. To this end, this kit has everything you\'ll need to clean up a few square feet of pollution. This project is a long, slow process, as you may know, but there\'s no time like now to start.", "Are you ready for your next kit yet? There\'s a lot of ground left to cover. Oh, yeah, um-well done with that first one. I\'m sure the locals appreciate it.",   "ti_fac_toxic.jpg", 16000,  12000, 22, 16, 22, 14, 12, 10);

/** Waste Farm Mission Descriptions **/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Keeping Them Warm",      "It gets cold around here at night, but I do my best to keep my family well-clothed. Getting supplies around here has been a little bit difficult as of late, what with all the fighting. So, to get to my point, I\'m in bad need of some wool. If you come across any, I\'ll pay well for it.", "Well done. I\'ll be able to get a few good sweaters out of this.",   "wf_gen_keepi.jpg", 21000,  17500, 17, 15, 21, 12, 8, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Pilferin\' Pamphlets",      "You know those Human League bastards? They\'ve been givin\' me grief due to my eyes bein\' the way they are. I was there trying to get some of my stuff back the other day, and I saw where they keep their literature. Steal some from a box in their shed and bring that garbage back here so I can burn it. Knock a few of \'em around for me while you\'re at it, if you want.", "Good. Now can put this crap on the burn-pile where it belongs.",   "wf_gen_pilfe.jpg", 19500,  15000, 24, 19, 22, 11, 8, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("No More Ills",      "Folks\'re always getting themselves hurt around here. Hell, with the damnable Benedicts around, I think I spend about half my time patching up wounds. I\'m currently running a little low on supplies. You think you could find some medicines?", "Yes, indeed. These will do the trick. Thank you, stranger.",   "wf_gen_nomor.jpg", 15000,  12000, 17, 14, 19, 12, 8, 4);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("It\'s a Mirage",      "There\'s a rumor going around the fresh faces in camp that a group of well-armed tough guys are planning something big. I think it\'s just the normal chest-puffing, holding-your-privates type of tribal posturing, but who am I to question without seeking answers? Go to the place where the young ones saw the strange activity and report back to me.", "From this vantage point, you\'ve seen some odd documents. This may be an opportunity to learn more!",   "wf_own_itsam.jpg", 20000,  16000, 27, 22, 24, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("It\'s Sabotage!",      "These plans are frightening. We have to strike, and quickly. These saboteurs are moving against the town soon. Very soon. We\'ll intercept them on the way to their destination. That way they won\'t have the home-base advantage, and we\'ll have surprise, to boot. Talk to Mike Shallah. He\'ll be organizing the strike. You\'ll lead.", "It wouldn\'t have gone better if I\'d done it myself. This is a big win for us and for Waste Farm.",   "wf_own_itssa.jpg", 28000,  22000, 22, 20, 25, 10, 8, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Gas Bandits",      "We got word that there\'s a group of thieves out there planning a big heist to steal gas from Waste Farm. We\'re not sure yet if they\'re planning on taking some or trying to secure the area. The first would be foolish, but the latter would be more so due to the number of... interests... in the area. Go talk to Trisha Zau. She\'s agreed to tell us what she knows.", "What took you so long? I thought you\'d never show.",   "wf_own_gasba.jpg", 17000,  14000, 18, 16, 21, 10, 8, 6);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Tech Advance",      "This town is OURS! We\'re not giving it back no matter how much the fools out there want it. No way! The Techs think they\'re so smart. They\'ve been snooping around one of the farms. They call themselves scientists. I call them SPIES! Kill them. Make an example for those who try to overthrow the Children!", "Good. I can smell their blood on you.",   "wf_fac_techa.jpg", 25000,  20000, 27, 22, 27, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("A Desperate Attempt",      "The Vistas are so arrogant to think that they can tell everyone else how to use the resources of this world. OUR world. Everybody\'s. They think they own it all. They want to retake this town so bad, they can taste it. There\'s a three-man scout team that\'s been probing our defenses for the last few hours. Go out there and kill three of theirs at their camp. They\'ll keep their scouts away next time!", "You\'ll never believe this. They\'re on the move. Out in the open. Coming to attack us! Ha! They think pretty highly of themselves to take us on.",   "wf_fac_adesp.jpg", 25000,  20000, 27, 22, 27, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Powerless Children",      "Those CHOTA are sitting out there, just waiting to take back this town. They\'re like wolves. Vicious and tactically sharp, but not too smart. I have a feeling they\'re preparing something big.... Go out near their camp. Find a good spot to hide, if you can, and see if you can find anything out-unusual organizing, chatter, whatever.", "Luckily, despite the commotion of the camp, you picked out a few words like \'power station\' and \'today.\' It\'s good you got there when you did. They won\'t try that again anytime soon. Well, at least until they lick their wounds and come back tomorrow.",   "wf_fac_power.jpg", 25000,  20000, 27, 22, 27, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Not So Bright",      "We\'ve got some of those first-edition monks just outside the walls, thinking they\'re all sneaky. Ummm... you can\'t hide from surveillance cameras! Sheesh. How\'re you supposed to be stealthy when you\'re \'bearing light\' all the time? Anyway, we couldn\'t catch up to them, but we\'d like you to go out and scout their camp. See what\'s up.", "You distinctly overheard a Lightbearer discussing an attack on the power station? We dodged a bullet on that one. Thanks for all your help!",   "wf_fac_notso.jpg", 25000,  20000, 27, 22, 27, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("In Force",      "The Enforcers really don\'t like it when they\'re not in control. You\'d think they\'d learn by now that they can\'t always have their way. They\'ve got some mook out there, patrolling near the walls, as if this was their town. It\'s not. Teach them that this town is OURS. Kill that guy. That may piss the rest of them off, but you can handle \'em.", "These jokers think they\'re tough. They didn\'t know we had a badass like you here. Great work.",   "wf_fac_infor.jpg", 25000,  20000, 27, 22, 27, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Green Energy",      "We worked hard to get this town. We need to make sure no one else butts in. We got a message from one of our spies, Ferny Taylor, but he\'s too spooked to come near town. Go meet him and find out what he\'s got. And then kill him. We know for a fact that he\'s been feeding accurate information to the Travelers. We don\'t know where his loyalties lie. Oh, and the password is \'apple blossom.\'", "The spy\'s dead. A shame you found some documents on him that proved he had been loyal all along.",   "wf_fac_green.jpg", 25000,  20000, 27, 22, 27, 12, 10, 8);

/**Park City mission descriptions **/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Desperation Breeds Violence",      "You have to do something to help us with the Judges. They attacked the other day and killed an entire family. They also kidnapped the head of our guards-Naomi\'s husband, Michael. Can you watch their camp to see if they\'re holding him captive?", "Rusk is one of them... and it looks like he spotted you!",   "pc_gen_despe.jpg", 28000,  20000, 24, 20, 26, 10, 8, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Hard Decisions",      "He\'s one of them now? I don\'t understand it. This was his home; he was one of our guards; he helped us fix this place up. Which means... he knows about the weak points in our defenses. I can\'t believe I\'m saying this, but I need you to kill him. The knowledge he has could be devastating to the people here. If we want to survive, he has to die.", "I\'m sorry you had to do that. I know it wasn\'t how you were supposed to be helping us, but you saved a lot of lives by killing him. Thanks.",   "pc_gen_hardd.jpg", 24000,  22000, 30, 26, 28, 9, 7, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Move Over, Bacon",      "Maybe you can help me. Everyone knows that a balanced diet is the most important part to being strong and healthy. But have you seen the people in this burg? The more protein we can get into the town diet, the stronger we will be. If I can get some decent meat, everyone will get stronger and healthier.", "This will keep the people from getting too undernourished.",   "pc_gen_moveo.jpg", 23000,  21000, 24, 22, 27, 11, 9, 7);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Death to Fozzie",      "Got a minute? You look like you know your way around the Kaibab, which means you\'re probably aware of the bears. Well, the bears around here break into our supply caches, scare off our foragers, and eat people. The mess they make, not to mention the lost merchandise, has really put a hurting on local business. If you\'d get rid of some of them, that would be great.", "Your efforts are really appreciated. I know the local businesses will be better off for it.",   "pc_own_death.jpg", 26000,  22000, 32, 28, 30, 12, 10, 8);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Smokey the Clone",      "All the dried wood and brush out there could turn into a firestorm with just a single spark. It wouldn\'t surprise me if the Judges set a fire on purpose to drive us out or otherwise \'purify\' us. Even if they don\'t, one unsupervised campfire that goes out of control and WHOOSH. If you could clear out the kindling in the underbrush, it would really help us out.", "You don\'t know how valuable a service you\'ve done us.",   "pc_own_smoke.jpg", 29000,  25000, 25, 22, 28, 7, 5, 3);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Friends Like These",      "So you think you\'re tough enough to hang with real Children? We\'ll see about that. If you wanna hang out here, you\'ve got to be initiated. We all did it, so it should be easy for a tough warrior like you. First thing you have to do is talk to Burn on the edge of the forest. He\'ll tell you the rest.", "I can\'t believe you made it. Last one to try that lost three fingers and the better part of his ass. Here ya go, consider yourself one of us.",   "pc_own_frien.jpg", 26000,  24000, 30, 26, 30, 10, 8, 6);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Children\'s Crusade",      "Welcome to the war. The Judges and the throwbacks are many, but we\'re the toughest warriors in the Kaibab, so there\'s nothing to do but go out and prove it. Every little victory brings us closer to freeing the locals. Collect a chapter of the Vulgate Judicare, a letter of receipt from the Professor, a GlobalTech file, and a token of your victory over the Judges. In time, Park City will be ours.", "Our crusade of liberation marches on, thanks to you!",   "pc_fac_child.jpg", 32000,  26000, 35, 28, 34, 12, 8, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Night of the Throwback",      "You look like you\'ve seen a thousand miles of hard road. I like that. I\'d wager that you would have no problem taking down those damned throwbacks that think my deputies are a light snack. The situation around here would be helped with fewer of those ravening monsters out there.", "I knew you could put down those monsters. Killing ten was a good start.",   "pc_fac_night.jpg", 32000,  26000, 35, 28, 34, 12, 8, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Paths of Righteousness",      "No matter how bad the other factions may be for Park City, they\'re still preferable to the Judges or the throwbacks. Once you\'ve hunted down the town\'s enemies, Park City will see our loyalty and wisdom, and the locals will flock to our cause.", "I shouldn\'t be surprised to find that people don\'t want to listen to us until we\'ve done something for them first. At least these people don\'t want us to do anything truly objectionable.",   "pc_fac_paths.jpg", 32000,  26000, 35, 28, 34, 12, 8, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Slice of Life",      "You wouldn\'t know it at a glance, but Park City is home to one of the Province\'s most accomplished geneticists. Alvin talks a lot about his \'retirement,\' but he\'s undertaken a study of the local throwbacks. They can\'t really be captured for study, though, so he\'s asked us to get genetic samples. They\'re a deadly menace anyway, so you needn\'t restrain yourself from hurting them.", "Okay, maybe I could have given you a few guidelines on protecting the samples and lab standards for hygiene, but these are certainly usable. The professor\'s research is critical to the defense of Park City, and you\'re making it possible. ",   "pc_fac_slice.jpg", 32000,  26000, 35, 28, 34, 12, 8, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Payoff",      "Ah, Park City. Great place to get away from the hustle and bustle of Banker\'s Hole, wouldn\'t you say? Of course, there\'s profit to be made here, too. The people here have things they want done, and who can blame \'em, right? The Judges and the throwbacks aren\'t exactly friends of ours, so if the townsfolk want to give us the keys to the joint for taking them out, I\'m sure you won\'t refuse.", "Easy peasy, was it? No? Sorry to hear that, but the payoff is all gonna be worth it. Trust me.",   "pc_fac_thepa.jpg", 32000,  26000, 35, 28, 34, 12, 8, 10);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Mass Quantities",      "You probably think your collar has an \'Ask me for help\' sign attached to it, but, hey-you\'re usually the only ones who can get things done. You still game? Okay, I bet you\'ve heard this before, but we need more supplies, gear, ammunition, and tools to get this town secure and thriving. Not far from here, the Judges have a makeshift storehouse with the stuff we need.", "This is gonna help the local situation a lot. Thanks. If you feel like doing it again, it would be appreciated.",   "pc_fac_massq.jpg", 32000,  26000, 35, 28, 34, 12, 8, 10);

/**Fender Gate mission descriptions **/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Who Wants the Roach?",      "You want to help us out with our roach problem? It\'s not a minor thing. They\'re all over the damned place. Get out to the junk pile. You\'ll see \'em swarming all over the place. Hell, they\'ve even managed to get into town in a few spots. Kill a bunch of them, please.", "That sounds like one hellaciously huge bug. We\'re all indebted to you for killing it. Maybe now Fender Gate will get some peace.",   "fg_gen_whowa.jpg", 28000,  23000, 27, 24, 30, 6, 3, 2);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Show \'Em You Got Guts",      "What do you want? Can\'t you see I\'m trying to organize a supply chain for the guards? If you\'re thinking of doing something decent, like helping me outfit the people who defend the town, take some of my scavenger buds out to the battlefield to gather swag. We could really use the extra material.", "Thanks for the help. Even scrap armor\'s better than nothing.",   "fg_gen_showe.jpg", 34000,  28000, 34, 28, 32, 7, 6, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Raider Troubles",      "As the security chief of the civilian population, I have been authorized by the town\'s leadership to hire mercenaries to deal with the recent rash of raider attacks. These thieves and ruffians are preying on those who wander just outside of town.", "This is the standard-issue light-grade mercenary allowance. I know it\'s not a whole lot, but it\'s all that I am authorized to award you.",   "fg_gen_raide.jpg", 31000,  27000, 33, 29, 35, 9, 6, 5);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Overdue Books",      "One of my couriers was on an assignment to bring me some books from the Repository when he was attacked. I\'d like to be able to continue borrowing from the Repository, but if their books have a chance of going missing, they might restrict me. Locate the thugs that attacked him and return the books to me!", "Jolene was worried about me missing these books? It\'s not a problem. They aren\'t long overdue.",   "fg_own_overd.jpg", 33000,  29000, 35, 30, 37, 7, 6, 5);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Dawn of the Rotten",      "We have a situation developing to the northeast in a small town called Buxton. We sent a contractor there to establish an observation post, and his reports have been highly irregular. We are pleased to offer very generous compensation, including weaponry and currency, for your help.", "By accepting this compensation package, you agreed that you have hereby received payment in full for your contracted aid in the town of Buxton. This resolves our dealings.",   "fg_own_dawno.jpg", 42000,  35000, 44, 38, 41, 8, 7, 6);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Outside the Box",      "Have you seen those suits they\'re wearing? The Outsiders? Even better than what the Techs make. There\'s a new guy in their ranks-maybe still in training, maybe someone\'s kid... Who cares? The point is: he\'s a weak spot and we\'re going to exploit it. I need you to get over to their HQ and infiltrate the building. See if you can find a schedule or timesheet. Then, we plan our strike.", "The Outsider don\'t suspect a thing. You were in, out, and gone before any of the guards spotted you.",   "fg_own_outsi.jpg", 31000,  25000, 34, 30, 36, 5, 4, 3);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Jarl Want Proof",      "Whoever told you Warhall is alive is wrong. Warhall is dead. Vost told me so. She knows stuff. Course, if she\'s wrong and I side with her and the Warchief comes back, she\'ll kill me. That would be bad. Maybe I need something to show she\'s alive. Bring me proof, I let you live. Don\'t come back-I find you, I kill you.", "That\'s Warhall\'s bat. Warhall is alive? Oh, she sounds pissed. I\'ll get my warriors to help Blue-Skull keep order. She won\'t kill me if I\'ve been helping...",   "fg_fac_jarlw.jpg", 34000,  28000, 40, 35, 39, 8, 6, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Simple Task",      "If it\'s not those damn renegades on the western road, it\'s crazy people trying to climb the hill and blabbing about sin. Signals aren\'t carrying as well as they used to, and we\'re closed off from the rest of the Enforcer outposts in the region. Handle our problems with one of the locals.", "Nice work, Recruit.",   "fg_fac_simpl.jpg", 34000,  28000, 40, 35, 39, 8, 6, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Unfavorable Conditions",      "I\'m worried. As if we didn\'t have enough trouble around here with the All-Mind, this morning I saw a couple of Shiva\'s Favored lurking in the woods to the east. If they contaminated the groundwater, it could leave this place unlivable for years. Find those Favored and kill them before they try anything.", "I\'m glad you got them. They don\'t just kill; they poison everything, even the land itself.",   "fg_fac_unfav.jpg", 34000,  28000, 40, 35, 39, 8, 6, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Self-Obsolescence",      "I\'m working on a prototype network interface for the Riders. It should help the Riders use the radio as a communication device... so simple messages can be sent out via electrons and photons rather than the back of a horse. While I start the framework, could you get me some other supplies I need?", "Right. Now that I have all this stuff, it\'ll just take me a little while to get the prototype complete...",   "fg_fac_selfo.jpg", 34000,  28000, 40, 35, 39, 8, 6, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("The Wizard of Osbourne",      "You want some work? Got a finder\'s fee for salvaged goods, so that Ed and I can whip up some stuff to sell. I pay top chip for scrap metal of all kinds, so you bring me the goods, and I\'ll send you off with a fat wallet.", "Fan-friggin-tastic! You\'re a godsend. Keep the change; you\'ve earned it.",   "fg_fac_thewi.jpg", 34000,  28000, 40, 35, 39, 8, 6, 4);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Compost Critters",      "Have you seen the cockroaches out by the compost heap? Those things are HUGE! They just keep getting bigger and bigger, and they breed like crazy. There are always more of \'em. I think they need to be humanely euthanized. That means kill \'em.", "Good job. I\'m not sure how much it\'s gonna help, though.",   "fg_fac_compo.jpg", 34000,  28000, 40, 35, 39, 8, 6, 4);

/**
  * Crafting Mission Descriptions
  */
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Lawnmower Blade",      "Item Description", "Crafting result text",   "wea_law_bla.jpg", 0,  0, 3, 2, 2, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Chaps",      "Item Description", "Crafting result text",   "arm_cha.jpg", 0,  0, 5, 3, 3, 0, 0, 0);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Leather Pants",      "Item Description", "Crafting result text",   "arm_lea_pan.jpg", 0,  0, 6, 3, 3, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Light Crossbow",      "Item Description", "Crafting result text",   "wea_lig_cro.jpg", 0,  0, 7, 4, 4, 0, 0, 0);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Police Baton",      "Item Description", "Crafting result text",   "wea_pol_bat.jpg", 0,  0, 10, 5, 5, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Reinforced Light Jacket",      "Item Description", "Crafting result text",   "arm_rei_lig_jac.jpg", 0,  0, 11, 6, 6, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Heavy Zip Gun",      "Item Description", "Crafting result text",   "wea_hea_zip_gun.jpg", 0,  0, 12, 6, 6, 0, 0, 0);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Tactical Pants",      "Item Description", "Crafting result text",   "arm_tac_pan.jpg", 0,  0, 13, 7, 7, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Magnum Rimfire Rifle",      "Item Description", "Crafting result text",   "wea_mag_rim_rif.jpg", 0,  0, 18, 9, 9, 0, 0, 0);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Crude Sledge Hammer",      "Item Description", "Crafting result text",   "wea_cru_sle_ham.jpg", 0,  0, 20, 10, 10, 0, 0, 0);


INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Cleaver",      "Item Description", "Crafting result text",   "wea_cle.jpg", 0,  0, 24, 12, 12, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Athlete's Tunic",      "Item Description", "Crafting result text",   "test.jpg", 0,  0, 28, 14, 14, 0, 0, 0);


INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Riot Helmet",      "Item Description", "Crafting result text",   "arm_rio_hel.jpg", 0,  0, 32, 16, 16, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("GA-17 .38 Service Revolver",      "Item Description", "Crafting result text",   "wea_ga_ser_rev.jpg", 0,  0, 36, 18, 18, 0, 0, 0);

INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Military Plate",      "Item Description", "Crafting result text",   "arm_mil_pla.jpg", 0,  0, 38, 19, 19, 0, 0, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Breastplate",      "Item Description", "Crafting result text",   "arm_bre.jpg", 0,  0, 44, 22, 22, 0, 0, 0);

/** BOSS MISSIONS **/
/**BOSS Crafting missions*/
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Huge Fake Chicken Nest",      "The best way to take down Old Willy is to make him come to you.", "Why didn\'t you think of this sooner? This fake nest doesn\'t look like much, but prairie chickens aren\'t picky and this is the only one large enough to fit Old Willy. He should fall right into your trap. ",   "boss_1_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Sandworm Juice",      "Possibly the most disgusting jug of juice in the Sector. Possibly.", "You\'ve got the juice. You\'ve got the manpower. Now to find a good location and bring Thunder to you.",   "boss_2_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Cage Key",      "A rusty iron key possessed by the White Crow soldiers, at least for now.", "You found this key on the last White Crow you killed. Whatever the White Crow are hiding, they\'re scared enough to keep it locked away. Now, to find the lock.",   "boss_3_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Mausoleum Key",      "A key to the vampire home-base, and your ticket to a confrontation with their boss, Mother Larissa.", "Your efforts to cull the local vampire population have yielded some fruit: a heavy iron key. You heard that the Cult of the Dead was hanging out in a mausoleum to keep up the whole vampire theme. That makes you the cunning adventurer willing to brave that tomb at dawn to slay the evil. Who are you to disappoint?",   "boss_4_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Hunting Stand",      "You can watch the cows from this vantage point.", "You\'ve got the cows and your backup is positioned and ready. All that\'s left is to bait the trap and watch quietly from your hunting stand. If anything tries to make steak tartare, you\'ll be there to do something about it.",   "boss_5_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Operation: Bear Food",      "You\'re not sure what Ursaline is on the prowl for, but here\'s hoping that one of your items will draw him out.", "Your plan is to place the items in a clearing near Ursaline\'s known stomping grounds, and then form a perimeter with your men. What could go wrong?",   "boss_6_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Lab Access Code",      "You\'ve found the lab.  Once you hack the access code, you can enter whenever you\'re ready.", "You finish hacking the access code and look at the now open door. You\'ve got a bad feeling about what you\'re going to find in there. Better rally the troops.",   "boss_7_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Brigg\'s Point Access Card",      "You\'ll have to barter and trade to get your hands on this card. The secrets of Brigg\'s Point await you.", "Making deals in the apocalypse is a fine art. One guy might want bottle caps, others want something really unusual. You\'ve moved items from buyer to buyer and finally received the access key you\'ve been looking for.",   "boss_8_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);
INSERT INTO fe_faction_wars.fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Toxic Snack",      "Grendels love this stuff, but you have no idea why.", "You\'ve made a rich cocktail of death-dealing radiation-a grendel\'s favorite treat. This should attract the patriarch.",   "boss_9_item.jpg", 0,  0, 20, 10, 10, 0, 0, 0);

/**BOSS SUMMON MISSIONS
completion_one = time multiplier
completion_two = boss starting hp
*/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Old Willy", "Have you heard the tales about Old Willy? He\'s the biggest damned prairie chicken that you ever saw, and he\'s mean old cuss to boot. He\'s out there now, tearing up farmland and making a real mess of things. Everybody wants him dead, and I mean everyone, even the Vistas. There\'s a reward waiting for the Wastelander who finally takes him down. Just don\'t try to fight him alone, or you\'ll end up as fertilizer.", "Well, it worked. Old Willy has arrived and he\'s none too pleased about your little ruse. You\'ll need to call in all hands if you want to take this bird out.  Visit the Boss page to manage your active Boss Fights.", "boss_1_battle.jpg", 1200, 800, 1, 1, 1, 12, 15000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Thunder", "We\'ve got a sandworm infestation in the nearby hills. Nothing serious, but it pays to keep their numbers in check. I sent some of the local boys to thin the herd, but they were wiped out, swallowed up by what looks like the biggest sandworm we\'ve ever had in these parts. It\'s so big that it sounds like thunder when it moves through the dirt. The town\'s too scared to form a hunting party. Can you take it out?", "As soon as you pour the juice, there\'s a rumble under your feet and the sound of thunder coming from the horizon. He\'ll be here soon.",   "boss_2_battle.jpg", 2400,  1600, 2, 2, 2, 8, 12000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Unleashed Sasquatch", "Your reputation proceeds you. You\'ve cut a path through the wastes on your way to my town, and you\'re always looking for work. This is good, because the White Crow soldiers have bred some kind of new secret weapon. It\'s a super soldier that\'s supposed to be a real badass; this town can\'t take it. You should \'persuade\' some White Crow to tell you the location of their monster. And then you should kill it.", "You followed a White Crow patrol to the location of their super soldier-a caged, hulking monster that looks exactly like the classic description of a sasquatch. Even worse, from the conversation you overheard, it sounded like they\'re trying to breed more! Grinning, you sneaked past the soldiers and fitted your key to the lock.  You figured this might be fun.", "boss_3_battle.jpg", 3600, 2400, 3, 3, 3, 4, 10000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Mother Larissa", "You there! We\'re doomed; you know that, right? Soon night will fall and the vampires will come and this whole town will be sacrificed to the glorious destiny of eternal night! It\'s inevitable! The strongest shall survive. Nobody can stand against the immortal power of Mother Larissa, even with this pathetic reward the town has offered for her death, and. . .Wait, where are you going? You\'ll ruin everything!", "Your efforts to cull the local vampire population have yielded some fruit: a heavy iron key. You heard that the Cult of the Dead was hanging out in a mausoleum to keep up the whole vampire theme. That makes you the cunning adventurer willing to brave that tomb at dawn to slay the evil. Who are you to disappoint?", "boss_4_battle.jpg", 4800, 3200, 8, 4, 4, 4, 15000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Giant Chupacabra", "Hey, maybe you--? Naw, never mind. You won\'t believe me, either. I keep telling people that my livestock is under attack, and that this is a problem that affects everybody, but they just laugh and tell me to put out some prairie chicken traps. It ain\'t no chicken! Whatever\'s doing this is big, and it\'s tearing into my cows like they were fruit or something. Please. . . I\'m a proud man, but I\'ll beg if I have to. Will you help me?", "You\'ve got the cows and your backup is positioned and ready. All that\'s left is to bait the trap and watch quietly from your hunting stand. If anything tries to make steak tartare, you\'ll be there to do something about it.", "boss_5_battle.jpg", 6000, 4000, 10, 5, 5, 12, 200000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Ursaline", "You know how things grow big out here? If something was small back before the crap, it\'s probably going to be three times as big now and just as deadly. Cockroaches, chickens... it never fails. Now imagine a bear. We\'ve got a monster bear living in the woods near here that we\'ve started calling Ursaline. We need to lure it out and kill it, but we\'re not sure what it eats. Other than us, that is. Help us, and we\'ll reward you nicely.", "Ursaline sniffs at the food, but then turns his eyes toward the one truly interesting item on the menu: you. Playing dead won\'t work. The fight is on.", "boss_6_battle.jpg", 7000, 5000, 12, 6, 6, 8, 115000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Test Subject 42", "The super-soldier experiments are a local spook story that most try to pretend didn\'t actually happen. They did. Even worse, there\'s someone out there, a woman named Pamela Hunter, who wants to bring these spook stories back into reality. If something goes wrong, the people in this town will be in real danger again. Find her laboratory and put a stop to these experiments before she does something everyone will regret.", "You hear fists ramming against the steel walls of a cell. Hunter succeeded in her experiments, but the super-soldier she created is unstable and insane. The paperwork refers to the monster as Test Subject 42, but you barely have time to think about that number before the wall gives way. It\'s time to fight.", "boss_7_battle.jpg", 8000, 6000, 21, 7, 7, 8, 140000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("El Cadejo", "I found Brigg\'s Point! It\'s the new El Dorado! The new Shangri-La or Fort Knox. Brigg\'s Point was a genetic testing lab hidden deep underground before the fall. It\'s abandoned now, with genetic research and samples just lying around for the taking! I\'ll give you the location, you get past security, and we\'ll split the take fifty-fifty. OK?", "You\'re surprised to find that the power still works at the Brigg\'s Point facility, and your access card seems to do the trick. The door slides open slowly, thanks to years of dust and muck. You take a single step inside of the facility when you hear a bellowing, furious roar that shakes the cobwebs from the corners. Something lives here.", "boss_8_battle.jpg", 9000, 7000, 24, 8, 8, 12, 400000, 0);
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Grendel Patriarch", "We\'re very grateful to the grendels. They look like hammerhead elephants, but they do a great thing by cleaning up the radiation in the wasteland. So I don\'t want to seem like a jerk when I ask you to kill one. The problem is the patriarch, kind of the bull of the local herd. He\'s gone a bit mad and grown very aggressive. He\'s driving all the other grendels to stampede over our crops and, well, he needs to be put down.", "Now you\'ve done it. Grendels are strong and heavy enough to knock over buildings and smash dune buggies into dust! Now the biggest one in the Sector has its mind set to murdering you. Time to call in the troops.", "boss_9_battle.jpg", 10000, 8000, 27, 9, 9, 8, 100000, 0);

/**ADDITIONAL MISSION ITEMS**/
INSERT INTO fw_mission (title, description, result_text, image, chips_max, chips_min, xp_max, xp_min, energy_drain, completion_one, completion_two, completion_three) VALUES ("Liberty Vest Mk 2",      "Stops 100% more bullets than Mk 1.", "Crafting result text",   "arm_lib_ves_2.jpg", 0,  0, 28, 25, 25, 0, 0, 0);


/**
  * Regular town missions - connect mission to town
  */
INSERT INTO fw_town_mission (townid, missionid) VALUES (1,1);
INSERT INTO fw_town_mission (townid, missionid) VALUES (1,2);
INSERT INTO fw_town_mission (townid, missionid) VALUES (1,3);

INSERT INTO fw_town_mission (townid, missionid) VALUES (2,13);
INSERT INTO fw_town_mission (townid, missionid) VALUES (2,14);
INSERT INTO fw_town_mission (townid, missionid) VALUES (2,15);

INSERT INTO fw_town_mission (townid, missionid) VALUES (3,25);
INSERT INTO fw_town_mission (townid, missionid) VALUES (3,26);
INSERT INTO fw_town_mission (townid, missionid) VALUES (3,27);

INSERT INTO fw_town_mission (townid, missionid) VALUES (4,37);
INSERT INTO fw_town_mission (townid, missionid) VALUES (4,38);
INSERT INTO fw_town_mission (townid, missionid) VALUES (4,39);

INSERT INTO fw_town_mission (townid, missionid) VALUES (5,49);
INSERT INTO fw_town_mission (townid, missionid) VALUES (5,50);
INSERT INTO fw_town_mission (townid, missionid) VALUES (5,51);

INSERT INTO fw_town_mission (townid, missionid) VALUES (6,61);
INSERT INTO fw_town_mission (townid, missionid) VALUES (6,62);
INSERT INTO fw_town_mission (townid, missionid) VALUES (6,63);

INSERT INTO fw_town_mission (townid, missionid) VALUES (7,73);
INSERT INTO fw_town_mission (townid, missionid) VALUES (7,74);
INSERT INTO fw_town_mission (townid, missionid) VALUES (7,75);

INSERT INTO fw_town_mission (townid, missionid) VALUES (8,85);
INSERT INTO fw_town_mission (townid, missionid) VALUES (8,86);
INSERT INTO fw_town_mission (townid, missionid) VALUES (8,87);

INSERT INTO fw_town_mission (townid, missionid) VALUES (9,97);
INSERT INTO fw_town_mission (townid, missionid) VALUES (9,98);
INSERT INTO fw_town_mission (townid, missionid) VALUES (9,99);

/**
  * Owned Missions town 1 - connect mission to town
  */
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (1, 4);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (1, 5);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (1, 6);

/**
  * Owned Missions town 2 - Dry Flats
  */
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (2, 16);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (2, 17);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (2, 18);

/**
  * Owned Missions town 3 - Slaughterville
  */
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (3, 28);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (3, 29);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (3, 30);

/** Owned missions town 4 - The Dump **/
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (4,40);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (4,41);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (4,42);

/** Owned missions town 5 - New Gallows **/
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (5,52);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (5,53);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (5,54);

/** Owned missions town 6 - Tinkersdam **/
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (6,64);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (6,65);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (6,66);

/** Owned missions town 7 - Waste Farm **/
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (7,76);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (7,77);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (7,78);

/** Owned missions town 8 - Park City **/
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (8,88);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (8,89);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (8,90);

/** Owned missions town 9 - Fender Gate **/
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (9,100);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (9,101);
INSERT INTO fw_owned_town_mission (townid, missionid) VALUES (9,102);


/** Faction Missions town 1 */
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (1, 7,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (1, 8,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (1, 9,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (1, 10,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (1, 11,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (1, 12,6);

/** Faction Missions town 2 - Dry Flats */
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (2,19,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (2,20,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (2,21,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (2,22,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (2,23,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (2,24,6);

/** Faction Missions town 3 - Slaughterville */
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (3,31,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (3,32,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (3,33,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (3,34,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (3,35,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (3,36,6);

/** Faction Missions town 4 - The Dump **/
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (4,43,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (4,44,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (4,45,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (4,46,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (4,47,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (4,48,6);

/** Faction Missions town 5 - New Gallows **/
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (5,55,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (5,56,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (5,57,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (5,58,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (5,59,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (5,60,6);

/** Faction Missions town 6 - Tinkersdam **/
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (6,67,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (6,68,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (6,69,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (6,70,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (6,71,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (6,72,6);

/** Faction Missions town 7 - Waste Farm **/
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (7,79,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (7,80,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (7,81,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (7,82,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (7,83,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (7,84,6);

/** Faction Missions town 8 - Park City **/
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (8,91,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (8,92,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (8,93,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (8,94,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (8,95,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (8,96,6);

/** Faction Missions town 9 - Fender Gate **/
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (9,103,1);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (9,104,2);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (9,105,3);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (9,106,4);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (9,107,5);
INSERT INTO fw_faction_mission (townid, missionid, factionid) VALUES (9,108,6);

/** Crafting Missions **/
INSERT INTO fw_crafting (townid, missionid) VALUES (1,109);
INSERT INTO fw_crafting (townid, missionid) VALUES (1,110);

INSERT INTO fw_crafting (townid, missionid) VALUES (2,111);
INSERT INTO fw_crafting (townid, missionid) VALUES (2,112);

INSERT INTO fw_crafting (townid, missionid) VALUES (3,113);
INSERT INTO fw_crafting (townid, missionid) VALUES (3,114);

INSERT INTO fw_crafting (townid, missionid) VALUES (4,115);
INSERT INTO fw_crafting (townid, missionid) VALUES (4,116);

INSERT INTO fw_crafting (townid, missionid) VALUES (5,117);
INSERT INTO fw_crafting (townid, missionid) VALUES (5,118);

INSERT INTO fw_crafting (townid, missionid) VALUES (6,120);

INSERT INTO fw_crafting (townid, missionid) VALUES (7,119);

INSERT INTO fw_crafting (townid, missionid) VALUES (8,121);
INSERT INTO fw_crafting (townid, missionid) VALUES (8,122);

INSERT INTO fw_crafting (townid, missionid) VALUES (9,123);
INSERT INTO fw_crafting (townid, missionid) VALUES (9,124);
INSERT INTO fw_crafting (townid, missionid) VALUES (9,143);


/** Town 1 -- Trailer Park -- Mission Ingredients */
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (22,3,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (22,5,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (23,5,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (23,6,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (11,7,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (12,8,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (15,9,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (17,10,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (16,11,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (18,12,5);

/**
  * Town 2 - Dry Flats - Mission Ingredients
  */
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (26,14,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (22,14,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (23,15,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (24,17,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (26,17,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (24,18,7);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (12,19,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (19,19,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (17,20,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (14,20,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (18,21,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (13,21,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (16,22,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (14,22,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (12,23,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (20,23,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (11,24,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (21,24,4);

/** Town 3 missions ingredients - Slaughterville */
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (26,26,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (30,26,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (32,27,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (30,28,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (32,28,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (27,30,3);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (33,31,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (17,31,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (34,32,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (16,32,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (35,33,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (15,33,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (33,34,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (17,34,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (34,35,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (16,35,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (35,36,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (15,36,10);

/** Town 4 The Dump Mission Ingredients **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (27,37,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (27,38,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (32,38,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (31,39,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (27,40,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (30,40,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (32,40,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (24,41,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (24,42,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (27,42,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (34,43,12);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (35,44,12);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (33,45,12);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (34,46,12);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (35,47,12);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (33,48,12);

/** Town 5 New Gallows Mission Ingredients **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (37,51,3);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,55,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,55,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,55,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,56,7);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,56,3);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,57,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,57,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,57,4);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,58,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,58,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,58,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,59,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,59,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,59,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,60,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,60,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,60,3);

/** Town 6 Tinkersdam Mission Ingredients **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (33,61,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (20,61,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (62,62,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (65,62,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (66,64,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (63,64,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (34,64,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (66,65,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (64,65,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (12,65,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,67,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,67,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,67,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,68,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,68,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,69,7);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,69,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,69,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,70,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,70,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,70,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,71,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,71,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,71,3);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,72,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,72,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,72,5);

/** Town 7 Waste Farm Mission Ingredients **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (73,73,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (76,73,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (72,74,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (36,74,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (13,74,20);


INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (67,75,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (31,76,25);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (30,76,25);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (67,77,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (70,77,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (70,78,6);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (57,79,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,79,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,79,15);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (61,80,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,80,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,80,15);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (59,81,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,81,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,81,15);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (60,82,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,82,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,82,15);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (58,83,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,83,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,83,15);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (56,84,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,84,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,84,15);

/** Mission Ingredients - Park City **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (68,85,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (70,85,15);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (33,85,30);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (102,86,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,86,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (34,86,30);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,87,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (70,87,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (103,88,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (74,88,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (20,88,35);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (64,89,25);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (73,89,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (21,89,35);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,91,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,91,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (104,91,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,92,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,92,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (104,92,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,93,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,93,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (104,93,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,94,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,94,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (104,94,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,95,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,95,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (104,95,20);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (77,96,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,96,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (104,96,20);

/** Mission Ingredients Fender Gate **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,97,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,97,5);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (71,98,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,98,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (72,98,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (36,98,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (96,99,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (67,100,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (70,100,20);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (75,100,10);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (96,101,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (69,101,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (76,101,15);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (100,102,3);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,103,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,103,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,103,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,103,2);

INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,104,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,104,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (8,104,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,104,4);


INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,105,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,105,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,105,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,105,2);


INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,106,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,106,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (8,106,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,106,4);


INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,107,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,107,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (8,107,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,107,4);


INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,108,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,108,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,108,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,108,2);

/** Crafting mission ingredients **/
/** Trailer Park **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,109,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,110,4);

/** Dry Flats **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,111,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,111,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,112,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,112,3);

/** Slaughterville **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,113,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,113,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,114,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,114,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,115,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,115,3);

/** The Dump **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,116,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,116,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,117,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,117,3);

/** New Gallows **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,118,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,118,3);

/** Waste Farm **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,119,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,119,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,119,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,120,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,120,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,120,3);

/** Park City **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,121,8);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (8,121,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (2,122,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (6,122,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (4,122,2);
/** Fender Gate **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (7,123,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,123,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,123,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,123,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (8,124,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (5,124,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,124,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (9,124,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (10,143,10);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (8,143,6);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (1,143,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (3,143,1);

/** BOSS CRAFTING MISSION INGREDIENTS **/
/** Crafting ingredient hookups **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (109,125,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (110,126,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,126,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (111,127,4);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (108,127,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (106,127,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (112,128,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (113,128,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,128,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (106,128,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (114,129,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (108,129,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,129,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (115,130,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (116,130,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (106,130,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,130,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (108,130,2);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (117,131,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (108,131,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (106,131,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,131,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (118,132,3);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (108,132,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (106,132,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,132,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (119,133,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (107,133,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (106,133,5);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (108,133,5);

/** BOSS Summon mission ingredient hookup **/
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (120,134,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (121,135,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (122,136,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (123,137,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (124,138,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (125,139,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (126,140,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (127,141,1);
INSERT INTO fw_mission_ingredient (itemid, missionid, quantity) VALUES (128,142,1);

/**
  * Town 1 - Trailer Park - Mission Rewards
  */
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (15,1,1,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,1,1,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (2,2,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (16,3,1, 60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,3,1, 40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,4,1, 80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,4,1, 20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (17,5,1, 70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,5,1, 30);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,7,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,7,1,80);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,8,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,8,1,80);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,9,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,9,1,80);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,10,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,10,1,80);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,11,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,11,1,80);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,12,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,12,1,80);

/**
  * Town 2 - Dry Flats - Mission Rewards
  */
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (1,13,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (19,14,1,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,14,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,16,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,16,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (21,17,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,17,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,19,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,19,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,20,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,20,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,21,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,21,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,22,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,22,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,23,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,23,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,24,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,24,1,80);

/** Town 3 - Slaughterville - Mission Rewards */
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (4,25,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,29,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,29,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,31,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (45,31,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,31,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (48,32,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,32,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,32,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (44,33,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,33,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,33,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (46,34,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,34,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,34,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (47,35,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,35,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,35,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (49,36,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,36,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,36,1,40);

/** Town 4 - The Dump - Mission Rewards **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (3,37,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,41,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,41,2,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (38,43,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,43,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,43,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (40,44,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,44,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,44,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (43,45,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,45,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,45,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (41,46,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,46,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,46,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (39,47,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,47,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,47,1,40);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (42,48,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,48,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,48,1,40);

/** Town 5 - New Gallows - Mission Rewards **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (5, 49,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,52,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,52,1,80);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (50,55,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,55,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (51,56,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,56,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (52,57,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,57,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (54,58,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,58,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (53,59,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,59,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (55,60,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,60,1,20);

/** Town 6 - Tinkersdam - Mission Rewards **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (6,61,1);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (63,62,1,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,62,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (62,63,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,63,1,30);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,66,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,66,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (57,67,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,67,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (61,68,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,68,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (59,69,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,69,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (60,70,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,70,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (58,71,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,71,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (56,72,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,72,1,20);

/** Town 7 - Waste Farm - Mission Rewards **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (7,73,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (71,75,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (72,76,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (74,77,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,75,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,76,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (105,77,1,30);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,78,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,78,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (70,79,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (70,80,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (70,81,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (70,82,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (70,83,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (70,84,1,45);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (68,79,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (68,80,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (68,81,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (68,82,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (68,83,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (68,84,1,45);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,79,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,80,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,81,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,82,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,83,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,84,1,10);

/** Town 8 - Park City - Mission Rewards **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (8, 85, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,90,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,90,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (81,91,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (79,92,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (82,93,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (80,94,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (78,95,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (83,96,1,45);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (45,91,5,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (48,92,5,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (44,93,5,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (46,94,5,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (47,95,5,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (49,96,5,45);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,91,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,92,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,93,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,94,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,95,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,96,1,10);

/** Town 9 - Fender Gate - Mission Rewards **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (10, 97, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,100,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,100,1,20);

INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (90, 103, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (91, 104, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (92, 105, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (93, 106, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (94, 107, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (95, 108, 1);

/** Crafting Rewards **/
/** Trailer Park **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (22, 109, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (23, 110, 1);

/** Dry Flats**/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (26, 111, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (24, 112, 1);

/** Slaughterville **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (30, 113, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (32, 114, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (27, 115, 1);

/** The Dump **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (31, 116, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (36, 117, 1);

/** New Gallows**/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (37, 118, 1);

/** Waste Farm **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (67, 119, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (70, 120, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (77, 121, 1);

/** Park City **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (69, 122, 1);

/** Fender Gate **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (96, 123, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (100, 124, 1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (97, 143, 1);

/** BOSS REWARDS **/
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (120,125,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (121,126,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (122,127,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (123,128,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (124,129,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (125,130,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (126,131,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (127,132,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity) VALUES (128,133,1);

INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,134,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,2,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,134,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,2,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,134,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,3,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,134,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,3,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,4,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,5,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,5,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,134,4,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,6,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,134,2,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,6,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,134,4,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,6,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,5,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,5,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,6,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (2,134,6,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,134,5,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,134,6,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,134,6,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,1,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,1,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,135,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,2,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,135,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,2,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,1,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,135,3,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,4,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,2,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,135,2,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,2,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,4,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,4,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,135,3,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,4,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,4,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,3,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,4,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,5,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (4,135,5,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,135,5,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,136,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,136,1,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,136,1,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,136,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,136,1,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,2,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,136,2,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (1,136,2,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,137,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,137,1,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,137,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,137,1,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,137,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,137,1,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,137,1,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,137,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,137,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,137,1,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,137,2,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,2,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,2,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,2,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,2,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,2,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,2,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,2,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,2,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,2,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,138,2,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,4,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,2,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,4,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,4,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,138,3,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,5,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,5,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,138,3,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,5,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,6,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,138,7,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,12,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,10,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,138,10,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,10,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,138,15,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,20,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (3,138,25,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (5,138,20,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,1,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,1,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,139,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,2,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,139,1,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,2,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,2,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,4,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,4,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,139,2,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,2,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,4,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,4,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,139,2,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,4,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,4,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,139,3,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,4,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,139,4,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (6,139,8,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,139,12,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,1,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,1,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,140,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,1,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,140,2,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,2,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,2,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,2,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,2,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,140,2,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,2,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,140,2,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,2,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,3,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,3,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,140,6,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,140,6,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,140,6,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,2,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,2,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,2,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,2,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,141,2,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,2,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,2,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,2,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,141,3,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,5,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,3,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,5,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,5,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,141,5,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,5,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,141,5,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,10,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,3,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,8,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,141,10,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (7,141,10,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,141,15,100);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,1);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,2);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,3);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,4);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,5);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,6);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,7);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,8);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,9);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,10);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,12);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,13);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,15);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,17);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,20);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,25);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,30);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,33);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,35);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,40);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,45);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,50);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,55);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,60);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,66);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,70);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (9,142,1,80);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (8,142,1,90);
INSERT INTO fw_mission_reward (itemid, missionid, quantity, chance) VALUES (10,142,1,100);

/** BOSS SUMMON ITEMS **/
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (1,125);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (2,126);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (3,127);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (4,128);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (5,129);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (6,130);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (7,131);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (8,132);
INSERT INTO fw_craft_summon_item (townid, missionid) VALUES (9,133);

/** BOSS SUMMON MISSIONS **/
INSERT INTO fw_summon_mission (townid, missionid) VALUES (1,134);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (2,135);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (3,136);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (4,138);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (5,137);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (6,139);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (7,140);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (8,141);
INSERT INTO fw_summon_mission (townid, missionid) VALUES (9,142);

/* Perks -- Order-sensitive list. DO NOT REORGANIZE */
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Refill Gamma", "Keep running missions by spending faction points.", 10, 1, "fp_refillgamma.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Refill Stamina", "Jump back into the fight by spending faction points", 10, 1, "fp_refillstamina.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Refill Health", "Player, heal thyself. Automatically buys you a full refill or  as many points as you can afford, whichever is greater.", 50, 1, "fp_refillhealth.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Buy achievement points", "Improve your stats. Get 10 AP.", 12, 1, "fp_buyachievementpoints.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Speed gamma recharge", "Recover 2 seconds faster after running missions. Can't go lower than 1:30.", 1, 1, "fp_speedgammarecharge.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Speed stamina recharge", "Recover 2 seconds faster after fights. Can't go lower than 1:30.", 1, 1, "fp_speedstaminarecharge.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Change faction", "Leave your friends, make new ones. Does not include respec of faction-related stats.", 20, 1, "fp_changefaction.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Change Name", "Change your character's name.", 15, 1, "fp_changename.jpg");
INSERT INTO fw_fp_perk (name, description, fp_price, perk_type, image) VALUES ("Character respec", "Reset your stats, get back all your AP and redistribute them.", 30, 1, "fp_characterrespec.jpg");