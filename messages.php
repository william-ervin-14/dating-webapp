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
?>
<h1>Messages</h1>
<h3><?php echo $current_tab->ID; ?></h3>
<div class="message_content">
    <form method="post">

        <div id="navigation">
            <?php foreach ($different_friends as $friend ) : ?>
                <ul>
                    <li><a href="messages.php?uid=<?php echo $friend->ID ?>"><?php echo "{$friend->firstname} {$friend->lastname}"; ?></a></li>
                    <?php $current_tab = $friend; ?>
                </ul>
            <?php endforeach; ?>
        </div>

        <div class ="chat_container">

                <?php $messages_temp = $query->do_messages($message_received_objects, $message_sent_objects, $current_tab_user); ?>

                    <?php foreach($messages_temp as $message_temp): ?>
                        <?php if(in_array($message_temp,$message_received_objects)) :?>
                            <div class="message_box_received">
                                <p><a href="profile-view.php?uid=<?php echo $current_tab_user->ID; ?>"><?php echo "{$current_tab_user->firstname} {$current_tab_user->lastname}" ; ?></a></p>
                                <p><?php echo $message_temp->message_content; ?></p>
                                <p><?php echo $message_temp->message_time; ?></p>
                            </div>
                        <?php else : ?>
                            <div class="message_box_sent">
                                <p><a href="profile-view.php?uid=<?php echo $user->ID; ?>"><?php echo "{$user->firstname} {$user->lastname}" ; ?></a></p>
                                <p><?php echo $message_temp->message_content; ?></p>
                                <p><?php echo $message_temp->message_time; ?></p>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                    <div class="send_message_form">
                        <input name="message_time" type="hidden" value="<?php echo time(); ?>" />
                        <input name="message_sender_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
                        <input name="message_recipient_id" type="hidden" value="<?php echo $current_tab_user->ID; ?>" />
                        <input class="message_input" name="message_content" type="text" placeholder="Your message">
                        <button class="submit_button" type="submit" value="Submit">Send</button>
                    </div>
                </div>
        </div>
    </form>
    <script>
        function openVerticalTab(evt, tabName) {
            var i, tab_content, tab_links;

            tab_content = document.getElementsByClassName("tab_content");
            for (i = 0; i < tab_content.length; i++) {
                tab_content[i].style.display = "none";
            }
            tab_links = document.getElementsByClassName("tab_links");
            for (i = 0; i < tab_links.length; i++) {
                tab_links[i].className = tab_links[i].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
</div>
</body>
</html>