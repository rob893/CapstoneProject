<?php
namespace CurriculumForecaster;

abstract class FuturePredictor
{
	protected $name;
	protected $description;
	
	
	public function __construct()
	{
		$this->setNameAndDescription();
	}
	
	abstract public function predictFuture(array $databaseData);
	
	abstract protected function setNameAndDescription();
	
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