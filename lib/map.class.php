<?php
 /**
   * Displays map with links and other needed information
   *
   * @version 18 September 2009
   * @author Jason Cisarano jcisarano@icarusstudios.com
   *
   * @history
   *         created 26 August 2009
   *         add pvp map 18 September 2009
   *         add faction badges 25 September 2009
   *         add mouseover tooltips, lock icons 12 Oct 2009
   */

require_once('config.php');
require_once('db_access.php');
require_once('db_access_faction.php');
require_once('town.class.php');
require_once('faction.class.php');

class Map
{
    function __constructor()
    {}
    function __destructor()
    {}

    protected $map_filename = 'sector_map_modified.jpg'; //mod with fac logos
    protected $sector_map   = 'sector_map2.jpg'; //original
    
    protected $badge_z = 50;
    protected $note_z  = 100;

    /**
      * Get sector and town information from database,
      * generate XHTML for inclusion in mission page.
      *
      * @param $playerFac - factionid of current player
      * @param $playerLevel - determines which towns will be set
      *        as open for missions.
      * @return XHTML for inclusion in mission page with faux image
      *         map done with CSS
      */
    function draw_mission_map($playerFac, $playerLevel='1' )
    {
          //get sector and town info from db
        $db = new DatabaseAccess;
        $fac_db = new FactionDatabase;
        
        $factions = $fac_db->get_faction_info();
        $towns   = $db->get_town_info();

        $mishMap = '';

        foreach( $towns as $town )
        {
            $onclick = '';

            if( $town->town_level <= $playerLevel )
            {
                $onclick = 'showMissions(\''
                    . ROOT . HANDLER_PATH . 'get_missions.php\', '
                    . $town->id . ', ' . $playerFac . ', \''
                    . $town->name
                    . '\' );return false;';

                 //hitbox for town click
                $mishMap .= '<div id="' . $town->name .  '" align="center"'
                         . ' style="background:none;
                         cursor:pointer; outline:none;
                         text-align:center; vertical-align:middle;
                         position:absolute; top:' . $town->hit_y
                         . 'px; left:' . $town->hit_x . 'px;
                         z-index:' . $this->badge_z . '; padding:10px; border:none;"
                         onclick="' . $onclick . '" >'
                         . str_repeat("&nbsp;",5) .'</div>';
            }
            else
            {
                $mishMap .= '<div class="locked" align="center"'
                         . ' style="background-image:url(\''
                              . ROOT . IMG_PATH
                              . '/lock.gif\');
                              background-repeat: no-repeat;
                              background-position: top right;
                              cursor:default; outline:none;
                              text-align:center; vertical-align:middle;
                              position:absolute; top:' . $town->hit_y
                              . 'px; left:' . $town->hit_x . 'px;
                              z-index:100; padding:10px; border:none;"
                              onclick="" >' . str_repeat("&nbsp;",5)
                              .'<span class="tooltip">Locked until level '
                              . $town->town_level . '</span></div>';
            }

            if($town->owned)
            {
                $mishMap .= $this->insert_faction_badge(
                            $playerFac,
                            $town,
                            $factions[$town->owner_factionid],
                            $onclick);
            }
        }
        $mishMap .= '<img src="' . ROOT . IMG_PATH . 'sector_map2.jpg">';

        return $mishMap;
    }

