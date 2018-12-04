<?php
    $vid = $_GET['vid'];
    $_SESSION['video_url'] = 'youtube.php?vid='. $vid;
    $insert->update_chat_state($_SESSION['video_url'], $_SESSION['chat_id']);
    $url = $query->get_chat_video_url($_SESSION['chat_id']);
    header('location: '.$url);