<?php
require_once('header.php');

if(!isset($_POST['submit'])){
	?>
	<div class='container-fluid'>
		<br>
		<br>
		<h2>Generate Report</h2>
		<br>
		<form action='#' method='post' enctype='multipart/form-data'>
			<div class='row'>
				<div class='col-sm-2'>
					<div class='form-group'>
						<label for='selectClass'>Select Class:</label>
						<select class='form-control' id='selectClass' name='selectClass'>
							<option value='1'>Software Engineering</option>
							<option value='2'>Data Structures and Algorithms</option>
							<option value='3'>Game Design and Development</option>
							<option value='4'>Formal Methods</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class='row'>
				<div class='col-sm-2'>
					<div class='form-group'>
						<label for='ds'>Select Data Source:</label>
						<select class='form-control' id='ds' name='ds'>
							<option value='1'>IEEE Data Source</option>
							<option value='2'>Test Data Source</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class='row'>
				<div class='col-sm-2'>
					<div class='form-group'>
						<label for='rule'>Select Relevancy Rule:</label>
						<select class='form-control' id='rule' name='rule'>
							<option value='1'>Rule 1</option>
							<option value='2'>Rule 2</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class='row'>
				<div class='col-sm-2'>
					<div class='form-group'>
						<label for='fp'>Select Future Predictor:</label>
						<select class='form-control' id='fp' name='fp'>
							<option value='1'>Future Predictor 1</option>
							<option value='2'>Future Predictor 2</option>
						</select>
					</div>
				</div>
			</div>
			<input name='submit' type='submit' value='Select'>
		</form>
	</div>
	<?php
}
else if(isset($_POST['ds']) && isset($_POST['rule']) && isset($_POST['fp']) && isset($_POST['selectClass']))
{
	$reportFactory = new \CurriculumForecaster\ReportFactory();

	$report = $reportFactory->createReport($_POST['ds'], $_POST['rule'], $_POST['fp'], true, $_POST['selectClass']);
	
	//$report->printDataByKeyword();
	
	//$report->printDataFromDatabase();
	
	$report->printReport();
}
else
{
	echo "<div class='container-fluid'>Something went wrong.</div>";
}

require_once('footer.php');
?>