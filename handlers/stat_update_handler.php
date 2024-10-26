<?php
     /**
       * Handles stat updates in player stats database
       *
       *
       * @version 29 September 2009
       * @author Jason Cisarano jcisarano@icarusstudios.com
       *
       * @history
       *         created 29 September 2009
       */
       
      include_once('../lib/config.php');
      
      if($facebook_config['debug']==1)
      {
          ini_set('display_errors', true);
          ini_set('log_errors', true);
      }
      else
      {
          ini_set('display_errors', false);
          ini_set('log_errors', false);
      }

      //require_once('../' . LIB_PATH . 'db_access.php');
      require_once('../' . LIB_PATH . 'db_access_player.php');
      require_once('../' . LIB_PATH . 'player.class.php');
      require_once('../' . LIB_PATH . 'display.php');

      //$db = new DatabaseAccess;
      $player_db = new PlayerDatabase;

      $playerid = 0;
      $type     = '';

        //get post variable info
      if(isset($_POST['playerid']))
      {
          $playerid = $_POST['playerid'];
      }

      if(isset($_POST['type']))
      {
          $type = $_POST['type'];
      }

      $countagain = false;
      $val        = 0;
      $recharge   = 0;
      $player = $player_db->get_player_data($playerid);
      if( $type=='gamTimer' )
      {
          $val = $player->current_gamma;
          $recharge = $player->gamma_update_rate;
          
          if( $player->current_gamma < $player->max_gamma )
          {
              $countagain = true;
          }
      }
      else if ( $type=='stamTimer' )
      {
          $val = $player->current_stamina;
          $recharge = $player->stam_update_rate;

          if( $player->current_stamina < $player->max_stamina )
          {
              $countagain = true;
          }
      }
      else if ( $type=='healthTimer')
      {
          $val = $player->current_health;
          $recharge = $player->health_update_rate;
          
          if( $player->current_health < $player->max_health )
          {
              $countagain = true;
          }
      }


      $stats = render_player_data($player);

      $output = array( 'newval'      => $val,
                       'countagain'  => $countagain,
                       'time'        => $recharge,
                       'playerstats' => $stats );
      echo json_encode($output);
?>