<!-- secret/brainstorm.php -->
<?php $thisPage="secret/brainstorm"; 	
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
		<title>APHELION DESIGN CENTER: Brainstorm</title>
	</head>
	<body>
		<?php
			require_once('header.php');
		?>
		<div class="content">
			<p>Super Space Game Brainstorm</p>
			<p>Don't exactly know what this is yet</p>
			<p>Alls I know is javascript javascript javascript</p>
		</div>
	</body>
</html>
