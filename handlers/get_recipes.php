<?php
/**
  * Crafting recipe backend script. Grabs crafting items and ingredients from
  * mission list in db, returns markup for inclusion in web page.
  *
  * @version 14 December 2009
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 14 December 2009
  */

require_once('../lib/config.php');
require_once('../' . LIB_PATH . '/db_access.php');
require_once('../' . LIB_PATH . '/db_access_player.php');

$db        = new DatabaseAccess;
$player_db = new PlayerDatabase;

$townid=0;
$player_id=0;
$output = '';

if(isset($_POST['townid']))
{
 $townid = $_POST['townid'];
}

if(isset($_POST['p_id']))
{
 $player_id = $_POST['p_id'];
}

//$recipes = $db->get_crafting_missions( $townid, $player_id );
$recipes        = $db->get_crafting_missions( $townid );
$summon_recipes = $db->get_summon_crafting_missions( $townid );
$town           = $db->get_town_info( $townid );

$output .= '<br /><h1 style="text-align:center;">Crafting recipes available
               in ' . $town[$townid]->name . '</h1><br />';

if($recipes || $summon_recipes)
{
    if($recipes)
    {
        foreach( $recipes as $recipe)
        {
            $output .= parse_recipe($recipe);
        }
    }
    if($summon_recipes)
    {
        foreach( $summon_recipes as $recipe)
        {
            $output .= parse_recipe($recipe, 1);
        }
    }
}
else
{
    $output .= '<p>No crafting available in this town.</p>';
}
echo $output;

/**
  * Parses a recipe item into usable HTML. Includes support for summon crafting
  * items.
  *
  * @param $recipe Recipe info from database, i.e get_summon_crafting_missions
  *        or get_crafting_missions.
  * @param $is_summon Set to 1 if the recipe item is of the special type that
  *        creates an item for the summoning/co-op battle system. Default value
  *        is 0.
  */
function parse_recipe($recipe, $is_summon='0')
{
    global $player_db;
    global $player_id;
    global $townid;

    $r_out = '<div class="recipe"><div class="recipeText">'
            . '<h1>' . $recipe->title . '</h1>'
            . '<p>' . $recipe->description . '';

    $r_out .= '<br/>Requires ' . $recipe->energy_drain
            . ' stamina and awards ' . $recipe->xp_min . ' - '
            . $recipe->xp_max . ' xp.</p></div>';
            
    $r_out .= '<div class="recipeButtonCol">
                <input type="submit" value="Craft Item"
                                     class="fwButton"
                                     onclick="craftItem(\''
                                          . ROOT . HANDLER_PATH
                                          . '/crafting_handler.php\', '
                                           . $player_id
                                          . ', ' . $recipe->id
                                          . ', ' . $townid
                                          . ');return false;" /></div>';
                                          
    $r_out .= '<div class="fwClear"></div>';

      //ingredients
    if($recipe->ingredients)
    {
        foreach($recipe->ingredients as $ingred)
        {
            $player_has = $player_db->player_has_item($player_id,
                                                   $ingred['itemid'],
                                                   $ingred['quantity']);

            if($player_has < $ingred['quantity'])
            {
                $class = 'insufficient';
            }
            else
            {
                $class = 'complete';
            }

            $r_out .= '<div class="ingredCol"><span class="' . $class . '">'
                    . '<img src="' . ROOT . ITEM_PATH
                                   . $ingred['image'] .'"'
                    . ' title="' . $ingred['name']
                    . ' - Need ' . $ingred['quantity'] . ' (Have: '
                    . max(0,$player_has)
                    . ')">'
                    . '</span></div>';
        }
    }
        //display rewards
    if($recipe->treasure_table)
    {
        foreach($recipe->treasure_table as $treasure)
        {
            $r_out .= '<div class="rewardCol">'
                . '<img src="' . ROOT . ITEM_PATH
                                   . $treasure['image'] .'"'
                    .' title="Receive ' . $treasure['name']
                    . ' x' . $treasure['quantity'] . '">'
                . '</div>';
        }
    }

    $r_out .= '</div>';
    
    return $r_out;
}
?>