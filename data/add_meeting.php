<?php
session_start();
include_once '../inc/connect.php';
error_reporting(0);
$place = $_POST['place'];
$date = $_POST['date'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];


	pg_query($db, "set search_path to fsrif");
	
	$data = pg_query($db, "select addnewmeeting('$date','$place','$stime','$etime')");
    
	if(!$data){
		//$_SESSION['add_meeting_error1'] = pg_last_error($db);
	    $error = explode( 'CONTEXT',pg_last_error($db));
        $error = explode( ':',$error[0]); 		
		$_SESSION['add_meeting_error'] = $error[1];
	    //echo $_SESSION['add_meeting_error'];
        header('Location: ../add_meeting.php');		
	}else{
		//echo "No error";
		$result = pg_fetch_row($data);
		$_SESSION['add_meeting_success'] = $result[0];
	    header('Location: ../dashboard.php');
	}
	
	


?>