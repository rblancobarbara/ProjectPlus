<?php

session_start();
require_once("check_session.php");
require_once("check_ownership.php");
$ok = Check();
if($ok == true && isset($_GET["id"])){
	if(CheckOwnership($_GET["id"])){
		$id = $_GET["id"];
		//
		$title = "";
		$description = "";
		$price = 0;
		$category = "";
		$picture_urls = array();
		$picture_ids = array();
		//
		$conn = new mysqli("localhost","root","","projectplus");
		$query = "SELECT * FROM projects WHERE id = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$id);
			if($sql->execute()){
				$result = $sql->get_result();
				$row = $result->fetch_assoc();
				$title = $row["name"];
				$description = $row["description"];
				$price = $row["price"];
				$category = $row["category"];
			}
			$sql->close();
		}
		$query = "SELECT id,url FROM project_pictures WHERE project_id = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$id);
			if($sql->execute()){
				$sql->store_result();
				$sql->bind_result($pic_id,$url);
				while($sql->fetch()){
					array_push($picture_urls,$url);
					array_push($picture_ids,$pic_id);
				}
			}
			$sql->close();
		}
		$conn->close();
	}
	else{
		exit("This is not your project");
	}
}
else{
	exit("Invalid login");
}

?>

<html>
	<head>
		<title>Project+ - Project Edit</title>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/edit_project_delete_image.js"></script>
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/edit_project.css">
		<link rel = "stylesheet" href = "../css/general.css">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
		<h2 align="center">Edit your project!</h2>
		
		<div class = "container" id = "edit-div">
			<hr class = "hr-black">
			<form action = "edit_project_backend.php?project_id=<?= $id ?>" method = "POST" enctype="multipart/form-data" name="formUploadFile">
				<input name="name" type = "text" placeholder="Project name" class = "form-control" value = "<?php echo $title ?>"><br>
				<textarea name="description" class =  "form-control" placeholder="Project description" rows="4"><?php echo $description ?></textarea><br>
				<input name="price" type = "number" min = 1 placeholder="Min. project price" class = "form-control" value = "<?php echo $price ?>"><br>
				<select name="category" class = "form-control">
					<option value = "Awearness" <?= $category == "Awearness" ? "selected" : "" ?>>Awearness</option>
					<option value = "ITandTechnology" <?= $category == "IT and Technology" ? "selected" : "" ?>>IT and Technology</option>
					<option value = "Physics" <?= $category == "Physics" ? "selected" : "" ?>>Physics</option>
					<option value = "Sport" <?= $category == 'Sport' ? "selected" : '' ?>>Sport</option>
					<option value = "Science" <?= $category == "Science" ? "selected" : "" ?>>Science</option>
					<option value = "Social" <?= $category == "Social" ? "selected" : "" ?>>Social</option>
				</select><br>
				<label>New files:</label>
				<input type="file" name="files[]" multiple="multiple" class = "form-control"><br>
				<label>Old files:</label>
				<!-- holds the currently uploaded pictures -->
				<div class = "container" id = "pictures-holder">
					<?php
						$pic_num = count($picture_urls);
						$rows_num = ceil($pic_num/3);
						$counter = 0;
						for ($i=0; $i < $rows_num ; $i++) { 
							echo("<div class = 'row pic_row'>");
							$curr = 0;
							while($curr < 3 && $counter < count($picture_urls)){
								echo("<div class = 'col-md-4' id = 'old-pic-div'>
										<img id = 'old-pic-img' class = 'd-block img-fluid' src = '../" . $picture_urls[$counter] . "'>
										<div id = 'over-img-div'>
											<a href = 'delete_image.php?pic_id=" . $picture_ids[$counter] . "' id = 'del-pic-a' align = 'center' class = 'text-white'>DELETE &#9747;</a>
										</div>
									</div>");
								$curr++;
								$counter++;
							}
							
							echo("</div>");
							$counter++;
						}
					?>
				</div>
				<br>
				<div id = "button-center-div">
					<button type = "submit" class = "btn-item-blue" id = "submit-btn">Update your idea!</button>
				</div>
			</form>
		</div>
	</body>
</html>
