<?php
namespace CurriculumForecaster;

//NOTE: THIS IS A TEST CLASS!
class TestDataSource2 extends DataSource
{	
	
	protected function setNameAndDescription()
	{
		$this->name = "Test data source 2.";
		$this->description = "Test ds2 description.";
	}
	
	protected function getRawDataFromAPI(string $queryWord): array
	{
		$results = [];
		$results['total_records'] = 50;
		$results['total_searched'] = 500;
		
		return $results;
	}
	
	protected function getFormattedDataFromAPI(string $queryWord): array
	{
		$unformattedData = $this->getRawDataFromAPI($queryWord);
		
		$formattedData['word'] = $queryWord;
		$formattedData['freq'] = $unformattedData['total_records'];
		$formattedData['totalSearched'] = $unformattedData['total_searched'];
		
		return $formattedData;
	}
	
	protected function getDatabaseTableName(): string
	{
		return "test2Table";
	}
}
?>