<?php
namespace CurriculumForecaster;


class RelevancyRuleFactory implements AbstractFactory
{
	public function createDataSource(int $id): DataSource
	{
		return null;
	}
	
	public function createRelevancyRule(int $id): RelevancyRule
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\RelevancyRule1();
			default:
				return null;
		}
	}
	
	public function createFuturePredictor(int $id): FuturePredictor
	{
		return null;
	}
}
?>