<?php

session_start();
session_destroy();

?>
<html>
	<head>
		<title>Project+ - Log In</title>
		<!-- jquery -->
		<script src = "../js/jquery.js"></script>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/log_in.js"></script>
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/signup_login.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
		<div class = "main container">
			<div id = "logo-div">
				<a href = "/project+/index.php"><img id = "logo" src = "/project+/website_pictures/logo.png"></a>
			</div>
			<hr>
			<div id = "other-div">
				<a href = "../index.php" class = "a-link ">< Go to home page</a>
			</div>
			<br>
			<div id = "form-div">
				<h1 align="center">LOG IN</h1><br>
				<form id = "log-in-form" action = "check_login.php" method = "POST">
					<input name = "username" type = "text" placeholder="Username"><br><br>
					<input name = "password" type = "password" placeholder = "Password"><br>
					<a href = "forgot_pass_submit.php" class = "a-link ">Forgot your password?</a>
					<br>
					<br>
					<button type = "submit" id = "submit-btn">
						Log In
					</button>
				</form>
			</div>
		</div>
	</body>
</html>