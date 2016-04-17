<?php
	require_once('../dao.php');
	$dao = new Dao();
	$cat = $_GET["cat"];	
	$topics = $dao->getForumTopics($cat);

	echo "<div class=\"breadcrumb\">";
	echo "<a href=\"forum.php?subpage=forum/home\">Forum</a> &gt; " . $cat;
	
	echo "<table>";
	echo "<tr><th colspan=\"2\"><h4 class=\"forum\">" . strtoupper($cat) . "</h4></th></tr>";
	if($topics->rowCount() > 0 ) {
		foreach($topics as $topic) {
			$postcount = $dao->getForumPostCount($topic["id"]);
			echo "<tr>";
			echo "<td class=\"content\"><a href=\"forum.php?subpage=forum/topic&topic=" . $topic["id"] . "\">" . $topic["subject"] . "</a> ( " . $postcount . " )</td>";
			echo "</tr>";
		}
	}
	else {
		echo "<tr><td colspan=\"2\" class=\"content\">No topics for this category.</td></tr>";
	}

	echo "</table>";
?>

Start a new topic:
<form class="forumform" name="newtopic" method="POST" action="forum/forumhandler.php?cat=<?php echo $cat ?>">
	<input type="hidden" name="cat" value="<?php echo $cat ?>" />
	<label class="forum" for="subject">Subject</label>
	<input class="forum" type="text" name="subject" id="subject" value="" required/>
	<label class="forum" for="content"></label>
	<textarea class="forum" name="content" id="content" required></textarea>
	<input class="forum" type="submit" name="newtopic" value="Create" />
</form>
