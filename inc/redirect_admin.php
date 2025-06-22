<?php

if(isset($_SESSION['user_type'])&&$_SESSION['user_type']=="admin")
	header("location:../dashboard.php");

?>