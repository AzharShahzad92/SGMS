<?php
session_start();
include_once '../inc/connect.php';
$_SESSION["deletion"] = false;

   $meetingid = $_GET["mid"];
   $isadmin=true;
   

   pg_query($db, "set search_path to fsrif");
   $result = pg_query($db, "select deletemeeting('$meetingid')") or die('Unable to CALL stored procedure: ' . pg_last_error());
   $row = pg_fetch_row($result);

   $deletion = $row[0];
   
   //if delete is successful   
   if($deletion=='t'){
	   $_SESSION["deletion"] = true; 	   
   }
   else{
       $_SESSION["deletion"] = false;
   }
   header('Location: ../dashboard.php');
   

?>