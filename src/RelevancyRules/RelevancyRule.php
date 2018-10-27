<?php
declare(strict_types = 1);

namespace CurriculumForecaster;


abstract class RelevancyRule
{
	protected $name;
	protected $description;
	protected $upperBreakPoint;
	protected $lowerBreakPoint;
	
	
	public function __construct()
	{
		$this->setNameAndDescription();
		$this->setBreakPoints();
	}
	
	abstract public function analyzeData(array $databaseData): float;
	
	abstract protected function setNameAndDescription(): void;
	
	abstract protected function setBreakPoints(): void;
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function getDescription(): string
	{
		return $this->description;
	}
	
	public function getUpperBreakPoint(): float
	{
		return $this->upperBreakPoint;
	}
	
	public function getLowerBreakPoint(): float
	{
		return $this->lowerBreakPoint;
	}
}

?>