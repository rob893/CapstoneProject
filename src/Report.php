<?php
namespace CurriculumForecaster;


class Report
{
	private $dataSource;
	private $relevancyRule;
	private $futurePredictor;
	private $dataFromDatabase;
	private $dataByKeyword;
	
	
	function __construct(Datasource $dataSource, RelevancyRule $relevancyRule, FuturePredictor $futurePredictor)
	{
		$this->dataSource = $dataSource;
		$this->relevancyRule = $relevancyRule;
		$this->futurePredictor = $futurePredictor;
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
	
	public function analyzeData($dataFromDatabase)
	{
		$this->relevancyRule->analyzeData($dataFromDatabase);
	}
	
	public function predictFuture($dataFromDatabase)
	{
		$this->futurePredictor->predictFuture($dataFromDatabase);
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
	
	public function printGraph($keyword)
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