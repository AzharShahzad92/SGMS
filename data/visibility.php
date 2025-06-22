<?php
session_start();
include_once '../inc/connect.php';

$mid = $_POST['mid'];
$visibility = $_POST['mvisibility'];
    //echo "<script>alert('Hello');</script>";
	pg_query($db, "set search_path to fsrif");	
	$data = pg_query($db, "select changemeetingvisibility('$mid','$visibility')");
	$row = pg_fetch_row($data);

    echo $row[0];
?>