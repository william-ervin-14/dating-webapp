<?php
    include('includes/header.php');
	require_once('includes/class-query.php');

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: login.php");
    }
?>
<head>
    <title>Member Directory</title>
</head>
		<h1>Members Directory</h1>
		<div class="content">
			<?php $query->do_user_directory(); ?>
		</div>
	</body>
</html>