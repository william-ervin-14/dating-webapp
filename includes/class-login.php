<?php
	require_once('class-query.php');
	require_once('class-insert.php');
	require_once('class-db.php');

if ( !class_exists('Login') ){
	class Login{
		public $user;
		public $db;
        public $query;
        public $insert;
		public function __construct(){
			global $db;
			global $query;
            global $insert;
			session_start(); 
			$this->db = $db;
            $this->query = $query;
            $this->insert = $insert;
		} 
		public function verify_login($post){
            if (isset($_POST['login_user'])) {
                if (!isset($post['email']) || !isset($post['password'])) {
                    return false;
                }

                $email    = mysqli_real_escape_string($this->db->connection, $post['email']);
                $password = mysqli_real_escape_string($this->db->connection, $post['password']);

                $results = $this->query->load_single_user_by_email_password($email, $password);

                if (mysqli_num_rows($results) == 1) {
                    $_SESSION['email'] = $email;
                    return true;
                }

                return false;
            }
        }
		public function verify_session() {
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $user  = $this->user_exists($email);

                if (false !== $user) {
                    $this->user = $user;
                    return true;
                }
            }
			return false;
		}
		public function register($post) {
            if (isset($_POST['reg_user'])) {

                $email      = $post['email'];
                $first_name = $post['firstname'];
                $last_name  = $post['lastname'];
                $password   = $post['password_1'];

                if ($post['password_2'] !== $post['password_1']) {
                    return "two passwords do not match";
                }

                $results = $this->query->load_single_user_by_email($email);

                if (mysqli_num_rows($results) == 1) {
                    return "Email already exists";
                }

                $insert = $this->insert->register_user($first_name, $last_name, $email, $password);

                if (false !== $insert) {
                    return "Account created successfully.";
                }

                return "An unknown error has occurred";
            }
        }
		private function user_exists($email){
			$user = $this->query->load_user_objects_by_email($email);
		
			if(false !== $user){
				return $user;
			}
			return false;
		}
	}
}
$login = new Login;
