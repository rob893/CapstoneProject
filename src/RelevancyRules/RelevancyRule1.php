<?php
namespace CurriculumForecaster;

class RelevancyRule1 extends RelevancyRule
{
	
	public function analyzeData(array $databaseData): float
	{
		return 0.5;
	}
	
	protected function setNameAndDescription()
	{
		$this->name = "RR1 name";
		$this->description = "RR1 description.";
	}
}

?>