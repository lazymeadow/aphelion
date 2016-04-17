<?php
	session_start();
	//features.php
	$thisPage="features";
	$subPage=$_GET["subPage"];
	require_once('dao.php');
	$dao = new Dao();
?>

<html>
	<head>
		<link rel=StyleSheet href="style.css">
		<link rel="icon" href="favicon.ico" />
		<link rel="StyleSheet" type="text/css" href="slick-1.3.15/slick/slick.css">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="slick-1.3.15/slick/slick.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/sliders.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
		<title>
			APHELION: Features
		</title>
	</head>
	<body>
		<?php
			include_once('header.php');
			
			echo "<div class=\"content\">";
			
			$paths = $dao->getPagePaths("features");

			echo "<div class=\"slider-nav\">";

			foreach ($paths as $path) {
				echo "<div><h2><a href=\"#!\">{$path["title"]}</a></h2></div>";
			}
			echo "</div>";

	
			$paths = $dao->getPagePaths("features");

			echo "<div class=\"slider-for\">";
			foreach ($paths as $path) {
				echo "<div>";
					include_once($path["path"] . '.php');
				echo "</div>";
			}
			
			echo "</div>";
			//include_once('comments.php');
			
			include_once('footer.php');
		?>
	</body>
</html>
