<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body> 
  <form method="post" action="login.php">
  	<div class="container">
		<h1>Log In</h1>
		<?php include('errors.php'); ?>
  		<label>Email</label>
  		<input type="email" placeholder="Enter Email" name="email" >
		
  		<label>Password</label>
  		<input type="password" placeholder="Enter Password" name="password">
  	
  		<button type="submit" class="btn" name="login_user">Login</button>
		<label>
			<input type="checkbox" checked="checked" name="remember"> Remember me
		</label>
  	
  	<div class="container" style="background-color:#f1f1f1">
		<span class="psw">Forgot <a href="#">password?</a></span>
		Not a member yet?
		<a href="register.php" class="to_register">Join us</a>
	</div>
		
	</div>
  </form>
</body>
</html>