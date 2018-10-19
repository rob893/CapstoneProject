<?php
namespace CurriculumForecaster;


class DataSourceFactory
{
	public function createDataSource(int $id): DataSource
	{
		switch($id)
		{
			case 1:
				return new \CurriculumForecaster\IEEEDataSource();
			case 2:
				return new \CurriculumForecaster\TestDataSource2();
			default:
				return new \CurriculumForecaster\IEEEDataSource();
		}
	}
}
?>