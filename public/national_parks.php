<?php  

// connect to db, present db connection as $connection variable
require __DIR__ . '/../database/db-connection.php';
require __DIR__ . '/../Input.php';

// protect from looking at blank pages past the number of results
# of results / limit to get number of total pages, round up
function getLastPage($connection, $limit) {
	$statement = $connection->query("SELECT count(*) from parks");
	$count = $statement->fetch()[0]; // to get the count
	$lastPage = ceil($count / $limit);
	return $lastPage;
}

function getPaginatedParks($connection, $page, $limit) {
	// offset = (pageNumber -1) * limit
	$offset = ($page - 1) * $limit;

	$select = "SELECT * from parks limit $limit offset $offset";
	$statement = $connection->query($select);
	return $statement->fetchAll(PDO::FETCH_ASSOC); 
}

function handleOutOfRangeRequests($page, $lastPage) {
	// protect from looking at negative pages, too high pages, and non-numeric pages
	if($page < 1 || !is_numeric($page)) {
		header("location: national_parks.php?page=1");
		die;
	} else if($page > $lastPage) {
		header("location: national_parks.php?page=$lastPage");
		die;
	}
}

function pageController($connection) {

	$data = [];
	
	$limit = 4;
	$page = Input::get('page', 1);

	$lastPage = getLastPage($connection, $limit);

	handleOutOfRangeRequests($page, $lastPage);

	$data['parks'] = getPaginatedParks($connection, $page, $limit);
	$data['page'] = $page;
	$data['lastPage'] = $lastPage;

	return $data;
}

extract(pageController($connection));


?>
<!DOCTYPE html>
	<html lang="en-us">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">
		
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="">
		<meta name="Keywords" content="">
	    <meta name="author" content="">
		<title></title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- Custom CSS -->
	<style></style>
	</head>
	<body>
		<main class="container">
			<h1>Welcome to National Parks</h1>

			<section class="parks">
				<table class="table table-striped">
					<tr>
						<th>Park Name: </th>
						<th>Location: </th>
						<th>Area in Acres: </th>
						<th>Date Established: </th>
					</tr>
					<?php foreach($parks as $park): ?>
						<tr>
							<td><?= $park['name'] ?></td>
							<td><?= $park['location'] ?></td>
							<td><?= $park['area_in_acres']?></td>
							<td><?= $park['date_established']?></td>
						</tr>
					<?php endforeach; ?>	
				</table>

				<?php if($page > 1): ?>
					<a href="?page=<?= $page - 1 ?>"><span class="glyphicon glyphicon-chevron-left">Previous</span></a>
				<?php endif; ?>
				
				<?php if($page < $lastPage): ?>	
					<a class="pull-right" href="?page=<?= $page + 1 ?>"><span class="glyphicon glyphicon-chevron-right">Next</span></a>
				<?php endif; ?>

			</section>
		</main>
		<!-- minified jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
		<!-- Your custom JS goes here -->
		<script type="text/javascript"></script>
	</body>
	</html>
	
