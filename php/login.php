<?php

session_start();
session_destroy();

?>
<html>
	<head>
		<title>Project+ - Log In</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- JAVASCRIPT -->

		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/signup_login.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
		<div class = "main container">
			<div id = "logo-div">
				<a href = "/project+/index.php"><img id = "logo" src = "/project+/website_pictures/logo.png"></a>
			</div>
			<hr>
			<br>
			<div id = "form-div">
				<h1 align="center">LOG IN</h1><br>
				<form action = "check_login.php" method = "POST">
					<input name = "username" type = "text" class = "form-control " placeholder="Username"><br><br>
					<input name = "password" type = "password" class = "form-control " placeholder = "Password"><br>
					<a href = "forgot_pass_submit.php" class = "a-link ">Forgot your password?</a>
					<br>
					<br>
					<button type = "submit" id = "submit-btn" class = "form-control ">
						Log In
					</button>
				</form>
			</div>
			<br>
			<hr>
			<div id = "other-div">
				<a href = "../index.php" class = "a-link ">< Go to home page</a>
			</div>
		</div>
	</body>
</html>