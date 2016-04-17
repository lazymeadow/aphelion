<!-- secret/authorized.php -->

<?php
	$thisPage = "secret/authorized" ;
	
	session_start();
	if (isset($_SESSION["authorized"]) && !$_SESSION["authorized"] || 
		!isset($_SESSION["authorized"]))
	{
		$_SESSION["status"] = "You need to log in first";
		header("Location:login.php");
	}
?>

<html>
	<head>
		<link rel=StyleSheet href="../style.css">
		<link rel="icon" href="favicon.ico">
		<title>Aphelion Design Center</title>
	</head>
	<body>
		<?php
			require_once('header.php');
		?>
		<div class="content">
			<p> Beep boop bop </p>
			<p>Authorized User</p>
		</div>
	</body>
</html>
