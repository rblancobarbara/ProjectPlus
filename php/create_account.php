<?php

if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_repeat"])){
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$password_repeat = $_POST["password_repeat"];
	// checking start
	$pass = true;
	$message = "Errors:\r\n";
	if(ContainsNumbers($first_name)){
		$pass = false;
		$message .= "First name contains numbers.\r\n";
	}
	if(ContainsNumbers($last_name)){
		$pass = false;
		$message .= "Last name contains numbers.\r\n";
	}
	if(CheckEmail($email) == false){
		$pass = false;
		$message .= "Email is invalid.\r\n";
	}
	if(strlen($username) > 16){
		$pass = false;
		$message .= "Username must be less then 16 characters long.\r\n";
	}
	if(strlen($password) < 8 || ContainsNumbers($password) == false){
		$pass = false;
		$message .= "Password must be greater then 8 characters long and must contain at least 1 number.\r\n";
	}
	if($password_repeat != $password){
		$pass = false;
		$message .= "Passwords must match.\r\n";
	}
	// checking end
	if($pass){
		$conn = new mysqli("localhost","root","","projectPlus");
		if(Exists($conn,$email,$username) == false){
			$query = "INSERT INTO accounts(f_name,l_name,e_mail,username,password,hash,verified) VALUES(?,?,?,?,?,?,?)";
			if($sql = $conn->prepare($query)){
				$hashed_pass = password_hash($password,PASSWORD_BCRYPT);
				$verified = (int)0;
				$hash = md5( rand(0,1000) );
				$sql->bind_param("ssssssi",$first_name,$last_name,$email,$username,$hashed_pass,$hash,$verified);
				if($sql->execute()){
					echo "1"; //success
				}
				else{
					echo "0"; // error
				}
				$sql->close();
				$conn->close();
			}
		}
		else{
			echo "4"; // already exists
		}
	}
	else{
		echo $message;
	}
}
else{
	echo "2"; // something is empty
}
function CheckEmail($email){
	//strpos vraca false ako ne nadje needle u haystacku, a vraca poziciju needla ako nadje
	$includes_at = strpos($email, "@");
	$includes_dot = strpos($email, ".");
	$includes_comma = strpos($email, ",");
	if($includes_at !== false && $includes_dot !== false && $includes_comma === false){
		$index_at = $includes_at;
		$index_dot = strpos($email,".",$index_at+1);
		//levo od at
		$left = substr($email, 0, $index_at);
		//desno od at
		$right = substr($email, $index_at+1,$index_dot);
		//desno od tacke
		$after = substr($email, $index_dot+1);
		if(strlen($left) == 0 || strlen($right) == 0 || strlen($after) > 3){
			return false;
		}
	}
	else{
		return false;
	}
	return true;
}
function ContainsNumbers($String){
    return preg_match('/\\d/', $String) > 0;
}
function Exists($conn,$email,$username){
	$query = "SELECT id FROM accounts WHERE e_mail = ? OR username = ?";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("ss",$email,$username);
		if($sql->execute()){
			$sql->store_result();
			$sql->bind_result($gotten_id);
			$sql->fetch();
			if($sql->num_rows > 0){
				$sql->free_result();
				$sql->close();
				return true;
			}
			else{
				$sql->free_result();
				$sql->close();
				return false;
			}
		}

	}
}

?>