<?php
    require_once('load.php');
    include('includes/header.php');

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        unset($_SESSION['email']);
        session_destroy();
        header("location: login.php");
    }
    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email($email);
    $logged_user_id = ($user->ID);
    $notifications = $query->get_notifications($logged_user_id)
?>
<html>
<head>
    <title>Notifications</title>
</head>

<h1>Notifications</h1>
<form method="post">
    <div class="content">
        <?php if("No notifications found" == $notifications): ?>
            <h3>No notifications found</h3>
        <?php else : ?>
            <?php foreach ( $notifications as $notification ) : ?>
                <?php $friend = $query->load_user_object($notification->friend_id)?>
                <div class="notification-item">
                    <h3><?php echo "{$friend->firstname} {$friend->lastname}"; ?></h3>
                </div>
            <?php endforeach;?>
        <?php endif; ?>
    </div>
</form>
</html>
