<?php
require_once('header.php');
require_once('lib/DataSources/IEEEDataSource.php');
require_once('lib/RelevancyRules/RelevancyRule1.php');
require_once('lib/FuturePredictors/FuturePredictor1.php');
require_once('lib/Report.php');

$ieeeDS = new IEEEDataSource();
$rule1 = new RelevancyRule1();
$predictor1 = new FuturePredictor1();

$testData = "asdf";

$report = new Report($ieeeDS, $rule1, $predictor1);

echo '<div class="container-fluid"><br>';

$report->analyzeData($testData);

echo '<br>';

$report->predictFuture($testData);

echo '<br>';

$report->printDataFromDatabase();

echo '</div>';

require_once('footer.php');
?>