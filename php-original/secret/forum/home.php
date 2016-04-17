<?php
	require_once('../dao.php');
	$dao = new Dao();

	if(isset($_SESSION["message"])) {
		echo $_SESSION["message"];
		unset($_SESSION["message"]);
	}

	echo "<table>";

	$cats = $dao->getForumCategories();

	if($cats->rowCount() >0 ) {
		foreach ($cats as $cat) {
			$topiccount = $dao->getForumTopicCount($cat["catname"]);
			echo "<tr>";
			echo "<th class=\"header\"><h4 class=\"forum\"><a class=\"forumheader\" href=\"forum.php?subpage=forum/cat&cat=" . $cat["catname"] . "\">" . strtoupper($cat["catname"]) . "</a></h4></th>";
			echo"<th class=\"count\"> ( " . $topiccount . " )</th>";
			echo "<tr><td colspan=\"2\" class=\"content\">" . $cat["catdesc"] . "</td></tr>";
			
		}
	}
	else {
		echo "<tr><td colspan=\"2\"><h4 class=\"forum\">No Categories in the forum.</h4></td></tr>";
	}
	echo "</table>";

	$user = $dao->getUserFull($_SESSION["user_preset"])->fetch();
	if($user["level"]==1) { //admin
		?>		
			Add a new category:
			<form class="forumform" name="category" method="POST" action="forum/forumhandler.php">
				<label class="forum" for="name">Category name</label>
				<input class="forum" class="stacked" type="text" name="catname" id="name" value="" required />
				<label class="forum" for="desc">Description</label>
				<textarea class="forum" name="catdesc" id="desc" required></textarea>
				<input class="forum" type="submit" name="newcat" value="Create" />
			</form>
	<?php
	}

?>
