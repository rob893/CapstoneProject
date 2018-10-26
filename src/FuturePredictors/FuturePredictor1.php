<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

class FuturePredictor1 extends FuturePredictor
{

	public function predictFuture(array $databaseData): int
	{
		//Will not be implemented for the prototype.
		return 0;
	}
	
	protected function setNameAndDescription(): void
	{
		$this->name = "FP1 name";
		$this->description = "FP1 description.";
	}
}

?>