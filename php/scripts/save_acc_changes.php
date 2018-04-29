<?php

session_start();
require_once("check_session.php");
$ok = Check();
if($ok == true){
	if(isset($_POST["f_name"]) && isset($_POST["l_name"]) && isset($_POST["e_mail"]) && isset($_POST["username_new"])){
		$f_name = $_POST["f_name"];
		$l_name = $_POST["l_name"];
		$e_mail = $_POST["e_mail"];
		$username = $_POST["username_new"];
		$id = $_SESSION["user_id"];
		$conn2 = new mysqli("localhost","root","","projectplus");
		$query = "UPDATE accounts SET f_name = ? , l_name = ? , e_mail = ? , username = ? WHERE id = ?";
		if($sql = $conn2->prepare($query)){
			$sql->bind_param("ssssi",$f_name,$l_name,$e_mail,$username,$id);
			if($sql->execute()){
				echo "1";
				$_SESSION["username"] = $username;
			}else{
				echo "2";
			}
			$sql->close();
		}
		else{
			echo "2";	
		}
		$conn2->close();
	}
}
else{
	exit("Invalid login");
}

?>