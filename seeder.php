<?php
require __DIR__ . '/db-connection.php';

$insert = 'INSERT INTO roles (name) VALUES (\'admin\')';

$connection->exec($insert);


$users = [
    ['email' => 'jason@codeup.com',   'name' => 'Jason Straughan'],
    ['email' => 'chris@codeup.com',   'name' => 'Chris Turner'],
    ['email' => 'michael@codeup.com', 'name' => 'Michael Girdley']
];

foreach ($users as $user) {
    $query = "INSERT INTO users (email, name) VALUES ('{$user['email']}', '{$user['name']}')";

    $connection->exec($query);

    echo "Inserted ID: " . $connection->lastInsertId() . PHP_EOL;
}
