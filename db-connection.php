<?php
// mysql -u vagrant -p -- localhost / 127.0.0.1
// DSN - Data Source Name
// 1. Driver. mysql
// 2. Host. 127.0.0.1 or localhost
// 3. Database name. employees
// 4. username: vagrant
// 5. password: vagrant
require __DIR__ . '/constants.php' ; // Don't forget the forward slash at the beginning, when using __DIR__

try {

    $connection = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USER,
        DB_PASS
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Exception
    // exceptional.- Something you cannot control

    echo $e->getMessage(), PHP_EOL;
}
