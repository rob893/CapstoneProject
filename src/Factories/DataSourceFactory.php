<?php
namespace CurriculumForecaster;


class DataSourceFactory implements AbstractFactory
{
	public function createDataSource(int $id): DataSource
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\IEEEDataSource();
			default:
				return null;
		}
	}
	
	public function createRelevancyRule(int $id): RelevancyRule
	{
		return null;
	}
	
	public function createFuturePredictor(int $id): FuturePredictor
	{
		return null;
	}
}
?>