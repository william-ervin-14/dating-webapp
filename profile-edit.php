<?php
    include('includes/header.php');
	require_once('load.php');


	
	if ( !empty ( $_POST ) ) {
		$update = $insert->update_user($logged_user_id, $_POST);
	}
	
	$user = $query->load_user_object($logged_user_id);
?>
		<h1>Edit Profile</h1>
		<div class="content">
			<form method="post">
				<p>
					<label class="labels" for="name">Name:</label>
					<input name="firstname" type="text" value="<?php echo $user->firstname; ?>" />
				</p>
				<p>
					<label class="labels" for="email">Email Address:</label>
					<input name="email" type="text" value="<?php echo $user->email; ?>" />
				</p>
				<p>
					<label class="labels" for="password">Password:</label>
					<input name="password" type="password" value="<?php echo $user->password; ?>" />
				</p>
				<p>
					<input type="submit" value="Submit" />
				</p>
			</form>
		</div>
	</body>
</html>