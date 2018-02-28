<?php

session_start();
require_once("check_session.php");
require_once("check_ownership.php");
$ok = Check();
if($ok == true && isset($_GET["id"])){
	$del_id = $_GET["id"]; //id of project to delete
	$delete = CheckOwnership($del_id);
	$message = "";
	if($delete == true){
		$conn = new mysqli("localhost","root","","projectplus");
		$first = false;
		$second = false;
		$query = "DELETE FROM projects WHERE id = ?"; // deletes from projects table
		if($del_sql = $conn->prepare($query)){
			$del_sql->bind_param("i",$del_id);
			if($del_sql->execute()){
				$first= true;
			}
			$del_sql->close();
		}
		$query = "SELECT url FROM project_pictures WHERE project_id = ?";//deletes pictures associated to this project from project_pictures folder
		if($delete_pics = $conn->prepare($query)){
			$delete_pics->bind_param("i",$del_id);
			if($delete_pics->execute()){
				$delete_pics->store_result();
				$delete_pics->bind_result($del_url);
				while($delete_pics->fetch()){
					unlink("../" . $del_url);
				}
			}
			$delete_pics->close();
		}
		$query = "DELETE FROM project_pictures WHERE project_id = ?"; // deletes all urls that are connected to this projects with del id
		if($pic_sql = $conn->prepare($query)){
			$pic_sql->bind_param("i",$del_id);
			if($pic_sql->execute()){
				$second = true;
			}
			$pic_sql->close();
		}
		if($first == true && $secon = true){
			$message = "Your project was deleted! We are sorry to hear this :( <br> Be sure to keep up your work and creativity and maybe one day post your idea again here on our website!";
		}
		else{
			$message = "Error. Something went wrong :(";
		}
	}
	else{
		exit("This is not your project to delete! Accurate measures for your account will be taken soon because of this try.");
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