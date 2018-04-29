<html>
	<head>
		<title>Project+ - Reset Password</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- JAVASCRIPT -->

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
				<a href = "../index.php" class = "a-link ">< Go to home page</a><br>
				<a href = "login.php" class = "a-link ">< Go to log in page</a>
			</div>
			<br>
			<div id = "form-div">
				<h1 align="center">PASSWORD RESET - TICKET SUBMISSION</h1><br>
				<form action = "forgot_pass_sender.php" method = "POST">
					<label>Enter email that is associated with your account:</label>
					<input name = "email" type = "email" class = "form-control " placeholder="example@example.com"><br><br>
					<button type = "submit" id = "submit-btn" class = "form-control ">
						Issue ticket
					</button>
				</form>
			</div>
		</div>
	</body>
</html>