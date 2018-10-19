<?php
namespace CurriculumForecaster;


class FuturePredictorFactory implements AbstractFactory
{
	public function createDataSource(int $id): DataSource
	{
		return null;
	}
	
	public function createRelevancyRule(int $id): RelevancyRule
	{
		return null;
	}
	
	public function createFuturePredictor(int $id): FuturePredictor
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\FuturePredictor1();
			default:
				return null;
		}
	}
}
?>