<?php
  
  require_once('load.php');
  include('includes/header.php');

  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
      unset($_SESSION['email']);
      session_destroy();
  	  header("location: login.php");
  }
  $email = $_SESSION['email'];
  $user = $query->load_user_objects_by_email($email);
  $logged_user_id = ($user->ID);


?>

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
		<h3>Messages</h3>
			<ul>
			<li><a href="messages.php">Messages</a></li>
		</ul>
		</div>
        <h2><?php echo $logged_user_id; ?></h2>
        <h2><?php echo $email; ?></h2>
	</body>
</html>