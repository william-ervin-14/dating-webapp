<?php  
  require_once('load.php');
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
	  $login_status = $login->verify_login($_POST);

	  if( false !== $login_status){

          if($login->verify_session() ){
              $user = $login->user;
              header('location: home.php');
              //include( 'home.php' );
          } else {
              header('location: config.php');
          }
      } else {
          header('location: login.php');
          //include( 'login.php' );
      }
  }


