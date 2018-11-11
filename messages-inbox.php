<?php
    include('includes/header.php');
	require_once('load.php');
	
	$logged_user_id = 45;
	
?>
		<h1>Inbox</h1>
		<div class="content">
			<?php $query->do_inbox($logged_user_id); ?>
		</div>
	</body>
</html>