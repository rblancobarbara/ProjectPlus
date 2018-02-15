<?php

$conn = new mysqli("localhost","root","","projectplus");
//project id tells for which project is(are) this(these) picture(s)
$query = "CREATE TABLE project_pictures(
id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
project_id INT(11) NOT NULL,
url TEXT NOT NULL
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