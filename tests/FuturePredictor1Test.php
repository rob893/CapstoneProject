<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use CurriculumForecaster\FuturePredictor1;

/*
Due to not actually implementing this concrete class, the testing will be limited.
*/
final class FuturePredictor1Test extends TestCase
{
	protected $futurePredictor;
	
	
	protected function setUp(): void
	{
		$this->futurePredictor = new FuturePredictor1();
	}
	
	public function testAnalyzeData(): void
	{
		$testData = [];
		$this->assertEquals(0, $this->futurePredictor->predictFuture($testData));
	}
	
	public function testGetName(): void
	{
		$this->assertEquals("FP1 name", $this->futurePredictor->getName());
	}
	
	public function testGetDescription(): void
	{
		$this->assertGreaterThan(0, strlen($this->futurePredictor->getDescription()));
	}
}
?>