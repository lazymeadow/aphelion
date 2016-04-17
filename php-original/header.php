<?php
	//header.php
?>
<div class="header">
	<?php
		if ($thisPage=="index") echo "<h2>APHELION</h2>";
		else echo "<h2><a href=\"index.php\">APHELION</a></h2>";
	?>
	
	<div class="subheader">
		<?php
			if ($thisPage=="universe") echo "<h2 id=\"current\">UNIVERSE";
			else echo "<h2><a href=\"universe.php?subPage=universe/main\">UNIVERSE</a>";
			echo "</h2>";

			if ($thisPage=="features") echo "<h2 id=\"current\">FEATURES";
			else echo "<h2><a href=\"features.php?subPage=features/main\">FEATURES</a>";
			echo "</h2>";

			if ($thisPage=="art") echo "<h2 id=\"current\">ART";
			else echo "<h2><a href=\"art.php\">ART</a>";
			echo "</h2>";
		?>
		<noscript>
			<h2><a href="secret/login.php" class="login">LOGIN</a></h2>
		</noscript>
	</div>
	<hr />
</div>
