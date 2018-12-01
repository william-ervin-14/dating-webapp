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
?>
<html>
<head>
    <title>Invitations</title>
</head>
<h1>Invitations</h1>
<div class="content">

</div>
</html>
