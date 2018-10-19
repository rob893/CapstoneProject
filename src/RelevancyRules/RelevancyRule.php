<?php
namespace CurriculumForecaster;

abstract class RelevancyRule
{
	abstract public function analyzeData(array $databaseData): float;
}

?>