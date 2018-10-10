<?php 
  session_start(); 
  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/profilepage.css">
	<title>profile page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="navbar">
		<a href="index.php">Home</a>
		<a href="messages.php">Messages</a>
		<div class="dropdown">
			<button class="dropbtn">Settings</button>
			<div class="dropdown-content">
				<a href="settings.php">Account</a>
				<a href="login.php" name="logout">Log out</a>
			</div>
		</div>
	</div>
	
	<div id="Messages" class="navBarTabs">
		<div class="row">
			<div class="side">
				<h2>Messages:</h2>
			</div>			
			<div class="main">
				<h2>Message Content</h2>
			</div>
		</div>
	</div>
</body>
</html>