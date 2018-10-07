<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="container">
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
        <a href="index.html" class="to_register"> Go and log in </a>
      </p>
  	</div>
  </form>
</body>
</html>