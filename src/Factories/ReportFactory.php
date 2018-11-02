<?php
declare(strict_types = 1);

namespace CurriculumForecaster;

use CurriculumForecaster\DataSourceFactory;
use CurriculumForecaster\RelevancyRuleFactory;
use CurriculumForecaster\FuturePredictorFactory;
use CurriculumForecaster\Report;


class ReportFactory
{
	public function createReport(int $dataSourceId, array $relevancyRuleIds, int $futurePredictorId, bool $limitByCourse = false, int $courseId = -1): Report
	{
		if(count($relevancyRuleIds) < 1)
		{
			throw new \InvalidArgumentException("There must be at least one id in relevancyRuleIds!");
		}
		
		$dataSourceFactory = new DataSourceFactory();
		$relevancyRuleFactory = new RelevancyRuleFactory();
		$futurePredictorFactory = new FuturePredictorFactory();
		
		$dataSource = $dataSourceFactory->createDataSource($dataSourceId);
		
		$relevancyRules = [];
		
		foreach($relevancyRuleIds as $ruleId)
		{
			if(is_numeric($ruleId))
			{
				$relevancyRules[] = $relevancyRuleFactory->createRelevancyRule((int)$ruleId);
			}
			else
			{
				throw new \InvalidArgumentException("A non numeric value was passed into the rule ids array!");
			}
		}
		
		$futurePredictor = $futurePredictorFactory->createFuturePredictor($futurePredictorId);
		
		return new Report($dataSource, $relevancyRules, $futurePredictor, $limitByCourse, $courseId);
	}
}
?>