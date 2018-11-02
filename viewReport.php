<?php
require_once('header.php');

use CurriculumForecaster\DatabaseConnection;
use CurriculumForecaster\ReportFactory;


if(!isset($_POST['submit']))
{
	$sqlCourses = "SELECT * FROM Courses";
	
	$dbConnection = new DatabaseConnection();
	$conn = $dbConnection->getConnection();
	$queryResults = $conn->query($sqlCourses);
	
	$results = [];
	
	$i = 0;
	while($row = $queryResults->fetch_assoc())
	{
		$results[$i] = $row;
		$i++;
	}
	
	?>
	<script>
		$(function(){

			var requiredCheckboxes = $(':checkbox[required]');

			requiredCheckboxes.change(function(){

				if(requiredCheckboxes.is(':checked')) {
					requiredCheckboxes.removeAttr('required');
				}

				else {
					requiredCheckboxes.attr('required', 'required');
				}
			});

		});
	</script>
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
							<?php
								foreach($results as $row)
								{
									echo "<option value='".$row['id']."'>".$row['name']."</option>";
								}
							?>
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
						<label>Select Relevancy Rules:</label><br>
						<input type='checkbox' name='rule[]' id='rule1' value='1' required> Wilson Score Rule<br>
						<input type='checkbox' name='rule[]' id='rule2' value='2' required> Rule 2<br>
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
			<input name='submit' type='submit' value='Create Report'>
		</form>
	</div>
	<?php
}
else if(isset($_POST['ds']) && isset($_POST['rule']) && isset($_POST['fp']) && isset($_POST['selectClass']))
{
	$reportFactory = new ReportFactory();

	$report = $reportFactory->createReport($_POST['ds'], $_POST['rule'], $_POST['fp'], true, $_POST['selectClass']);
	
	$report->printReport();
}
else
{
	echo "<div class='container-fluid'>Something went wrong.</div>";
}

require_once('footer.php');
?>