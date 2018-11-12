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
	
	$friends = $query->get_friends($logged_user_id);
?>

		<h1>Friends List</h1>
		<div class="content">
			<?php $query->do_friends_list($friends); ?>
		</div>
	</body>
</html>