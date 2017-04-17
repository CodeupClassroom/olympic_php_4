<?php

require_once "Person.php";
require_once "Superhero.php";

$batman = new Superhero("Bruce", "Wayne", "Batman");

echo $batman->fullName() . PHP_EOL;
echo $batman->alterEgo() . PHP_EOL;


$superman = new Superhero("Clark", "Kent", "Superman");

echo $superman->fullName() . " works with Lois Lane and she knows him as " . $superman->alterEgo() . PHP_EOL;

