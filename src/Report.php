<?php
namespace CurriculumForecaster;


class Report
{
	private $dataSource;
	private $relevancyRule;
	private $futurePredictor;
	private $dataFromDatabase;
	private $dataByKeyword;
	private $courseName;
	private $courseNeedsUpdating = false;
	
	
	public function __construct(Datasource $dataSource, RelevancyRule $relevancyRule, FuturePredictor $futurePredictor, bool $limitByCourse = false, int $courseId = -1)
	{
		$this->dataSource = $dataSource;
		$this->relevancyRule = $relevancyRule;
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
	
	public function printDataFromDatabase()
	{
		echo "<pre>";
		print_r($this->dataFromDatabase);
		echo "</pre>";
	}
	
	public function printDataByKeyword()
	{
		echo "<pre>";
		print_r($this->dataByKeyword);
		echo "</pre>";
	}
	
	public function printReport()
	{
		echo "
			<div class='container-fluid'><br>
		
				<h2>Report</h2>
				<br>
				<h2>Analysis for ".$this->courseName."</h2>
				<br>
				<h4>Data Source Used: ".$this->dataSource->getName()."</h4>
				<p>".$this->dataSource->getDescription()."</p>
				<h4>Rule Used: ".$this->relevancyRule->getName()."</h4>
				<p>".$this->relevancyRule->getDescription()."</p>
				<h4>Future Predictor Used: ".$this->futurePredictor->getName()."</h4>
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
						<p>".$this->getRecommendation($this->dataByKeyword[$keyword])."</p>
						<p>".$this->getFurturePrediction($this->dataByKeyword[$keyword])."</p>
				";
				
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
	}
	
	private function setOverallClassRecomendation()
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
	
	private function getRecommendation(array $keywordData): string
	{
		$relValue = $this->analyzeData($keywordData);
		$resultString = "";
		
		if($relValue >= 0.5)
		{
			$resultString .= "This topic is still relevant";
		}
		else
		{
			$this->courseNeedsUpdating = true;
			$resultString .= "This topic is no longer relevant";
		}
		
		$resultString .= " with a relevancy value of ".$relValue.".";
		return $resultString;
	}
	
	private function getFurturePrediction(array $keywordData): string
	{
		$this->predictFuture($keywordData);
		return "This is the future prediction.";
	}
	
	private function analyzeData(array $dataFromDatabase): float
	{
		return $this->relevancyRule->analyzeData($dataFromDatabase);
	}
	
	private function predictFuture(array $dataFromDatabase)
	{
		$this->futurePredictor->predictFuture($dataFromDatabase);
	}
	
	private function printGraph(string $keyword)
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