<!-- dao.php -->
<?php

class Dao
{
	private $host = "localhost";
	private $db = "aphelion";
	private $dbuser = "user";
	private $dbpass = "password";

	public function getConnection() {
		return
			new PDO("mysql:host={$this->host};dbname={$this->db}", $this->dbuser, $this->dbpass);
	}


	public function saveComment ($comment, $id) {
		$conn = $this->getConnection();
		$saveQuery =
			"INSERT INTO comments
			(comment_text, id)
			VALUES
			(:comment, :id)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":comment", $comment);
		$q->bindParam(":id", $id);
		$q->execute();
	}

	public function getComments($id) {
		$conn = $this->getConnection();
		$comments = $conn->query("SELECT * FROM comments WHERE id={$id}");
		return $comments;
	}

	public function saveVote($vote, $id) {
		$conn = $this->getConnection();
		$saveQuery =
			"INSERT INTO votes
			(vote, id)
			VALUES
			(:vote, :id)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":vote", $vote);
		$q->bindParam(":id", $id);
		$q->execute();
	}

	public function getVoteCount($vote, $id) {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT COUNT(*) AS count FROM votes WHERE vote={$vote} AND id={$id}");
		return $result;
	}
	
	public function getContent($type) {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT * FROM pages WHERE type='{$type}'");
		return $result;
	}
	
	public function getThumbnails() {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT thumb_path, content_id, public FROM images");
		return $result;
	}
	
	public function getImage($id) {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT * FROM images WHERE content_id={$id}");
		return $result;
	}

	public function getImages() {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT * FROM images");
		return $result;
	}

	public function saveImage($filename, $name, $caption) {
		$conn = $this->getConnection();
		$conn->query("INSERT INTO content (type) values \"image\"");
		$id = $conn->lastInsertId("content_id");
		$saveQuery = "INSERT INTO images (content_id, name, caption, content_path, public) values (:id, :name, :caption, :path, 0)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":id", $id);
		$q->bindParam(":name", $name);
		$q->bindParam(":caption", $caption);
		$filepath = "images/" . $filename;
		$q->bindParam(":path", $filepath);
		$q->execute();
	}
	
	public function getPagePaths($category) {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT path, title FROM pages WHERE path like \"{$category}%\"");
		return $result;
	}

	public function getUser($email, $pass) {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT email, password, name from user WHERE email=\"{$email}\" and password=\"{$pass}\"");
		return $result;
	}
	
	public function getUserName($email) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT name FROM user WHERE email=(:email)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":email", $email);
		$q->execute();
		$name = $q->fetch();
		return $name["name"];
	}
	
	public function getUserFull($user) {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT * FROM user WHERE email=\"{$user}\"");
		return $result;
	}
	
	public function getUserProfile($user) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT name, avatarpath FROM user WHERE email=(:email)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":email", $user);
		$q->execute();
		return $q;
		$profile = $q->fetch();
		return $profile;
		
	}
		
	public function saveFile($fileName, $type) {
		$conn = $this->getConnection();
		$saveQuery = "INSERT INTO files (path, type) values (:fileName, :type)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":fileName", $fileName);
		$q->bindParam(":type", $type);
		$q->execute();
	}
	
	public function getFilePaths() {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT * FROM files");
		return $result;
	}
	
	public function changeUserName($email, $newName) {
		$conn = $this->getConnection();
		$saveQuery = "UPDATE user SET name=(:newName) WHERE email=(:email)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":newName", $newName);
		$q->bindParam(":email", $email);
		$q->execute();
	}
	
	public function changeUserEmail($oldEmail, $newEmail) {
		$conn = $this->getConnection();
		$saveQuery = "UPDATE user SET email=(:newEmail) WHERE email=(:oldEmail)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":newEmail", $newEmail);
		$q->bindParam(":oldEmail", $oldEmail);
		$q->execute();
	}
	
	public function changeUserPassword($email, $password) {
		$conn = $this->getConnection();
		$saveQuery = "UPDATE user SET password=(:password) WHERE email=(:email)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":email", $email);
		$q->bindParam(":password", $password);
		$q->execute();
	}
	
	public function changeUserAvatar($email, $avatar) {
		$conn = $this->getConnection();
		$saveQuery = "UPDATE user SET avatarpath=(:avatar) WHERE email=(:email)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":email", $email);
		$q->bindParam(":avatar", $avatar);
		$q->execute();
	}

	public function getForumCategories() {
		$conn = $this->getConnection();
		$result = $conn->query("SELECT * FROM forum_categories");
		return $result;
	}

	public function getForumCategory($name) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT catname, catdesc FROM forum_categories WHERE catname=(:catname)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":catname", $name);
		$q->execute();
		return $q;
	}

	//get count of topics in category
	public function getForumTopicCount($cat) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT COUNT(*) FROM forum_topics WHERE cat=(:cat)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":cat", $cat);
		$q->execute();
		$count = $q->fetch();
		return $count["COUNT(*)"];
	}

	public function addForumCategory($name, $desc) {
		$conn = $this->getConnection();
		$saveQuery = "INSERT INTO forum_categories (catname, catdesc) VALUES (:catname, :catdesc)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":catname", $name);
		$q->bindParam(":catdesc", $desc);
		$q->execute();
	}

	// returns new topic id when finished
	public function addForumTopic($cat, $subject, $author, $content) {
		$conn = $this->getConnection();
		$saveQuery = "INSERT INTO forum_topics (cat, subject, author) VALUES (:cat, :subject, :author)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":cat", $cat);
		$q->bindParam(":subject", $subject);
		$q->bindParam(":author", $author);
		$q->execute();
		$topic = $conn->lastInsertId("id");
		$this->addForumPost($topic, $author, $content);
		return $topic;
	}

	public function getForumTopics($cat) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT * FROM forum_topics WHERE cat=(:cat)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":cat", $cat);
		$q->execute();
		return $q;
	}
	
	public function getForumTopic($id) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT subject, cat FROM forum_topics WHERE id=(:id)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":id", $id);
		$q->execute();
		return $q;
	}
	
	//get count of posts in topic
	public function getForumPostCount($id) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT COUNT(*) FROM forum_posts WHERE topic=(:id)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":id", $id);
		$q->execute();
		$count = $q->fetch();
		return $count["COUNT(*)"];
	}

	public function addForumPost($topic, $author, $content) {
		$conn = $this->getConnection();
		$saveQuery = "INSERT INTO forum_posts (topic, author, content, date) values (:topic, :author, :content, NOW())";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":topic", $topic);
		$q->bindParam(":author", $author);
		$q->bindParam(":content", $content);
		echo $q->execute();
	}

	public function getForumPosts($topic) {
		$conn = $this->getConnection();
		$saveQuery = "SELECT * FROM forum_posts WHERE topic=(:topic)";
		$q = $conn->prepare($saveQuery);
		$q->bindParam(":topic", $topic);
		$q->execute();
		return $q;
	}
}
?>
