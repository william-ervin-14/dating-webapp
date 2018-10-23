<?php 
  session_start(); 
  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/profilepage.css">
	<title>profile page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="navbar">
		<a href="index.php">Home</a>
		<a href="messages.php">Messages</a>
		<div class="dropdown">
			<button class="dropbtn">Settings</button>
			<div class="dropdown-content">
				<a href="settings.php">Account</a>
				<a href="login.php" name="logout">Log out</a>
			</div>
		</div>
	</div>
	<div id="Settings" class="navBarTabs">
					
		<div class="verticalTabs">
			<button class="tablinks" onclick="openVerticalTab(event, 'View Profile')" id="defaultOpen">View Profile</button>
			<button class="tablinks" onclick="openVerticalTab(event, 'Change password')" >Change password</button>
			<button class="tablinks" onclick="openVerticalTab(event, 'Compatibility questions')">Compatibility questions</button>
		</div>	
				
		<div id="View Profile" class="tabcontent">
			<p>View Profile</p>
			<hr>
			<h4>Name:</h4>
			<hr>
			<h4>Email:</h4>
		</div>
		
		<div id="Change password" class="tabcontent">
			<p>Update account.</p>
			<hr>
			<h4>Update profile picture?</h4>
			<div class="upload-btn-wrapper">
				<button class="btn">Upload a file</button>
				<input type="file" name="myfile" />
			</div>
			<br>
			<br>
			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="psw" required>

			<label for="psw-repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
			
			<hr>
			
			<button type="submit" class="registerbtn">Register</button>
			
		</div>

		<div id="Compatibility questions" class="tabcontent">
				  
			<h1>Compatibility Questions</h1>
			<p>Please fill out these compatibility questions to add to your account.</p>
			<hr>

			<label for="email"><b>Question1</b></label>
			<input type="text" placeholder="Question1" name="question1" required>
					
			<label for="email"><b>Question2</b></label>
			<input type="text" placeholder="Question2" name="question2" required>
					
			<label for="email"><b>Question3</b></label>
			<input type="text" placeholder="Question3" name="question3" required>
					
			<label for="email"><b>Question4</b></label>
			<input type="text" placeholder="Question4" name="question4" required>
			
			<button type="submit" class="registerbtn">Register</button>
			<hr>
			
		</div>	
				
		<script>
			function openVerticalTab(evt, tabName) {
				var i, tabcontent, tablinks;
						
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}

				document.getElementById(tabName).style.display = "block";
				evt.currentTarget.className += " active";
						
			}
			document.getElementById("defaultOpen").click();
		</script>
				
	</div>
	
</body>
</html>