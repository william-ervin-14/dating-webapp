<?php  
  //session_start();
  
  require_once('load.php');
  
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
  $email = "bleh";
  $logged_user_id = 45;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div id="navigation">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile-view.php">View Profile</a></li>
				<li><a href="profile-edit.php">Edit Profile</a></li>
				<li><a href="friends-directory.php">Member Directory</a></li>
				<li><a href="friends-list.php">Friends List</a></li>
				<li><a href="feed-view.php">View Feed</a></li>
				<li><a href="feed-post.php">Post Status</a></li>
				<li><a href="messages-inbox.php">Inbox</a></li>
				<li><a href="messages-compose.php">Compose</a></li>
				<li><a href="login.php" name="logout">Log out</a></li>
			</ul>
		</div>
		<h1>Home</h1>
		<div class="square">
		<h3>Profile</h3>
		<ul>
			<li><a href="profile-view.php">View Profile</a></li>
			<li><a href="profile-edit.php">Edit Profile</a></li>
		</ul>
		</div>
		<div class="square">
		<h3>Friends</h3>
			<ul>
			<li><a href="friends-directory.php">Member Directory</a></li>
			<li><a href="friends-list.php">Friends List</a></li>
		</ul>
		</div>
		<div class="square">
		<h3>News Feed</h3>
			<ul>
			<li><a href="feed-view.php">View Feed</a></li>
			<li><a href="feed-post.php">Post Status</a></li>
		</ul>
		</div>
		<div class="square">
		<h3>Messages</h3>
			<ul>
			<li><a href="messages-inbox.php">Inbox</a></li>
			<li><a href="messages-compose.php">Compose</a></li>
		</ul>
		</div>
		<h2><?php echo $email; ?></h2>
	</body>
</html>