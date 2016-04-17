<!-- secret/fileshare.php -->
<?php
	$thisPage="secret/fileshare";
	
	session_start();
	if (isset($_SESSION["authorized"]) && !$_SESSION["authorized"] || !isset($_SESSION["authorized"])) {
		$_SESSION["status"] = "You need to log in first";
		header("Location:login.php");
	}

	require_once('../phpFileTree/php_file_tree.php');
?>

<html>
	<head>
		<link rel=StyleSheet href="../style.css">
		<link rel=StyleSheet href="../phpFileTree/styles/default/filetree.css">
		<link rel="icon" href="../favicon.ico">
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../js/filetree.js"></script>
		<script src="../phpFileTree/php_file_tree_jquery.js" type="text/javascript"></script>
		<title>APHELION DESIGN CENTER: File Sharing</title>
	</head>
	<body>
		<?php
			require_once('header.php');
			
			echo "<div class=\"content\">";
			
			//include('filetree.php');
			echo php_file_tree('files/', "javascript:alert('You clicked on [link]');");		


			if(isset($_SESSION["message"])) echo "<div class=\"status\">" .  $_SESSION["message"] . "</div>";
		?>
				<form name="upload" method="POST" action="filehandler.php" enctype="multipart/form-data">
					<input type="file" name="file" id="file" value="..." />
					<input type="submit" value="Upload" />
				</form>
			</div>
	</body>
</html>
