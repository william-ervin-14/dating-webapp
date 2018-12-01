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
		$update = $insert->update_user($logged_user_id, $_POST);
	}
    $email = $_SESSION['email'];
    $user_temp = $query->load_user_objects_by_email ($email);
    $logged_user_id = ($user_temp->ID);
	$user = $query->load_user_object($logged_user_id);
?>
<head>
    <title>Edit Profile</title>
</head>
		<h1>Edit Profile</h1>
		<div class="content">
			<form method="post">
				<p>
					<label class="labels" for="name">First name:</label>
					<input name="firstname" type="text" value="<?php echo $user->firstname; ?>" />
				</p>
                <p>
                    <label class="labels" for="name">Last name:</label>
                    <input name="lastname" type="text" value="<?php echo $user->lastname; ?>" />
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