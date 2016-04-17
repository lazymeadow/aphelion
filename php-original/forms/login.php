<?php if(!isset($handler)) $handler="secret/login_handler.php" ?>

<form method="POST" name="login" action="<?php echo $handler ?>">
	<label class="stacked" for="user">Username</label>
	<input class="stacked user" type="text" name="user" id="user" value="<?php echo $user_preset; ?>" email required/>
	<label class="stacked" for="pass">Password</label>
	<input class="stacked user" type="password" name="pass" id="pass" required/>
	<input class="stacked" type="submit" value="Login" />
</form>
