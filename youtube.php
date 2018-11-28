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
<body>
<iframe id="existing-iframe-example"
        width="640" height="360"
        src="https://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1"
        frameborder="0"
        style="border: solid 4px #37474F"
></iframe>
<form action="http://www.youtube.com/results" method="get" target="_blank" >
    <input name="search_query" type="text" maxlength="128" />
    <select name="search_type">
        <option value="">Videos</option>
        <option value="search_users">Channels</option>
    </select>
    <input type="submit" value="Search" />
</form>


<script type="text/javascript">
    var tag = document.createElement('script');
    tag.id = 'iframe-demo';
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('existing-iframe-example', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }
    function onPlayerReady(event) {
        document.getElementById('existing-iframe-example').style.borderColor = '#FF6D00';
    }
    function changeBorderColor(playerStatus) {
        var color;
        if (playerStatus == -1) {
            color = "#37474F"; // unstarted = gray
        } else if (playerStatus == 0) {
            color = "#FFFF00"; // ended = yellow
        } else if (playerStatus == 1) {
            color = "#33691E"; // playing = green
        } else if (playerStatus == 2) {
            color = "#DD2C00"; // paused = red
        } else if (playerStatus == 3) {
            color = "#AA00FF"; // buffering = purple
        } else if (playerStatus == 5) {
            color = "#FF6DOO"; // video cued = orange
        }
        if (color) {
            document.getElementById('existing-iframe-example').style.borderColor = color;
        }
    }
    function onPlayerStateChange(event) {
        changeBorderColor(event.data);
    }
</script>
</body>
</html>
