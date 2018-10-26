<?php
declare(strict_types = 1);

namespace CurriculumForecaster;


class DatabaseConnection
{
	private $conn;
	
	
	public function __construct()
	{
		$servername = "localhost";
		$user = "CapstoneMember";
		$password = "capstonepassword1!";
		$database = "Capstone Project";
		
		$conn = new \mysqli($servername, $user, $password, $database);
		
		if($conn->connect_error)
		{
			die("Connection failed: " .$conn->connect_error);
		}
		
		$this->conn = $conn;
	}
	
	public function getConnection(): \mysqli
	{
		return $this->conn;
	}
}
?>
