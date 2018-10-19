<?php
namespace CurriculumForecaster;

class RelevancyRule1 extends RelevancyRule
{
	public function analyzeData(array $databaseData): float
	{
		return 0.5;
	}
}

?>