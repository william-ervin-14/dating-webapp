<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="container">
	
	  <h1>Sign Up</h1>
	  <p>Please fill in this form to create an account.</p>
	  <hr>
	  
  	  <label>Username</label>
  	  <input type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>">
  	
  	  <label>Email</label>
  	  <input type="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
  
  	  <label>Password</label>
  	  <input type="password" placeholder="Enter Password" name="password_1">
  
  	  <label>Confirm password</label>
  	  <input type="password" placeholder="Repeat Password" name="password_2">
	  
	  <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
 
  	  <div class="clearfix">
			<button type="button" class="cancelbtn">Cancel</button>
			<button type="submit" value="Register" name="register" class="signupbtn">Sign Up</button>
	  </div>
	  <p class="change_link">
        Already a member ?
        <a href="index.php" class="to_register"> Go and log in </a>
      </p>
  	</div>
  </form>
</body>
</html>