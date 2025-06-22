<?php
session_start();
include_once '../inc/connect.php';
//error_reporting(0);

$mid = $_POST['meetingid'];
$place = $_POST['place'];
$date = $_POST['date'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];


	pg_query($db, "set search_path to fsrif");
	
	$data = pg_query($db, "select editmeeting('$mid','$place','$date','$stime','$etime')");
   		//$result = pg_fetch_row($data);
		//echo $result[0];

	if(!$data){
		//$_SESSION['add_meeting_error1'] = pg_last_error($db);
	    $error = explode( 'CONTEXT',pg_last_error($db));
        $error = explode( ':',$error[0]); 		
		$_SESSION['edit_meeting_error'] = $error[1];
	    //echo $_SESSION['add_meeting_error'];
        header('Location: ../edit_meeting.php?mid='.$mid);		
	}else{
		//echo "No error";
		$result = pg_fetch_row($data);
		$_SESSION['edit_meeting_success'] = $result[0];
	    header('Location: ../dashboard.php');
	}

	

?>