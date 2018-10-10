<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	
  <form method="post" action="register.php">
  	
  	<div class="container">
	  <?php include('errors.php'); ?>
	  <h1>Sign Up</h1>
	  <p>Please fill in this form to create an account.</p>
	  <hr>
  	  <label>First Name</label>
  	  <input type="text" placeholder="Enter First Name" name="firstname" value="<?php echo $firstname; ?>">
	  
	  <label>Last Name</label>
  	  <input type="text" placeholder="Enter Last Name" name="lastname" value="<?php echo $lastname; ?>">
  	
  	  <label>Email</label>
  	  <input type="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
  
  	  <label>Password</label>
  	  <input type="password" placeholder="Enter Password" name="password_1">
  
  	  <label>Confirm password</label>
  	  <input type="password" placeholder="Repeat Password" name="password_2">
	  
	  <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
 
  	  <div class="clearfix">
			<button type="button" class="cancelbtn">Cancel</button>
			<button type="submit" name="reg_user" class="signupbtn">Sign Up</button>
	  </div>
	  <p class="change_link">
        Already a member ?
        <a href="login.php" class="to_register"> Go and log in </a>
      </p>
  	</div>
  </form>
</body>
</html>