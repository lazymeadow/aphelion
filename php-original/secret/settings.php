<!-- settings.php -->
<?php $thisPage="secret/settings"; 
	session_start();
	if (isset($_SESSION["authorized"]) && !$_SESSION["authorized"] || !isset($_SESSION["authorized"])) {
		$_SESSION["status"] = "You need to log in first";
		header("Location:login.php");
	}
	
	require_once('../dao.php');
	$dao = new Dao();
?>

<html>
	<head>
		<link rel=StyleSheet href="../style.css">
		<link rel="icon" href="../favicon.ico">
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
		<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
		<title>APHELION DESIGN CENTER: User Settings</title>
	</head>
	<body>
		<?php
			require_once('header.php');
			
			echo "<div class=\"content\">";
			
			if(isset($_SESSION["message"])) {
				echo $_SESSION["message"];
				unset($_SESSION["message"]);
			}
			
			$user = $dao->getUserFull($_SESSION["user_preset"] )->fetch();
			
		?>
		
		<div class="left">
			<img src="<?php echo "users/" . $user["avatarpath"] ?>" />
			<form method="POST" name="upload" action="users/profilechanger.php" enctype="multipart/form-data">
				<input type="file" name="avatar" />
				<input type="submit" value="Upload" />
			</form>
		</div>
		
		<form method="POST" name="name" action="users/profilechanger.php">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="<?php echo $user["name"] ?>" />
			<input type="submit" value="Change" />
		</form>
		
		<form method="POST" name="email" action="users/profilechanger.php">
			<label for="email">E-mail:</label>
			<input type="text" id="email" name="email" value="<?php echo $user["email"] ?>" />
			<input type="submit" value="Change" />
		</form>
		
		<form class="passwordchange" method="POST" name="password" action="users/profilechanger.php">
			<label class="stacked" for="password1">Password:</label>
			<input class="stacked" type="password" id="password1" name="password1" value="" required />
			
			<label class="stacked" for="password2">Re-enter:</label>
			<input class="stacked" type="password" id="password2" name="password2" value="" required equalTo="#password1"/>
			<input type="submit" value="Change" />
		</form>
		</div>
	</body>
</html>
