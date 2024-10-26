<?php
/**
  * Add and retrieve items from metrics database
  *
  * Metrics constants found in config.php
  *
  * @version 17 December 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 17 December 2009
  */

require_once('db_connect.php');
require_once('config.php');
//require_once('player.class.php');
//require_once('town.class.php');
//require_once('mission.class.php');
//require_once('faction.class.php');

class MetricsDatabase
{

    protected $db_util;

    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }

    /**
      * Increment counts for metrics
      *
      * Metrics types & params:
      * TIME_TO_LEVEL, player_level, time in seconds, num players
      *                (how much time it takes players to level)
      * CASH_ON_LEVEL, player_level, cash, num players
      *                (how much cash players have at a given level)
      * TOWN_TIME, townid, time in seconds, num turnovers
      *                (how much time between turnovers for a given town)
      * TOWN_FAC, factionid, time in seconds, num turnovers
      *                (how long a faction is in ownership of any town,
      *                 how long ownership lasts)
      *
      * @param $metricid Type of metric to update (in config.php)
      * @param $identifier Specific metric identifier (e.g. townid)
      * @param $param1 Value to add to existing value - In "avg" type metrics, 
                       this param should be the item to average, e.g. chips,
                       time, etc. This will be the dividend in the avg function.
      * @param $param2 Value to add to existing value - In "avg" type metrics,
                       this param should be the number of items counted, e.g. the
                       number of players counted, the number of times a town
                       has changed faction, etc. This will be the divisor in
                       the avg function.
      * @param $param3 Value to add to existing value
      */
    function update_metrics_item ($metricid, $identifier, $param1=0,
                                             $param2=0, $param3=0)
    {
        $query = 'INSERT INTO ' . METRICS . ' (metricid, identifier, param_one, 
                                               param_two, param_three) VALUES '
            . ' ( ' . $metricid . ', ' . $identifier . ', ' . $param1 . ', '
                   . $param2 . ', ' . $param3
            . ' ) ON DUPLICATE KEY UPDATE '
            . '  param_one   = param_one + ' . $param1
            . ', param_two   = param_two + ' . $param2
            . ', param_three = param_three + ' . $param3;

        $this->db_util->execute_query($query);
    }

    /**
      * Retrieve metrics values from database
      *
      * @param $metricid Type of metric to retrieve (in config.php)
      * @param $identifier Specific metric identifier (e.g. townid)
      *        If not specified, will return all metrics of type metricid
      * @return Assoc array with keys same as table headings
      */
    function retrieve_metric($metricid, $identifier='')
    {
        $query = 'SELECT * FROM ' . METRICS . ' WHERE metricid=' . $metricid;
        if(!empty($identifier))
        {
            $query .= ' AND identifier=' . $identifier;
        }
        $result = $this->db_util->execute_query($query);
        while($row=mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $data [] = $row;
        }

        return $data;
    }
    
    /**
      * Insert one player's level-up data into the database
      *
      * @param $player_level
      * @param $time How long it took to level
      */
    function set_time_to_level($player_level, $time)
    {
        $this->update_metrics_item(TIME_TO_LEVEL, $player_level, $time, 1);
    }
    
    /**
      * Insert one player's level-up data into database
      *
      * @param $player_level
      * @param $cash How much cash the player has at moment of level-up
      */
    function set_cash_on_level($player_level, $cash)
    {
        $this->update_metrics_item(CASH_ON_LEVEL, $player_level, $cash, 1);
    }
    
    /**
      * Track average time between faction turnover for a given town.
      * Uses current time as turnover moment
      *
      * @param $town town id
      */
    function set_town_win($townid)
    {
        $time = time();
        /*
        $old_time = 0;
        $query = 'SELECT param_three FROM ' . METRICS
            . ' WHERE metricid=' . TOWN_TIME
            . ' AND identifier=' . $townid;
        $result = $this->db_util->execute_query($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);

        $old_time = (empty($row['param_three']))
                       ? $time : $row['param_three'];
        $old_time = $row['param_three'];
        */
          //params: metric, townid(identifier),
          //        total(param_one), num turnovers(param_two),
          //        last time(param_three)
        $query = 'INSERT INTO ' . METRICS
               . ' (metricid, identifier, param_one, param_two, param_three) '
               . ' VALUES ('. TOWN_TIME .', '. $townid  . ', 0, 1, ' . $time .')'
               . ' ON DUPLICATE KEY UPDATE '
               . ' param_one=param_one+' . $time . '-param_three,'
               . ' param_two=param_two+1,'
               . ' param_three=' . $time;

        $this->db_util->execute_query($query);
        //return $query;
        //return 'done' . $time . ' old time=' . $old_time;
    }
    
    /**
      * Calculates average of given metric. If identifier is specified, only
      * that item is returned. Else, an array of all avg metrics matching $type
      * is returned.
      *
      * @param $type constant from config.php
      * @param $identifier specific identifier (e.g. player level)
      * @return array of averaged results w/ decimal values
      */
    function get_metric_avg($type, $identifier='')
    {
        $query = 'SELECT param_one, param_two, identifier FROM ' . METRICS
               . ' WHERE metricid=' . $type;
        
        if($identifier != '')
        {
            //only use this limiter if specified, otherwise get all
            $query .= ' AND identifier=' . $identifier;
        }

        $query .= ' ORDER BY identifier'; //sort in ascending order

        $result = $this->db_util->execute_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
              //calculate averages
            $avg[] = array( 'identifier' => $row['identifier'],
                            'avg' => ($row['param_one'] / $row['param_two']));
        }
        return $avg;
    }
}
?>