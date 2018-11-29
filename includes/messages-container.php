<?php
?>
<html>

    <select name="message_recipient_id">
        <option value="">--Select a Friend--</option>
        <?php foreach ( $friend_objects as $friend ) : ?>
            <option value="<?php echo $friend->ID; ?>"><?php echo "{$friend->firstname} {$friend->lastname}"; ?></option>
        <?php endforeach; ?>
    </select>
    <?php $messages_temp = $query->do_messages($message_received_objects, $message_sent_objects, $current_tab_user); ?>
    <div class="top-name"><h4><?php echo "{$current_tab_user->firstname} {$current_tab_user->lastname}" ; ?></h4></div>
    <?php foreach($messages_temp as $message_temp): ?>
        <?php if(in_array($message_temp,$message_received_objects)) :?>
            <div class="message-box-received">
                <p><?php echo $message_temp->message_content; ?></p>
            </div>

            <div class="message-time-received">
                <p><?php echo $message_temp->message_time; ?></p>
            </div>
        <?php else : ?>
            <div class="message-box-sent">
                <p><?php echo $message_temp->message_content; ?></p>
            </div>

            <div class="message-time-sent">
                <p><?php echo $message_temp->message_time; ?></p>
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


</html>
