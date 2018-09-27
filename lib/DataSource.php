<?php
require_once('dbconnection.php');

abstract class DataSource
{
	protected $queryWord;
	
	
	abstract protected function getFormattedDataFromAPI($queryWord);
	
	abstract protected function getRawDataFromAPI($queryWord);
	
	abstract protected function getDatabaseTableName();
	
	public function updateDatabase()
	{
			$apiData = $this->getFormattedDataFromAPI($this->queryWord);
			
			if($this->checkDataFormat($apiData))
			{
				//put in database
				echo "Inserting data into the database table ".$this->getDatabaseTableName()."!";
			}
			else
			{
				echo "Data is not formatted correctly to be put into the database!";
			}
	}
	
	public function setQueryWord($word)
	{
			$this->queryWord = $word;
	}
	
	public function getQueryWord()
	{
		return $this->queryWord;
	}
	
	public function printRawDataFromAPI()
	{
		echo "<pre>";
		print_r($this->getRawDataFromAPI($this->queryWord));
		echo "</pre>";
	}
	
	public function printFormattedDataFromAPI()
	{
		$data = $this->getFormattedDataFromAPI($this->queryWord);
		
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