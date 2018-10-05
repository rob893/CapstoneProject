<?php
require_once(__DIR__ . '/DataSources/IEEEDataSource.php');

$ieeeDataSource = new IEEEDataSource();
$ieeeDataSource->updateDatabase();
?>