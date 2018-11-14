<?php
	require_once('class-db.php');

	if ( !class_exists('QUERY') ) {
		class QUERY {


			public function load_user_object($user_id) {
				global $db;
				
				$table = 'users';
				
				$query = "
								SELECT * FROM $table
								WHERE ID = '$user_id'
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				
				return $obj[0];
			}
            public function load_user_objects_by_email($email) {
                global $db;

                $table = 'users';

                $query = "
								SELECT * FROM $table
								WHERE email = '$email'
							";

                $obj = $db->select($query);

                if ( !$obj ) {
                    return "No user found";
                }

                return $obj[0];
            }
			public function load_single_user_by_email($email) {
				global $db;
				
				$table = 'users';
				
				$query = "
								SELECT * FROM $table
								WHERE email = '$email'
							";
				
				$result = $db->select_one($query);

				
				return $result;
			}
            public function load_single_user_by_email_password($email, $password) {
                global $db;

                $table = 'users';

                $query = "
								SELECT * FROM $table
								WHERE email = '$email'
								AND password = '$password'
							";

                $result = $db->select_one($query);


                return $result;
            }
			public function load_user_id($email) {
				global $db;
				
				$table = 'users';
				
				$query = "
								SELECT ID FROM $table
								WHERE email = '$email'
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				
				return $obj;
			}
			public function load_all_user_objects() {
				global $db;
				
				$table = 'users';
				
				$query = "
								SELECT * FROM $table
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				
				return $obj;
			}
			public function get_friends_again($id){
                global $db;

                $table = 'friends';

                $query = "
								SELECT ID, user_id FROM $table
								WHERE friend_id = '$id'
							";

                $friends = $db->select($query);

                return $friends;
            }
			public function get_friends($id) {
				global $db;
				
				$table = 'friends';
				
				$query = "
								SELECT ID, friend_id FROM $table
								WHERE user_id = '$id'
							";
				
				$friends = $db->select($query);
				
				foreach ( $friends as $friend ) {
					$friend_ids[] = $friend->friend_id;
				}

				$more_friends = $this->get_friends_again($id);

                foreach ( $more_friends as $friend ) {
                    $friend_ids[] = $friend->user_id;
                }

				return $friend_ids;
			}
			
			public function get_message_received_objects($user_id) {
				global $db;
				
				$table = 'messages';
				
				$query = "
								SELECT * FROM $table
								WHERE message_recipient_id = '$user_id'
							";
				
				$messages = $db->select($query);
								
				return $messages;
			}
            public function get_message_sent_objects($user_id) {
                global $db;

                $table = 'messages';

                $query = "
								SELECT * FROM $table
								WHERE message_sender_id = '$user_id'
							";

                $messages = $db->select($query);

                return $messages;
            }
            public function get_senders_again($id){
                global $db;

                $table = 'friends';

                $query = "
								SELECT ID, message_recipient_id FROM $table
								WHERE message_sender_id = '$id'
							";

                $friends = $db->select($query);

                return $friends;
            }
            public function get_message_senders($id) {
                global $db;

                $table = 'messages';

                $query = "
								SELECT ID, message_sender_id FROM $table
								WHERE message_recipient_id = '$id'
							";

                $senders = $db->select($query);

                foreach ( $senders as $sender ) {
                    $sender_ids[] = $sender->message_sender_id;
                }

                $more_senders = $this->get_senders_again($id);

                foreach ( $more_senders as $sender ) {
                    $sender_ids[] = $sender->message_recipient_id;
                }


                return $sender_ids;
            }
			
			public function do_user_directory() {
				$users = $this->load_all_user_objects();
				
				foreach ( $users as $user ) { ?>
					<div class="directory_item">
						<h3><a href="profile-view.php?uid=<?php echo $user->ID; ?>"><?php echo "{$user->firstname} {$user->lastname}"; ?></a></h3>
						<p><?php echo $user->email; ?></p>
					</div>
				<?php
				}
			}
			
			public function do_friends_list($friends_array) {
				foreach ( $friends_array as $friend_id ) {
					$users[] = $this->load_user_object($friend_id);
				}
								
				foreach ( $users as $user ) { ?>
					<div class="directory_item">
						<h3><a href="profile-view.php?uid=<?php echo $user->ID; ?>"><?php echo "{$user->firstname} {$user->lastname}"; ?></a></h3>
						<p><?php echo $user->email; ?></p>
					</div>
				<?php
				}
			}
			
			
			public function do_inbox($user_id) {
				$message_objects = $this->get_message_received_objects($user_id);
				
				foreach ( $message_objects as $message ) {?>
					<div class="status_item">
						<?php $user = $this->load_user_object($message->message_sender_id); ?>
						<h3>From: <a href="profile-view.php?uid=<?php echo $user->ID; ?>"><?php echo "{$user->firstname} {$user->lastname}" ; ?></a></h3>
						<p><?php echo $message->message_content; ?></p>
					</div>
				<?php
				}
			}
            public function get_senders($user_id) {
                $sender_ids = $this->get_message_senders($user_id);
                $different_friends = array();

                foreach ( $sender_ids as $sender_id ) {
                    $user = $this->load_user_object($sender_id);
                    if(!in_array($user, $different_friends)){
                        $different_friends[] = $user;
                    }
                }
                return $different_friends;
            }
            function cmp($a, $b){
                return ($a->message_time < $b->message_time) ? -1 : 1;
            }
            public function do_messages($message_received, $message_sent, $friend){
			   $messages_temp = array();
			   foreach($message_received as $received){

                   $friend_temp = $this->load_user_object($received->message_sender_id);

                   if($friend_temp->ID == $friend->ID){
                       $messages_temp[] = $received;
                   }
			   }
			   foreach($message_sent as $sent){

			       $friend_temp = $this->load_user_object($sent->message_recipient_id);

			       if($friend_temp->ID == $friend->ID){
			           $messages_temp[] = $sent;
			       }
			   }
			   usort($messages_temp, array($this, "cmp"));
			   return $messages_temp;
            }
		}
	}
	
	$query = new QUERY;
?>