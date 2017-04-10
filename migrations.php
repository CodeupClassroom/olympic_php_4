<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
require __DIR__ . '/db-connection.php';

$createUsersTable = 'CREATE TABLE if not exists users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(240) NOT NULL,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
)';

$connection->exec($createUsersTable);

$createRolesTable = 'create table if not exists roles (
  id INT unsigned not null auto_increment,
  name varchar(80),
  primary key(id)
)';

$connection->exec($createRolesTable);







