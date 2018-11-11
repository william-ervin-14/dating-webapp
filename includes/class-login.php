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
                //$user = $this->user_exists($post['email']);

               // if ($user !== false) {
                    //if (($post['password']) == $user['password']) {
                       // $_SESSION['email'] = $user['email'];
                        //return true;
                    //}
               // }
                $email = mysqli_real_escape_string($this->db->connection, $post['email']);
                $password = mysqli_real_escape_string($this->db->connection, $post['password']);
                $encrypt_password = md5($password);

                $query = "SELECT * FROM users WHERE email='$email' AND password='$encrypt_password'";
                $results = mysqli_query($this->db->connection, $query);
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
                $user = $this->user_exists($email);

                if (false !== $user) {
                    $this->user = $user;
                    return true;
                }
            }
			return false;
		}
		public function register($post) {
            if (isset($_POST['reg_user'])) {
                if ($post['password_2'] !== $post['password_1']) {
                    return "two passwords do not match";
                }
                $email = $post['email'];
                //$query = "SELECT * FROM users WHERE email='$email'";
                //$results = mysqli_query($this->db->connection, $query);
                $results = $this->query->load_user_object_by_email($email);
                if (mysqli_num_rows($results) == 1) {
                    return "Email already exists";
                }
                $firstname = $post['firstname'];
                $lastname  = $post['lastname'];
                $password  = md5($post['password_1']);

                //$query = "INSERT INTO users (firstname, lastname, email, password)
				//	VALUES('$firstname', '$lastname', '$email', '$password')";

                //$insert = $this->db->insert($query);
                $insert = $this->insert->register_user($firstname, $lastname, $email, $password);

                if (false !== $insert) {
                    return "Account created successfully.";
                }
                return "An unknown error has occurred";
            }
        }
		private function user_exists($email){
			$user = $this->query->load_user_object_by_email($email);
		
			if(false !== $user){
				return $user[0];
			}
			return false;
		}
	}
}
$login = new Login;
