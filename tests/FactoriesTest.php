<?php
declare(strict_types = 1);

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
	protected $dsFactory;
	protected $rrFactory;
	protected $fpFactory;
	protected $rFactory;
	
	
	protected function setUp(): void
	{
		$this->dsFactory = new DataSourceFactory();
		$this->rrFactory = new RelevancyRuleFactory();
		$this->fpFactory = new FuturePredictorFactory();
		$this->rFactory = new ReportFactory();
	}
	
	public function testCreateDataSource(): void
	{
		$this->assertInstanceOf(DataSource::class, $this->dsFactory->createDataSource(1));
	}
	
	public function testCreateDataSourceMinId(): void
	{
		$this->assertInstanceOf(DataSource::class, $this->dsFactory->createDataSource(PHP_INT_MIN));
	}
	
	public function testCreateDataSourceMaxId(): void
	{
		$this->assertInstanceOf(DataSource::class, $this->dsFactory->createDataSource(PHP_INT_MAX));
	}
	
	public function testCreateDataSourceNullId(): void
	{
		$this->expectException(TypeError::class);
		$this->dsFactory->createDataSource(null);
	}
	
	public function testCreateDataSourceInvalidId(): void
	{
		$this->expectException(TypeError::class);
		$this->dsFactory->createDataSource("asdfasdfasdfasdf");
	}
	
	public function testCreateDataSourceInvalidId2(): void
	{
		$this->expectException(TypeError::class);
		$this->dsFactory->createDataSource(1.5);
	}
	
	public function testCreateDataSourceNoId(): void
	{
		$this->expectException(ArgumentCountError::class);
		$this->dsFactory->createDataSource();
	}
	
	public function testCreateRelevancyRule(): void
	{
		$this->assertInstanceOf(RelevancyRule::class, $this->rrFactory->createRelevancyRule(1));
	}
	
	public function testCreateRelevancyRuleMinId(): void
	{
		$this->assertInstanceOf(RelevancyRule::class, $this->rrFactory->createRelevancyRule(PHP_INT_MIN));
	}
	
	public function testCreateRelevancyRuleMaxId(): void
	{
		$this->assertInstanceOf(RelevancyRule::class, $this->rrFactory->createRelevancyRule(PHP_INT_MAX));
	}
	
	public function testCreateRelevancyNullId(): void
	{
		$this->expectException(TypeError::class);
		$this->rrFactory->createRelevancyRule(null);
	}
	
	public function testCreateRelevancyInvalidId(): void
	{
		$this->expectException(TypeError::class);
		$this->rrFactory->createRelevancyRule("asdfasdfasdf");
	}
	
	public function testCreateRelevancyInvalidId2(): void
	{
		$this->expectException(TypeError::class);
		$this->rrFactory->createRelevancyRule(1.5);
	}
	
	public function testCreateRelevancyNoId(): void
	{
		$this->expectException(ArgumentCountError::class);
		$this->rrFactory->createRelevancyRule();
	}
	
	public function testCreateFuturePredictor(): void
	{
		$this->assertInstanceOf(FuturePredictor::class, $this->fpFactory->createFuturePredictor(1));
	}
	
	public function testCreateFuturePredictorMinId(): void
	{
		$this->assertInstanceOf(FuturePredictor::class, $this->fpFactory->createFuturePredictor(PHP_INT_MIN));
	}
	
	public function testCreateFuturePredictorMaxId(): void
	{
		$this->assertInstanceOf(FuturePredictor::class, $this->fpFactory->createFuturePredictor(PHP_INT_MAX));
	}
	
	public function testCreateFuturePredictorNullId(): void
	{
		$this->expectException(TypeError::class);
		$this->fpFactory->createFuturePredictor(null);
	}
	
	public function testCreateFuturePredictorInvalidId(): void
	{
		$this->expectException(TypeError::class);
		$this->fpFactory->createFuturePredictor("asdfasdfsadf");
	}
	
	public function testCreateFuturePredictorInvalidId2(): void
	{
		$this->expectException(TypeError::class);
		$this->fpFactory->createFuturePredictor(1.5);
	}
	
	public function testCreateFuturePredictorNoId(): void
	{
		$this->expectException(ArgumentCountError::class);
		$this->fpFactory->createFuturePredictor();
	}
	
	public function testCreateReport(): void
	{
		$this->assertInstanceOf(Report::class, $this->rFactory->createReport(1, 1, 1));
	}
	
	public function testCreateReportMinId(): void
	{
		$this->assertInstanceOf(Report::class, $this->rFactory->createReport(PHP_INT_MIN, PHP_INT_MIN, PHP_INT_MIN));
	}
	
	public function testCreateReportMaxId(): void
	{
		$this->assertInstanceOf(Report::class, $this->rFactory->createReport(PHP_INT_MAX, PHP_INT_MAX, PHP_INT_MAX));
	}
	
	public function testCreateReportNullId(): void
	{
		$this->expectException(TypeError::class);
		$this->rFactory->createReport(null, null, null);
	}
	
	public function testCreateReportNullId2(): void
	{
		$this->expectException(TypeError::class);
		$this->rFactory->createReport(1, null, null);
	}
	
	public function testCreateReportNullId3(): void
	{
		$this->expectException(TypeError::class);
		$this->rFactory->createReport(1, 1, null);
	}
	
	public function testCreateReportNullId4(): void
	{
		$this->expectException(TypeError::class);
		$this->rFactory->createReport(1, null, 1);
	}
	
	public function testCreateReportInvalidId(): void
	{
		$this->expectException(TypeError::class);
		$this->rFactory->createReport(1.5, 1, 1);
	}
	
	public function testCreateReportInvalidId2(): void
	{
		$this->expectException(TypeError::class);
		$this->rFactory->createReport("a", 1, 1);
	}
	
	public function testCreateReportNoId(): void
	{
		$this->expectException(ArgumentCountError::class);
		$this->rFactory->createReport();
	}
}
?>