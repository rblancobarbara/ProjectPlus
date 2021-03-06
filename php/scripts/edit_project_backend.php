<?php

session_start();
require_once("check_session.php");
require_once("check_ownership.php");
$ok = Check();
if($ok == true){
	$errors = array();
	$uploadedFiles = array();
	$extension = array("jpeg","jpg","JPG","png","gif");
	$bytes = 4096;
	$KB = 1024;
	$totalBytes = $bytes * $KB;
	$UploadFolder = "project_pictures";
	    if(count($_FILES["files"]["tmp_name"])>0 && count($_FILES["files"]["tmp_name"])<=5){

        	if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["category"]) && isset($_GET["project_id"])){
        		if(CheckOwnership($_GET["project_id"]) == true){
        			$user_id = $_SESSION["user_id"];
					$name = $_POST["name"];
					$description = $_POST["description"];
					$price = $_POST["price"];
					$category = $_POST["category"];
					if(trim($name) == "" || trim($description) == "" || trim($price) == "" || trim($category) == "")
					{
						$done = "Empty fields are found. Please go back and fill them in.";
					}
					else{
						$conn = new mysqli("localhost","root","","projectplus");
						$query = "UPDATE projects SET name = ? , description = ? , price = ? , category = ? WHERE id = ?";
						$done = "We are sorry to tell you, but there was an error updating your idea! Please, do not forget it and try updating it at a later time, thank you! :)";
						if($sql = $conn->prepare($query)){
							$sql->bind_param("ssisi",$name,$description,$price,$category,$_GET["project_id"]);
							if($sql->execute()){
								$done = "Hooray! Your project was updated! Thank you for this! Keep track of your project and be sure to update it regularly.";
								foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
								    $temp = $_FILES["files"]["tmp_name"][$key];
								    $name = $_FILES["files"]["name"][$key];
								     
								    if(empty($temp))
								    {
								        break;
								    }
								     
								    $UploadOk = true;
								     
								    if($_FILES["files"]["size"][$key] > $totalBytes)
								    {
								        $UploadOk = false;
								        array_push($errors, $name." file size is larger than the 4 MB.");
								    }
								     
								    $ext = pathinfo($name, PATHINFO_EXTENSION);
								    if(in_array($ext, $extension) == false){
								        $UploadOk = false;
								        array_push($errors, $name." is invalid file type.");
								    }
								     
								    if(file_exists($UploadFolder."/".$name) == true){
								        $UploadOk = false;
								        array_push($errors, $name." file is already exist.");
								    }
								     
								    if($UploadOk == true){
								        move_uploaded_file($temp,"../" . $UploadFolder."/".$name);
								        array_push($uploadedFiles, $name);
								    }
								}
							    if(count($errors)>0)
							    {
							        echo "<b>Errors:</b>";
							        echo "<br/><ul>";
							        foreach($errors as $error)
							        {
							            echo "<li>".$error."</li>";
							        }
							        echo "</ul><br/>";
							    }
							}
							else{
								$done = $conn->error;
							}
							$sql->close();
						}
				        foreach($uploadedFiles as $fileName)
				        {
				            $url = "project_pictures/" . $fileName;
				            $query = "INSERT INTO project_pictures(project_id,url) VALUES(?,?)";
				            if($sql = $conn->prepare($query)){
				            	$sql->bind_param("is", $_GET["project_id"],$url);
				            	$sql->execute();
				            	$sql->close();
				            }
				        }
				        $conn->close();
					}
        		}
				else{
					$done = "This is not your project.";
				}
	    	}
	    	else{
	    		$done = "Something is empty";
	    	}
	    }
	    else{
	    	$done = "Please choose between 0 and 5 pictures for a single upload.";
	    }
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
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "background-white font-Raleway">
		<div class = "container">
			<h2 align="center"><?= $done ?></h2>
			<hr class = "hr-black">
			<ul>
				<?php 

				if(count($uploadedFiles) > 0){
					echo('<p><b>Uploaded files:</b></p>');
					foreach ($uploadedFiles as $fileName) {
						echo "<li>" . $fileName . "</li>";
					}
				}
				else{
					echo "<li>No files uploaded now</li>";
				}

				?>
			</ul>
			<hr class = "hr-black">
			<p id = "go_back_history" align="center">Go back</p>
		</div>
	</body>
</html>