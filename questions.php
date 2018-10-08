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
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==1) echo "checked";?> value=1>1
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==2) echo "checked";?> value=2>2
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==3) echo "checked";?> value=3>3 
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==4) echo "checked";?> value=4>4
		<input type="radio" name="q1" <?php if (isset($q1) && $q1==5) echo "checked";?> value=5>5 
	  <br><br>
	  Question two:
	    <input type="radio" name="q2" <?php if (isset($q2) && $q2==1) echo "checked";?> value=1>1
		<input type="radio" name="q2" <?php if (isset($q2) && $q2==2) echo "checked";?> value=2>2
		<input type="radio" name="q2" <?php if (isset($q2) && $q2==3) echo "checked";?> value=3>3 
		<input type="radio" name="q2" <?php if (isset($q2) && $q2==4) echo "checked";?> value=4>4
		<input type="radio" name="q2" <?php if (isset($q2) && $q2==5) echo "checked";?> value=5>5
	  <br><br>	
	  Question three:
		<input type="radio" name="q3" <?php if (isset($q3) && $q3==1) echo "checked";?> value=1>1
		<input type="radio" name="q3" <?php if (isset($q3) && $q3==2) echo "checked";?> value=2>2
		<input type="radio" name="q3" <?php if (isset($q3) && $q3==3) echo "checked";?> value=3>3 
		<input type="radio" name="q3" <?php if (isset($q3) && $q3==4) echo "checked";?> value=4>4
		<input type="radio" name="q3" <?php if (isset($q3) && $q3==5) echo "checked";?> value=5>5 
	  <br><br>
	  Question four:
	    <input type="radio" name="q4" <?php if (isset($q4) && $q4==1) echo "checked";?> value=1>1
		<input type="radio" name="q4" <?php if (isset($q4) && $q4==2) echo "checked";?> value=2>2
		<input type="radio" name="q4" <?php if (isset($q4) && $q4==3) echo "checked";?> value=3>3 
		<input type="radio" name="q4" <?php if (isset($q4) && $q4==4) echo "checked";?> value=4>4
		<input type="radio" name="q4" <?php if (isset($q4) && $q4==5) echo "checked";?> value=5>5
	  <br><br>
	  Question four:
	    <input type="radio" name="q5" <?php if (isset($q5) && $q5==1) echo "checked";?> value=1>1
		<input type="radio" name="q5" <?php if (isset($q5) && $q5==2) echo "checked";?> value=2>2
		<input type="radio" name="q5" <?php if (isset($q5) && $q5==3) echo "checked";?> value=3>3 
		<input type="radio" name="q5" <?php if (isset($q5) && $q5==4) echo "checked";?> value=4>4
		<input type="radio" name="q5" <?php if (isset($q5) && $q5==5) echo "checked";?> value=5>5
	  <br><br>		
  	  <div class="clearfix">
			<button type="submit" name="questions_user" class="signupbtn">Submit</button>
	  </div>
  	</div>
  </form>
</body>
</html>