<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$ieeeDataSource = new \CurriculumForecaster\IEEEDataSource();
$ieeeDataSource->updateDatabase();
?>