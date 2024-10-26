/**
  * Scripts that implement the three stat recharge timers.
  * @version 8 December 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 20 November 2009
  *                 8 December 2009 - added fix for timer reset on every call
  **/

  //gamma timer
var g_timer_on = false; //is this timer running
var g_timer    = null;  //timer object
var g_time     = 0;     //current time

  //stamina timer
var s_timer_on = false;
var s_timer    = null;
var s_time     = 0;

  //health timer
var h_timer_on = false;
var h_timer    = null;
var h_time     = 0;

  //town timer
var t_timer_on = false;
var t_timer    = null;
var t_time     = 0;

  //boss timer
var b_timer_on = false;
var b_timer    = null;
var b_time     = 0;


/**
  *@param time - current time on counter in seconds -- used as start time and
  *              update time
  *@param div - div to update with this time
  */
function set_gamma_timer(time, timerLoc)
{
     if(g_timer_on)
     {
           //update existing timer
         g_time -=1;
         time = g_time;
           //clear timer to avoid two running simultaneously
         clearTimeout( g_timer );      }
     else
     {
         g_timer_on = true;
         g_time = time; //initialize
         //don't update time the first time
     }



     if (time < 0)
     {
         //timer has run out
        g_timer_on = false;


        //var dialog = new Dialog().showMessage("countdown complete", "done");

        //update database via ajax
        var ajax = new Ajax();
        ajax.responseType = Ajax.JSON;
        ajax.requireLogin = 1;
        ajax.ondone = function(data)
        {
            //var dialog = new Dialog().showMessage(data.newval, data.countagain);
              //update display with new stat value as determined by db
            document.getElementById("playerData").setInnerXHTML(data.playerstats);
            //determine if we need to count again based on return from db
            if(data.countagain)
            {
                refresh_timer(data.time, timerLoc)
            }
        }
        var params={"type":timerLoc, "playerid":playerid};
        ajax.post(statHandler, params);


     }
     else
     {
           //create output
         var min = Math.floor( time / 60);
         var sec = time % 60;
         if (sec < 10)
         {
             sec = "0" + sec;
         }
         var out = min + ':' + sec;

         document.getElementById( timerLoc ).setInnerXHTML("<span>"+out+"</span>");

         //set next timer
         g_timer =  refresh_timer(time, timerLoc);
     }
}

/**
  *@param time - current time on counter in seconds -- used as start time and
  *              update time
  *@param div - div to update with this time
  */
function set_stam_timer(time, timerLoc)
{
     if(s_timer_on)
     {
           //update existing timer
         s_time -= 1;
         time = s_time;
           //clear timer to avoid two running simultaneously
         clearTimeout( s_timer );      }
     else
     {
         s_timer_on = true;
         s_time = time; //initialize
         //don't update time the first time
     }



     if (time < 0)
     {
         //timer has run out
        s_timer_on = false;


        //var dialog = new Dialog().showMessage("countdown complete", "done");

        //update database via ajax
        var ajax = new Ajax();
        ajax.responseType = Ajax.JSON;
        ajax.requireLogin = 1;
        ajax.ondone = function(data)
        {
            //var dialog = new Dialog().showMessage(data.newval, data.countagain);
              //update display with new stat value as determined by db
            document.getElementById("playerData").setInnerXHTML(data.playerstats);
            //determine if we need to count again based on return from db
            if(data.countagain)
            {
                refresh_timer(data.time, timerLoc)
            }
        }
        var params={"type":timerLoc, "playerid":playerid};
        ajax.post(statHandler, params);


     }
     else
     {
           //create output
         var min = Math.floor( time / 60);
         var sec = time % 60;
         if (sec < 10)
         {
             sec = "0" + sec;
         }
         var out = min + ':' + sec;

         document.getElementById( timerLoc )
                                  .setInnerXHTML("<span>"+out+"</span>");
         document.getElementById( timerLoc ).setStyle('color', '#d27111');

         //set next timer
         s_timer =  refresh_timer(time, timerLoc);
     }
}             

