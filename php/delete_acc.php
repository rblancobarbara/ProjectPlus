<?php

session_start();
require_once("check_session.php");
$ok = Check();
if($ok == false){
	exit("Invalid login");
}
else{
	$pass = 1;
	$picture_del_pass = 1;
	// user id to delete from anywhere in database
	$user_id = $_SESSION["user_id"];
	// craeting connection to the db
	$conn = new mysqli("localhost","root","","projectplus");
	// removing from accounts table
	$query = "DELETE FROM accounts WHERE id = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$user_id);
		if(!$sql->execute()){
			$pass = -1;
		}
		$sql->close();
	}
	// removing from profile pictures table
	$query = "DELETE FROM profile_pictures WHERE account_id = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$user_id);
		if(!$sql->execute()){
			$pass = -1;
		}
		$sql->close();
	}
	// removing picture from server
	unlink("../profile_pictures/" . $user_id . ".jpg");
	// getting ids of all projects held by this user
	$query = "SELECT id FROM projects WHERE holder_id = ?";
	$project_ids = array();
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$user_id);
		if($sql->execute()){
			$sql->store_result();
			$sql->bind_result($project_id);
			while($sql->fetch){
				array_push($project_ids, $project_id);
			}
		}
		else{
			$pass = -1;
		}
		$sql->close();
	}
	// removing project pictures for all pictures that are associated to any project id held by this user
	foreach ($project_ids as $key => $project_id) {
		$query = "DELETE FROM project_pictures WHERE project_id = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$project_id);
			if(!$sql->execute()){
				$picture_del_pass = -1;
			}
			$sql->close();
		}
	}
	// removing from projects table
	$query = "DELETE FROM projects WHERE holder_id = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$user_id);
		if(!$sql->execute()){
			$pass = -1;
		}
		$sql->close();
	}
	// closing conn
	$conn->close();
	if($pass == -1 && $picture_del_pass == -1){
		echo -1;
	}
	if($pass == 1 && $picture_del_pass == -1){
		echo 2;
	}
	if($pass == 1 && $picture_del_pass == 1){
		echo 1;
	}
}

?>