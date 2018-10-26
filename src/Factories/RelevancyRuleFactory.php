<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\RelevancyRule1;
use CurriculumForecaster\RelevancyRule2;


class RelevancyRuleFactory
{
	public function createRelevancyRule(int $id): RelevancyRule
	{
		switch($id)
		{
			case 1:
				return new RelevancyRule1();
			case 2:
				return new RelevancyRule2();
			default:
				return new RelevancyRule1();
		}
	}
}
?>