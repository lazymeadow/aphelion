<!--secret/login_handler.php -->

<?php
	require_once("../dao.php");
	$dao = new Dao();

	$pass = hash("sha256", $_POST["pass"]);
	session_start();
	$login=$dao->getUser($_POST["user"], $pass)->fetch();
	
	if (isset($login) && $login["email"]==$_POST["user"] && $login["password"]==$pass){
		$_SESSION["authorized"] = true;
		$_SESSION["user_preset"] = $login["email"];
		$_SESSION["name"] = $login["name"];
		header("Location:authorized.php");
	}
	else
	{
		$status = "Invalid username or password";
		$_SESSION["status"] = $status;
		$_SESSION["user_preset"] = $_POST["user"];
		$_SESSION["authorized"] = false;

		header("Location:login.php");
	}
?> 
