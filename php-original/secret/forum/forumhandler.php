<?php
	session_start();
	require_once('../../dao.php');
	$dao = new Dao();	

	if(isset($_POST["newcat"])) {
		//create new category
		$dao->addForumCategory($_POST["catname"], $_POST["catdesc"]);
		$_SESSION["message"] = "New forum category created.";
		header('Location: ../forum.php?subpage=forum/home');
	}

	if(isset($_POST["newtopic"])) {
		//create a new topic with an initial post
		$id = $dao->addForumTopic($_POST["cat"], $_POST["subject"], $_SESSION["user_preset"], $_POST["content"]);
		header("Location: ../forum.php?subpage=forum/topic&topic={$id}");
	}

	if(isset($_POST["newpost"])) {
		//create a new post on an existing topic
		$topic = $_POST["topic"];
		$dao->addForumPost($topic, $_SESSION["user_preset"], $_POST["content"]);
		header("Location: ../forum.php?subpage=forum/topic&topic=" . $topic);
	}
?>
