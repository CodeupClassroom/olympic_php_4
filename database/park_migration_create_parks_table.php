<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
require __DIR__ . '/db-connection.php';

// drop table
$connection->exec("DROP TABLE IF EXISTS parks");

// create table command
$createParksTable = 'CREATE TABLE if not exists parks (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date_established DATE NOT NULL,
    area_in_acres DOUBLE NOT NULL,
    PRIMARY KEY (id)
)';

$connection->exec($createParksTable);
echo "table created" . PHP_EOL;
