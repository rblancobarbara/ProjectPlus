<?php

session_start();
require_once("check_session.php");
$ok = Check();
$link = "";
if($ok == true && isset($_GET["id"])){
	$id = $_GET["id"];
	$link = "https://www.projectplus.com/view_project?id=" . $id;
}
else{
	exit("Invalid login");
}

?>

<html>
	<head>
		<!-- BOOTSTRAP4 -->
		<script src = "../../js/jquery.js"></script>	
		<script src = "../../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../../css/bootstrap.css">
		<!-- JAVASCRIPT -->
		<script src = "../../js/twitter_for_website.js"></script>
		<script src = "../../js/facebook_sdk.js"></script>
		<script src = "../../js/go_back_browser.js"></script>
		<!-- CSS -->
		<link rel = "stylesheet" href = "../../css/general.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../../css/fonts.css">
	</head>
	<body class = "background-white font-Raleway">
		<div class = "container">
			<h2 align="center">Your share link is ready</h2>
			<hr class = "hr-black">
			<p align="center"><?php if($link != ""){ echo $link; }else{ echo "Error generating a link."; }  ?></p>
		</div>
		<div id = "share-buttons-div">
			<div id="fb-root"></div>
			<div class="fb-share-button" data-href="<?php if($link != ""){ echo $link; }else{ echo "#"; }  ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
			<div class = "twitter-share-button">
				<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hey,%20come%20and%20take%20a look%20at%20my%20project%20@%20"
				  data-size="large">
				Tweet</a>
			</div>
			<hr class = "hr-black">
			<p id = "go_back_history" align="center">Go back</p>
		</div>
	</body>
</html>