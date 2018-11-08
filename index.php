<?php  
  require_once('load.php');
  
  if(isset($_POST['login_user'])){
	  $login_status = $login->verify_login($_POST);
  }
  if($login->verify_session() ){
	  $user = $login->user;
	  
	  include( 'home.php' );
  } else {
	  include( 'login.php' );
  }
?>
