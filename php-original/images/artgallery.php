<!-- images/artgallery.php -->

<?php
	require_once('dao.php');
	$dao = new Dao();
	if(isset($_GET["id"]))
		$id = $_GET["id"];
?>

		<div class="art-nav">
		<?php
			$thumbs = $dao->getThumbnails();
			foreach ($thumbs as $thumb) {
		?>
			<div>
				<img src="<?php echo $thumb["thumb_path"] ?>" />
			</div>
		<?php } ?>
		</div>
		<noscript>
		<?php 
			if(isset($id)) {
				$img = $dao->getImage($id)->fetch();
				echo "<h4>".$img["name"]."</h4>";
				echo "<img src=\"" . $img["content_path"]  . "\" />";
			}
			else {
				echo "<h4></h4>";
				echo "<img />";
			}
		?>
		</noscript>
		<div class="art-gallery">
			<?php
				$images = $dao->getImages();
				foreach ($images as $img) {
					echo "<div>";
					echo "<h4>".$img["name"]."</h4>";
					echo "<img src=\"" . $img["content_path"]  . "\" />";
					echo "<p>" . $img["caption"] . "</p>";
					echo "</div>";
				}
			?>
		</div>
