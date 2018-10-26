<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use CurriculumForecaster\IEEEDataSource;

/*
NOTE: These tests do not test the updateDatabase(), getFormattedDataFromAPI(), getRawDataFromAPI(), 
printRawDataFromAPI(), or the printFormattedDataFromAPI() as I don't want to modify the database
or make API calls while testing. I can build stubs for testing, but it would be time consuming 
so those functions will not be included in automated testing.
*/

final class IEEEDataSourceTest extends TestCase
{
	protected $dataSource;
	
	
	protected function setUp(): void
	{
		$this->dataSource = new IEEEDataSource();
	}
	
	public function testGetName(): void
	{
		$this->assertEquals("IEEE Xplore Digital Library", $this->dataSource->getName());
	}
	
	public function testGetDescription(): void
	{
		$this->assertGreaterThan(0, strlen($this->dataSource->getDescription()));
	}
	
	public function testGetDataFromDatabase(): void
	{
		$this->assertGreaterThan(0, count($this->dataSource->getDataFromDatabase()));
	}
	
	public function testGetDataFromDatabase2(): void
	{
		$this->assertGreaterThan(0, count($this->dataSource->getDataFromDatabase(true, 1)));
	}
	
	public function testGetDataFromDatabase3(): void
	{
		$this->assertEquals(0, count($this->dataSource->getDataFromDatabase(true, PHP_INT_MIN)));
	}
	
	public function testGetDataFromDatabase4(): void
	{
		$this->expectException(TypeError::class);
		$this->dataSource->getDataFromDatabase(1, 1);
	}
	
	public function testGetDataFromDatabase5(): void
	{
		$this->expectException(TypeError::class);
		$this->dataSource->getDataFromDatabase(false, "a");
	}
	
	public function testGetDataFromDatabase6(): void
	{
		$this->expectException(TypeError::class);
		$this->dataSource->getDataFromDatabase(null, null);
	}
}
?>