    /**
      * Creates HTML for sector map specific to faction page
      * @param $playerFac player's factionid
      * @return html to display sector map with interface
      */
    function draw_faction_map($playerFac)
    {
          //get sector and town info from db
        $db = new DatabaseAccess;
        $fac_db = new FactionDatabase;

        $factions = $fac_db->get_faction_info();
        $towns   = $db->get_town_info();

        $facMap = '';

        foreach( $towns as $town )
        {
            $onclick = 'showTownInfo(\''
                          . ROOT . HANDLER_PATH . 'get_factions.php\', '
                          . $town->id.', ' . $playerFac . ', \''
                          . $town->name
                          . '\');return false;';

            $facMap .= '<div id="' . $town->name .  '" align="center"'
                     . ' style="background:none; cursor:pointer; outline:none;
                          text-align:center; vertical-align:middle;
                          position:absolute; top:' . $town->hit_y
                          . 'px; left:' . $town->hit_x . 'px;
                          z-index:' . $this->badge_z . '; padding:10px; border:none;"
                          onclick="' . $onclick . '" >'
                          . str_repeat("&nbsp;",5) .'</div>';
            if($town->owned)
            {
                $facMap .= $this->insert_faction_badge(
                            $playerFac,
                            $town, 
                            $factions[$town->owner_factionid],
                            $onclick);
            }
        }

        $facMap .= '<img src="' . ROOT . IMG_PATH . 'sector_map2.jpg">';
        return $facMap;
    }

    /**
      * Generates HTML to make sector map specific for merchant.
      *
      * @param $playerFac player's factionid
      * @param $playerLevel player's current level, default = 1
      * @return html to display sector map with clickable towns
      */
    function draw_item_map($playerFac, $playerLevel='1')
    {
            //get sector and town info from db
        $db = new DatabaseAccess;
        $fac_db = new FactionDatabase;
        
        $factions = $fac_db->get_faction_info();
        $towns   = $db->get_town_info();

        $itemMap = '';

        foreach( $towns as $town )
        {
            $onclick = '';
            if( $town->town_level <= $playerLevel )
            {
                $onclick = 'showItems(\''
                    . ROOT . HANDLER_PATH . 'get_items.php\', '
                    . $town->id . ', ' . $playerFac . ', \''
                    . $town->name
                    . '\');return false;';

                $itemMap .= '<div id="' . $town->name .  '" align="center"'
                    . ' style="background:none;
                    cursor:pointer; outline:none;
                    text-align:center; vertical-align:middle;
                    position:absolute; top:' . $town->hit_y
                    . 'px; left:' . $town->hit_x . 'px;
                    z-index:' . $this->badge_z . '; padding:10px; border:none;"
                    onclick="' . $onclick . '" >'
                    . str_repeat("&nbsp;",5) .'</div>';

            }
            else
            {
                $itemMap .= '<div class="locked" align="center"'
                     . ' style="background-image:url(\''
                              . ROOT . IMG_PATH
                              . '/lock.gif\');
                     background-repeat: no-repeat;
                     background-position: top right;
                     cursor:default; outline:none;
                     text-align:center; vertical-align:middle;
                     position:absolute; top:' . $town->hit_y
                     . 'px; left:' . $town->hit_x . 'px;
                     z-index:100; padding:10px; border:none;"
                     onclick="" >' . str_repeat("&nbsp;",5) 
                     .'<span class="tooltip">Locked until level '
                              . $town->town_level . '</span></div>';
            }

            if($town->owned)
            {
                $itemMap .= $this->insert_faction_badge(
                            $playerFac,
                            $town, 
                            $factions[$town->owner_factionid],
                            $onclick);
            }
        }

        $itemMap .= '<img src="' . ROOT . IMG_PATH . 'sector_map2.jpg">';

        return $itemMap;
    }
    
