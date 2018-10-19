<?php
namespace CurriculumForecaster;

class RelevancyRule2 extends RelevancyRule
{
	
	public function analyzeData(array $databaseData): float
	{
		return 0.25;
	}
	
	protected function setNameAndDescription()
	{
		$this->name = "RR2 name";
		$this->description = "RR2 description.";
	}
}
?>