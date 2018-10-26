<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use CurriculumForecaster\DatabaseConnection;


final class DatabaseConnectionTest extends TestCase
{
	protected $dbConnection;
	
	
	protected function setUp(): void
	{
		$this->dbConnection = new DatabaseConnection();
	}
	
	public function testGetConnection(): void
	{
		$this->assertInstanceOf(\mysqli::class, $this->dbConnection->getConnection());
	}
}
?>