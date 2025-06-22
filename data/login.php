<?php
session_start();
include_once '../inc/connect.php';
$_SESSION["login_error"] = false;

   $username = $_POST["username"];
   $password = $_POST["pwd"];
   $isadmin='t';
   
   $error = false;

   pg_query($db, "set search_path to fsrif");
   $result = pg_query($db, "select login('$username','$password','$isadmin')") or die('Unable to CALL stored procedure: ' . pg_last_error());
   $row = pg_fetch_row($result);

   $error = $row[0];
   
   //if login is successful   
   if($error=='t'){
	   header('Location: ../dashboard.php');
       $_SESSION["login_error"] = false;
	   $_SESSION["user_type"] = "admin";
	   $_SESSION["admin_name"] = $_POST["username"];
   }
   else{
	   header('Location: ../login.php');
       $_SESSION["login_error"] = true;
	   unset($_SESSION["user_type"]);
   }
   
?>