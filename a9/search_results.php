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
	dvd_titles.release_date as release_date, ratings.rating as rating
	FROM dvd_titles
	JOIN genres
		ON genres.genre_id = dvd_titles.genre_id
	JOIN ratings
		ON ratings.rating_id = dvd_titles.rating_id
	WHERE 1=1";

	if(isset($_GET["title"]) && !empty($_GET["title"])) {
		$sql = $sql . " AND title LIKE '%" . $_GET["title"] . "%'";
	}

	if(isset($_GET["genre"]) && !empty($_GET["genre"])) {
		$sql = $sql . " AND dvd_titles.genre_id = " . $_GET["genre"];
	}

	if(isset($_GET["rating"]) && !empty($_GET["rating"])) {
		$sql = $sql . " AND dvd_titles.rating_id = " . $_GET["rating"];
	}

	if(isset($_GET["label"]) && !empty($_GET["label"])) {
		$sql = $sql . " AND dvd_titles.label_id = " . $_GET["label"];
	}

	if(isset($_GET["format"]) && !empty($_GET["format"])) {
		$sql = $sql . " AND dvd_titles.format_id = " . $_GET["format"];
	}

	if(isset($_GET["sound"]) && !empty($_GET["sound"])) {
		$sql = $sql . " AND dvd_titles.sound_id = " . $_GET["sound"];
	}

	if(isset($_GET["award"]) && !empty($_GET["award"])) {
		if ($_GET["award"] == "yes") {
			$sql = $sql . " AND dvd_titles.award IS NOT NULL";
		}

		else if ($_GET["award"] == "no") {
			$sql = $sql . " AND dvd_titles.award IS NULL";
		}
	}

	if(isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"]) && isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"])) {
		$sql = $sql . " AND dvd_titles.release_date >= " .  "'" . $_GET["release_date_from"] .  "'" . " AND dvd_titles.release_date <= " .  "'" . $_GET["release_date_to"] . "'";
	} else {
		if(isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"])) {
			$sql = $sql . " AND dvd_titles.release_date >= " . "'" . $_GET["release_date_from"] . "'";
		}
	
		if(isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"])) {
			$sql = $sql . " AND dvd_titles.release_date <= " .  "'" . $_GET["release_date_to"] . "'" ;
		}
	}

	$sql = $sql . " ORDER BY title;";

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
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">
				Showing <?php echo $results->num_rows ?> result(s).
			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>
								Title name.
							</td>
							<td>Release Date</td>
							<td>Genre</td>
							<td>Rating</td>
						</tr>

						<?php while($row = $results->fetch_assoc()) :?>
							<tr>
								<td> <?php echo $row['title']; ?></td>
								<td> <?php echo $row['release_date']; ?></td>
								<td> <?php echo $row['genre']; ?></td>
								<td> <?php echo $row['rating']; ?></td>
							</tr>
						<?php endwhile;?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>