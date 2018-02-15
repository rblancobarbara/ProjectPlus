<?php

function Check(){
	if(isset($_SESSION["username"]) && isset($_SESSION["user_hash"]) && isset($_SESSION["user_id"])){
		$ok = false;
		$username = $_SESSION["username"];
		$hash = $_SESSION["user_hash"];
		$conn = new mysqli("localhost","root","","projectplus");
		$query = "SELECT username,hash FROM accounts WHERE username = ? AND hash = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("ss",$username,$hash);
			if($sql->execute()){
				$sql->bind_result($get_username,$get_hash);
				if($sql->fetch()){
					$ok = true;
				}
			}
			$sql->close();
		}
		return $ok;
		$conn->close();
	}
	else{
		return false;
	}
}

?>