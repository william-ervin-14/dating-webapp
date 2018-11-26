<?php
    require_once('class-query.php');
    require_once('class-insert.php');
    require_once('class-db.php');
    require_once('class-login.php');

    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email ($email);
    $logged_user_id = ($user->ID);
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
                <li><a href="messages.php">Messages</a></li>
                <li><a href="notifications.php">Notifications</a></li>
				<li><a href="login.php" name="logout">Log out</a></li>
			</ul>
		</div>
