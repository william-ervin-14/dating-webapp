<?php
	session_start();
	
	require_once('includes/class-query.php');
?>
		<h1>Members Directory</h1>
		<div class="content">
			<?php $query->do_user_directory(); ?>
		</div>
	</body>
</html>