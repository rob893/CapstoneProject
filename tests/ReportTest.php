<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use CurriculumForecaster\ReportFactory;
use CurriculumForecaster\Report;


final class ReportTest extends TestCase
{
	protected $report;
	
	
	protected function setUp(): void
	{
		$rFactory = new ReportFactory();
		$this->report = $rFactory->createReport(1, 1, 1);
	}
	
	public function testPrintReport(): void
	{
		$this->assertEquals(true, $this->report->printReport());
	}
	
	public function testPrintData(): void
	{
		$this->assertEquals(true, $this->report->printDataFromDatabase());
	}
	
	public function testPrintDataByKeyword(): void
	{
		$this->assertEquals(true, $this->report->printDataByKeyword());
	}
}
?>