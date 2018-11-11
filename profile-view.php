<?php
    session_start(); 

	
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
	
	if ( !empty ( $_POST ) ) {
		if ( $_POST['type'] == 'add' ) {
			$add_friend = $insert->add_friend($_POST['user_id'], $_POST['friend_id']);
		}
		
		if ( $_POST['type'] == 'remove' ) {
			$remove_friend = $insert->remove_friend($_POST['user_id'], $_POST['friend_id']);
		}
	}
	
    $logged_user_id = $_SESSION['uid'];
	
	if ( !empty ( $_GET['uid'] ) ) {
		$user_id = $_GET['uid'];
		$user = $query->load_user_object($user_id);
		
		if ( $logged_user_id == $user_id ) {
			$mine = true;
		}
	} else {
		$user = $query->load_user_object($logged_user_id);
		$mine = true;
	}
	
	$friends = $query->get_friends($logged_user_id);
?>
		<h1>View Profile</h1>
		<div class="content">
			<p>Name: <?php echo $user->firstname; ?></p>
			<p>Email Address: <?php echo $user->email; ?></p>
			<?php if ( !$mine ) : ?>
				<?php if ( !in_array($user_id, $friends) ) : ?>
					<p>
						<form method="post">
							<input name="user_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
							<input name="friend_id" type="hidden" value="<?php echo $user_id; ?>" />
							<input name="type" type="hidden" value="add" />
							<input type="submit" value="Add as Friend" />
						</form>
					</p>
				<?php else : ?>
					<p>
						<form method="post">
							<input name="user_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
							<input name="friend_id" type="hidden" value="<?php echo $user_id; ?>" />
							<input name="type" type="hidden" value="remove" />
							<input type="submit" value="Remove Friend" />
						</form>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</body>
</html>