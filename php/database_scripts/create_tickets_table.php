<?php

$conn = new mysqli("localhost","root","","projectPlus");
$query = "CREATE TABLE reset_tickets(
id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
email TEXT NOT NULL,
ticket_hash VARCHAR(255) NOT NULL
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