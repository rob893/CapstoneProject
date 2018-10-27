<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use CurriculumForecaster\RelevancyRule1;


final class RelevancyRule1Test extends TestCase
{
	protected $rule;
	
	
	protected function setUp(): void
	{
		$this->rule = new RelevancyRule1();
	}
	
	public function testAnalyzeData(): void
	{
		$testData = [["totalSearched" => 500, "frequency" => 50]];
		$this->assertInternalType("float", $this->rule->analyzeData($testData));
	}
	
	public function testAnalyzeData2(): void
	{
		$testData = [["totalSearched" => 500, "frequency" => 50, "junk" => 0], ["totalSearched" => 500, "frequency" => 15], ["totalSearched" => 500, "frequency" => 25]];
		$this->assertInternalType("float", $this->rule->analyzeData($testData));
	}
	
	public function testAnalyzeDataNull(): void
	{
		$this->expectException(TypeError::class);
		$this->rule->analyzeData(null);
	}
	
	public function testAnalyzeDataInvalidArg(): void
	{
		$this->expectException(TypeError::class);
		$this->rule->analyzeData(1);
	}
	
	public function testAnalyzeDataInvalidArg2(): void
	{
		$this->expectException(TypeError::class);
		$this->rule->analyzeData("asdf");
	}
	
	public function testAnalyzeDataInvalidArrayKeys(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$testData = [["junk1" => 500, "junk2" => 50], ["totalSearched" => 500, "frequency" => 15], ["totalSearched" => 500, "frequency" => 25]];
		$this->rule->analyzeData($testData);
	}
	
	public function testAnalyzeDataInvalidArrayKeys2(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$testData = [["totalSearched" => "asdf", "frequency" => "asdf"], ["totalSearched" => 500, "frequency" => 15], ["totalSearched" => 500, "frequency" => 25]];
		$this->rule->analyzeData($testData);
	}
	
	public function testAnalyzeDataEmptyArray(): void
	{
		$testData = [];
		$this->assertEquals(0, $this->rule->analyzeData($testData));
	}
	
	public function testGetName(): void
	{
		$this->assertEquals("Wilson Score Rule", $this->rule->getName());
	}
	
	public function testGetDescription(): void
	{
		$this->assertGreaterThan(0, strlen($this->rule->getDescription()));
	}
	
	public function testGetUpperBreakPoint(): void
	{
		$this->assertEquals(0.1, $this->rule->getUpperBreakPoint());
	}
	
	public function testGetLowerBreakPoint(): void
	{
		$this->assertEquals(-0.05, $this->rule->getLowerBreakPoint());
	}
}
?>