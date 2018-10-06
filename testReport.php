<?php
require_once('header.php');

$ieeeDS = new \CurriculumForecaster\IEEEDataSource();
$rule1 = new \CurriculumForecaster\RelevancyRule1();
$predictor1 = new \CurriculumForecaster\FuturePredictor1();

$testData = "asdf";

$report = new \CurriculumForecaster\Report($ieeeDS, $rule1, $predictor1);

echo '<div class="container-fluid"><br>';

$report->analyzeData($testData);

echo '<br>';

$report->predictFuture($testData);

echo '<br>';

$report->printDataFromDatabase();

echo '</div>';

require_once('footer.php');
?>