function set_health_timer(time, timerLoc)
{
     if(h_timer_on)
     {
           //update existing timer
         h_time -= 1;
         time = h_time;
           //clear timer to avoid two running simultaneously
         clearTimeout( h_timer );      }
     else
     {
         h_timer_on = true;
         h_time = time;
         //don't update time the first time
     }



     if (time < 0)
     {
         //timer has run out
        h_timer_on = false;


        //var dialog = new Dialog().showMessage("countdown complete", "done");

        //update database via ajax
        var ajax = new Ajax();
        ajax.responseType = Ajax.JSON;
        ajax.requireLogin = 1;
        ajax.ondone = function(data)
        {
              //update display with new stat value as determined by db
            document.getElementById("playerData")
                    .setInnerXHTML(data.playerstats);
            
            //determine if we need to count again based on return from db
            if(data.countagain)
            {
                refresh_timer(data.time, timerLoc)
            }
        }
        var params={"type":timerLoc, "playerid":playerid};
        ajax.post(statHandler, params);

     }
     else
     {
           //create output
         var min = Math.floor( time / 60);
         var sec = time % 60;
         if (sec < 10)
         {
             sec = "0" + sec;
         }
         var out = min + ':' + sec;

         document.getElementById( timerLoc )
                 .setInnerXHTML( "<span>" + out + "</span>" );
         document.getElementById( timerLoc ).setStyle('color', '#e5bc75');

         //set next timer
         h_timer =  refresh_timer(time, timerLoc);
     }
}

function set_town_timer(time, timerLoc)
{
     if(t_timer_on)
     {
           //update existing timer
         t_time -= 1;
         time = t_time;
           //clear timer to avoid two running simultaneously
         clearTimeout( t_timer );
     }
     else
     {
         t_timer_on = true;
         t_time = time;
         //don't update time the first time
     }

     if (time < 0)
     {
         //timer has run out
        t_timer_on = false;

        //var dialog = new Dialog().showMessage("countdown complete", "done");

        showFactions(currTownId, playerid, mapType, oldTown);
     }
     else
     {
           //create output
         var min = Math.floor( time / 60);
         var sec = time % 60;
         if (sec < 10)
         {
             sec = "0" + sec;
         }
         var out = min + ':' + sec;

         document.getElementById( timerLoc )
                 .setInnerXHTML("<span>"+out+"</span>");

         //set next timer
         t_timer =  refresh_timer(time, timerLoc);
     }
}

function set_boss_timer(time, timerLoc)
{
     if(b_timer_on)
     {
           //update existing timer
         b_time -= 1;
         time = b_time;
           //clear timer to avoid two running simultaneously
         clearTimeout( t_timer );
     }
     else
     {
         b_timer_on = true;
         b_time = time;
         //don't update time the first time
     }

     if (time < 0)
     {
         //timer has run out
        b_timer_on = false;

        //var dialog = new Dialog().showMessage( "boss countdown complete", 
                                                 //"done");
        document.getElementById( timerLoc )
                 .setInnerXHTML("<span>Timed out</span>");
        //showFactions(currTownId, playerid, mapType, oldTown);
     }
     else
     {
           //create output
         var hour = Math.floor( time / 3600);
         var min  = Math.floor( (time - hour * 3600) / 60);
         if (min < 10)
         {
             min = "0" + min;
         }
         var sec  = time % 60;
         if (sec < 10)
         {
             sec = "0" + sec;
         }
         var out = hour + ':' + min + ':' + sec;

         document.getElementById( timerLoc )
                 .setInnerXHTML("<span>"+out+"</span>");

         //set next timer
         b_timer =  refresh_timer(time, timerLoc);
     }
}

/**
  * Set timer helper for set_recharge_timer()
  */
function refresh_timer(time, timerLoc)
{
     //timers currently set to wait just a bit longer than 1 second
    if(timerLoc=='gamTimer')
    {
        return setTimeout(function() {set_gamma_timer(time, timerLoc)}, 1050);
    }
    else if(timerLoc == 'stamTimer')
    {
        return setTimeout(function() {set_stam_timer(time, timerLoc)}, 1050);
    }
    else if(timerLoc == 'healthTimer')
    {
        return setTimeout(function() {set_health_timer(time, timerLoc)}, 1050);
    }
    else if(timerLoc == 'townTimer')
    {
        return setTimeout(function() {set_town_timer(time, timerLoc)}, 1050);
    }
    else if(timerLoc == 'bossTimer')
    {
        return setTimeout(function() {set_boss_timer(time, timerLoc)}, 1050);
    }
}

/**
  * Sets value
  */
function update_stat(item, loc)
{
}