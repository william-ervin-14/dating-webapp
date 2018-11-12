<?php
require_once('class-login.php');
require_once('class-query.php');
require_once('class-insert.php');
require_once('class-db.php');

$email = $_SESSION['email'];
$user_temp = $query->load_user_objects_by_email ($email);
$logged_user_id = ($user_temp->ID);
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
				<li><a href="profile-view.php?uid=<?php echo $logged_user_id; ?>">View Profile</a></li>
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
