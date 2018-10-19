<?php
namespace CurriculumForecaster;


class FactoryProducer
{
	public function createFactory(int $id): AbstractFactory
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\DataSourceFactory();
			case 2:
				return new \CurriculumForecaster\RelevancyRuleFactory();
			case 3:
				return new \CurriculumForecaster\FuturePredictorFactory();
			default:
				return null;
		}
	}
}
?>