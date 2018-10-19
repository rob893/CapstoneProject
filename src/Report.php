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
	
	
	function __construct(Datasource $dataSource, RelevancyRule $relevancyRule, FuturePredictor $futurePredictor, string $courseName)
	{
		$this->dataSource = $dataSource;
		$this->relevancyRule = $relevancyRule;
		$this->futurePredictor = $futurePredictor;
		$this->courseName = $courseName;
		$this->dataFromDatabase = $this->dataSource->getDataFromDatabase();
		
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
		echo '<div class="container-fluid"><br>';
		
		echo "<h2>Report</h2><br>";
		echo "<h2>Analysis for ".$this->courseName."</h2>";
		echo "<p>".$this->getOverallClassRecomendation()."</p>";
		echo "<h3>Subjects for this Course:</h3>";
		foreach($this->dataByKeyword as $keyword => $record)
		{
			echo "<div>";
			echo "<h4>'".$keyword."'</h4>";
			
			echo "<p>".$this->getRecommendation($this->dataByKeyword[$keyword])."</p>";
			echo "<p>".$this->getFurturePrediction($this->dataByKeyword[$keyword])."</p>";
			
			$this->printGraph($keyword);
			
			echo "</div>";
		}
		
		echo "</div>";
	}
	
	private function getOverallClassRecomendation(): string
	{
		//WIP
		return "This is where the overall class recommendation will go.";
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