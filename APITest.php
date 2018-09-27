<?php
require_once('header.php');
require_once('lib/IEEEDataSource.php');
?>

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

if(isset($_POST['submitQuery']) && isset($_POST['query'])){
	
	$ieeeDataSource = new IEEEDataSource();
	$ieeeDataSource->setQueryWord($_POST['query']);
	
	echo "<br><h2>Results for: ".$ieeeDataSource->getQueryWord()."</h2>";
	
	$ieeeDataSource->updateDatabase();
	
	echo "<h3>Formatted for Database insertion:</h3>";
	$ieeeDataSource->printFormattedDataFromAPI();
	
	echo "<h3>Raw data from API:</h3><br>";
	$ieeeDataSource->printRawDataFromAPI();
}

require_once('footer.php');
?>