<?php
namespace CurriculumForecaster;


class ReportFactory
{
	public function createReport(int $dataSourceId, int $relevancyRuleId, int $futurePredictorId, string $className): Report
	{
		$dataSourceFactory = new \CurriculumForecaster\DataSourceFactory();
		$relevancyRuleFactory = new \CurriculumForecaster\RelevancyRuleFactory();
		$futurePredictorFactory = new \CurriculumForecaster\FuturePredictorFactory();
		
		$dataSource = $dataSourceFactory->createDataSource($dataSourceId);
		$relevancyRule = $relevancyRuleFactory->createRelevancyRule($relevancyRuleId);
		$futurePredictor = $futurePredictorFactory->createFuturePredictor($futurePredictorId);
		
		return new \CurriculumForecaster\Report($dataSource, $relevancyRule, $futurePredictor, $className);
	}
}
?>