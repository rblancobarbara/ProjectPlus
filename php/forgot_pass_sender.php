<?php
//this script sends the ticket to the database
if(isset($_POST["email"])){
	$email = $_POST["email"];
	$exists = false;
	$conn = new mysqli("localhost","root","","projectplus");
	$query = "SELECT id FROM accounts WHERE e_mail = ?";
	echo "Entered email: " . $email . "<br>";
	if($sql = $conn->prepare($query)){
		$sql->bind_param("s",$email);
		if($sql->execute()){
			$sql->store_result();
			$sql->bind_result($gotten_id);
			$num_rows = $sql->num_rows;
			if($num_rows == 1){
				$exists = true;
			}
		}
		$sql->close();
	}
	if($exists == true){
		$query = "INSERT INTO reset_tickets(email,ticket_hash) VALUES(?,?)";
		if($sql_insert = $conn->prepare($query)){
			$ticket_hash = md5(rand(0,1000));
			$sql_insert->bind_param("ss",$email,$ticket_hash);
			if($sql_insert->execute()){
				//sends email to the user
				$last_id = $conn->insert_id;
				$link = "localhost/forgot_pass_reseter.php?ticket_id=".$last_id."&ticket_code=".$ticket_hash;
			}
			$sql_insert->close();
		}
	}
	echo "If the email is associated with any account, the email with link to reset the password will be sent to this email.";
	$conn->close();
}

?>