<?php
namespace CurriculumForecaster;

abstract class RelevancyRule
{
	abstract public function analyzeData($databaseData);
}

?>