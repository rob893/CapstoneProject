<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\FuturePredictor1;
use CurriculumForecaster\FuturePredictor2;


class FuturePredictorFactory
{
	public function createFuturePredictor(int $id): FuturePredictor
	{
		switch($id)
		{
			case 1:
				return new FuturePredictor1();
			case 2:
				return new FuturePredictor2();
			default:
				return new FuturePredictor1();
		}
	}
}
?>