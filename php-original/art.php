<?php
	//art.php
	$thisPage="art"
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
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<title>
		APHELION: Art
	</title>
	</head>
	<body>
		<?php
			include_once("header.php");
	
			echo "<div class=\"content\">";	
			include_once("images/artgallery.php");
			//include_once("comments.php");
			echo "</div>";
		include_once('footer.php');
		?>
	</body>
</html>
