<!-- secret/filetree.php -->

<div class="left">
	<?php
		require_once('../dao.php');
		$dao = new Dao();
		$filepaths = $dao->getFilePaths();
		
		echo "Available files: ";
		
		foreach ($filepaths as $path)
			echo "<ul><a href=\"downloader.php/?path=" . "files/" . $path["path"] . "&type=" . $path["type"] . "\">" . $path["path"] . "</a></ul>";
	?>
</div>
