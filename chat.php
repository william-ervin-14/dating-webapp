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

$email           = $_SESSION['email'];
$user            = $query->load_user_objects_by_email ($email);
$logged_user_id  = ($user->ID);
$friend_ids      = $query->get_friends($logged_user_id);
$message_received_objects = $query->get_message_received_objects($logged_user_id);
$message_sent_objects = $query->get_message_sent_objects($logged_user_id);
$different_friends = $query->get_senders($logged_user_id);
if ( !empty ( $_GET['uid'] ) ) {
    $current_tab_id = $_GET['uid'];
    $current_tab_user = $query->load_user_object($current_tab_id);
}

foreach ( $friend_ids as $friend_id ) {
    $friend_objects[] = $query->load_user_object($friend_id);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['new_message_content']) && isset($_POST['new_message_recipient_id'])) {
        $send_message = $insert->send_message($_POST['new_message_time'], $_POST['new_message_sender_id'], $_POST['new_message_recipient_id'], $_POST['new_message_content']);
        unset($_POST['new_message_time']);
        unset($_POST['new_message_sender_id']);
        unset($_POST['new_message_recipient_id']);
        unset($_POST['new_message_content']);
        header('location: messages.php');
    }
    if (!empty($_POST['message_content']) && isset($_POST['message_recipient_id'])) {
        $send_message = $insert->send_message($_POST['message_time'], $_POST['message_sender_id'], $_POST['message_recipient_id'], $_POST['message_content']);
        unset($_POST['message_time']);
        unset($_POST['message_sender_id']);
        unset($_POST['message_recipient_id']);
        unset($_POST['message_content']);
        header('location: messages.php');
    }
}
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}

require_once __DIR__ . '/vendor/autoload.php';

if (isset($_GET['q'])) {

    $DEVELOPER_KEY = 'AIzaSyCDQM84XUFkyA6__WNdffCvmMzYoiaA6og';
    $client = new Google_Client();
    $client->setDeveloperKey($DEVELOPER_KEY);

    $youtube = new Google_Service_YouTube($client);

    $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'type' => 'video',
        'q' => $_GET['q'],
        'maxResults' => 25,
    ));

    $videos = '';
    $thumbnails = array();

    foreach ($searchResponse['items'] as $searchResult) {
        $videos .= sprintf('<li>%s (%s)</li>',
            $searchResult['snippet']['title'], $searchResult['id']['videoId']);
    }
    foreach ($searchResponse['items'] as $searchResult) {
        $thumbnails = $searchResult['snippet']['thumbnails']['default'];
    }
}
$current_video_id = $_GET['vid'];
?>

