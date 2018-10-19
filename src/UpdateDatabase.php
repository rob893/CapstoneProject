<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$dataSourceFactory = new \CurriculumForecaster\DataSourceFactory();

$ieeeDataSource = $dataSourceFactory->createDataSource(1);

$ieeeDataSource->updateDatabase();
?>