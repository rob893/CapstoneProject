<?php
namespace CurriculumForecaster;

class FuturePredictor1 extends FuturePredictor
{

	public function predictFuture(array $databaseData)
	{
		return 0;
	}
	
	protected function setNameAndDescription()
	{
		$this->name = "FP1 name";
		$this->description = "FP1 description.";
	}
}

?>