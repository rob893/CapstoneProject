<?php

abstract class DataSource
{
	protected $conn;
	
	
	function __construct()
	{
		include('dbconnection.php');
		$this->conn = $conn;
	}
	
	abstract protected function getFormattedDataFromAPI($queryWord);
	
	abstract protected function getRawDataFromAPI($queryWord);
	
	abstract protected function getDatabaseTableName();
	
	public function updateDatabase()
	{
		$keyWordQuery = "SELECT * FROM Keywords";
		$conn = $this->conn;
		$results = $conn->query($keyWordQuery);
		
		while($row = $results->fetch_assoc())
		{
			$apiData = $this->getFormattedDataFromAPI($row['word']);
		
			if($this->checkDataFormat($apiData))
			{
				$sqlInsert = $conn->prepare("INSERT INTO ".$this->getDatabaseTableName()." (keywordId, frequency) VALUES (?, ?)");
				$sqlInsert->bind_param('ii', $row['id'], $apiData['freq']);
				if($sqlInsert->execute() === true){
					$sqlInsert->close();
				} 
				else 
				{
					echo $sqlInsert->error;
					$sqlInsert->close();
				}
			}
			else
			{
				echo "Data is not formatted correctly to be put into the database!";
			}
		}
	}
	
	public function printRawDataFromAPI($queryWord)
	{
		echo "<pre>";
		print_r($this->getRawDataFromAPI($queryWord));
		echo "</pre>";
	}
	
	public function printFormattedDataFromAPI($queryWord)
	{
		$data = $this->getFormattedDataFromAPI($queryWord);
		
		if(!$this->checkDataFormat($data))
		{
				echo "The data is not formatted correctly! Please check the getFormattedDataFromAPI() function implementation.";
				return;
		}
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	
	protected function checkDataFormat($data)
	{
		if(isset($data['word']) && isset($data['freq']))
		{
			return true;
		}
		
		return false;
	}
}

?>