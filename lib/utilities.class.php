<?php

class Utilities
{
    public function __construct()
    {
    }
    
    /**
       * Determines an item's attack and defense bonuses based on player's
       * mastery level with that item.
       *
       * @param $item standard item array from get_player_inventory,
       *              get_item_info -- must include 'mastery' column along with
       *              bonus info columns
       * @return assoc array of attack and defense bonuses:
       *         {attack, defense}
       */
    function get_bonus($item)
    {
        $attack  = 0;
        $defense = 0;
        switch((int)$item['mastery'])
        {
            case 0:
            case null:
                 $attack  = $item['attack_bonus_one'];
                 $defense = $item['defense_bonus_one'];
                 break;
            case 1:
                 $attack  = $item['attack_bonus_two'];
                 $defense = $item['defense_bonus_two'];
                 break;
            case 2:
                 $attack  = $item['attack_bonus_three'];
                 $defense = $item['defense_bonus_three'];
                 break;
            default:
                   //error case - should be one of the other options
                 $attack  = $item['attack_bonus_one'];
                 $defense = $item['defense_bonus_one'];
                 break;
        }

        return array ('attack'  => $attack,
                      'defense' => $defense);
    }
    
    /**
      * Determine which game string to display based on the boss's current hp.
      *
      * @param $gamestrings Array of gamestrings for this fight
      * @param $fight Assoc array data about current fight. Keys match column
      *        headings.
      */
    function get_description($gamestrings, $fight)
    {
        $count = count($gamestrings);
        $interval = $fight['boss_start_hp'] / ($count-1);

        for($i=0; $i<$count; $i++)
        {
            $threshold = ($fight['boss_start_hp'] - ($interval * $i));
            if($fight['boss_hp'] <= $threshold)
            {
                $desc = 'interval=' . $interval . ' threshold='. $threshold
                                    . ' i=' . $i . '<br />';
                $desc = $gamestrings[$i]['gamestring'];
            }
        }

        return $desc;
    }
    
    /**
      * Checks if number is plural, returns s if true
      *
      * @param $number
      * @param $use_e if true, adds e to return. Default = false
      *
      * @param return plain text, either 's' or 'es'
      */
    function get_plural($number, $use_e='0')
    {
        if($use_e==true)
        {
            return $number==1 ? '' : 'es';
        }
        else
        {
            return $number==1 ? '' : 's';
        }
    }
}
?>