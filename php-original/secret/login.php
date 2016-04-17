<!-- secret/login.php -->

<?php
	$thisPage = "login";
	session_start();

	if (isset($_SESSION["authorized"]) && $_SESSION["authorized"]) {
		header("Location:authorized.php");
	}

	$user_preset = "";
	if (isset($_SESSION["user_preset"])) {
		$user_preset = $_SESSION["user_preset"];
	}
?>

<html>
	<head>
	<link rel=StyleSheet href="../style.css">
	<link rel="icon" href="../favicon.ico" />
	<title>
		APHELION DESIGN CENTER LOGIN
	</title>
	</head>
	<body>
		<div class="header">
			<h2><a href="../index.php">APHELION</a></h2>
		
			<div class="subheader">
				<h2><a href="../universe.php?subPage=universe/main">UNIVERSE</a></h2>
				<h2><a href="../features.php?subPage=features/main">FEATURES</a></h2>
				<h2><a href="../art.php">ART</a></h2>
			</div>
			<hr />
		</div>
		
		<div class="content">
			<?php if(isset($_SESSION["status"])) echo $_SESSION["status"]; unset($_SESSION["status"]); ?>
			<form method="POST" name="login" action="login_handler.php">
				<label class="stacked" for="user">Username</label>
				<input class="stacked" type="text" name="user" id="user" value="<?php echo $user_preset; ?>"/>
				<label class="stacked" for="pass">Password</label>
				<input class="stacked" type="password" name="pass" id="pass" />
				<input class="stacked" type="submit" value="Login" />
			</form>
		</div>
		
	</body>
</html>
