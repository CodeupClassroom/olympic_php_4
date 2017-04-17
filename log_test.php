<?php

require_once "Log.php";

// create a new log object
$log = new Log();

$log->error('$bob is undefined');
$log->info('On a routine mission to ...');
