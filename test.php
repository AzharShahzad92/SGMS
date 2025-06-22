<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);
   $host        = "host=127.0.0.1";
   $port        = "port=5432";
   $dbname      = "dbname=postgres";
   $credentials = "user=root password=PAZinTU_426";

   $db = pg_connect( "$host $port $dbname $credentials") or die('Could not connect');;
   if(!$db){
      echo "Error : Unable to open database\n";
   }
  
   
/*
   // retrieve data from function
   $results = pg_query($db, "SELECT * FROM fsrif.students");

     while ($row_students = pg_fetch_array($results)) {
        echo "<br></br>";
       	echo $student_name = ($row_students ["name"]);  
     }
*/


  /*
   // add a new meeting

   pg_query($db, "set search_path to fsrif");
   $place = "Sahiwal";
   $date = date('Y-m-d');
   $stime = date('H:i:s');
   $etime = date('H:i:s');
   $result = pg_query($db, "select addnewmeeting('$date','$place','$stime','$etime')") or die('Unable to CALL stored procedure: ' . pg_last_error());
   $row = pg_fetch_row($result);

   echo $row[0];
  
  */ 


     pg_close($db); 

?>