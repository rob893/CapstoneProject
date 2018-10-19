<?php
namespace CurriculumForecaster;

class FuturePredictor2 extends FuturePredictor
{
	
	public function predictFuture(array $databaseData)
	{
		return 1;
	}
	
	protected function setNameAndDescription()
	{
		$this->name = "FP2 name";
		$this->description = "FP2 description.";
	}
}
?>