<?php

session_start();
require("my_project_class.php");
require_once("check_session.php");
$ok = Check();
if($ok == true){
	$conn = new mysqli("localhost","root","","projectplus");
	$conn->set_charset("utf-8");
	$user_id = $_SESSION["user_id"];
	$query = "SELECT * FROM projects WHERE holder_id = ?";
	$my_projects = array();
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$user_id);
		if($sql->execute()){
			$result = $sql->get_result();
			while($row = $result->fetch_assoc()){
				$project = new Project($row["id"],$row["holder_id"],$row["name"],$row["description"],$row["price"],$row["likes"],$row["saves"],$row["category"],$row["status"],$row["date_posted"]);
				array_push($my_projects,$project);
				$project->GenerateCard();
			}
		}
		$sql->close();
	}
	$conn->close();
	if(count($my_projects) == 0){
		echo "<h3 align = 'center'>No your projects found! :( <br> Create one by clicking on 'Add +'</h3>";
	}
}
else{
	exit("Invalid login");
}

?>