<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\DatabaseConnection;


abstract class DataSource
{
	protected $conn;
	protected $name;
	protected $description;
	
	
	public function __construct()
	{
		$conn = new DatabaseConnection();
		$this->conn = $conn->getConnection();
		
		$this->setNameAndDescription();
	}
	
	abstract protected function setNameAndDescription(): void;
	
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
	
	public function updateDatabase(): void
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
			
			if(!$this->checkDataFormat($apiData))
			{
				throw new \InvalidArgumentException("The data is not formatted correctly! Please check the getFormattedDataFromAPI() function implementation for the ".$this->getName()." data source.");
			}
			
			if($sqlInsert = $conn->prepare("INSERT INTO ".$this->getDatabaseTableName()." (keywordId, frequency, totalSearched) VALUES (?, ?, ?)"))
			{
				$sqlInsert->bind_param('iii', $row['id'], $apiData['freq'], $apiData['totalSearched']);
				if($sqlInsert->execute() === true)
				{
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
				throw new \InvalidArgumentException("Error preparing database query.");
			}
		}
	}
	
	public function printRawDataFromAPI(string $queryWord): void
	{
		echo "<pre>";
		print_r($this->getRawDataFromAPI($queryWord));
		echo "</pre>";
	}
	
	public function printFormattedDataFromAPI(string $queryWord): void
	{
		$data = $this->getFormattedDataFromAPI($queryWord);
		
		if(!$this->checkDataFormat($data))
		{
			throw new \InvalidArgumentException("The data is not formatted correctly! Please check the getFormattedDataFromAPI() function implementation.");
		}
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	
	public function getDataFromDatabase(bool $limitByCourse = false, int $courseId = -1): array
	{
		$sqlQuery = "SELECT ".$this->getDatabaseTableName().".id AS dsTableId, keywordId, word, frequency, totalSearched, dateTimeStamp 
						FROM ".$this->getDatabaseTableName()." 
						INNER JOIN Keywords ON Keywords.id = keywordId";
		
		if($limitByCourse)
		{
			$sqlQuery = "SELECT ".$this->getDatabaseTableName().".id AS dsTableId, Keywords.id AS keywordId, Courses.id AS courseID, word, name AS courseName, frequency, totalSearched, dateTimeStamp 
						FROM Courses
                        INNER JOIN CourseKeywordXref ON CourseKeywordXref.courseId = Courses.id
						INNER JOIN Keywords ON Keywords.id = CourseKeywordXref.keywordId
                        INNER JOIN ".$this->getDatabaseTableName()." ON ".$this->getDatabaseTableName().".keywordId = Keywords.id
						WHERE Courses.id = '$courseId'";
		}
		
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