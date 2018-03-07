<?php

session_start();
require_once("check_session.php");
require_once("check_ownership.php");
$ok = Check();
if($ok == true && isset($_GET["pic_id"]))
{
	$pic_id = $_GET["pic_id"];
	//selects project_id of this pictures
	//checks ownership between current user and that project id
	$conn = new mysqli("localhost","root","","projectplus");
	$query = "SELECT project_id,url FROM project_pictures WHERE id = ?";
	$owned = false;
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$pic_id);
		if($sql->execute()){
			$sql->store_result();
			$sql->bind_result($proj_id,$url);
			$sql->fetch();
			$owned = CheckOwnership($proj_id);
			if($owned == true){
				unlink("../" . $url);
			}
		}
		$sql->close();
	}
	//if user owns the project to which the picture is associated
	if($owned == true){
		$query = "DELETE FROM project_pictures WHERE id = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$pic_id);
			if($sql->execute()){
				echo "This picture is now deleted!";
			}
			else{
				echo "Error";
			}
			$sql->close();
		}
	}
	else{
		exit("You are not the owner of the project to which this picture belongs to.");
	}
	$conn->close();
}
else{
	exit("Invalid login");
}

?>