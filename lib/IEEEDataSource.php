<?php
require_once('DataSource.php');
require_once('SDKs/xplore-php-sdk.php');

class IEEEDataSource extends DataSource
{
	private $ieeeAPIKey = "c67wkrzktr7ucc385gznctzb";
	
	
	protected function getRawDataFromAPI($queryWord)
	{
		$query = new XPLORE($this->ieeeAPIKey);
		$query->queryText($this->queryWord);
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
}

?>