    /**
      * Creates html to display pvp-specific sector map.
      *
      * @param $userid player's fb userid
      * @param $playerFac player's factionid
      * @param $playerLevel player's current level. Default = 1
      * @return html to display sector map with clickable towns
      */
    function draw_pvp_map($userid, $playerFac, $playerLevel='1')
    {
        
            //get sector and town info from db
        $db = new DatabaseAccess;
        $fac_db = new FactionDatabase;
        
        $factions = $fac_db->get_faction_info();
        $towns   = $db->get_town_info();

        $pvpMap = '';
        
        foreach( $towns as $town )
        { 
            $onclick = '';

            if( $town->town_level <= $playerLevel )
            {
                $onclick = 'showOpponents(\''
                         . ROOT . HANDLER_PATH . 'get_opponents.php\', '
                         . $town->id . ', ' . $playerFac . ', '
                         . $userid . ', '
                         . $playerLevel . ', \''
                         . $town->name
                         . '\');return false;';

                $pvpMap .= '<div id="' . $town->name .  '" align="center"'
                     . ' style="background:none;
                     cursor:pointer; outline:none;
                     text-align:center; vertical-align:middle;
                     position:absolute; top:' . $town->hit_y
                     . 'px; left:' . $town->hit_x . 'px;
                     z-index:' . $this->badge_z . '; padding:10px; border:none;"
                     onclick="' . $onclick . '" >' . str_repeat("&nbsp;",5) .'</div>';
            }
            else
            {
                $pvpMap .= '<div class="locked" align="center"'
                     . ' style="background-image:url(\''
                              . ROOT . IMG_PATH
                              . '/lock.gif\');
                     background-repeat: no-repeat;
                     background-position: top right;
                     cursor:default; outline:none;
                     text-align:center; vertical-align:middle;
                     position:absolute; top:' . $town->hit_y
                     . 'px; left:' . $town->hit_x . 'px;
                     z-index:100; padding:10px; border:none;"
                     onclick="" >' . str_repeat("&nbsp;",5) 
                     .'<span class="tooltip">Locked until level '
                              . $town->town_level . '</span></div>';
            }

            if($town->owned)
            {
                $pvpMap .= $this->insert_faction_badge(
                            $playerFac,
                            $town, 
                            $factions[$town->owner_factionid],
                            $onclick);
            }
        }

        $pvpMap .= '<img src="' . ROOT . IMG_PATH . 'sector_map2.jpg">';

        return $pvpMap;
    }
    
    function draw_crafting_map($playerFac, $playerLevel='1')
    {
          //get sector and town info from db
        $db = new DatabaseAccess;
        $fac_db = new FactionDatabase;

        $factions = $fac_db->get_faction_info();
        $towns   = $db->get_town_info();

        $map = '';

        foreach( $towns as $town )
        {
            $onclick = '';
            if( $town->town_level <= $playerLevel )
            {
                $onclick = 'showRecipes(\''
                    . ROOT . HANDLER_PATH . 'get_recipes.php\', '
                    . $town->id . ', ' //. $playerFac . ', \''
                    . '\'' . $town->name
                    . '\' );return false;';

                 //hitbox for town click
                $map .= '<div id="' . $town->name .  '" align="center"'
                         . ' style="background:none;
                         cursor:pointer; outline:none;
                         text-align:center; vertical-align:middle;
                         position:absolute; top:' . $town->hit_y
                         . 'px; left:' . $town->hit_x . 'px;
                         z-index:' . $this->badge_z . '; padding:10px; border:none;"
                         onclick="' . $onclick . '" >'
                         . str_repeat("&nbsp;",5) .'</div>';
            }
            else
            {
                $map .= '<div class="locked" align="center"'
                         . ' style="background-image:url(\''
                              . ROOT . IMG_PATH
                              . '/lock.gif\');
                              background-repeat: no-repeat;
                              background-position: top right;
                              cursor:default; outline:none;
                              text-align:center; vertical-align:middle;
                              position:absolute; top:' . $town->hit_y
                              . 'px; left:' . $town->hit_x . 'px;
                              z-index:100; padding:10px; border:none;"
                              onclick="" >' . str_repeat("&nbsp;",5)
                              .'<span class="tooltip">Locked until level '
                              . $town->town_level . '</span></div>';
            }

            if($town->owned)
            {
                $map .= $this->insert_faction_badge(
                            $playerFac,
                            $town,
                            $factions[$town->owner_factionid],
                            $onclick);
            }
        }
        $map .= '<img src="' . ROOT . IMG_PATH . 'sector_map2.jpg">';

        return $map;

    }

