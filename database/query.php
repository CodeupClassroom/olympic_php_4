<?php

require __DIR__ . "/db-connection.php";

// select all from parks
$select = "SELECT * FROM parks";

$statement = $connection->query($select);

$parks = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>National Parks</h1>

	<table>
		<tr>
			<th>Name</th>
			<th>Location</th>
			<th>Date Established</th>
			<th>Area in Acres</th>
		</tr>
		<?php foreach($parks as $park): ?>
			<tr>
				<td><?= $park['name'] ?></td>
				<td>...</td>
				<td>...</td>
				<td>...</td>
			</tr>
		<?php endforeach; ?>	
	</table>

</body>
</html>