<?php

if (!isset($_POST['title']) || empty($_POST['title'])) {
	$error = "Please fill out all required fields";
}

else {
	$host = "303.itpwebdev.com";
	$user = "sinhan_db_user";
	$password = "uscItp2021";
	$db = "sinhan_dvd";

	$mysqli = new mysqli($host, $user, $password, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	if( isset($_POST["release_date"]) && !empty($_POST["release_date"])  ) {
		$release_date= "'" . $_POST["release_date"] . "'";
	}
	else {
		$release_date = "null";
	}
	if( isset($_POST["label_id"]) && !empty($_POST["label_id"])  ) {
		$label = "'" . $_POST["label_id"] . "'";
	}
	else {
		$label = "null";
	}
	if( isset($_POST["sound_id"]) && !empty($_POST["sound_id"])  ) {
		$sound = $_POST["sound_id"];
	}
	else {
		$sound = "null";
	}
	if( isset($_POST["genre_id"]) && !empty($_POST["genre_id"])  ) {
		$genre = $_POST["genre_id"];
	}
	else {
		$genre = "null";
	}
	if( isset($_POST["rating_id"]) && !empty($_POST["rating_id"])  ) {
		$rating = $_POST["rating_id"];
	}
	else {
		$rating = "null";
	}
	if( isset($_POST["format_id"]) && !empty($_POST["format_id"])  ) {
		$format = $_POST["format_id"];
	}
	else {
		$format = "null";
	}
	if( isset($_POST["award"]) && !empty($_POST["award"])  ) {
		$award = "'" . $_POST["award"] . "'";
	}
	else {
		$award = "null";
	}

	// Escape any special characters. e.g. single quotes get escaped so it doesn't affect the SQL statement
	$title = $mysqli->real_escape_string($_POST["title"]);

	$sql = "INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
		VALUES('" . $title . "', " 
		. $release_date . " , " 
		. $award . " , " 
		. $label . ", "
		. $sound . ","
		. $genre . ", " 
		. $rating .", "
		. $format . ");";

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}
	
	$mysqli->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<div class="text-danger font-italic"><?php if(isset($error)) {echo $error;}?></div>

				<div class="text-success"><span class="font-italic"><?php echo $title ?></span> was successfully added.</div>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>