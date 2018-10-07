<head>
	<link rel="stylesheet" href="css/register.css">
</head>

<html>
<body>
<form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<div class="container">
		<h1>Sign Up</h1>
		<p>Please fill in this form to create an account.</p>
		<hr>
			
		<div class="alert alert-error"><?= $_SESSION['message'] ?></div>
			
		<label for="username"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="username" required>

		<label for="email"><b>Email</b></label>
		<input type="email" placeholder="Enter Email" name="email" required>

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required>

		<label for="psw-repeat"><b>Repeat Password</b></label>
		<input type="password" placeholder="Repeat Password" name="confirmpassword" required>

		<label>
			<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
		</label>

		<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

		<div class="clearfix">
			<button type="button" class="cancelbtn">Cancel</button>
			<button type="submit" value="Register" name="register" class="signupbtn">Sign Up</button>
		</div>
		<p class="change_link">
            Already a member ?
            <a href="index.html" class="to_register"> Go and log in </a>
        </p>
	</div>
</form> 
</body> 
</html>   
