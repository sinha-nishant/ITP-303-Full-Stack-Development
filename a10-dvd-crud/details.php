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

	$sql = "SELECT dvd_titles.title AS title, genres.genre AS genre, 
	dvd_titles.release_date AS release_date, ratings.rating AS rating, labels.label AS label, sounds.sound AS sound, formats.format AS format, dvd_titles.award AS award
	FROM dvd_titles
	JOIN genres
		ON genres.genre_id = dvd_titles.genre_id
	JOIN ratings
		ON ratings.rating_id = dvd_titles.rating_id
	JOIN labels
		ON labels.label_id = dvd_titles.label_id
	JOIN sounds
		ON sounds.sound_id = dvd_titles.sound_id
	JOIN formats
		ON formats.format_id = dvd_titles.format_id
	WHERE dvd_titles.title='" . $_GET["name"] . "';";
	
	$results = $mysqli->query($sql);
	if (!$results) {
		echo $mysqli->error;
		exit();
	}

	$dvd = $results->fetch_assoc();

	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<div class="text-danger font-italic">Display Errors Here</div>

				<table class="table table-responsive">

					<tr>
						<th class="text-right">Title:</th>
						<td><?php echo $dvd["title"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Release Date:</th>
						<td><?php echo $dvd["release_date"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Genre:</th>
						<td><?php echo $dvd["genre"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Label:</th>
						<td><?php echo $dvd["label"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Rating:</th>
						<td><?php echo $dvd["rating"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Sound:</th>
						<td><?php echo $dvd["sound"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Format:</th>
						<td><?php echo $dvd["format"] ?></td>
					</tr>

					<tr>
						<th class="text-right">Award:</th>
						<td><?php echo $dvd["award"] ?></td>
					</tr>

				</table>


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