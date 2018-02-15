<?php

$conn = new mysqli("localhost","root","","projectplus");
$query = "CREATE TABLE projects(
id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
holder_id INT(11) NOT NULL,
name TEXT NOT NULL,
description TEXT NOT NULL,
price INT(11) NOT NULL,
likes INT(11) NOT NULL,
saves INT(11) NOT NULL,
category TEXT NOT NULL,
status TEXT NOT NULL,
date_posted DATETIME NOT NULL
)";
if($sql = $conn->prepare($query)){
	if($sql->execute()){
		echo "Created";
	}
	else{
		echo "Error: " . $conn->error;
	}
}
$conn->close();
?>