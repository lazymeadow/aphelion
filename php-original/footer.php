<?php
	$user_preset = "";
	if (isset($_SESSION["user_preset"])) {
		$user_preset = $_SESSION["user_preset"];
	}
?>


<hr />

<noscript>
		<form method="POST" name="login" action="secret/login_handler.php">
				<label class="stacked" for="user">Username</label>
				<input class="stacked" type="text" name="user" id="user" value="<?php echo $user_preset; ?>"/>
				<label class="stacked" for="pass">Password</label>
				<input class="stacked" type="password" name="pass" id="pass" />
				<input class="stacked" type="submit" value="Login" />
			</form>
</noscript>
<div class="overlay">
	<div class="loginbox">
		<a href="#!"class="close">X</a>
		<?php include('forms/login.php') ?>
	</div>
</div>
