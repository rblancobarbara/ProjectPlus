<?php

$conn = new mysqli("localhost","root","","projectplus");
//user id tells for which user is this profile picture
$query = "CREATE TABLE profile_pictures(
id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
user_id INT(11) NOT NULL,
url TEXT NOT NULL
)";
if($sql = $conn->prepare($query)){
	if($sql->execute()){
		echo "Created";
	}
	else{
		echo "Error: " $conn->error;
	}
}
$conn->close();
?>