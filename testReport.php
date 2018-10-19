<?php
require_once('header.php');

$ieeeDS = new \CurriculumForecaster\IEEEDataSource();
$rule1 = new \CurriculumForecaster\RelevancyRule1();
$predictor1 = new \CurriculumForecaster\FuturePredictor1();

$report = new \CurriculumForecaster\Report($ieeeDS, $rule1, $predictor1, "Software Engineering Test Course");

$report->printReport();

require_once('footer.php');
?>