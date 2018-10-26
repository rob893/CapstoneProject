<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\DataSourceFactory;
use CurriculumForecaster\RelevancyRuleFactory;
use CurriculumForecaster\FuturePredictorFactory;
use CurriculumForecaster\Report;


class ReportFactory
{
	public function createReport(int $dataSourceId, int $relevancyRuleId, int $futurePredictorId, bool $limitByCourse = false, int $courseId = -1): Report
	{
		$dataSourceFactory = new DataSourceFactory();
		$relevancyRuleFactory = new RelevancyRuleFactory();
		$futurePredictorFactory = new FuturePredictorFactory();
		
		$dataSource = $dataSourceFactory->createDataSource($dataSourceId);
		$relevancyRule = $relevancyRuleFactory->createRelevancyRule($relevancyRuleId);
		$futurePredictor = $futurePredictorFactory->createFuturePredictor($futurePredictorId);
		
		return new Report($dataSource, $relevancyRule, $futurePredictor, $limitByCourse, $courseId);
	}
}
?>