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
    $current_tab_id;
    $chat = $query->get_chat($logged_user_id, $_SESSION['message_friend_id']);

    if ( !empty ( $_GET['uid'] ) ) {
        $current_tab_id = $_GET['uid'];
        $_SESSION['message_friend_id'] = $current_tab_id;
        $current_tab_user = $query->load_user_object($current_tab_id);
        if("No chat found" == $chat){
            $insert->add_chat($logged_user_id, $_SESSION['message_friend_id']);
            $chat = $query->get_chat($logged_user_id, $_SESSION['message_friend_id']);
            $_SESSION['chat_id'] = ($chat->ID);
        }else{
            $_SESSION['chat_id'] = ($chat->ID);
        }
    }

    foreach ( $friend_ids as $friend_id ) {
        $friend_objects[] = $query->load_user_object($friend_id);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['message_content']) && isset($_POST['message_recipient_id'])) {
            $send_message = $insert->send_message($_POST['message_time'], $_POST['message_sender_id'], $_POST['message_recipient_id'], $_POST['message_content']);
            unset($_POST['message_time']);
            unset($_POST['message_sender_id']);
            unset($_POST['message_recipient_id']);
            unset($_POST['message_content']);
            header('location: messages.php?uid='.$current_tab_id);
        }
        if(isset($_POST['send_invitation'])){
            $insert->send_invitation($current_tab_id, $logged_user_id, 0, 0);
        }

    }


?>
<head>
    <title>Messages</title>
</head>
<h1>Messages</h1>
<p><?php echo $current_tab_id; ?></p>
    <form method="post">
        <div class="row">
            <div id="vertical-navigation">
                <?php foreach ($different_friends as $friend ) : ?>
                    <ul>
                        <li><a href="messages.php?uid=<?php echo $friend->ID ?>"><?php echo "{$friend->firstname} {$friend->lastname}"; ?></a></li>
                        <?php $current_tab = $friend; ?>
                    </ul>
                <?php endforeach; ?>
            </div>

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
            <input>
                <input type="submit" name="send_invitation" value="Send Invitation"/>
                <li><a href="youtube.php?cid=<?php echo $_SESSION['chat_id']; ?>" name="invitation">Watch Youtube?</a></li>
            </ul>
        </div>
    </form>
</body>
</html>