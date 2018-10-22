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
		return 0.5;//$wilsonScoreChange;
	}
	
	protected function setNameAndDescription()
	{
		$this->name = "RR1 name";
		$this->description = "RR1 description.";
	}
}

?>