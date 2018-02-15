<?php

$conn = new mysqli("localhost","root","","projectplus");
//bidder id tells who bidded this bid
//project id tells for which projects is this bid for
$query = "CREATE TABLE bids(
id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
bidder_id INT(11) NOT NULL, 
project_id INT(11) NOT NULL,
ammount INT(11) NOT NULL,
description TEXT NOT NULL,
date_posted DATETIME NOT NULL
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