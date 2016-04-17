<!-- forum.php -->
<?php $thisPage="secret/forum"; 	
	session_start();
	if (isset($_SESSION["authorized"]) && !$_SESSION["authorized"] || !isset($_SESSION["authorized"])) {
		$_SESSION["status"] = "You need to log in first";
		header("Location:login.php");
	}
?>

<html>
	<head>
		<link rel=StyleSheet href="../style.css">
		<link rel="icon" href="../favicon.ico">
		<script src="../js/main.js"></script>
		<script src="../js/forum.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<title>APHELION DESIGN CENTER: Forum</title>
	</head>
	<body>
		<?php
			require_once('header.php');
			echo "<div class=\"forum\">";
			echo "<noscript><h2>GUESS WHAT, THE FORUM WILL NOT WORK RIGHT WITHOUT JAVASCRIPT</h2></noscript>";
			include($_GET["subpage"] . ".php");
		?>
		</div>
	</body>
</html>
