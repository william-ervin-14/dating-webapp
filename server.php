<?php
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
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) { array_push($errors, "First Name is required"); }
  if (empty($lastname)) { array_push($errors, "Last Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (firstname, lastname, email, password) 
  			  VALUES('$firstname', '$lastname', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: questions.php');
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
// QUESTIONS
if (isset($_POST['questions_user'])) {
	$email = $_SESSION['email'];
	if (empty($_POST["gender"])) {
		$genderErr = "Gender is required";
	} else {
		$gender = mysqli_real_escape_string($db, $_POST["gender"]);
		$query = "UPDATE users SET gender='$gender' WHERE email='$email'";
		mysqli_query($db, $query);
	}
	if(empty($_POST["q1"])){ $err = "Answer the question";}
	else{
		$q1 = $_POST["q1"];
		$query = "UPDATE users SET q1='$q1' WHERE email='$email'";
		mysqli_query($db, $query);
	}
	if(empty($_POST["q2"])){ $err = "Answer the question";}
	else{
		$q2 = $_POST["q2"];
		$query = "UPDATE users SET q2='$q2' WHERE email='$email'";
		mysqli_query($db, $query);
	}
	if(empty($_POST["q3"])){ $err = "Answer the question";}
	else{
		$q3 = $_POST["q3"];
		$query = "UPDATE users SET q3='$q3' WHERE email='$email'";
		mysqli_query($db, $query);
	}
	if(empty($_POST["q4"])){ $err = "Answer the question";}
	else{
		$q4 = $_POST["q4"];
		$query = "UPDATE users SET q4='$q4' WHERE email='$email'";
		mysqli_query($db, $query);
	}
	if(empty($_POST["q5"])){ $err = "Answer the question";}
	else{
		$q5 = $_POST["q5"];
		$query = "UPDATE users SET q5='$q5' WHERE email='$email'";
		mysqli_query($db, $query);
	}
	header('location: index.php');
}

?>