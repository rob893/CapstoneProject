<?php
namespace CurriculumForecaster;

class RelevancyRule2 extends RelevancyRule
{
	public function analyzeData(array $databaseData): float
	{
		return 0.25;
	}
}
?>