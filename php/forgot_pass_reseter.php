<?php
// this script is for html css form to enter the new password once the user has clicked the link in his email inbox
session_start();
if(!isset($_GET["ticket_id"]) || !isset($_GET["ticket_code"])){
	exit("Error");
	session_destroy();
}
else{
	$ticket_id  = $_GET["ticket_id"];
	$ticket_code = $_GET["ticket_code"];
	$conn = new mysqli("localhost","root","","projectplus");
	$query = "SELECT email FROM reset_tickets WHERE id = ? AND ticket_hash = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("is",$ticket_id,$ticket_code);
		if($sql->execute()){
			$sql->store_result();
			$sql->bind_result($gotten_email);
			if($sql->num_rows == 0){
				exit("Error");
				session_destroy();
			}
			else{
				if($sql->fetch()){
					$_SESSION["user_email_to_change"] = $gotten_email;
				}	
			}
		}
		$sql->close();
	}
	$conn->close();
}

?>
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
				<h1 align="center">RESET PASSWORD</h1><br>
				<form action = "forgot_pass_changer.php" method = "POST">
					<input name = "password" type = "password" class = "form-control " placeholder = "New password"><br><br>
					<input name = "password_repeat" type = "password" class = "form-control " placeholder="New password repeat"><br><br>
					<button type = "submit" id = "submit-btn" class = "form-control ">
						Reset the password
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