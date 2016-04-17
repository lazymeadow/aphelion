<!-- secret/header.php -->

<div class="header">
	<h2>
		APHELION DESIGN CENTER
	</h2>
	<div class="subheader">
		<?php
			echo "<h2>";
			if ($thisPage=="secret/forum") echo "<span id=\"current\">FORUM</span>";
			else echo "<a href=\"forum.php?subpage=forum/home\">FORUM</a>";
			echo "</h2>";

			echo "<h2>";
			if ($thisPage=="secret/artshare") echo "<span id=\"current\">ART SHARING</span>";
			else echo "<a href=\"artshare.php\">ART SHARING</a>";
			echo "</h2>";
			
			echo "<h2>";
			if ($thisPage=="secret/fileshare") echo "<span id=\"current\">FILE SHARING</span>";
			else echo "<a href=\"fileshare.php\">FILE SHARING</a>";
			echo "</h2>";
			
			echo "<h2>";
			if ($thisPage=="secret/settings") echo "<span id=\"current\">SETTINGS</span>";
			else echo "<a href=\"settings.php\">SETTINGS</a>";
			echo "</h2>";
		?>
	</div>
	<hr />
		<div class="subheader">
		<h5><a href="logout.php">LOGOUT</a></h5>
		</div>
		<h5>Welcome, <a href="forum.php?subpage=users/userprofile&user=<?php echo $_SESSION["user_preset"] ?>"><?php echo $_SESSION["name"] ?></a>!</h5>
</div>
