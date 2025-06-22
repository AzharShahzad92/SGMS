<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=postgres";
   $credentials = "user=root password=PAZinTU_426";

   $db = pg_connect( "$host $port $dbname $credentials") or die('Could not connect');
   if(!$db){
      echo "Error : Unable to open database\n";
   }

?>