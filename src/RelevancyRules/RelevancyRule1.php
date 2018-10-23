<?php
namespace CurriculumForecaster;

class RelevancyRule1 extends RelevancyRule
{
	
	public function analyzeData(array $databaseData): float
	{
		$oldWilsonScore = 1;
		$wilsonScoreChange = 0;
		
		foreach($databaseData as $dataPoint)
		{
			$ns = $dataPoint['frequency'];
			$n = $dataPoint['totalSearched'] == 0 ? 1 : $dataPoint['totalSearched'];
			$nf = $n - $ns;
			$z = 1.96;
			
			$newWilsonScore = ($ns + (pow($z, 2) / (2 * $n))) / ($n + pow($z, 2)) - $z / ($n + pow($z, 2)) * (sqrt(($ns * $nf / $n) + (pow($z, 2) / 4)));
			$wilsonScoreChange = ($newWilsonScore - $oldWilsonScore) / $oldWilsonScore;
			$oldWilsonScore = $newWilsonScore;
		}
		//Ask Chris about the wilson score change calc. As it stands, this will only calculate change from TimePresent - 1 to TimePresent
		return $wilsonScoreChange * 100;
	}
	
	protected function setNameAndDescription()
	{
		$this->name = "Wilson Score Rule";
		$this->description = "
			Wilson score is a statistical technique used to evaluate the likelihood of a successful result in an arbitrarily selected Success/Failure experiment in a series. 
			In the context of a data source that provides number of matches to a keyword and total dataset size, a Successful test is defined as any randomly selected entry in the dataset matching the keyword. 
			Wilson score is calculated by the following equation: 
			WilsonScore = (ns+z2/2n) / (n+z2) - z/(n+z2)(nsnf/n) + (z2/4).
		";
	}
}

?>