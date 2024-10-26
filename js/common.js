/**
  * Javascript functions shared across multiple pages in Faction Wars
  *
  * @version 15 November 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 15 November 2009
  */

/**
  * Sets display value on div with id "loadscreen"
  */
function showLoadscreen()
{
    document.getElementById("loadscreen")
                     .setStyle("display", "inline");
}

function hideLoadscreen()
{
    document.getElementById("loadscreen")
                     .setStyle("display", "none");
}

function showPopup(popup)
{
    document.getElementById(popup)
                     .setStyle("display", "inline");
}

function hidePopup(popup)
{
    document.getElementById(popup)
                     .setStyle("display", "none");
}


/**
  * Uses facebook animation to show passed-in object
  */
function showAnim(obj)
{
    Animation(obj).to("height", "auto").from("0px")
                  .show().go();
}
function hideAnim(obj)
{
    Animation(obj).to("height", "0px").hide().go();
}

/**
  * Update placement of player location icon on map.
  * @param oldLoc name of div where icon currently located
  * @param newLoc name of div where the icon will move to
  * @param img absolute path to icon image as string
  */
function setPlayerLocation(oldLoc, newLoc, img)
{
    document.getElementById(oldLoc).setStyle("backgroundImage","none");
    document.getElementById(newLoc).setStyle
            ({backgroundImage: "url("+img+")", backgroundRepeat: "no-repeat",
                               backgroundPosition: "top left" });
}

/**
  * Get current faction standings and post to screen.
  *
  * @param townid current town id from db
  * @param playerid Current player facebook id
  * @param mapType mission/merchant/crafting/pvp/faction used in get_factions
  * @param townName
  */
function showFactions(townid, playerid, mapType, townName)
{
    var ajax = new Ajax();
    ajax.responseType = Ajax.JSON;
    ajax.requireLogin = 1;
    ajax.ondone = function(data) {
        document.getElementById( "facPanels" )
                .setInnerXHTML(data.standings);
        document.getElementById( "facStandingsTitle" )
                .setInnerXHTML("<h1>" + data.town_name
                                      + " is controlled by the "
                                      + data.faction_name
                                      + "</h1>");
        t_timer_on = false;
        set_town_timer(data.count_time, "townTimer");
        if(data.new_map)
        {
            document.getElementById("map").setInnerFBML(data.fbml_map);
            setPlayerLocation(oldTown, townName, "" + imgPath
                                                    + "/player_icon2.png");
        }
    }

    var params={"townid":townid, "playerid":playerid, "type":mapType};
    var url = handlerPath + "/get_factions.php";
    //var url = "http://jcisarano.com/faction_wars/handlers/get_factions.php";
    ajax.post(url, params)
} 

/**
  * Prompts database to update faction town ownership as needed
  *
  *@param handler_url path to handlers
  *
  */
function updateStandings(handler_url, townid)
{
    var ajax = new Ajax();
    ajax.responseType = Ajax.JSON;
    ajax.requireLogin = 1;
    ajax.ondone = function(data) {}

    var params={"townid":townid};
    var url = handler_url + "town_ownership_handler.php";
    ajax.post(url, params);
}

/**
  * Publish a message to the current user's stream. Includes by default a 
  * brief description of FE along with a link to www.fallenearth.com.
  *
  * @param messageTitle Descriptive title of this post
  * @param messageLink Link useful to this particular post (probably to the 
  *                    app or some part of it)
  * @param caption The text to be included in the message.
  */
function post(messageTitle, messageLink, caption)
{
    var action_link = {"Fallen Earth" : "http://www.fallenearth.com"};
    var prompt = "Personalize your message:";
    var attachments = {"name": "Fallen Earth Faction Wars",
                       "href": "' . CANVAS_PATH . '",
                       "description": "Fallen Earth is an MMO set in a post-apocalyptic wasteland where six factions struggle for dominance. To learn more, visit www.fallenearth.com.",
                       "caption": caption};
    Facebook.streamPublish("", attachments, action_link, null, prompt );
}