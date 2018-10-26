<?php
require_once('header.php');

use CurriculumForecaster\DatabaseConnection;


$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

if(isset($_POST['submitClass']) && isset($_POST['class']))
{
	$className = $_POST['class'];
	
	if($sqlInsert = $conn->prepare("INSERT INTO Courses (name) VALUES (?)"))
	{
		$sqlInsert->bind_param('s', $className);
		if($sqlInsert->execute() === true)
		{
			echo "Inserted ".$className." successfully!";
			$sqlInsert->close();
		} 
		else 
		{
			echo $sqlInsert->error;
			$sqlInsert->close();
		}
	}
	else
	{
		throw new \InvalidArgumentException("Error preparing database query.");
	}
}

if(isset($_POST['submitKeyword']) && isset($_POST['keyword']))
{
	$keyword = $_POST['keyword'];
	
	if($sqlInsert = $conn->prepare("INSERT INTO Keywords (word) VALUES (?)"))
	{
		$sqlInsert->bind_param('s', $keyword);
		if($sqlInsert->execute() === true)
		{
			echo "Inserted ".$keyword." successfully!";
			$sqlInsert->close();
		} 
		else 
		{
			echo $sqlInsert->error;
			$sqlInsert->close();
		}
	}
	else
	{
		throw new \InvalidArgumentException("Error preparing database query.");
	}
}

if(isset($_POST['submitAssoc']) && isset($_POST['associatedWord']) && isset($_POST['associatedClass']))
{
	$assocWordId = $_POST['associatedWord'];
	$assocClassId = $_POST['associatedClass'];

	if($sqlInsert = $conn->prepare("INSERT INTO CourseKeywordXref (courseId, keywordId) VALUES (?, ?)"))
	{
		$sqlInsert->bind_param('ii', $assocClassId, $assocWordId);
		if($sqlInsert->execute() === true)
		{
			echo "Association successful!";
			$sqlInsert->close();
		} 
		else 
		{
			echo $sqlInsert->error;
			$sqlInsert->close();
		}
	}
	else
	{
		throw new \InvalidArgumentException("Error preparing database query.");
	}
}

$keyWordQuery = "SELECT * FROM Keywords";
$courseQuery = "SELECT * FROM Courses";

$keywordResults = ($conn->query($keyWordQuery)) ? $conn->query($keyWordQuery) : null;
$courseResults = $conn->query($courseQuery);

?>

<br>

<div class="container-fluid">
	<h2>Insert Data into the Database</h2>

	<h3>Add a New Class to the Database</h3>
	<form action='#' method='post' enctype='multipart/form-data'>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='class'>Class Name:</label>
					<input type='text' class='form-control' name='class' id='class' required>
				</div>
			</div>
		</div>
		<input id='submitClass' name='submitClass' type='submit' value='Add Class'>
	</form>

	<br>
	
	<h3>Add a New Keyword to the Database</h3>
	<form action='#' method='post' enctype='multipart/form-data'>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='keyword'>Keyword:</label>
					<input type='text' class='form-control' name='keyword' id='keyword' required>
				</div>
			</div>
		</div>
		<input id='submitKeyword' name='submitKeyword' type='submit' value='Add Keyword'>
	</form>

	<br>


	<h3>Associate a Keyword with a Class in the Database</h3>
	<form action='#' method='post' enctype='multipart/form-data'>
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='keyword'>Associate Keyword:</label>
					<select class='form-control' id='associatedWord' name='associatedWord'>
						<?php
							while($row = $keywordResults->fetch_assoc())
							{
								echo "<option value='".$row['id']."'>".$row['word']."</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-2'>
				<div class='form-group'>
					<label for='associatedClass'>With Class:</label>
					<select class='form-control' id='associatedClass' name='associatedClass'>
						<?php
							while($row = $courseResults->fetch_assoc())
							{
								echo "<option value='".$row['id']."'>".$row['name']."</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<input id='submitAssoc' name='submitAssoc' type='submit' value='Associate'>
	</form>
</div>

<?php
require_once('footer.php');
?>