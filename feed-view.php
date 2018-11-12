<?php
    include('includes/header.php');
	require_once('includes/class-query.php');

    $email = $_SESSION['email'];
    $user_temp = $query->load_user_objects_by_email ($email);
    $logged_user_id = ($user_temp->ID);
?>
		<h1>View Feed</h1>
		<div class="content">
			<?php $query->do_news_feed($logged_user_id); ?>
		</div>
	</body>
</html>