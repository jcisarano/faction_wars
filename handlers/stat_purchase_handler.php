<?php
     /**
       * Used when player purchases a stat on character page. Updates database
       * and notifies success.
       *
       * @version 1 October 2009
       * @author Jason Cisarano jcisarano@icarusstudios.com
       *
       * @history
       *         created 1 October 2009
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

      require_once('../' . LIB_PATH . 'db_access_player.php');
      require_once('../' . LIB_PATH . 'player.class.php');
      require_once('../' . LIB_PATH . 'display.php');

      $player_db = new PlayerDatabase;

      $playerid   = 0;  //player's facebook userid
      $type       = ''; //what kind of operation are we doing
      $spent_fac  = false; //flag tells which kind of points to deduct
      $spent_gam  = false;
      $amount     = 0; //stat change value
      $newval     = 0; //updated stat value
      $points     = 0; //achieve or faction points remaining

        //get post variable info
      if(isset($_POST['playerid']))
      {
          $playerid = $_POST['playerid'];
      }

      if(isset($_POST['type']))
      {
          $type = $_POST['type'];
      }

      if(isset($_POST['amount']))
      {
          $amount = $_POST['amount'];
      }

      $player = $player_db->get_player_data($playerid);

        //verify points available, then check type
      if( $player->achieve_points > 0)
      {
          if($type=='gamma')
          {
              $player->max_gamma += $amount;
              $player->update_gamma($amount);
              $newval = $player->max_gamma;
              $spent_gam = true;
          }
          else if($type=='stamina')
          {
              $player->max_stamina += $amount;
              $player->update_stamina($amount);
              $newval = $player->max_stamina;
              $spent_gam = true;
          }
          else if($type=='health')
          {
              $player->max_health += $amount;
              $player->update_health($amount);
              $newval = $player->max_health;
              $spent_gam = true;
          }
          else if($type=='attack')
          {
              $player->attack += $amount;
              $newval = $player->attack;
              $spent_gam = true;
          }
          else if($type=='defense')
          {
              $player->defense += $amount;
              $newval = $player->defense;
              $spent_gam = true;
          }
      }

        //verify points available, then check type
      if( $player->faction_points > 0 )
      {
          if($type=='g_rech')
          {
              $old = $player->gamma_update_rate;
              $player->gamma_update_rate =  max( 150, $player->gamma_update_rate - $amount);//2:30 min time
              $newval = format_time($player->gamma_update_rate);

                //be sure a change was made
              if($old != $player->gamma_update_rate)
              {
                  $spent_fac = true;
              }
          }
          else if($type=='s_rech')
          {
              $old = $player->stam_update_rate;
              $player->stam_update_rate =  max( 150, $player->stam_update_rate - $amount);//2:30 min time
              $newval = format_time($player->stam_update_rate);

                //be sure a change was made
              if( $old != $player->stam_update_rate )
              {
                  $spent_fac = true;
              }
          }
      }

      //spend the right kind of points
      if($spent_gam)
      {
          $player->achieve_points -= 1;
          $player->ap_spent += 1;
          $points = $player->achieve_points;

      }
      else if($spent_fac)
      {
          $player->faction_points -= 1;
          $points = $player->faction_points;
      }

         //update player db
      $player_db->update_player_db($player);

      $stats = render_player_data($player);

      $output = array('newval' => $newval,
                      'playerstats' => $stats,
                      'pointsleft' => $points );
      echo json_encode($output);

?>