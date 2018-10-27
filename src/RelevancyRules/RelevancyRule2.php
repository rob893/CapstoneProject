<?php
declare(strict_types = 1);

namespace CurriculumForecaster;


class RelevancyRule2 extends RelevancyRule
{
	
	public function analyzeData(array $databaseData): float
	{
		return 0.25;
	}
	
	protected function setNameAndDescription(): void
	{
		$this->name = "RR2 name";
		$this->description = "RR2 description.";
	}
	
	protected function setBreakPoints(): void
	{
		$this->upperBreakPoint = 2;
		$this->lowerBreakPoint = -2;
	}
}
?>