<?php
namespace CurriculumForecaster;


interface AbstractFactory
{
	public function createDataSource(int $id): DataSource;
	public function createRelevancyRule(int $id): RelevancyRule;
	public function createFuturePredictor(int $id): FuturePredictor;
}

?>