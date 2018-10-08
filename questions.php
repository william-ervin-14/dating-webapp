<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
  
</head>
<body>
	
  <form method="post" action="questions.php">
  	
  	<div class="container">
	  <h1>Sign Up</h1>
	  <p>Please fill out these compatability questions to complete account.</p>
	  <hr>
  	  Gender:
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other 
	  <br><br>
	  Question one:
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==1) echo "checked";?> value=1>One
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==2) echo "checked";?> value=2>Two
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==3) echo "checked";?> value=3>Three 
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==4) echo "checked";?> value=4>Four
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==5) echo "checked";?> value=5>Five 
	  <br><br>
 
  	  <div class="clearfix">
			<button type="submit" name="questions_user" class="signupbtn">Submit</button>
	  </div>
  	</div>
  </form>
</body>
</html>