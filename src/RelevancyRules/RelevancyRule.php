<?php
declare(strict_types = 1);

namespace CurriculumForecaster;


abstract class RelevancyRule
{
	protected $name;
	protected $description;
	
	
	public function __construct()
	{
		$this->setNameAndDescription();
	}
	
	abstract public function analyzeData(array $databaseData): float;
	
	abstract protected function setNameAndDescription(): void;
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function getDescription(): string
	{
		return $this->description;
	}
}

?>