<?php
namespace CurriculumForecaster;

abstract class DataSource
{
	protected $conn;
	protected $name;
	protected $description;
	
	public function __construct()
	{
		$conn = new \CurriculumForecaster\DatabaseConnection();
		$this->conn = $conn->getConnection();
		
		$this->setNameAndDescription();
	}
	
	abstract protected function setNameAndDescription();
	
	abstract protected function getFormattedDataFromAPI(string $queryWord): array;
	
	abstract protected function getRawDataFromAPI(string $queryWord): array;
	
	abstract protected function getDatabaseTableName(): string;
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function getDescription(): string
	{
		return $this->description;
	}
	
	public function updateDatabase()
	{
		$keyWordQuery = "SELECT * FROM Keywords";
		$conn = $this->conn;
		$results = ($conn->query($keyWordQuery)) ? $conn->query($keyWordQuery) : null;
		
		if($results == null || $results->num_rows == 0)
		{
			return;
		}
		
		while($row = $results->fetch_assoc())
		{
			$apiData = $this->getFormattedDataFromAPI($row['word']);
		
			if($this->checkDataFormat($apiData))
			{
				if($sqlInsert = $conn->prepare("INSERT INTO ".$this->getDatabaseTableName()." (keywordId, frequency, totalSearched) VALUES (?, ?, ?)"))
				{
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
					echo "Error preparing statement.";
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
		$queryResults = ($conn->query($sqlQuery)) ? $conn->query($sqlQuery) : null;
		
		$results = [];
		
		if($queryResults == null || $queryResults->num_rows == 0)
		{
			return $results;
		}
		
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