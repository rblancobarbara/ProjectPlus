<?php

session_start();
require_once("scripts/check_session.php");
$ok = Check();
if($ok == false){
	exit("Invalid login");
}

?>
<html>
	<head>
		<title>Project+ - My Projects</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- NAVIGATION -->
		<script src = "../js/main_navigation.js"></script>
		<link rel = "stylesheet" href = "../css/main_navigation.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/fullscreen_div.js"></script>
		<script src = "../js/myprojects.js"></script>
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/general.css">
		<link rel = "stylesheet" href = "../css/myprojects.css">
		<link rel = "stylesheet" href = "../css/project_cards.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
		<!-- FONT AWESOME ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class = "font-raleway">
		<nav>
			<div id = "navbar-container">
				<ul id = "nav-list">
					<li class = "nav-item-logo"><img id = "logo" src = "../website_pictures/logo-white.png"></li>
					<li class = "nav-item"><a class = "nav-link text-red" href = "logout.php">Log Out</a></li>
					<li class = "nav-item"><a class = "nav-link" href = "messages.php">Messages</a></li>
					<li class = "nav-item"><a class = "nav-link" href = "account.php">Account</a></li>
					<li class = "nav-item"><a class = "nav-link" href = "mybids.php">My bids</a></li>
					<li class = "nav-item"><a class = "nav-link active" href = "myprojects.php">My projects</a></li>
					<li class = "nav-item"><a class = "nav-link" href = "dashboard.php">Dashboard</a></li>
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
				<li class = "sliding-menu-item"><a class = "sliding-menu-link" href = "dashboard.php">Dashboard</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link  active-sliding" href = "myprojects.php">My projects </a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link" href = "mybids.php">My bids</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link" href = "account.php">Account</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link" href = "messages.php">Messages</a></li>
				<li class = "sliding-menu-item"><a class = "sliding-menu-link text-red" href = "logout.php">Log out</a></li>
			</ul>
		</div>
		<div id = "main">
			<button id = "open-div-btn" class = "btn-item-blue" type = "button">Add +</button>
			<div id = "fullscreen-div">
				<div class = "container">
					<p align="right" id = "div-close">CLOSE &#9747;</p>
					<div class = "main-full-div" class = "background-white">
						<h1 align="center" >Idea submission form</h1><br>
						<div id = "form-div">
							<form action = "submit_project.php" method = "POST" enctype="multipart/form-data" name="formUploadFile">
								<input name="name" type = "text" placeholder="Project name" class = "form-control"><br>
								<textarea name="description" class =  "form-control" placeholder="Project description" rows="7"></textarea><br>
								<input name="price" type = "number" min = 1 placeholder="Min. project price" class = "form-control"><br>
								<select name="category" class = "form-control">
									<option value = "Awearness">Awearness</option>
									<option value = "ITandTechnology">IT and Technology</option>
									<option value = "Physics">Physics</option>
									<option value = "Sport">Sport</option>
									<option value = "Science">Science</option>
									<option value = "Social">Social</option>
								</select><br>
								<input type="file" name="files[]" multiple="multiple" class = "form-control"><br>
								<div id = "button-center-div">
									<button type = "submit" class = "btn-item-blue" id = "submit-btn">Submit your idea!</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<hr class = "hr-black">
			<div id = "projects-list">
				
			</div>
		</div>
	</body>
</html>