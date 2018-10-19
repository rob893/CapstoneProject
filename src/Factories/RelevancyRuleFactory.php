<?php
namespace CurriculumForecaster;


class RelevancyRuleFactory
{
	public function createRelevancyRule(int $id): RelevancyRule
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\RelevancyRule1();
			case 2:
				return new \CurriculumForecaster\RelevancyRule2();
			default:
				return new \CurriculumForecaster\RelevancyRule1();
		}
	}
}
?>