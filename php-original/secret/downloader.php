<?php
	$filePath = $_GET["path"];
	$type = $_GET["type"];
	header("Content-description: File Transfer");
	header("Content-disposition: attachment; filename={$filePath}");
	header("Content-type: {$type}");
	readfile($filePath);
?> 
