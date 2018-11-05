<?php
class Server{
	session_start(); 

	// initializing variables
	$firstname = "";
	$lastname = "";
	$email    = "";
	$errors = array(); 
	$genderErr = "";
	$err = "";
	$gender = "";


	// connect to the database
	$db = mysqli_connect('cpsc498.c4gfuryc8w4w.us-east-1.rds.amazonaws.com', 'WillAdmin', 'C@pstone498', 'accounts');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
	
	$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	if (empty($firstname)) { array_push($errors, "First Name is required"); }
	if (empty($lastname)) { array_push($errors, "Last Name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
  
	if ($user) { // if user exists
		if ($user['email'] === $email) {
		array_push($errors, "email already exists");
		}
	}

	//register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password
	
		$query = "INSERT INTO users (firstname, lastname, email, password) 
				VALUES('$firstname', '$lastname', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}
	}
	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong email/password combination");
			}
		}
	}
}
?>