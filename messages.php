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

    $email = $_SESSION['email'];
    $user = $query->load_user_objects_by_email ($email);
    $logged_user_id = ($user->ID);
	$friend_ids = $query->get_friends($logged_user_id);

    //$different_friends = $query->get_senders($logged_user_id);
    $message_objects = $query->get_message_objects($logged_user_id);
?>
        <h1>Messages</h1>
        <div class="content">

            <div class="verticalTabs">
                <button class="tab_links" onclick="openVerticalTab(event, 'New Message')" id="defaultOpen">New Message</button>
                <?php foreach ($message_objects as $message ) : ?>
                    <?php $friend = $query->load_user_object($message->message_sender_id); ?>
                    <button class="tab_links" onclick="openVerticalTab(event, '<?php echo "{$friend->firstname} {$friend->lastname}"  ?>')"><?php echo "{$friend->firstname} {$friend->lastname}"; ?></button>
                <?php endforeach; ?>
            </div>
            <?php foreach ($message_objects as $message ) : ?>
                <?php $friend = $query->load_user_object($message->message_sender_id); ?>
                <div id="<?php echo "{$friend->firstname} {$friend->lastname}"  ?>" class="tab_content">
                    <h3>From: <a href="profile-view.php?uid=<?php echo $friend->ID; ?>"><?php echo "{$friend->firstname} {$friend->lastname}" ; ?></a></h3>
                    <p><?php echo $message->message_content; ?></p>

                </div>
            <?php endforeach; ?>

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