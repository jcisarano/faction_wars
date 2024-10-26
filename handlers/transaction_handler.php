<?php
/*
      * Process sales from merchant.php -
      *         player sales
      *         player purchases
      *         update player inventory and cash
      *
      * @version 12 September 2009
      * @author Jason Cisarano jcisarano@icarusstudios.com
      *
      * @history
      *         created 12 September 2009
      *         8 feb 2010 added button update function
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

      //require_once('../' . FB_PATH  . 'facebook.php');
      require_once('../' . LIB_PATH . 'db_access.php');
      require_once('../' . LIB_PATH . 'db_access_achievement.php');
      require_once('../' . LIB_PATH . 'db_access_player.php');
      require_once('../' . LIB_PATH . 'display.php');

      $achieve_db = new AchievementDatabase;

      /*
      $facebook = new Facebook(
             $facebook_config['api_key'],
             $facebook_config['secret']);

      $fb_user = $facebook->get_loggedin_user();
       */
      $db = new DatabaseAccess;

      $item_id    = 0;
      $player_id  = 0;
      $town_id    = 0;
      $player_fac = 0;
      $type       = ''; //sell or buy
      $price      = 0;
      $quantity   = 0;
      $fail       = false;

        //for text output to fbjs dialog popup
      $title      = '';
      $body       = '';
      $stats      = '';
      $button     = '';
      $output;

        //get item and player info
      if(isset($_POST['itemid']))
      {
          $item_id = $_POST['itemid'];
      }

      if(isset($_POST['townid']))
      {
          $town_id = $_POST['townid'];
      }

      if(isset($_POST['p_faction']))
      {
          $player_fac = $_POST['p_faction'];
      }

      if(isset($_POST['type']))
      {
          $type = $_POST['type'];
      }

      if(isset($_POST['fb_sig_user']))
      {
          $player_id = $_POST['fb_sig_user'];
      }

      if(isset($_POST['quantity']))
      {
          $quantity = $_POST['quantity'];
      }

        //get item info from database
      $item = $db->get_item_info($item_id, $player_id);

      if($type=='sell')
      {
          $title = $item['name'] . ' sold';
            //sell item in db
          $result = $db->sell_item($item_id, $player_id, $quantity);
          if($result==-1)
          {
              $fail = true;
              $title = 'Transaction Failed';
              $body = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                           . '" />'
                     . '<div class="transText">' . $item['name'] 
                     . ' not sold. Make sure you have
                      enough inventory before you attempt a sale.</div>
                      </div>';
          }
          else
          {
                //update achievement databases
              $achieve_db->increment_achievement($item['id'], SELL,
                                                 $player_id, $quantity);
              $achieve_db->increment_achievement(CHIP_ITEM, CHIP_TOTAL,
                                                 $player_id,
                                                 $result['total_cost']);
              $body  = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                                    . '" />'
                     . '<div class="transText">'
                     . $item['description'] . '<br />You received '
                     . $result['total_cost'] . ' chips.</div>'
                     . '</div>';

              $player_db = new PlayerDatabase;
              $player = $player_db->get_player_data($player_id);
              $stats = render_player_data($player);

              if($result['new_quant']==0)
              {
                  //player sold last item of this type, update button
                  $button = '<input type="submit" value="Can\'t Improve"
                                    disabled ="true" 
                                    id="button_' . $item['id']. '"
                                    class="fwButton_disabled"
                                    onclick="";return false; />';
              }
          }
      }
      else if($type=='buy')
      {
          $title = $item['name'] . ' acquired';
          $result = $db->buy_item($item_id, $player_id, $quantity);

          if($result==-1)
          {
              $fail = true;
              $title = 'Transaction Failed';
              $body = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image']
                           . '" />'
                     . '<div class="transText">'
                     . $item['description']. '<br />You need more'
                     . ' chips to make this purchase.
                      </div></div>';
          }
          else
          {
              $achieve_db->increment_achievement($item['id'], BUY,
                                                 $player_id, $quantity);
              $body  = '<div class="transResult">'
                     . '<img src="' . ROOT . ITEM_PATH . $item['image'] 
                                    . '" />'
                     . '<div class="transText">'
                     . $item['description']. '<br />You spent '
                     . number_format($result['total_cost'])
                     . ' chips.</div>'
                     . '</div>';

              $player_db = new PlayerDatabase;
              $player = $player_db->get_player_data($player_id);
              $stats = render_player_data($player);
              
                //first item of this type, button needs updating
              if($result['new_quant']==1)
              {
                  $button = '<input type="submit" value="Improve"
                            id="button_' . $item_id . '"
                            class="fwButton"
                            onclick="handleUpgrade(\''
                            . ROOT . HANDLER_PATH
                            . 'upgrade_handler.php\', ' . $item_id
                            . ')";return false; />';
              }
          }
      }
      else
      {
          $fail = true;
          $title = 'Error';
          $body  = '<div class="tranResult"><div class="transText">Invalid 
                         data. Please try again.</div></div>';
      }
      
      $body .= '<div style="clear:both;"></div>';

        //output array to be parsed by fbjs in mission.php
      $output = array( 'fail'         => $fail,
                       'title'        => $title,
                       'player_stats' => $stats,
                       'fbml_body'    => $body,
                       'new_quant'    => $result['new_quant'],
                       'button'       => $button);

       echo json_encode($output);
?>