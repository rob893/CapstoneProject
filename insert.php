<?php
require_once('header.php');
?>
<br>
<br>
<div class="container-fluid">
	<h2>Insert Data into the Database</h2>

	<h3>Add a New Class to the Database</h3>
	<form>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='class'>Class Name:</label>
					<input type='text' class='form-control' name='class' id='class' required>
				</div>
			</div>
		</div>
		<input name='submitClass' type='submit' value='Add Class'>
	</form>

	<br>


	<h3>Associate a Keyword with a Class in the Database</h3>
	<form>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='keyword'>Associate Keyword:</label>
					<input type='text' class='form-control' name='keyword' id='keyword' required>
				</div>
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='associatedClass'>With Class:</label>
					<select class='form-control' id='associatedClass' name='associatedClass'>
						<option>Software Engineering</option>
						<option>Requirements Engineering</option>
						<option>Project Planning and Management</option>
					</select>
				</div>
			</div>
		</div>
		<input name='submitKeyword' type='submit' value='Associate'>
	</form>
</div>

<?php
require_once('footer.php');
?>