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
            header('location: messages.php');
        }
    }
?>
        <h1>Messages</h1>
        <div class="message_content">
            <form method="post">

                <div class="verticalTabs">
                    <button class="tab_links" type="button" onclick="openVerticalTab(event, 'New Message'); return false;" id="defaultOpen">New Message</button>
                    <?php foreach ($different_friends as $friend ) : ?>
                        <button class="tab_links" type="button" onclick="openVerticalTab(event, '<?php echo "{$friend->firstname} {$friend->lastname}"  ?>'); return false;"><?php echo "{$friend->firstname} {$friend->lastname}"; ?></button>
                    <?php endforeach; ?>
                </div>

                <div id="New Message" class="tab_content">
                    <input name="message_time" type="hidden" value="<?php echo time(); ?>" />
                    <input name="message_sender_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
                    <p>
                        <label for="message_recipient_id">To:</label>
                        <select name="message_recipient_id">
                            <option value="">--Select a Friend--</option>
                            <?php foreach ( $friend_objects as $friend ) : ?>
                                <option value="<?php echo $friend->ID; ?>"><?php echo "{$friend->firstname} {$friend->lastname}"; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p>
                        <label for="message_content">Message:</label>
                        <textarea name="message_content"></textarea>
                    </p>
                    <p>
                        <input type="submit" value="Submit" />
                    </p>
                </div>

                <div class ="chat_container">
                    <?php foreach ($different_friends as $friend) : ?>
                        <?php $messages_temp = $query->do_messages($message_received_objects, $message_sent_objects, $friend); ?>
                        <div id="<?php echo "{$friend->firstname} {$friend->lastname}"  ?>" class="tab_content">
                            <div class="top_name"><h4><?php echo "{$friend->firstname} {$friend->lastname}" ; ?></h4></div>
                            <?php foreach($messages_temp as $message_temp): ?>
                                <?php if(in_array($message_temp,$message_received_objects)) :?>
                                    <div class="message_box_received">
                                        <p><a href="profile-view.php?uid=<?php echo $friend->ID; ?>"><?php echo "{$friend->firstname} {$friend->lastname}" ; ?></a></p>
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
                                <input name="message_recipient_id" type="hidden" value="<?php echo $friend->ID; ?>" />
                                <input class="message_input" name="message_content" type="text" placeholder="Your message">
                                <button class="submit_button" type="submit" value="Submit">Send</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
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