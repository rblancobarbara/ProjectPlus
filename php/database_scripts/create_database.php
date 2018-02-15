<?php

$conn = new mysqli("localhost","root","");
$query = "CREATE DATABASE projectPlus";
if($sql = $conn->prepare($query)){
	if($sql->execute()){
		echo "Created";
	}
	else{
		echo $conn->error;
	}
	$sql->close();
}
$conn->close();
?>