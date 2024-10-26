<?php
     /**
       * Forward an errant/nosey user to main index file
       *
       * @version 17 August 2009
       * @author Jason Cisarano jcisarano@icarusstudios.com
       *
       * @history
       *         created 17 August 2009
       */

      include('../lib/config.php');

      header('Location: ' . ROOT);

?>