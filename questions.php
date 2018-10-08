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
		<span class="error"><?php echo $genderErr;?></span>
	  <br><br>
 
  	  <div class="clearfix">
			<button type="submit" name="questions_user" class="signupbtn">Submit</button>
	  </div>
  	</div>
  </form>
</body>
</html>