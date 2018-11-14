<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\XPLORE;


class IEEEDataSource extends DataSource
{
	private $ieeeAPIKey = "c67wkrzktr7ucc385gznctzb";
	
	
	protected function setNameAndDescription(): void
	{
		$this->name = "IEEE Xplore Digital Library";
		$this->description = "The IEEE Xplore digital library is a collection of academic papers.";
	}
	
	protected function getRawDataFromAPI(string $queryWord): array
	{
		$query = new XPLORE($this->ieeeAPIKey);
		$query->queryText($queryWord);
		$query->maximumResults(20);
		$query->resultsFilter('start_year', '2018');
		$results = $query->callAPI();
		
		$results = $results == null ? [ 'total_records' => 0, 'total_searched' => 0 ] : $results;
		
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