<?php
	require_once('class-query.php');
	require_once('class-insert.php');
	require_once('class-db.php');

if ( !class_exists('Login') ){
	class Login{
		public $user;
		public $db;
        public $query;
		public function __construct(){
			global $db;
			global $query;
			session_start(); 
			$this->db = $db;
            $this->query = $query;
		} 
		public function verify_login($post){
			if( ! isset($post['email'] ) || ! isset($post['password'] )) {
				return false;
			}
			$user = $this->user_exists($post['email']);
		
			if( $user !== false ){
				if( md5($post['password']) == $user['password']) {
					$_SESSION['email'] = $user['email'];
					return true;
				}
			}
			return false;
		}
		public function verify_session() {
			if(!isset($_SESSION['email'])){
				$email = $_SESSION['email'];
				$user = $this->user_exists($email);
		
				if( $user != false){
					$this->user = $user;
					return true;
				}
			}
			return false;
		}
		public function register($post){
	
			if( false !== $this->user_exists($post['email'])){
				return array('status'=>0, 'messages'=>'Email already exists');
			}
		
			$query = "INSERT INTO users (firstname, lastname, email, password) 
					VALUES('$post[firstname]', '$post[lastname]', '$post[email]', '$post[password]')";
			
			$insert = $this->db->insert($query);
		
			if($insert == true){
				return array('status'=>1, 'messages'=>'Account created successfully');
			}
			return array('status'=>0, 'messages'=>'An unknown error has occured.');
		}
		private function user_exists($email){
			$user = $this->query->load_user_object_by_email($email);
		
			if($user !== false){
				return $user[0];
			}
			return false;
		}
	}
}
$login = new Login;
