<?php
namespace CurriculumForecaster;


class Report
{
	private $dataSource;
	private $relevancyRule;
	private $futurePredictor;
	
	
	function __construct(Datasource $dataSource, RelevancyRule $relevancyRule, FuturePredictor $futurePredictor)
	{
		$this->dataSource = $dataSource;
		$this->relevancyRule = $relevancyRule;
		$this->futurePredictor = $futurePredictor;
	}
	
	public function analyzeData($dataFromDatabase)
	{
		$this->relevancyRule->analyzeData($dataFromDatabase);
	}
	
	public function predictFuture($dataFromDatabase)
	{
		$this->futurePredictor->predictFuture($dataFromDatabase);
	}
	
	public function printDataFromDatabase()
	{
		echo "<pre>";
		print_r($this->dataSource->getDataFromDatabase());
		echo "</pre>";
	}
}

?>