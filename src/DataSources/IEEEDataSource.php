<?php
namespace CurriculumForecaster;

class IEEEDataSource extends DataSource
{
	private $ieeeAPIKey = "c67wkrzktr7ucc385gznctzb";
	
	
	protected function getRawDataFromAPI($queryWord)
	{
		$query = new \CurriculumForecaster\XPLORE($this->ieeeAPIKey);
		$query->queryText($queryWord);
		$query->maximumResults(200);
		$query->resultsFilter('start_year', '2018');
		$results = $query->callAPI();
		
		return $results;
	}
	
	protected function getFormattedDataFromAPI($queryWord)
	{
		$unformattedData = $this->getRawDataFromAPI($queryWord);
		
		$formattedData['word'] = $queryWord;
		$formattedData['freq'] = $unformattedData['total_records'];
		
		return $formattedData;
	}
	
	protected function getDatabaseTableName()
	{
		return "ieeeData";
	}
}

?>