    /**
      * Takes info from faction and town object and converts it to
      * html for display in sector maps.
      *
      * @param $playerFac player's faction id
      * @param $town town object for this town
      * @param $faction faction object for faction owner of town
      * @param $onclick text to add to onclick function for the badge
      * @return html ready for inclusion in image map
      */
    function insert_faction_badge($playerFac, $town, $faction, $onclick="")
    {
        $badge_info = $this->get_badge_info($town, $playerFac);
        if($playerFac == $faction->id)
        {
            $tooltip = $badge_info['text'];
        }
        else
        {
            $tooltip = $badge_info['text'];
            //$tooltip = 'Your faction: '
            //       . $town->get_faction_score($playerFac)
            //       . ' influence';
        }
                  //faction icon
        return '<div class="badge" align="center"'
             . ' style="background-image:url(\''
                   . ROOT . FAC_IMG_PATH
                   . $faction->thumb . '\');
              cursor:default; outline:none;
              text-align:center; vertical-align:middle;
              position:absolute; top:' . $town->img_y
              . 'px; left:' . $town->img_x . 'px;
              z-index:' . $this->badge_z . '; padding:10px; border:'
                                         . $badge_info['color'] . ';"
              onclick="' . $onclick . '" >'
                   . str_repeat("&nbsp;",5)
                   .'<span class="tooltip" style="z-index:' 
                           . $this->note_z . ';">'
                   . $tooltip . '</span></div>';
    }
    
    /**
      * Look at faction point values for a town and determine what color border
      *      to apply to the map based on faction standings
      *
      * @param $town Town object in question
      * @param $playerFac faction id of current player
      */
    function get_badge_info($town, $playerFac)
    {
        $color = '2px solid ';
        $text  = '';
        $max = max( $town->chota_score,
                    $town->enforcer_score,
                    $town->lightbearer_score,
                    $town->tech_score,
                    $town->traveler_score,
                    $town->vista_score );

        switch($playerFac)
        {
            case 1:
                 $playerFacPoints = $town->chota_score;
                 break;
            case 2:
                 $playerFacPoints = $town->enforcer_score;
                 break;
            case 3:
                 $playerFacPoints = $town->lightbearer_score;
                 break;
            case 4:
                 $playerFacPoints = $town->tech_score;
                 break;
            case 5:
                 $playerFacPoints = $town->traveler_score;
                 break;
            case 6:
                 $playerFacPoints = $town->vista_score;
                 break;
        }

          //three possible cases, use thirds
        if($playerFac == $town->owner_factionid)
        {
              //player's faction already owns the town
            $color .= '#228b22'; //green
            $text = 'Your faction owns ' . $town->name . '.';
        }
        else if($max <= 0)
        {
            //no one has any faction in this town
            $color .= '#8b8989'; //gray
            $text = 'No faction has the lead in ' . $town->name . '.';
        }
        else if($playerFacPoints == $max)
        {
              //player faction is the leader
            $color .= '#fff'; //white
            $text = 'Your faction is in the lead.';
        }
        else if($playerFacPoints <= $max/3)//bottom third
        {
            //player's faction is less than 1/3 of the top faction
            $color .= '#b22222'; //firebrick red
            $text = 'Your faction will have to work hard to catch up.';
        }
        else if($playerFacPoints <= 2*($max/3)) //middle third
        {
            //player's faction is between 1/3 and 2/3 of the top faction
            $color .= '#ff8c00'; //orange
            $text = 'Your faction still has a chance. Rally your friends and 
                          take over ' . $town->name . '!';
        }
        else      //top third
        {
            //player's faction is within 1/3 of the top faction
            $color .= '#ffd700'; //yellow
            $text = 'Your faction is neck and neck with the leader.';
        }
        
        //$text .= ' playerfacpt=' . $playerFacPoints . ' max=' . $max;
        //$text .= ' playerfac=' . $playerFac . ' townfac=' . $town->owner_factionid;
        
        return array('color'  => $color,
                     'text'   => $text);
    }
}
?>
