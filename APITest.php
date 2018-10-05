<?php
require_once('header.php');
require_once('lib/DataSources/IEEEDataSource.php');
?>
<br>
<br>

<div class="container-fluid">
	<form action='#' method='post' enctype='multipart/form-data'>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='associatedClass'>Enter Search:</label>
					<input name='query' id='query' type='text'>
				</div>
			</div>
		</div>
		<input name='submitQuery' type='submit' value='Search'>
	</form>

<?php
//crontab -e 00 00 * * 5 php /home/rob893/public_html/CapstoneProject/lib/UpdateDatabase.php to run every Friday
if(isset($_POST['submitQuery']) && isset($_POST['query'])){
	
	$ieeeDataSource = new IEEEDataSource();
	
	echo "<br><h2>Results for: ".$_POST['query']."</h2>";
	//$ieeeDataSource->updateDatabase();
	
	echo "<h3>Formatted for Database insertion:</h3>";
	$ieeeDataSource->printFormattedDataFromAPI($_POST['query']);
	
	echo "<h3>Raw data from API:</h3><br>";
	$ieeeDataSource->printRawDataFromAPI($_POST['query']);
}
?>

</div>

<?php
require_once('footer.php');
?>