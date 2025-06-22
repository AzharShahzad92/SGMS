<?php

session_start();

if(isset($_SESSION['user_type'])){
	unset($_SESSION['user_type']);
	session_destroy();
	header('Location: ../index.php');
}

?>