<?php
	require_once('class-db.php');
	
	if ( !class_exists('INSERT') ) {
		class INSERT {
			public function update_user($user_id, $postdata) {
				global $db;
				
				$table = 'users';
				
				$query = "
								UPDATE $table
								SET email='$postdata[email]', password='$postdata[password]', firstname='$postdata[firstname]'
								WHERE ID=$user_id
							";

				return $db->update($query);
			}
			
			public function add_friend($user_id, $friend_id) {
				global $db;
				
				$table = 'friends';
				
				$query = "
								INSERT INTO $table (user_id, friend_id)
								VALUES ('$user_id', '$friend_id')
							";
				
				return $db->insert($query);
			}
			
			public function remove_friend($user_id, $friend_id) {
				global $db;
				
				$table = 'friends';
				
				$query = "
								DELETE FROM $table 
								WHERE user_id = '$user_id'
								AND friend_id = '$friend_id'
							";
				
				return $db->insert($query);
			}
			
			public function send_message() {
				global $db;
				
				$table = 'messages';
				
				$query = "
								INSERT INTO $table (message_time, message_sender_id, message_recipient_id, message_content)
								VALUES ('$_POST[message_time]', '$_POST[message_sender_id]', '$_POST[message_recipient_id]', '$_POST[message_content]')
							";
				
				return $db->insert($query);
			}
		}
	}
	
	$insert = new INSERT;
?>