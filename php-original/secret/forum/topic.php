<?php
	require_once('../dao.php');
	$dao = new Dao();
	$topicid = $_GET["topic"];

	$topic = $dao->getForumTopic($topicid)->fetch();
	echo "<div class=\"breadcrumb\"><a href=\"forum.php?subpage=forum/home\">Forum</a> &gt; <a href=\"forum.php?subpage=forum/cat&cat=" . $topic["cat"] . "\">" . $topic["cat"] . "</a> &gt; " . $topic["subject"] . "</div>";

	echo "<table>";
	$posts = $dao->getForumPosts($topicid);
	echo "<tr>";
	echo "<th colspan=\"2\">" . $topic["subject"] . "</th>";
	echo "</tr>";

	foreach($posts as $post) {
		$name = $dao->getUserName($post["author"]);
		echo "<tr><td class=\"content\" colspan=\"2\">" . $post["content"] . "</td></tr>";
		echo "<tr><td class=\"postAuthor\"><a href=\"forum.php?subpage=users/userprofile&user=" . $post["author"] . "\">" . $name . "</td><td class=\"postDate\">" . $post["date"] . "</td></tr>";
	}

	echo "</table>";
	//allow admins to delete individual posts

?>

<form class="forumform" name="newpost" method="POST" action="forum/forumhandler.php">
	<input class="forum" type="hidden" name="topic" value="<?php echo $topicid ?>"/>
	<label class="forum" for="content">Post a response:</label>
	<textarea class="forum" name="content" id="content" required></textarea>
	<input class="forum" type="submit" name="newpost" value="Reply" />
</form>
</div>
