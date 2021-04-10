<?php
	// establish DB connection
	$host = "303.itpwebdev.com";
	$user = "sinhan_db_user";
	$password = "uscItp2021";
	$db = "sinhan_dvd";

	// to use MySQLi extension
	$mysqli = new mysqli($host, $user, $password, $db);

	// returns errorr code from db connection call
	if ($mysqli -> connect_errno) {
		// there is an error if in this block
		echo $mysqli -> connect_error;
		// terminates PHP program
		exit();
	}

	$mysqli->set_charset('utf8');

	$sql = "DELETE FROM dvd_titles WHERE dvd_titles.dvd_title_id=" . $_GET["id"] . ";";
	
	$results = $mysqli->query($sql);
	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete a DVD | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Delete</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Delete a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<div class="text-success"><span class="font-italic"><?php echo $_GET["title"] ?></span> was successfully deleted.</div>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>