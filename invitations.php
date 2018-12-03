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
    $invitations = $query->get_invitations($logged_user_id);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['accept_invitation'])){

        }
    }
?>
<html>
    <head>
        <title>Video Invitations</title>
    </head>

    <h1>Invitations</h1>
    <form method="post">
        <div class="content">
        <?php if("No invitations found" == $invitations): ?>
            <h3>No invitations found</h3>
        <?php else : ?>
            <?php foreach ( $invitations as $invitation ) : ?>
                <?php $friend = $query->load_user_object($invitation->friend_id)?>
                <div class="invitation-item">
                    <h3><?php echo "{$friend->firstname} {$friend->lastname}"; ?></h3>
                    <ul>
                        <li><a href="youtube.php?<?php echo $logged_user_id; ?>">Accept</a></li>
                    </ul>
                    <input type="submit" name="delete_invitation" value="Delete"/>
                </div>
            <?php endforeach;?>
        <?php endif; ?>
        </div>
    </form>
</html>
