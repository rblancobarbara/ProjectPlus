<?php
session_start();
//this script updates the password in the database
if(isset($_POST["password"]) && isset($_POST["password_repeat"]) && isset($_SESSION["user_email_to_change"])){
	$new_pass = $_POST["password"];
	$new_pass_repeat = $_POST["password_repeat"];
	if($new_pass != $new_pass_repeat){
		exit("Passwords do not match");
	}
	if(strlen($new_pass) < 8 || !ContainsNumbers($new_pass))
	{
		exit("Password must be greater then 8 characters long and must contain at least 1 number.\r\n");
	}
	$conn = new mysqli("localhost","root","","projectplus");
	$email_to_change = $_SESSION["user_email_to_change"];
	$query = "UPDATE accounts SET password = ? WHERE e_mail = ?";
	if($sql = $conn->prepare($query)){
		$hashed_pass = password_hash($new_pass,PASSWORD_BCRYPT);
		$sql->bind_param("ss",$hashed_pass,$email_to_change);
		if($sql->execute()){
			echo "Success<br>";
		}
		else{
			echo "Error";
			session_destroy();
		}
		$sql->close();
	}
	$conn->close();
}
function ContainsNumbers($String){
    return preg_match('/\\d/', $String) > 0;
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
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
			<div id = "other-div">
				<a href = "../index.php" class = "a-link ">< Go to home page</a><br>
				<a href = "login.php" class = "a-link ">< Go to log in page</a>
			</div>
		</div>
	</body>
</html>