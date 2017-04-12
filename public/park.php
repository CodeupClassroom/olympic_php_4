<?php
require __DIR__ . '/../database/db-connection.php';


$id = (int) $_REQUEST['id'];
//$selectOnePark = 'SELECT * FROM parks WHERE id = ?';
$selectOnePark = 'SELECT * FROM parks WHERE id = :id';

$preparedStatement = $connection->prepare($selectOnePark);

// extra step
// Binding parameters

// Pass a numeric array when using ? parameters
//$preparedStatement->execute([$id]);  // It always expects an array, even with a single argument

// Pass an associative array when using named parameters
//$preparedStatement->execute([':id' => $id]);  // It always expects an array, even with a single argument

// Bind parameters one by one, calling `bindValue`
$preparedStatement->bindValue(':id', $id);

$preparedStatement->execute(); // Do not forget to execute the query

$park = $preparedStatement->fetch(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <title><?= $park['name'] ?></title>
    </head>
    <body>
        <h1><?= $park['name'] ?></h1>
        <p><?= $park['location'] ?></p>
        <p><?= $park['date_established'] ?></p>
        <p><?= $park['area_in_acres'] ?></p>
    </body>
</html>
