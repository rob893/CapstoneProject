<?php
namespace CurriculumForecaster;

abstract class FuturePredictor
{
	abstract public function predictFuture(array $databaseData);
}

?>