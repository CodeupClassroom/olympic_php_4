<?php
require __DIR__ . '/database/db-connection.php';

$users = [
    ['email' => 'jason@codeup.com',   'name' => 'Jason Straughan'],
    ['email' => 'chris@codeup.com',   'name' => 'Chris Turner'],
    ['email' => 'michael@codeup.com', 'name' => 'Michael Girdley']
];

// You only prepare a single statement
$stmt = $connection->prepare('INSERT INTO users (email, name) VALUES (:email, :name)');

foreach ($users as $user) {
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':name',  $user['name'],  PDO::PARAM_STR);

    $stmt->execute(); // Call the statement multiple times
}

// A single named parameter in a SELECT
$select = 'SELECT * FROM users WHERE id = :id';
$statement = $connection->prepare($select);
$statement->bindValue(':id', 4, PDO::PARAM_INT);
$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);

$user['name'] = 'JSON Straughan';

// Several named parameters in an UPDATE statement
$update = 'UPDATE users SET name = :name WHERE id = :id';
$statement = $connection->prepare($update);
$statement->bindValue(':name', $user['name'], PDO::PARAM_STR);
$statement->bindValue(':id', $user['id'], PDO::PARAM_INT);
$statement->execute();
