<?php

    require_once('load.php');

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
    $current_video_id = $_GET['vid'];
    $friend_id = $_GET['uid'];
    $insert->add_chat($logged_user_id, $friend_id);
    $chat_id = $query->get_chat_id($logged_user_id, $friend_id);

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
    if (isset($_GET['exit'])) {
        $insert->remove_chat($chat_id);
    }

?>
<html>
    <body>
        <iframe id="existing-iframe"
                width="640" height="360"
                src="https://www.youtube.com/embed/<?php echo $current_video_id; ?>?enablejsapi=1"
                frameborder="0"
                style="border: solid 4px #37474F"
        ></iframe>
        <div class="chat-container">
            <?php include('includes/messages-container'); ?>
        </div>
        <form method="GET">
            <div>
                Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
            </div>
            <div class = "youtube-submit-button">
                <input type="submit" value="Search">
            </div>
            <h3>Videos</h3>
            <div class="video-search-results">
                <?php foreach ($searchResponse['items'] as $searchResult) : ?>
                <ul>
                    <li><a href="youtube.php?vid=<?php echo $searchResult['id']['videoId']; ?>"><?php echo $searchResult['snippet']['title']; ?></a></li>
                </ul>
                <?php endforeach; ?>
            </div>
            <div class="leave-chat">
                <ul>
                    <li><a href="messages.php" id="exit" name="exit">Exit Chat</a></li>
                </ul>
            </div>
        </form>

    </body>
</html>
