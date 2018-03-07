<?php

session_start();
require_once("check_session.php");
$ok = Check();
if($ok == true){
		$conn = new mysqli("localhost","root","","projectplus");
		//get currently logged users id
		$curr_id = $_SESSION["user_id"];
		//defaults
		$project_number = 0;
		$bids_number = 0;
		//counting number of projects
		$query = "SELECT id FROM projects WHERE holder_id = ?";
		if($sql_projects = $conn->prepare($query)){
			$sql_projects->bind_param("i",$curr_id);
			if($sql_projects->execute()){
				$sql_projects->store_result();
				$sql_projects->bind_result($gotten_id_check);
				$sql_projects->fetch();
				$project_number = $sql_projects->num_rows;
				$sql_projects->free_result();
			}
			$sql_projects->close();
		}
		//counting number of bids
		$query = "SELECT id FROM bids WHERE bidder_id = ?";
		if($sql_bid = $conn->prepare($query)){
			$sql_bid->bind_param("i",$curr_id);
			if($sql_bid->execute()){
				$sql_bid->store_result();
				$sql_bid->bind_result($gotten_id_check);
				$sql_bid->fetch();
				$bids_number = $sql_bid->num_rows;
				$sql_bid->free_result();
			}
			$sql_bid->close();
		}
		$conn->close();
}
else{
	exit("Invalid login");
}

?>
<html>
	<head>
		<title>Project+ - Dashboard</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- NAVIGATION -->
		<script src = "../js/main_navigation.js"></script>
		<link rel = "stylesheet" href = "../css/main_navigation.css">
		<!-- JAVASCRIPT -->
	
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/general.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
		<nav>
			<div id = "navbar-container">
				<ul id = "nav-list">
					<li class = "nav-item-logo"><img id = "logo" src = "../website_pictures/logo-white.png"></li>
					<li class = "nav-item"><a class = "nav-link  text-red" href = "logout.php">Log Out</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "messages.php">Messages</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "account.php">Account</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "mybids.php">My bids</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "myprojects.php">My projects</a></li>
					<li class = "nav-item"><a class = "nav-link  active" href = "dashboard.php">Dashboard</a></li>
					<li class = "nav-collapse-item">
						<button type = "button" id = "collapse-menu-btn" class = "">
							&#9776;
						</button>
					</li>
				</ul>
			</div>
		</nav>
		<div id = "sliding-menu">
			<ul id = "sliding-menu-list">
				<li class = "sliding-menu-logo"><img id = "slide-logo" src = "../website_pictures/logo.png"></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link  active-sliding" href = "dasboard.php">Dashboard</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "myprojects.php">My projects </a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "mybids.php">My bids</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "account.php">Account</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "messages.php">Messages</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link  text-red" href = "logout.php">Log out</a></li>
			</ul>
		</div>
		<div id = "main">
			<h1 align="left" class = " text-black">Project number: <span class = " text-blue" align = "center"><?php echo $project_number; ?></span></h1>
			<a href = "myprojects.php" class = "a-link">Go see your projects</a>
			<hr class = "hr-black">
			<h1 align="left" class = " text-black">Bid number: <span class = " text-blue" align = "center"><?php echo $bids_number; ?></span></h1>
			<a href = "mybids.php" class = "a-link">Go see your bids</a>
			<hr class = "hr-black">
		</div>
	</body>
</html>