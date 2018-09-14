<?php
require_once('header.php');
?>
<h2>Report</h2>
<br>

<?php

if(!isset($_POST['selectClassSubmit'])){
	?>
	<form action='#' method='post' enctype='multipart/form-data'>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='associatedClass'>Select Class:</label>
					<select class='form-control' id='selectClass' name='selectClass'>
						<option>Software Engineering</option>
						<option>Requirements Engineering</option>
						<option>Project Planning and Management</option>
					</select>
				</div>
			</div>
		</div>
		<input name='selectClassSubmit' type='submit' value='Select'>
	</form>

	<?php
}

if(isset($_POST['selectClassSubmit'])){
	?>

	<h2>Analysis for Software Engineering</h2>
	<br>
	<p>Class recommendation: Some subjects need to be updated. See below for details.</p>
	<br>
	<h3>Subjects for this Class</h3>
	<h4>'Java'</h4>
	<p>Recommendation: No update needed.</p>
	<img src="lineGraph.JPG">
	<br>
	<br>
	<h4>'Waterfall Method'</h4>
	<p>Recommendation: Update needed.</p>
	<img src="lineGraph.JPG">
	<br>
	<br>
	<h4>'Requirements Elicitation'</h4>
	<p>Recommendation: No update needed.</p>
	<img src="lineGraph.JPG">
	<br>
	<br>
	<h4>'Agile'</h4>
	<p>Recommendation: No update needed.</p>
	<img src="lineGraph.JPG">
	<br>

	<?php
}
require_once('footer.php');
?>