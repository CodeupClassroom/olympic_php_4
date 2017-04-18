<?php  

// connect to db, present db connection as $connection variable
require __DIR__ . '/../database/db-connection.php';
require __DIR__ . '/../Input.php';
require __DIR__ . '/../Park.php';

function pageController($connection) {

	$data = [];
	
	$limit = 4;

	// Get the page number or default it to 1
	$data['page'] = Input::get('page', 1);

	// Get the total number of pages to determine the last page
	$data['lastPage'] = ceil(Park::count() / $limit);

	// set empty errors array to hold exception messages when needed
	$data['errors'] = [];

	if(!empty($_POST)) {
		$park = new Park();
		
		try {
			$park->name = Input::getString('name');
		} catch (Exception $e) {
			$data['errors']['name'] = $e->getMessage();
		}

		try {
			$park->location = Input::getString('location');
		} catch (Exception $e) {
			$data['errors']['location'] = $e->getMessage();
		}

		try {
			$park->areaInAcres = Input::getNumber("area_in_acres");
		} catch (Exception $e) {
			$data['errors']['area_in_acres'] = $e->getMessage();
		}

		try {
			$park->dateEstablished = Input::getDate('date_established');
		} catch(Exception $e) {
			$data['errors']['date_established'] = $e->getMessage();
		}

		try {
			$park->description = Input::getString("description");		
		} catch (Exception $e) {
			$data['errors']['description'] = $e->getMessage();
		}

		if(empty($data['errors'])) {
			$park->insert();
		}
	}

	$data['parks'] = Park::paginate($data['page'], $limit);

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
			      	<?php if(empty($errors['name'])): ?>
						<div class="form-group">
			    			<label for="name" class="col-sm-4 control-label">Park Name: </label>
			    			<div class="col-sm-8">
			      				<input type="text" name="name" class="form-control" id="name" placeholder="Park Name">
					      	</div>
					  	</div>
			      	<?php else: ?>
			      		<div class="form-group has-error">
			    			<label for="name" class="col-sm-4 control-label">Park Name: </label>
			    			<div class="col-sm-8">
			      				<input type="text" name="name" class="has-error form-control" id="name" placeholder="<?= $errors['name'] ?>">
					      	</div>
					  	</div>
			      			
			      	<?php endif; ?>
					
					<?php if(empty($errors['location'])): ?>
						<div class="form-group">
				    		<label for="location" class="col-sm-4 control-label">Location:</label>
				    		<div class="col-sm-8">
				      			<input type="text" name="location" class="form-control" id="location" placeholder="Location">
				    		</div>
				  		</div>
				  	<?php else: ?>
				  		<div class="form-group has-error">
				    		<label for="location" class="col-sm-4 control-label">Location:</label>
				    		<div class="col-sm-8">
				      			<input type="text" name="location" class="form-control" id="location" placeholder="<?= $errors['location'] ?>">
				    		</div>
				  		</div>
			  		<?php endif; ?>
			  		
			  		<?php if(empty($errors['area_in_acres'])): ?>
						<div class="form-group">
				    		<label for="area_in_acres" class="col-sm-4 control-label">Area in acres:</label>
				    		<div class="col-sm-8">
				      			<input type="text" name="area_in_acres" class="form-control" id="area_in_acres" placeholder="Area in acres">
				    		</div>
				  		</div>
				  	<?php else: ?>
				  		<div class="form-group has-error">
				    		<label for="area_in_acres" class="col-sm-4 control-label">Area in acres:</label>
				    		<div class="col-sm-8">
				      			<input type="text" name="area_in_acres" class="form-control" id="area_in_acres" placeholder="<?= $errors['area_in_acres'] ?>">
				    		</div>
				  		</div>
				  	<?php endif; ?>
				  	<?php if(empty($errors['date_established'])): ?>
				  		<div class="form-group">
				    		<label for="date_established" class="col-sm-4 control-label">Date Established:</label>
				    		<div class="col-sm-8">
				      			<input type="text" name="date_established" class="form-control" id="date_established" placeholder="Date Established YYYY-MM-DD">
				    		</div>
				  		</div>
				  	<?php else: ?>
						<div class="form-group has-error">
				    		<label for="date_established" class="col-sm-4 control-label">Date Established:</label>
				    		<div class="col-sm-8">
				      			<input type="text" name="date_established" class="form-control" id="date_established" placeholder="<?= $errors['date_established']?>">
				    		</div>
				  		</div>
			  		<?php endif; ?>

			  		<?php if(empty($errors['description'])): ?>
						<div class="form-group">
			    			<label for="description" class="col-sm-4 control-label">Description:</label>
			    			<div class="col-sm-8">
			      				<input type="text" name="description" class="form-control" id="description" placeholder="Description">
			    			</div>
			  			</div>
			  		<?php else: ?>
			  			<div class="form-group has-error">
			    			<label for="description" class="col-sm-4 control-label">Description:</label>
			    			<div class="col-sm-8">
			      				<input type="text" name="description" class="form-control" id="description" placeholder="<?= $errors['description'] ?>">
			    			</div>
			  			</div>
			  		<?php endif; ?>
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
                                <a href="park.php?id=<?= $park->id ?>">
                                    <?= $park->name ?>
                                </a>
                            </td>
							<td><?= $park->location ?></td>
							<td><?= $park->area_in_acres?></td>
							<td><?= $park->date_established?></td>
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
	
