<?php
namespace CurriculumForecaster;


class FuturePredictorFactory
{
	public function createFuturePredictor(int $id): FuturePredictor
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\FuturePredictor1();
			case 2:
				return new \CurriculumForecaster\FuturePredictor2();
			default:
				return new \CurriculumForecaster\FuturePredictor1();
		}
	}
}
?>