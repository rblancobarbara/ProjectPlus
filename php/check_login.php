<?php
session_start();
if(isset($_POST["username"]) && isset($_POST["password"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$conn = new mysqli("localhost","root","","projectPlus");
	$query = "SELECT id,username,password,hash,verified FROM accounts WHERE username = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("s",$username);
		if($sql->execute()){
			$sql->store_result();
			$sql->bind_result($id,$username,$found_pass,$hash,$verified);
			if($sql->fetch()){
				if(password_verify($password,$found_pass) && $verified == 1){
					//log in the user
					$_SESSION["user_id"] = $id;
					$_SESSION["user_hash"] = $hash;
					$_SESSION["username"] = $username;
					ob_start();
					header("location: dashboard.php");
					ob_end_flush();
					die();
				}
				else{
					if($verified == 0){
						echo "Account not yet verified. Please check your email.";
						exit();
					}
					else{
						echo "Wrong password";
						exit();
					}
				}
			}
			else{
				echo "No such username found.";
				exit();
			}
		}
		else{
			echo "Something went wrong! :(";
			exit();
		}
		$sql->close();
	}
	$conn->close();
}

?>