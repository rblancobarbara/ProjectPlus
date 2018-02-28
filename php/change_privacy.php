<?php

session_start();
require_once("check_session.php");
require_once("check_ownership.php");
$ok = Check();
if($ok == true && isset($_GET["set"]) && isset($_GET["id"])){
		$set = $_GET["set"]; // what privacy level to set
		$proj_id = $_GET["id"]; // for what project
		$change = CheckOwnership($proj_id);
		$message = "";
		if($change == true){ // if the holder id is same as the logged in users id
			$conn = new mysqli("localhost","root","","projectplus");
			$curr_status = "";
			// checks if the project is verified
			$check = "SELECT status FROM projects WHERE id = ?";
			if($sql_check = $conn->prepare($check)){
				$sql_check->bind_param("i",$proj_id);
				if($sql_check->execute()){
					$sql_check->bind_result($current_read_status);
					if($sql_check->fetch()){
						$curr_status = $current_read_status;
					}
				}
				$sql_check->close();
			}
			if($curr_status != "Not verified"){ // if the project is verified
				$query = "UPDATE projects SET status = ? WHERE id = ?"; // updates projects status
				if($sql_change = $conn->prepare($query)){
					$sql_change->bind_param("si",$set,$proj_id);
					if($sql_change->execute()){
						$message = "Status of the project changed to " . $set;
					}
					else{
						$message = "Error. Something went wrong :(";
					}
					$sql_change->close();
				}
			}
			else{
				$message = "This project has not been verified yet by our team.<br>Try again when it is verified. Thank you!";
			}
		}
		else{
			exit("This is not your project to change its privacy! Accurate measures for your account will be taken soon because of this try.");
		}
		$conn->close();
}
else{
	exit("Invalid login");
}

?>

<html>
	<head>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/general.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/go_back_browser.js"></script>
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
		<div class = "container">
			<h2 align="center"><?php echo $message ?></h2>
			<hr class = "hr-black">
			<p id = "go_back_history" align="center">Go back</p>
		</div>
	</body>
</html>