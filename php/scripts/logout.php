<?php

session_unset();
session_destroy();
ob_start();
header("location: login.php");
ob_flush();
	
?>