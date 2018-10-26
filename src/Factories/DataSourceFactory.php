<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\IEEEDataSource;
use CurriculumForecaster\TestDataSource2;


class DataSourceFactory
{
	public function createDataSource(int $id): DataSource
	{
		switch($id)
		{
			case 1:
				return new IEEEDataSource();
			case 2:
				return new TestDataSource2();
			default:
				return new IEEEDataSource();
		}
	}
}
?>