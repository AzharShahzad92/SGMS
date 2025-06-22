<?php
session_start();
include_once '../inc/connect.php';

   $mid= $_GET["mid"];
   $sgid = $_GET["sgid"];
   $sid = $_SESSION["sid"];

   pg_query($db, "set search_path to fsrif");
   $data = pg_query($db, "select deletegroup('$sid','$sgid')") or die('Unable to CALL stored procedure: ' . pg_last_error());

	if(!$data){
		//$_SESSION['add_meeting_error1'] = pg_last_error($db);
	    $error = explode( 'CONTEXT',pg_last_error($db));
        $error = explode( ':',$error[0]); 		
		$_SESSION['delete_group_error'] = $error[1];
	    //echo $_SESSION['add_group_error'];
         header('Location: ../select_group.php?mid='.$mid);		
	}else{
		//echo "No error";
		$result = pg_fetch_row($data);
		$_SESSION['delete_group_success'] = $result[0];
	    header('Location: ../select_group.php?mid='.$mid);
	}
   

?>