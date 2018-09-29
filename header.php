<?php
ini_set('display_errors', true);
require_once('lib/dbconnection.php');

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

		 <!-- Bootstrap core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom fonts for this template -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

		<!-- Custom styles for this template -->
		<link href="css/landing-page.min.css" rel="stylesheet">
		
		<title>Curriculum Forecaster</title>
	</head>
	<body>
		    <!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="index.php">Curriculum Forecaster</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a href="index.php" class='nav-item nav-link'>Home</a>
				</div>
				<div class="navbar-nav">
					<a href="report.php" class='nav-item nav-link'>Report</a>
				</div>
				<div class="navbar-nav">
					<a href="insert.php" class='nav-item nav-link'>Add Data</a>
				</div>
				<div class="navbar-nav">
					<a href="APITest.php" class='nav-item nav-link'>Test API</a>
				</div>
			</div>
		</nav>