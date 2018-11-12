<?php
    include('includes/header.php');
	require_once('includes/class-query.php');

    if (!isset($_SESSION['email'])) {
     $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        unset($_SESSION['email']);
        session_destroy();
        header("location: login.php");
    }
?>
		<h1>View Feed</h1>
		<div class="content">
			<?php $query->do_news_feed($logged_user_id); ?>
		</div>
	</body>
</html>