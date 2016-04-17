<?php
	session_start();
	if (isset($_SESSION["authorized"]) && !$_SESSION["authorized"] || !isset($_SESSION["authorized"])) {
		$_SESSION["status"] = "You need to log in first";
		header("Location:login.php");
	}
	
	require_once('../../dao.php');
	$dao = new Dao();
	$user = $dao->getUserFull($_SESSION["user_preset"])->fetch();
	
	if (isset($_POST["name"]) && $_POST["name"]!==$user["name"]) {		
		$dao->changeUserName($user["email"], $_POST["name"]);
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["message"] = "Name changed successfully.";
	}
	
	if (isset($_POST["email"]) && $_POST["email"]!==$user["email"]) {
		$dao->changeUserEmail($user["email"], $_POST["email"]);
		
		$_SESSION["user_preset"] = $_POST["email"];
		
		$_SESSION["message"] = "E-mail changed successfully.";
	}
	
	if (isset($_POST["password1"]) && isset($_POST["password2"])) {
		if($_POST["password1"]===$_POST["password2"] && hash("sha256", $_POST["password1"])!==$user["password"]) {
			$dao->changeUserPassword($user["email"], hash("sha256", $_POST["password1"]));
			$_SESSION["message"] = "Password changed successfully.";
		}
		else {
			$_SESSION["message"] = "Passwords do not match.";
		}
	}
	
	if (count($_FILES) > 0) {
		if ($_FILES["avatar"]["error"] > 0) {
			echo "Error: " . $_FILES["avatar"]["error"];
		}
		else {
			if (preg_match('/^image\/?pjpeg$/i', $_FILES['avatar']['type']))
				$ext = ".jpg";
			elseif (preg_match('/^image\/gif$/i', $_FILES['avatar']['type']))
				$ext = ".gif";
			elseif (preg_match('/^image\/(x-)?png$/i', $_FILES['avatar']['type']))
				$ext = ".png";
			else {
				$_SESSION["message"] = "Please submit a JPEG, GIF, or PNG image file."; 
				header('Location: ../settings.php');
			}
			
			//ALSO make sure file size is small, so it can be used as an avatar and not just a ginormous picture
			$size = getimagesize($_FILES["avatar"]["tmp_name"]);
			if($size[0] > 320 || $size[0] < 60 || $size[1] > 320 || $size[1] < 60) 
			{
				$_SESSION["message"] = "Your images is too big. Please keep it between 60 and 320 pixels wide and high."; 
				header('Location: ../settings.php');
			}

			
			//size[0] is width, size[1] is height
			$fileName = $user["name"] . $ext;
			if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $fileName)) {
				echo "File move failed";
			}
			else {
				$dao->changeUserAvatar($user["email"], $fileName);
			}
		}
	}
	
	
	header("Location: ../settings.php");

?>
