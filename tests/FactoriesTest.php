<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use CurriculumForecaster\DataSourceFactory;
use CurriculumForecaster\ReportFactory;
use CurriculumForecaster\RelevancyRuleFactory;
use CurriculumForecaster\FuturePredictorFactory;
use CurriculumForecaster\DataSource;
use CurriculumForecaster\RelevancyRule;
use CurriculumForecaster\Report;
use CurriculumForecaster\FuturePredictor;

final class FactoriesTest extends TestCase
{
	public function testCreateDataSource(): void
	{
		$dsFactory = new DataSourceFactory();
		$this->assertInstanceOf(DataSource::class, $dsFactory->createDataSource(1));
	}
	
	public function testCreateRelevancyRule(): void
	{
		$rrFactory = new RelevancyRuleFactory();
		$this->assertInstanceOf(RelevancyRule::class, $rrFactory->createRelevancyRule(1));
	}
	
	public function testCreateFuturePredictor(): void
	{
		$fpFactory = new FuturePredictorFactory();
		$this->assertInstanceOf(FuturePredictor::class, $fpFactory->createFuturePredictor(1));
	}
	
	public function testCreateReport(): void
	{
		$rFactory = new ReportFactory();
		$this->assertInstanceOf(Report::class, $rFactory->createReport(1, 1, 1));
	}
}
?>