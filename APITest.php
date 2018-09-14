<?php
require_once('header.php');
require_once('xplore-php-sdk.php');
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
if(isset($_POST['submitQuery'])){
	
	$ieeeAPIKey = "c67wkrzktr7ucc385gznctzb";
	$queryText = $_POST['query'];
	// $ieeeLink = 'http://ieeexploreapi.ieee.org/api/v1/search/articles?querytext='.$queryText.'&start_year=2018&format=json&apikey='.$ieeeAPIKey;
	// echo $queryText;
	// try{
		// $data = json_decode(file_get_contents($ieeeLink), true);
		// var_dump(http_response_code());
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
	// } 
	// catch(Exception $e){
		// echo 'Something went wrong. '.$e->getMessage();
	// }
	
	$query = new XPLORE($ieeeAPIKey);
	$query->queryText($queryText);
	$query->resultsFilter('start_year', '2018');
	$results = $query->callAPI();
	echo '<pre>';
	print_r($results);
	echo '</pre>';
}


require_once('footer.php');
?>