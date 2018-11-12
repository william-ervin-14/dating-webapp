<?php
    include('includes/header.php');
	require_once('includes/class-insert.php');
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
		$add_status = $insert->add_status($logged_user_id, $_POST);
	}
?>
		<h1>Post Status</h1>
		<div class="content">
			<form method="post">
					<input name="status_time" type="hidden" value="<?php echo time() ?>" />
				<p>What's on your mind?</p>
				<textarea name="status_content"></textarea>
				<p>
					<input type="submit" value="Submit" />
				</p>
			</form>
		</div>
	</body>
</html>