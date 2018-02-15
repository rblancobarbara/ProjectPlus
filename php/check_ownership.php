<?php

function CheckOwnership($project_id){
	require_once("check_session.php");
	$ok = Check();
	if($ok == true){
		$conn = new mysqli("localhost","root","","projectplus");
		$query = "SELECT holder_id FROM projects WHERE id = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$project_id);
			if($sql->execute()){
				$sql->store_result();
				$sql->bind_result($holder_id);
				if($sql->fetch()){
					if($holder_id == $_SESSION["user_id"]){
						$sql->close();
						$conn->close();
						return true;
					}
					else{
						$sql->close();
						$conn->close();
						return false;
					}
				}
			}
			$sql->close();
		}
		$conn->close();
	}
	else{
		exit("Invalid login");
	}
}

?>