<?php
namespace CurriculumForecaster;

class IEEEDataSource extends DataSource
{
	private $ieeeAPIKey = "c67wkrzktr7ucc385gznctzb";
	
	
	protected function getRawDataFromAPI(string $queryWord): array
	{
		$query = new \CurriculumForecaster\XPLORE($this->ieeeAPIKey);
		$query->queryText($queryWord);
		$query->maximumResults(200);
		$query->resultsFilter('start_year', '2018');
		$results = $query->callAPI();
		
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
		return "ieeeData";
	}
}

?>