<?php
namespace CurriculumForecaster;

abstract class DataSource
{
	protected $conn;
	
	
	function __construct()
	{
		include(__DIR__ . '/../dbconnection.php');
		$this->conn = $conn;
	}
	
	abstract protected function getFormattedDataFromAPI(string $queryWord): array;
	
	abstract protected function getRawDataFromAPI(string $queryWord): array;
	
	abstract protected function getDatabaseTableName(): string;
	
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
				$sqlInsert = $conn->prepare("INSERT INTO ".$this->getDatabaseTableName()." (keywordId, frequency, totalSearched) VALUES (?, ?, ?)");
				$sqlInsert->bind_param('iii', $row['id'], $apiData['freq'], $apiData['totalSearched']);
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
	
	public function printRawDataFromAPI(string $queryWord)
	{
		echo "<pre>";
		print_r($this->getRawDataFromAPI($queryWord));
		echo "</pre>";
	}
	
	public function printFormattedDataFromAPI(string $queryWord)
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
	
	public function getDataFromDatabase(): array
	{
		$sqlQuery = "SELECT ".$this->getDatabaseTableName().".id AS dsTableId, keywordId, frequency, totalSearched, dateTimeStamp, word 
						FROM ".$this->getDatabaseTableName()." 
						INNER JOIN Keywords ON Keywords.id = keywordId";
		$conn = $this->conn;
		$queryResults = $conn->query($sqlQuery);
		
		$results = [];
		$i = 0;
		while($row = $queryResults->fetch_assoc())
		{
			$results[$i] = $row;
			$i++;
		}
		
		return $results;
	}
	
	protected function checkDataFormat(array $data): bool
	{
		if(isset($data['word']) && isset($data['freq']) && isset($data['totalSearched']) )
		{
			return true;
		}
		
		return false;
	}
}

?>