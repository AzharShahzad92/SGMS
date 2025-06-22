<?php
session_start();
include_once '../inc/connect.php';
$_SESSION["login_error"] = false;

   $username = $_POST["username"];
   $password = $_POST["pwd"];
   $isadmin='f';
   
   $error = false;

   pg_query($db, "set search_path to fsrif");
   $result = pg_query($db, "select login('$username','$password','$isadmin')") or die('Unable to CALL stored procedure: ' . pg_last_error());
   $row = pg_fetch_row($result);

   $error = $row[0];
   
   //if login is successful   
   if($error=='t'){
       $_SESSION["login_error"] = false;
	   $_SESSION["user_type"] = "student";
	   $_SESSION["student_name"] = $_POST["username"];
	   
	   //get the id
	   $result_id = pg_query($db, "select getstudentid('$username','$password')") or die('Unable to CALL stored procedure: ' . pg_last_error());
       $row_id = pg_fetch_row($result_id);

       $_SESSION['sid'] = $row_id[0];
	   header('Location: ../student_dashboard.php');
   }
   else{
	   header('Location: ../student_login.php');
       $_SESSION["login_error"] = true;
	   unset($_SESSION["user_type"]);
   }
   
?>