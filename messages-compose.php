<?php
    include('includes/header.php');
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
		$send_message = $insert->send_message($_POST);
	}
    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email ($email);
    $logged_user_id = ($user->ID);
	$friend_ids = $query->get_friends($logged_user_id);
	
	foreach ( $friend_ids as $friend_id ) {
		$friend_objects[] = $query->load_user_object($friend_id);
	}
?>
		<h1>Compose Message</h1>
		<div class="content">
			<form method="post">
				<input name="message_time" type="hidden" value="<?php echo time(); ?>" />
				<input name="message_sender_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
				<p>
					<label for="message_recipient_id">To:</label>
					<select name="message_recipient_id">
						<option value="">--Select a Friend--</option>
						<?php foreach ( $friend_objects as $friend ) : ?>
							<option value="<?php echo $friend->ID; ?>"><?php echo $friend->firstname; ?></option>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="message_content">Message:</label>
					<textarea name="message_content"></textarea>
				</p>
				<p>
					<input type="submit" value="Submit" />
				</p>
			</form>
		</div>
	</body>
</html>