<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body> 
<div class="aurora-outer">
 <div class="aurora-inner">
  <form method="post" action="login.php">
  	<div class="container">
		<?php include('errors.php'); ?>
		<h1>Log In</h1>
		
		<hr>
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
 </div>
</div>
</body>
</html>