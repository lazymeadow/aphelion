<!-- secret/logout.php -->

<?php
	session_start();
	session_destroy();
	$_POST["pass"]="";
	header("Location:login.php");
?> 
