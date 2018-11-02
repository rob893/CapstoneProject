<?php
declare(strict_types = 1);

namespace CurriculumForecaster;


class Report
{
	private $dataSource;
	private $relevancyRules;
	private $futurePredictor;
	private $dataFromDatabase;
	private $dataByKeyword;
	private $courseName;
	private $courseNeedsUpdating = false;
	
	
	public function __construct(Datasource $dataSource, array $relevancyRules, FuturePredictor $futurePredictor, bool $limitByCourse = false, int $courseId = -1)
	{
		if(count($relevancyRules) < 1)
		{
			throw new \InvalidArgumentException("There must be at least one rule in relevancyRules!");
		}
		
		foreach($relevancyRules as $rule)
		{
			if(!($rule instanceof RelevancyRule))
			{
				throw new \InvalidArgumentException("A non relevancy rule was passed into the relevancyRules array!");
			}
		}
		
		$this->dataSource = $dataSource;
		$this->relevancyRules = $relevancyRules;
		$this->futurePredictor = $futurePredictor;
		$this->dataFromDatabase = $this->dataSource->getDataFromDatabase($limitByCourse, $courseId);
		
		$this->courseName = "All Courses";
		
		if($limitByCourse && count($this->dataFromDatabase) > 0 && isset($this->dataFromDatabase[0]['courseName']))
		{
			$this->courseName = $this->dataFromDatabase[0]['courseName'];
		}
		
		$dataByKeyword = [];
		foreach($this->dataFromDatabase as $recordNum => $recordData)
		{
			$dataByKeyword[$recordData['word']][] = array(
														'dsTableId' => $recordData['dsTableId'], 
														'frequency' => $recordData['frequency'], 
														'totalSearched' => $recordData['totalSearched'], 
														'dateTimeStamp' => $recordData['dateTimeStamp']
													);
		}
		
		$this->dataByKeyword = $dataByKeyword;
	}
	
	public function printDataFromDatabase(): bool
	{
		echo "<pre>";
		print_r($this->dataFromDatabase);
		echo "</pre>";
		
		return true;
	}
	
	public function printDataByKeyword(): bool
	{
		echo "<pre>";
		print_r($this->dataByKeyword);
		echo "</pre>";
		
		return true;
	}
	
	public function printReport(): bool
	{
		echo "
			<div class='container-fluid'><br>
		
				<h2>Report</h2>
				<br>
				<h2>Analysis for ".$this->courseName."</h2>
				<br>
				<h4>Data Source Used:<h4><h5>".$this->dataSource->getName()."</h5>
				<p>".$this->dataSource->getDescription()."</p>
				<h4>Rules Used:</h4> 
		";
		foreach($this->relevancyRules as $rule)
		{
			echo "<h5>".$rule->getName()."</h5>";
			echo "<p>".$rule->getDescription()."</p>";
		}
		
		echo "
				<h4>Future Predictor Used:</h4><h5>".$this->futurePredictor->getName()."</h5>
				<p>".$this->futurePredictor->getDescription()."</p>
				<h4>Overall Recommendation</h4>
				<p id='overallRecomendation'></p>
				<br>
				<h3>Subjects for this Course:</h3>
		";
		
		if(count($this->dataByKeyword) > 0)
		{
			foreach($this->dataByKeyword as $keyword => $record)
			{
				echo "
					<div>
						<h4>'".$keyword."'</h4>
						<p>Data Points: ".count($this->dataByKeyword[$keyword])."</p>
						<h5>Rule Analysis:</h5>
				";
				
				foreach($this->relevancyRules as $rule)
				{
					echo "<h5>Recommendation Using ".$rule->getName()."</h5>";
					echo "<p>".$this->getRecommendation($rule, $this->dataByKeyword[$keyword])."</p>";
				}
				
				echo "<h5>Future Analysis:</h5><p>".$this->getFurturePrediction($this->dataByKeyword[$keyword])."</p>";
				
				echo "<h5>Graph of Data Over Time:</h5>";
				$this->printGraph($keyword);
				
				echo "<br></div>";
			}
		}
		else
		{
			echo "<p>No data.</p>";
		}
		
		echo "</div>";
		
		$this->setOverallClassRecomendation();
		
		return true;
	}
	
	private function setOverallClassRecomendation(): void
	{
		$overallRecomendation = "Based on the data from the above data source analyzed by the the above rule, ";
		
		if($this->courseNeedsUpdating)
		{
			$overallRecomendation .= "this course needs updating. See individual subjects below for details.";
		}
		else
		{
			$overallRecomendation .= "this course does not need an update at this time.";
		}
		
		?>
		<script type="text/javascript">
		
			$(document).ready(function() {
				document.getElementById('overallRecomendation').innerHTML = "<?php echo $overallRecomendation; ?>";
			});
			
		</script>
		<?php
	}
	
	private function getRecommendation(RelevancyRule $rule, array $keywordData): string
	{
		$relValue = $this->analyzeData($rule, $keywordData);
		$resultString = "";
		
		if($relValue >= $rule->getUpperBreakPoint())
		{
			$resultString .= "This topic is growing in demand";
		}
		else if($relValue <= $rule->getLowerBreakPoint())
		{
			$this->courseNeedsUpdating = true;
			$resultString .= "This topic is declining in demand";
		}
		else
		{
			$resultString .= "This topic is in stable demand";
		}
		
		$resultString .= " with a relevancy value of ".$relValue.".";
		return $resultString;
	}
	
	private function analyzeData(RelevancyRule $rule, array $dataFromDatabase): float
	{
		return $rule->analyzeData($dataFromDatabase);
	}
	
	private function getFurturePrediction(array $keywordData): string
	{
		$this->predictFuture($keywordData);
		return "This is the future prediction.";
	}
	
	private function predictFuture(array $dataFromDatabase)
	{
		$this->futurePredictor->predictFuture($dataFromDatabase);
	}
	
	private function printGraph(string $keyword): void
	{
		$guid = uniqid();
		if(array_key_exists($keyword, $this->dataByKeyword))
		{
			$JSONData = json_encode($this->dataByKeyword[$keyword]);
		}
		else
		{
			$JSONData = json_encode([]);
		}
		?>
		<script type="text/javascript">
			
			$(function() {

				var graphData = [];
				for(var record in <?php echo $JSONData; ?>)
				{
					graphData.push([new Date(<?php echo $JSONData; ?>[record].dateTimeStamp).getTime(), <?php echo $JSONData; ?>[record].frequency]);
				}

				$.plot("#<?php echo $guid; ?>Graph", [ graphData ], { xaxis: { mode: "time" }});
			});

		</script>

		<div id="<?php echo $guid; ?>Graph" style="width:600px;height:300px" class="img-fluid"></div>
		<?php
	}
}

?>