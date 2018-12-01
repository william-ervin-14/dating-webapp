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
$invitations = $query->get_invitations($logged_user_id)
?>
<html>
    <head>
        <title>Video Invitations</title>
    </head>

    <h1>Invitations</h1>
    <div class="content">
    <? if("No invitations found" == $invitations): ?>
        <h3>No invitations found</h3>
    <? else : ?>
        <? foreach ( $invitations as $invitation ) : ?>
            <? $friend = $query->load_user_object($invitation->friend_id)?>
            <div class="invitation-item">
                <h3><? echo "{$friend->firstname} {$friend->lastname}"; ?></h3>
                <input type="submit" name="accept_invitation" value="Accept"/>
                <input type="submit" name="delete_invitation" value="Delete"/>
            </div>
        <? endforeach;?>
    <? endif; ?>
    </div>
</html>
