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
	$message = "";
	$target_dir = "../profile_pictures/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
    // Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
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
	if($pass && $uploadOk == 1){
		$conn = new mysqli("localhost","root","","projectPlus");
		if(Exists($conn,$email,$username) == false){
			$insert_id = -1;
			$query = "INSERT INTO accounts(f_name,l_name,e_mail,username,password,hash,verified) VALUES(?,?,?,?,?,?,?)";
			if($sql = $conn->prepare($query)){
				$hashed_pass = password_hash($password,PASSWORD_BCRYPT);
				$verified = (int)0;
				$hash = md5( rand(0,1000) );
				$sql->bind_param("ssssssi",$first_name,$last_name,$email,$username,$hashed_pass,$hash,$verified);
				if($sql->execute()){
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        	$insert_id = $conn->insert_id;
			        	rename($target_dir . basename( $_FILES["fileToUpload"]["name"]),$target_dir . $conn->insert_id . "." . $imageFileType);
				    } else {
				        $success_message .= "Sorry, there was an error uploading your file.\n";
				    }
					$success_message = "Succes, your account has been created now.\nOnly one thing left to do, and that is to verify your email. Please, check your inbox (make sure to check the spam folder too) for verification link."; //success
				}
				else{
					$message .= "Unknown error"; // error
				}
				$sql->close();
			}
			if($insert_id != -1)
			{
				$query = "INSERT INTO profile_pictures(account_id,url) VALUES(?,?)";
				if($sql = $conn->prepare($query)){
					$sql->bind_param("is",$insert_id,$target_dir . basename( $_FILES["fileToUpload"]["name"]),$target_dir . $insert_id . "." . $imageFileType);
					$sql->execute();
					$sql->close();
				}
			}
			
			$conn->close();
		}
		else{
			$message .= "This account already exists\n"; // already exists
		}
	}
}
else{
	$message .= "Something is empty in the form\n"; // something is empty
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

<html>
	<head>
		<!-- BOOTSTRAP4 -->
		<script src = "../js/jquery.js"></script>	
		<script src = "../js/bootstrap.js"></script>
		<link rel = "stylesheet" href = "../css/bootstrap.css">
		<!-- CSS -->
		<link rel = "stylesheet" href = "../css/general.css">
		<!-- JAVASCRIPT -->
		<script src = "../js/go_back_browser.js"></script>
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Raleway:500" rel="stylesheet">
		<link rel = "stylesheet" href = "../css/fonts.css">
	</head>
	<body class = "font-raleway">
		<div class = "container">
			<h2 align="center"><?php if($message != ""){ echo "Following errors occured:"; } else{ echo $success_message; } ?></h2>
			<hr class = "hr-black">
			<p align="center"><?= $message ?></p>
			<p id = "go_back_history" align="center">Go back</p>
		</div>
	</body>
</html>