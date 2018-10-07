<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
	<div class="imgcontainer">
		<img src="images/login_avatar.png" alt="Avatar" class="avatar">
	</div>
  	<div class="container">
  		<label>Username</label>
  		<input type="text" placeholder="Enter Username" name="username" >
  	
  		<label>Password</label>
  		<input type="password" placeholder="Enter Password" name="password">
  	
  		<button type="submit" class="btn" name="login_user">Login</button>
		<label>
			<input type="checkbox" checked="checked" name="remember"> Remember me
		</label>
  	</div>
  	<div class="container" style="background-color:#f1f1f1">
		<button type="button" class="cancelbtn">Cancel</button>
		<span class="psw">Forgot <a href="#">password?</a></span>
	</div>
		
	<div class="container">
		Not a member yet?
		<a href="register.php" class="to_register">Join us</a>
	</div>
  </form>
</body>
</html>