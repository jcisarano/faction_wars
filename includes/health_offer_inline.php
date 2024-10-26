<?php
/**
  * In-line include that will display health point purchase option if player isn't already
  *         at max health.
  *
  * Expects these items:
  *         $player initted with data for active player
  *         config.php loaded
  *
  * Uses:
  *         vars have ho_ prefix to avoid conflicts
  *
  * @version 26 April 2010
  * @author Jason Cisarano jcisarano@icarusstudios.com
  *
  * @history
  *         created 26 April 2010
  */
$ho_output = '';
if($player->current_health < $player->max_health)
{
    $ho_output = '<div id="healthOffer"><div class="perk">';
    $d_health = $player->max_health - $player->current_health;
    $per_point = $player->level * HEALTH_POINT_COST;
    $ho_output .= 'Refill your health for ' . $per_point
                                            . ' chips per health point.';
    $ho_output .= '<input type="submit"
                          value="Recharge health"
                          class="fwButton"
                          onclick="purchaseHealth();return false;" />';
    $ho_output .= '</div></div>';

    $ho_output .= '<script>
        <!--
        function purchaseHealth()
        {
            showLoadscreen();
            var url = "' . ROOT . HANDLER_PATH . '/health_purchase_handler.php";
            document.getElementById("healthOffer")
                    .setInnerXHTML("<span></span>");
            
            var ajax = new Ajax();
            ajax.responseType = Ajax.JSON;
            ajax.requireLogin = 1;
            
            ajax.ondone = function(data)
            {
                document.getElementById("healthOffer")
                    .setInnerFBML(data.fbml_body);
                document.getElementById("playerData")
                    .setInnerXHTML(data.player_stats);
                //need to reset stam, gamma timers?
                hideLoadscreen();
            }
            
            var params ={"p_id":"' . $player->userid . '"};
            ajax.post(url, params);

        }
        //--></script>';
}
return $ho_output;
?>