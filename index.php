<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/profilepage.css">
	<title>profile page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="navbar">
		<a href="home.html">Home</a>
		<a href="messages.html">Messages</a>
		<div class="dropdown">
			<button class="dropbtn">Settings</button>
			<div class="dropdown-content">
				<a href="settings.html">Account</a>
				<a href="login.php">Log out</a>
			</div>
		</div>
	</div>
	
	<div id="Home" class="navBarTabs">
		<div class="row">
			<div class="side">
				<img src="images/login_avatar.png" alt="Avatar" class="avatar">
				<?php  if (isset($_SESSION['username'])) : ?>
					<center><h2><?php echo $_SESSION['username']; ?></h2></center>
				<?php endif ?>
			</div>			
			<div class="main">
				<h2>Main content</h2>
			</div>
		</div>
	</div>	

</body>
</html>