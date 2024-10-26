<?php
/**
  * Helper methods for buying items/services with faction points
  * @version 19 October 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 19 October 2009
  *         23 April 2010 mod get_perks to use table column heads as array keys
  */

require_once('db_connect.php');
//require_once('player.class.php');
//require_once('town.class.php');
//require_once('mission.class.php');
//require_once('faction.class.php');

class FacPointDatabase
{

    protected $db_util;

    public function __construct()
    {
        $this->db_util = new DatabaseUtilities;
    }
/*
    function buy_item_fp($userid, $itemid, $quantity=1)
    {
        //get price, player current fb
        $query = 'SELECT faction_points, fp_price FROM ' . PLAYER_STATS . ', '
             . FAC_ITEM . ' WHERE ' . PLAYER_STATS . '.useridid=' . $userid . ' AND '
             . FAC_ITEM . '.itemid=' . $itemid;
          //make sure player has enough fp
        //update player inventory
        //deduct fp
    
    }
*/
    /**
      * Get list of currently available fp items
      * If townid or factionid specified, returns only items associated 
      * with them.
      *
      * @param $townid Not required
      * @param $factionid Not required
      * @return array of items or null if none found
      *
      */
    function get_fp_items($itemid=0, $factionid=0, $townid=0)
    {

        $query = 'SELECT ' . ITEM . '.*, ' . FAC_ITEM . '.fp_price FROM '
            . ITEM . ', ' . FAC_ITEM . ' WHERE ' . ITEM . '.id=' . FAC_ITEM
            . '.itemid AND available=1';

        if($itemid != 0)
        {
            $query .= ' AND ' . FAC_ITEM . '.itemid=' . $itemid;
        }
        if($factionid != 0)
        {
            $query .= ' AND ' . FAC_ITEM . '.factionid=' . $factionid;
        }
        if($townid != 0)
        {
            $query .= ' AND ' . FAC_ITEM . '.townid=' . $townid;
        }

        $result = $this->db_util->execute_query($query);

        while( $row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $items[] = $row;
        }

        return (isset($items) ? $items : null);
    }

    /**
      * Get list of perks the player can purchase for faction points
      *
      * @param $perkid if specified, returns details of only that perk
      * @return assoc array of perks:
      *               {id, name, description, fp_price}
      */
    function get_perks($perkid=0)
    {
        $perk = null;
        $query = 'SELECT * FROM ' . PERK ;
        if($perkid != 0)
        {
            $query .= ' WHERE id=' . $perkid;
        }
        $result = $this->db_util->execute_query($query);

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $perks[] = $row;
        }
        return $perks;
    }

    /**
      * Adds item to player's inventory
      * Does not update player's fp holdings
      *
      * @param $userid players fb user id
      * @param $itemid id of item to give
      * @param $quantity
      * @return
      */
    function give_fp_item($userid, $itemid, $quantity)
    {
        $query = 'INSERT INTO ' . PLAYER_INV 
            . ' (userid, itemid, quantity) VALUES (' . $userid . ', ' . $itemid
            . ', ' . $quantity . ') ON DUPLICATE KEY UPDATE quantity=quantity+'
            . $quantity;
        $this->db_util->execute_query($query);
    }

}
?>