<?php
session_start();
include_once '../inc/connect.php';
//error_reporting(0);
$topic = $_POST['topic'];
$description = $_POST['description'];
$limit = $_POST['limit'];
$mid = $_POST['mid'];
$sgid = $_POST['sgid'];
$sid = $_SESSION['sid'];


	pg_query($db, "set search_path to fsrif");
	
	$data = pg_query($db, "select editgroupdata('$sid','$sgid','$topic','$description','$limit')");
    
	if(!$data){
		//$_SESSION['add_meeting_error1'] = pg_last_error($db);
	    $error = explode( 'CONTEXT',pg_last_error($db));
        $error = explode( ':',$error[0]); 		
		$_SESSION['edit_group_error'] = $error[1];
	    //echo $_SESSION['add_group_error'];
         header('Location: ../select_group.php?mid='.$mid);		
	}else{
		//echo "No error";
		$result = pg_fetch_row($data);
		$_SESSION['edit_group_success'] = $result[0];
	    header('Location: ../select_group.php?mid='.$mid);
	}
	
	


?>