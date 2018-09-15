<?php
ini_set('display_errors', true);
require_once('dbconnection.php');

date_default_timezone_set('EST');
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		 <style>
		   #map {
			height: 400px;
			width: 100%;
		   }
		</style>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<title>Capstone Project</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class='navbar-brand' href='index.php'>
				Capstone Project
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a href="index.php" class='nav-item nav-link'>Home</a>
				</div>
				<div class="navbar-nav">
					<a href="report.php" class='nav-item nav-link'>Report</a>
				</div>
			</div>
		</nav>
		<br>
		<br>
		<div class="container-fluid">
