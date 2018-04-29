<?php
session_start();
	require_once("check_session.php");
	$ok = Check();
if($ok == true){
		$id = $_SESSION["user_id"];
		$old_pass = $_POST["old_pass"];
		$new_pass = $_POST["new_pass"];
		$old_pass_ok = false;
		$conn = new mysqli("localhost","root","","projectplus");
		$query = "SELECT password FROM accounts WHERE id = ?";
		if($sql = $conn->prepare($query)){
			$sql->bind_param("i",$id);
			if($sql->execute()){
				$sql->bind_result($old_pass_hash);
				if($sql->fetch()){
					if(password_verify($old_pass,$old_pass_hash)){
						$old_pass_ok = true;
					}
				}
				else{
					echo "2";
				}
			}
			else{
				echo "2";
			}
			$sql->close();
		}
		else{
			echo "2";
		}
		if($old_pass_ok == true){
			$query_change = "UPDATE accounts SET password = ? WHERE id = ?";
			$new_pass_hash = password_hash($new_pass,PASSWORD_BCRYPT);
			if($sql_change = $conn->prepare($query_change)){
				$sql_change->bind_param("si",$new_pass_hash,$id);
				if($sql_change->execute()){
					echo "1";
				}
				else{
					echo "2";
				}
				$sql_change->close();
			}
			else{
				echo "2";
			}
		}
		else{
			echo "2";
		}
		$conn->close();
}
else{
	exit("Invalid login");
}

?>