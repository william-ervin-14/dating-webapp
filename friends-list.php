<?php
    include('includes/header.php');
	require_once('load.php');
	
	$logged_user_id = 45;
	
	$friends = $query->get_friends($logged_user_id);
?>

		<h1>Friends List</h1>
		<div class="content">
			<?php $query->do_friends_list($friends); ?>
		</div>
	</body>
</html>