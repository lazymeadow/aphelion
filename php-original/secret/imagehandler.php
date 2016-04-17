<?php
	session_start();
	if (isset($_SESSION["authorized"]) && !$_SESSION["authorized"] || !isset($_SESSION["authorized"])) {
		$_SESSION["status"] = "You need to log in first";
		header("Location:login.php");
	}
	
	require_once('../dao.php');
	$dao = new Dao();
	

	if (count($_FILES) > 0) {
		if ($_FILES["image"]["error"] > 0) {
			$_SESSION["message"] = "Image failed to upload";
			header('Location: ../artshare.php');
		}
		else {
			if (preg_match('/^image\/?pjpeg$/i', $_FILES["image"]["type"]))
				$ext = ".jpg";
			elseif (preg_match('/^image\/gif$/i', $_FILES["image"]["type"]))
				$ext = ".gif";
			elseif (preg_match('/^image\/(x-)?png$/i', $_FILES["image"]["type"]))
				$ext = ".png";
			else {
				$_SESSION["message"] = "Please submit a JPEG, GIF, or PNG image file."; 
				header('Location: ../artshare.php');
			}
			
			$fileName = $_FILES["image"]["name"] . $ext;
			$imgpath = "images/" . $fileName;
			if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imgpath)) {
				$_SESSION["message"] = "File move failed";
				header('Location: artshare.php');
			}
			else {
				$dao->saveImage($fileName, $_POST["name"], $_POST["caption"]);
				$_SESSION["message"] = "File uploaded successfully";
				header('Location: artshare.php');
			}
		}
	}
?>
