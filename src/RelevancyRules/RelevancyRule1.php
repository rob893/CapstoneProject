<?php
declare(strict_types = 1);

namespace CurriculumForecaster;


class RelevancyRule1 extends RelevancyRule
{
	
	public function analyzeData(array $databaseData): float
	{
		if(count($databaseData) == 0)
		{
			return 0;
		}
		
		$firstWilsonScore = 1;
		$lastWilsonScore = 1;
		
		$i = 0;
		foreach($databaseData as $dataPoint)
		{
			if(!isset($dataPoint['totalSearched']) || !isset($dataPoint['frequency']))
			{
				throw new \InvalidArgumentException("The passed in array requires both a 'frequency' key and a 'totalSearched' key!");
			}
			
			$ns = $dataPoint['frequency'];
			$n = $dataPoint['totalSearched'] == 0 ? 1 : $dataPoint['totalSearched'];
			
			if(!is_numeric($n) || !is_numeric($ns))
			{
				throw new \InvalidArgumentException("The keys 'frequency' and 'totalSearched' must be mapped to a numeric value!");
			}
			
			$nf = $n - $ns;
			$z = 1.96;
			
			$newWilsonScore = ($ns + (pow($z, 2) / (2 * $n))) / ($n + pow($z, 2)) - $z / ($n + pow($z, 2)) * (sqrt(($ns * $nf / $n) + (pow($z, 2) / 4)));

			if($i == 0)
			{
				$firstWilsonScore = $newWilsonScore;
			}
			$i++;
			
			$lastWilsonScore = $newWilsonScore;
		}
		
		$wilsonScoreChange = ($lastWilsonScore - $firstWilsonScore) / $firstWilsonScore;
		
		return (float)number_format($wilsonScoreChange, 4);
	}
	
	protected function setNameAndDescription(): void
	{
		$this->name = "Wilson Score Rule";
		$this->description = "
			Wilson score is a statistical technique used to evaluate the likelihood of a successful result in an arbitrarily selected Success/Failure experiment in a series. 
			In the context of a data source that provides number of matches to a keyword and total dataset size, a Successful test is defined as any randomly selected entry in the dataset matching the keyword. 
			Wilson score is calculated by the following equation: 
			WilsonScore = (ns+z2/2n) / (n+z2) - z/(n+z2)(nsnf/n) + (z2/4).
		";
	}
	
	protected function setBreakPoints(): void
	{
		$this->upperBreakPoint = 0.1;
		$this->lowerBreakPoint = -0.05;
	}
}

?>