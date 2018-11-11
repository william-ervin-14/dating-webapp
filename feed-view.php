<?php
	session_start();
	
	require_once('includes/class-query.php');
	
	$logged_user_id = 45;
?>
		<h1>View Feed</h1>
		<div class="content">
			<?php $query->do_news_feed($logged_user_id); ?>
		</div>
	</body>
</html>