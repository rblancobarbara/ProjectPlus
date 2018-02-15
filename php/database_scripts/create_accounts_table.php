<?php

$conn = new mysqli("localhost","root","","projectPlus");
$query = "CREATE TABLE accounts(
id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
f_name TEXT NOT NULL,
l_name TEXT NOT NULL,
e_mail TEXT NOT NULL,
username TEXT NOT NULL,
password TEXT NOT NULL,
hash VARCHAR(256) NOT NULL,
verified INT(1) NOT NULL
)";
if($sql = $conn->prepare($query)){
	if($sql->execute()){
		echo "Created";
	}
	else{
		echo "Error: " . $conn->error;
	}
	$sql->close();
}
$conn->close();

?>