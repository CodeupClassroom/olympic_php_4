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

	$select = "SELECT * from parks limit :limit offset :offset";

	$statement = $connection->prepare($select);

	$statement->bindValue(':limit', $limit, PDO::PARAM_INT);
	$statement->bindValue(':offset', $offset, PDO::PARAM_INT);

	$result = $statement->execute();

	if($result) {
		return $statement->fetchAll(PDO::FETCH_ASSOC); 
	} else {
		return [];
	}

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

function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}


function inputsAreValid() {
	// date_established can't be empty and needs to be a date
	// area_in_acres can't be empty and needs to be a float
	// description can't be empty
	
	if(!empty($_POST['name']) &&
		!empty($_POST['location']) &&
		!empty($_POST['area_in_acres']) &&
		!empty($_POST['date_established']) && 
		is_numeric($_POST['area_in_acres']) &&
		validateDate($_POST['date_established'])) {

		return true;

	} else {
		return false;
	}

}

function insertPark($connection) {
	$insert = "INSERT INTO parks (name, location, area_in_acres, date_established, description) VALUES (:name, :location, :area_in_acres, :date_established, :description);";
	
	$statement = $connection->prepare($insert);
	$statement->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
	$statement->bindValue(":location", $_POST['location'], PDO::PARAM_STR);
	$statement->bindValue(":area_in_acres", $_POST['area_in_acres'], PDO::PARAM_STR);
	$statement->bindValue(":date_established", $_POST['date_established'], PDO::PARAM_STR);
	$statement->bindValue(":description", $_POST['description'], PDO::PARAM_STR);

	$statement->execute();

}


function pageController($connection) {

	if(!empty($_POST) && inputsAreValid()) {
		insertPark($connection);
	}

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

			<section class="col-md-6">
				<form class="form-horizontal" method="POST" action="national_parks.php">
					<div class="form-group">
			    		<label for="name" class="col-sm-4 control-label">Park Name: </label>
			    		<div class="col-sm-8">
			      			<input type="text" name="name" class="form-control" id="name" placeholder="Park Name">
			    		</div>
			  	</div>
				<form class="form-horizontal">
					<div class="form-group">
			    		<label for="location" class="col-sm-4 control-label">Location:</label>
			    		<div class="col-sm-8">
			      			<input type="text" name="location" class="form-control" id="location" placeholder="Location">
			    		</div>
			  	</div>
				<form class="form-horizontal">
					<div class="form-group">
			    		<label for="area_in_acres" class="col-sm-4 control-label">Area in acres:</label>
			    		<div class="col-sm-8">
			      			<input type="text" name="area_in_acres" class="form-control" id="area_in_acres" placeholder="Area in acres">
			    		</div>
			  	</div>
				<form class="form-horizontal">
					<div class="form-group">
			    		<label for="date_established" class="col-sm-4 control-label">Date Established:</label>
			    		<div class="col-sm-8">
			      			<input type="text" name="date_established" class="form-control" id="date_established" placeholder="Date Established">
			    		</div>
			  	</div>
				<form class="form-horizontal">
					<div class="form-group">
			    		<label for="description" class="col-sm-4 control-label">Description:</label>
			    		<div class="col-sm-8">
			      			<input type="text" name="description" class="form-control" id="description" placeholder="Description">
			    		</div>
			  	</div>
			  	<button class="btn btn-default" type="submit">Add Park</button>
				</form>
			</section>
			<section class="col-md-6">
				<table class="table table-striped">
					<tr>
						<th>Park Name: </th>
						<th>Location: </th>
						<th>Area in Acres: </th>
						<th>Date Established: </th>
					</tr>
					<?php foreach($parks as $park): ?>
						<tr>
							<td>
                                <a href="park.php?id=<?= $park['id'] ?>">
                                    <?= $park['name'] ?>
                                </a>
                            </td>
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
	
