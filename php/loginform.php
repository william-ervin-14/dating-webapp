<?php
	session_start();
	$_SESSION['message'] = '';
	
	$mysqli = new mysqli('cpsc498.c4gfuryc8w4w.us-east-1.rds.amazonaws.com', 'WillAdmin', 'C@pstone498', 'accounts');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		//make sure two passwords are equal to each other
		if ($_POST['password'] == $_POST['confirmpassword']{
			
			$username = $mysql->real_escape_string($_POST['username']);
			$email = $mysql->real_escape_string($_POST['email']);
			$password = md5($_POST['password']);
			
			$_SESSION['username'] = $username;
			
			$sql = "INSERT INTO users (username, email, password)"
				 . "VALUES ('$username','$email','$password')";
			
			//if query is successful redirect
			if (mysql->query($sql) === true){
				$_SESSION['message'] = "Registration successful! Added user to database";
				header("location: ../index.html");
			}
			else{
				$_SESSION['message'] = "User could not be added to database";
			}
				
		}
		else{
			$_SESSION['message'] = "passwords do not match";
		}
	}
?>