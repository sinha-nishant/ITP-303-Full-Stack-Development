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

// // else no errors so continue
// // Generate and submit SQL query
// $sql = "SELECT DISTINCT(genre) FROM sinhan_dvd.genres
// WHERE genre != '';";
// echo "<hr>" . $sql . "<hr>";

// $results = $mysqli->query($sql);

// // quickly see dump out the results
// var_dump($results);

// // check for any sql or result errors
// if(!$results) {
// 	echo $mysqli -> error;
// 	exit();
// }

// echo "<hr>";
// echo "Number of rows: " . $results->num_rows;

// // fetch_assoc returns first result as an associative array
// var_dump($results->fetch_assoc());

// // run a loop to get all results
// while ($row = $results->fetch_assoc()) {
// 	echo "<hr>";
// 	var_dump($row);
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item active">Search</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">DVD Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<form action="search_results.php" method="GET">
			<div class="form-group row">
				<label for="title-id" class="col-sm-3 col-form-label text-sm-right">DVD Title:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="title-id" name="title">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
					<select name="genre" id="genre-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Genre dropdown options here -->

						<?php
							$sql = "SELECT genre_id, genre FROM sinhan_dvd.genres WHERE genre != '';";

							$results = $mysqli->query($sql);

							// check for any sql or result errors
							if(!$results) {
								echo $mysqli -> error;
								exit();
							}
						?>

						<?php while($row = $results->fetch_assoc()):?>
							<option value=<?php echo $row['genre_id'];?>>
								<?php echo $row['genre']?>
							</option>
						<?php endwhile;?>
					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
				<div class="col-sm-9">
					<select name="rating" id="rating-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Rating dropdown options here -->
						<?php
							$sql = "SELECT rating_id, rating FROM sinhan_dvd.ratings;";

							$results = $mysqli->query($sql);

							// check for any sql or result errors
							if(!$results) {
								echo $mysqli -> error;
								exit();
							}
						?>

						<?php while($row = $results->fetch_assoc()):?>
							<option value=<?php echo $row['rating_id'];?>>
								<?php echo $row['rating']?>
							</option>
						<?php endwhile;?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="label-id" class="col-sm-3 col-form-label text-sm-right">Label:</label>
				<div class="col-sm-9">
					<select name="label" id="label-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Label dropdown options here -->
						<?php
							$sql = "SELECT label_id, label FROM sinhan_dvd.labels WHERE label != '';";

							$results = $mysqli->query($sql);

							// check for any sql or result errors
							if(!$results) {
								echo $mysqli -> error;
								exit();
							}
						?>

						<?php while($row = $results->fetch_assoc()):?>
							<option value=<?php echo $row['label_id'];?>>
								<?php echo $row['label']?>
							</option>
						<?php endwhile;?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="format-id" class="col-sm-3 col-form-label text-sm-right">Format:</label>
				<div class="col-sm-9">
					<select name="format" id="format-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Format dropdown options here -->
						<?php
							$sql = "SELECT format_id, format FROM sinhan_dvd.formats;";

							$results = $mysqli->query($sql);

							// check for any sql or result errors
							if(!$results) {
								echo $mysqli -> error;
								exit();
							}
						?>

						<?php while($row = $results->fetch_assoc()):?>
							<option value=<?php echo $row['format_id'];?>>
								<?php echo $row['format']?>
							</option>
						<?php endwhile;?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="sound-id" class="col-sm-3 col-form-label text-sm-right">Sound:</label>
				<div class="col-sm-9">
					<select name="sound" id="sound-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Sound dropdown options here -->
						<?php
							$sql = "SELECT sound_id, sound FROM sinhan_dvd.sounds;";

							$results = $mysqli->query($sql);

							// check for any sql or result errors
							if(!$results) {
								echo $mysqli -> error;
								exit();
							}
						?>

						<?php while($row = $results->fetch_assoc()):?>
							<option value=<?php echo $row['sound_id'];?>>
								<?php echo $row['sound']?>
							</option>
						<?php endwhile;?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="award-id" class="col-sm-3 col-form-label text-sm-right">Award:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input mr-2" type="radio" name="award" id="inlineCheckbox3" value="any" checked>Any
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input mr-2" type="radio" name="award" id="inlineCheckbox1" value="yes">Yes
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input mr-2" type="radio" name="award" id="inlineCheckbox2" value="no">No
						</label>
					</div>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="date-id" class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
				<div class="col-sm-9">
					<div class="row">
						<div class="col">
							<label class="form-check-label">
								From: 
								<input type="date" class="form-control mt-2" name="release_date_from">
							</label>
						</div> <!-- .col -->
						<div class="col">
							<label class="form-check-label">
								to: 
								<input type="date" class="form-control mt-2" name="release_date_to">
							</label>
						</div> <!-- .col -->
					</div> <!-- .row -->
				</div> <!-- .col -->
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>