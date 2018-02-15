<html>
	<head>
		<title>Project+ - Sign Up</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/signup.js"></script>
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
				<h1 align="center">SIGN UP</h1><br>
				<form>
					<input id = "f_name" type = "text" class = "form-control " placeholder="First name"><br><br>
					<input id = "l_name" type = "text" class = "form-control " placeholder="Last name"><br><br>
					<input id = "e_mail" type = "text" class = "form-control " placeholder="Email"><br><br>
					<input id = "username" type = "text" class = "form-control " placeholder="Username"><br><br>
					<input id = "password" type = "password" class = "form-control " placeholder = "Password"><br><br>
					<input id = "password_repeat" type = "password" class = "form-control " placeholder = "Repeat password"><br><br>
					<button type = "button" id = "submit-btn" class = "form-control ">
						Sign up
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