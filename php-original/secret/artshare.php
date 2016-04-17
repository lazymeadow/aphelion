<!-- secret/artshare.php -->
<?php
	$thisPage="secret/artshare";
	
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
		<title>APHELION DESIGN CENTER: Art Sharing</title>
	</head>
	<body>
		<?php
			require_once('header.php');
		?>	
		<div class="content">
			<div class="left">
			<?php			
				if(isset($_SESSION["message"])) echo "<div class=\"status\">" .  $_SESSION["message"] . "</div>";
				echo "<a href=\"artshare.php?id=upload\"><h5>Upload a picture</h5></a>";
				$thumbs = $dao->getThumbnails();
				foreach($thumbs as $thumb) {
					echo "<a href=\"artshare.php?id=" . $thumb["content_id"] . "\">";
					echo "<img class=\"stacked\" src=\"../" . $thumb["thumb_path"] . "\" />";
					echo "</a>";
				}
			?>
			</div>
			<div class="editor">
				<p>The art sharing is unfinished, but would have uploads and public/private settings for images.</p>

				<?php
					if(isset($_GET["id"])) {
						echo "<form method=\"POST\" action=\"imagehandler.php\">";
						$id = $_GET["id"];
						if($id==="upload") {
							echo "<p>Put the form here</p>";
							
						}
						else {
							$img = $dao->getImage($id)->fetch();
							echo "<input type=\"text\" name=\"title\" value=\"" . $img["name"] . "\" />";
							echo "<img  class=\"stacked\"src=\"../" . $img["content_path"] . "\"/ >";
							echo "<input type=\"text\" />";
							
						}
						echo "</form>";
					}
				?>
			</div>
		</div>
	</body>
</html>

