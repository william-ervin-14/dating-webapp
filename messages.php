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

    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email ($email);
    $logged_user_id = ($user->ID);
	$friend_ids = $query->get_friends($logged_user_id);
?>
        <h1>Messages</h1>
        <div class="content">
            <form method="post">

            </form>
        </div>
    </body>
</html>