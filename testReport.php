<?php
require_once('header.php');

$factoryProducer = new \CurriculumForecaster\FactoryProducer();
	
$dataSourceFactory = $factoryProducer->createFactory(1);
$ruleFactory = $factoryProducer->createFactory(2);
$predictorFactory = $factoryProducer->createFactory(3);

$dataSource = $dataSourceFactory->createDataSource(1);
$rule = $ruleFactory->createRelevancyRule(1);
$predictor = $predictorFactory->createFuturePredictor(1);

$report = new \CurriculumForecaster\Report($dataSource, $rule, $predictor, "Software Engineering Test Course");

$report->printReport();

require_once('footer.php');
?>