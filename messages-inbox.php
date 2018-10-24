<?php
	session_start();
	
	require_once('includes/class-insert.php');
	require_once('includes/class-query.php');
	
	$logged_user_id = 45;
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inbox</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
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
		<h1>Inbox</h1>
		<div class="content">
			<?php $query->do_inbox($logged_user_id); ?>
		</div>
	</body>
</html>