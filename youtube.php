<?php

    require_once('load.php');

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email($email);
    $logged_user_id = ($user->ID);
    $message_received_objects = $query->get_message_received_objects($logged_user_id);
    $message_sent_objects = $query->get_message_sent_objects($logged_user_id);
    $current_tab_user = $query->load_user_object($_SESSION['message_friend_id']);
    $different_friends = $query->get_senders($logged_user_id);
    $chat = $query->get_chat($logged_user_id, $_SESSION['message_friend_id']);
    $video_url = '';
    //$insert->update_chat_state($_SESSION['video_url'], $_SESSION['chat_id']);
    if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
        throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
    }

    require_once __DIR__ . '/vendor/autoload.php';

    if (!empty($_GET['q'])) {

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
    if (isset($_GET['vid'])) {
        $current_video_id = $_GET['vid'];
    }
    /*
    elseif (isset($_GET['vid'])){
        $current_video_id = $_GET['vid'];
        $url = $query->get_chat_video_url($_SESSION['chat_id']);
        if($current_video_id !== $url->chat_state){
            $_SESSION['video_url'] = $url->chat_state;
            header('location: '.$_SESSION['video_url']);
        }

    }*/
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['message_content']) && isset($_POST['message_recipient_id'])) {
            $send_message = $insert->send_message($_POST['message_time'], $_POST['message_sender_id'], $_POST['message_recipient_id'], $_POST['message_content']);
            unset($_POST['message_time']);
            unset($_POST['message_sender_id']);
            unset($_POST['message_recipient_id']);
            unset($_POST['message_content']);
            header('location: '.$_SESSION['video_url']);
        }
    }
    if(isset($_POST['exit_chat'])){
        $insert->update_chat_state('', $_SESSION['chat_id']);
        unset($_SESSION['message_friend_id']);
    }
?>

<html>

    <head>
        <title>Youtube</title>
        <link rel="stylesheet" href="css/style.css" />l
    </head>
    <body>
    <h3><?php echo $_SESSION['chat_id']; ?></h3>
    <h3><?php echo $_SESSION['message_friend_id']; ?></h3>
    <h3><?php echo $_SESSION['video_url']; ?></h3>
    <div class="row">
        <form method="GET">
            <div class="video-search-results">
                <div>
                    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
                </div>
                <div class = "youtube-submit-button">
                    <input type="submit" value="Search">
                </div>
                <h3>Videos</h3>
                <?php foreach ($searchResponse['items'] as $searchResult) : ?>
                    <?php $_SESSION['video_url'] = 'youtube.php?vid='.$searchResult['id']['videoId'] ?>
                    <ul>
                        <li><a href=<?php echo $_SESSION['video_url']; ?>><?php echo $searchResult['snippet']['title']; ?></a></li>
                    </ul>
                <?php endforeach; ?>
            </div>
        </form>
        <iframe id="existing-iframe"
                width="640" height="360"
                src="https://www.youtube.com/embed/<?php echo $current_video_id; ?>?enablejsapi=1"
                frameborder="0"
                style="border: solid 4px #37474F"
        ></iframe>
        <form action="messages.php?uid=<?php echo $_SESSION['message_friend_id']; ?>" method="POST">
            <input type="submit" name="exit_chat" value="Exit Chat"/>
        </form>
        <form method="post">
            <div class ="chat-container">
                <?php $messages_temp = $query->do_messages($message_received_objects, $message_sent_objects, $current_tab_user); ?>
                <div class="top-name"><h4><?php echo "{$current_tab_user->firstname} {$current_tab_user->lastname}" ; ?></h4></div>
                <?php foreach($messages_temp as $message_temp): ?>
                    <?php if(in_array($message_temp,$message_received_objects)) :?>
                        <div class="message-box-received">
                            <p><?php echo $message_temp->message_content; ?></p>
                        </div>
                    <?php else : ?>
                        <div class="message-box-sent">
                            <p><?php echo $message_temp->message_content; ?></p>
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
                <div class="send-message-form">
                    <input name="message_time" type="hidden" value="<?php echo time(); ?>" />
                    <input name="message_sender_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
                    <input name="message_recipient_id" type="hidden" value="<?php echo $current_tab_user->ID; ?>" />
                    <input class="message_input" name="message_content" type="text" placeholder="Your message">
                    <button class="submit_button" type="submit" value="Submit">Send</button>
                </div>
            </div>
        </form>
    </div>
    </body>
</html>
