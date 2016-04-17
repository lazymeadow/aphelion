<?php
	//userprofile.php
	require_once('../dao.php');
	$dao = new Dao();
	$user = $_GET["user"];
	$profile = $dao->getUserProfile($user);
	$profile = $profile->fetch();
?>

<a href="<?php echo $_SERVER["HTTP_REFERER"] ?> ">Back</a>

<h4><?php echo $profile["name"] ?></h4>
<img src="<?php echo "users/" . $profile["avatarpath"] ?>" />




