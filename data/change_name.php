<?php
session_start();
include_once '../inc/connect.php';
//error_reporting(0);

$name = $_POST['nname'];
$sid = $_SESSION['sid'];


	pg_query($db, "set search_path to fsrif");
	$data = pg_query($db, "select changename('$sid','$name')");
    $result = pg_fetch_array($data);
	$_SESSION["student_name"] = $result[0];
	    //echo $result[0];
		header('Location: ../student_dashboard.php');
	
	


?>