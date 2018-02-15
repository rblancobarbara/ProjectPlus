<?php

session_start();
require_once("check_session.php");
$ok = Check();
if($ok == false){
	exit("Invalid login");
}
else{
	$id = $_SESSION["user_id"];
	$conn = new mysqli("localhost","root","","projectplus");
	$query = "SELECT * from accounts WHERE id = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("i",$id);
		if($sql->execute()){
			$result = $sql->get_result();
			while($row = $result->fetch_assoc()){
				//f_name,l_name,e_mail,username
				$string = $row["f_name"].",".$row["l_name"].",".$row["e_mail"].",".$row["username"];
				echo $string;
				$sql->free_result();
				$conn->close();
				exit();
			}
		}
		$sql->close();
	}
	$conn->close();
}

?>