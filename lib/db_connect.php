<?php
     /*
      * General db functions including connection, query, and validation.
      *
      * @version 24 August 2009
      * @author Jason Cisarano jcisarano@icarusstudios.com
      *
      * @history
      *         created 24 August 2009
      */

     include('config.php');
     if($facebook_config['debug']==1)
     {
         ini_set('display_errors', false);
         ini_set('log_errors', true);
     }
     
     class DatabaseUtilities
     {
          protected $server     = '10.6.166.163';
          protected $login      = 'fwtestjcis';
          protected $password   = 'CNh1ans.';

          //protected $server   = 'lifenet54';
          //protected $login    = 'jcisarano';
          //protected $password = 'Vr4jFCuz';

          protected $db         = 'fwtestjcis';

          /** Create connection to db
            * connection should be closed locally after use
            *
            * @return MySQL connection for use in queries
            */
          function connect_to_db()
          {
               $con = mysql_connect($this->server, $this->login, $this->password);
               
               if ( !$con )
               {
                    $err = mysql_error();
                    error_log('Could not connect to db: ' .$err);
                    die('Could not connect: ' . $err);
               }
               mysql_select_db ($this->db, $con);

               return $con;
          }

          /**
            * Connect to db if needed and run query
            * @return MySQL result set
            */
          function execute_query( $query, $nocon=true )
          {
              if( $nocon )
              {
                  $this->connect_to_db();
              }

              $result= mysql_query( $query );
              $err   = mysql_error();

              if( $err != '' ) error_log( $err );
              if( $nocon ) mysql_close();

              return $result;
          }

          /**
            * Runs passed-in string through mysql_real_escape_string
            * to protect from mysql injection attacks. Returns a string
            * with all special characters escaped out.
            *
            * @param $s string to escape
            * @return escaped string
            */
          function real_escape($s, $nocon=true)
          {
              if( $nocon )
              {
                  $this->connect_to_db();
              }
              $escaped = mysql_real_escape_string($s);

              if( !$escaped ){
                  $err = mysql_error();
                  error_log( $err );
              }
              if( $nocon ) mysql_close();

              return $escaped;
          }
          
          /*
           * Verifies that a passed-in value contains digits only
           * to avoid potential mysql injection attacks.
           *
           * @param $num number to validate
           * @return 1 if passed-in value was valid int
           *         otherwise, return 0
           */
          function validate_int($num)
          {
              return ctype_digit($num)? 1:0;
          }
          
          /*
           * Verify that passed-in value is valid number.
           *
           * @param $num number to check
           * @return 1 if $num is valid int, float
           *         otherwise, return 0
           */
          function validate_num($num)
          {
              $regex = '/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/';
              return preg_match($regex, $num);
          }
          
     }
?>