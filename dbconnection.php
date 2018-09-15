<?php
    
    $servername="localhost";
    $user="CapstoneMember";
    $password="capstonepassword1!";
    $database="Capstone Project";
    $conn = new mysqli($servername, $user, $password, $database);
    if($conn->connect_error){
        die("Connection failed: " .$conn->connect_error);
    } /*else {
		echo 'Connection successful.';
	}*/
?>
