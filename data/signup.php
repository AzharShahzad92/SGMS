<?php
session_start();
include_once '../inc/connect.php';


   $username = $_POST["username"];
   $password = $_POST["pwd"];
   $isadmin='f';
   
   $error = false;

   pg_query($db, "set search_path to fsrif");
   pg_query($db, "insert into students(name,password,admin) values('$username','$password','$isadmin')") or die('Unable to CALL stored procedure: ' . pg_last_error());
   $_SESSION['singup'] = true;
   header('Location: ../student_login.php');

   
?>