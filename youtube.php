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
    $current_video_id = $_GET['vid'];
    $friend_id = $_GET['uid'];
    $_SESSION['friend_id'] = $friend_id;
    $current_tab_user = $query->load_user_object($_SESSION['friend_id']);
    $different_friends = $query->get_senders($logged_user_id);
    $chat = $query->get_chat($logged_user_id, $_SESSION['friend_id']);

    if("No chat found" == $chat){
        $insert->add_chat($logged_user_id, $_SESSION['friend_id']);
        $chat = $query->get_chat($logged_user_id, $_SESSION['friend_id']);
        $chat_id = ($chat->ID);
    }else{
        $chat_id = ($chat->ID);
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
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['new_message_content']) && isset($_POST['new_message_recipient_id'])) {
            $send_message = $insert->send_message($_POST['new_message_time'], $_POST['new_message_sender_id'], $_POST['new_message_recipient_id'], $_POST['new_message_content']);
            unset($_POST['new_message_time']);
            unset($_POST['new_message_sender_id']);
            unset($_POST['new_message_recipient_id']);
            unset($_POST['new_message_content']);
            header('location: messages.php?uid='.$friend_id);
        }
        if (!empty($_POST['message_content']) && isset($_POST['message_recipient_id'])) {
            $send_message = $insert->send_message($_POST['message_time'], $_POST['message_sender_id'], $_POST['message_recipient_id'], $_POST['message_content']);
            unset($_POST['message_time']);
            unset($_POST['message_sender_id']);
            unset($_POST['message_recipient_id']);
            unset($_POST['message_content']);
            header('location: youtube.php?uid='.$friend_id);
        }

    }

    $exit_chat_button = $_POST['exit_chat'];
    if($exit_chat_button){
        $insert->remove_chat($logged_user_id, $_SESSION['friend_id']);
        unset($_SESSION['friend_id']);
    }


?>
<html>
    <head>
        <title>Youtube</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
    <div class="row">
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
        </form>
        <iframe id="existing-iframe"
                width="640" height="360"
                src="https://www.youtube.com/embed/<?php echo $current_video_id; ?>?enablejsapi=1"
                frameborder="0"
                style="border: solid 4px #37474F"
        ></iframe>
        <form action="messages.php?uid=<?php echo $friend_id ?>" method="post">
            <input type="submit" name="exit_chat" value="Exit Chat"/>
        </form>
        <h3><?php echo $chat_id; ?></h3>
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
