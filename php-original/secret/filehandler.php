<?php

require_once('../dao.php');
$dao = new Dao();
$filePath = "";

if (count($_FILES) > 0) {
	if ($_FILES["file"]["error"] > 0) {
		echo "no files";
		$_SESSION["message"] = "Error: " . $_FILES["file"]["error"];
		header("Location:fileshare.php");
	} else {
		$basePath = "files/";
		$fileName = $_FILES["file"]["name"];
		$filePath = $basePath . $fileName;
		if (!move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
			echo "failure";
			$_SESSION["message"] = "File move failed";
			header("Location:fileshare.php");
		}
		else {
			$dao->saveFile($fileName, $_FILES["file"]["type"]);
			$_SESSION["message"] = "File uploaded successfully.";
			header("Location:fileshare.php");
		}
	}
}
else {
	$_SESSION["message"] = "File upload failed";
	header('Location: fileshare.php');
}
?>
