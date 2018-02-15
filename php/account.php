<?php

session_start();
require_once("check_session.php");
$ok = Check();
if($ok == false){
	exit("Invalid login");
}

?>
<html>
	<head>
		<title>Project+ - Account</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- NAVIGATION -->
		<script src = "../js/main_navigation.js"></script>
		<link rel = "stylesheet" href = "../css/main_navigation.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/account_management.js"></script>
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/general.css">
		<link rel = "stylesheet" href = "../css/account.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
		<!-- FONT AWESOME ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class = "font-raleway">
		<nav>
			<div id = "navbar-container">
				<ul id = "nav-list">
					<li class = "nav-item-logo"><img id = "logo" src = "../website_pictures/logo-white.png"></li>
					<li class = "nav-item"><a class = "nav-link  text-red" href = "logout.php">Log Out</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "messages.php">Messages</a></li>
					<li class = "nav-item"><a class = "nav-link  active" href = "account.php">Account</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "mybids.php">My bids</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "myprojects.php">My projects</a></li>
					<li class = "nav-item"><a class = "nav-link " href = "dashboard.php">Dashboard</a></li>
					<li class = "nav-collapse-item">
						<button type = "button" id = "collapse-menu-btn">
							&#9776;
						</button>
					</li>
				</ul>
			</div>
		</nav>
		<div id = "sliding-menu">
			<ul id = "sliding-menu-list">
				<li class = "sliding-menu-logo"><img id = "slide-logo" src = "../website_pictures/logo.png"></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "dashboard.php">Dashboard</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "myprojects.php">My projects </a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "mybids.php">My bids</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link  active-sliding" href = "account.php">Account</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link " href = "messages.php">Messages</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link  text-red" href = "logout.php">Log out</a></li>
			</ul>
		</div>
		<div id = "main">
			<label for = "full_name">Full Name <i class = "fa fa-id-card"></i></label>
			<input id = "full_name" type = "text" class = "form-control ">
			<label for = "e_mail">Email <i class = "fa fa-envelope"></i></label>
			<input id = "e_mail" type = "email" class = "form-control ">
			<label for = "username">Username <i class = "fa fa-user"></i></label>
			<input id = "username" type = "text" class = "form-control ">
			<div id = "button-div">
				<button id = "save-btn" type = "button">Save changes</button>
			</div>
			<div class = "container">
				<hr class = "hr-black">
			</div>
			<h1 align="center" class = "text-black ">Change password <i class = "fa fa-unlock-alt"></i></h1><br>
			<input id = "curr_pass" type = "password" placeholder = "Current password" class = " form-control"><br>
			<input id = "new_pass" type = "password" placeholder = "New password" class = " form-control"><br>
			<input id = "new_pass_repeat" type = "password" placeholder = "New password repeat" class = " form-control">
			<div id = "button-div">
				<button id = "change-pass-btn" type = "button">Change password</button>
			</div>
			<div class = "container">
				<hr class = "hr-black">
			</div>
		</div>
	</body>
</html>