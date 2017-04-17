<?php

require_once "Car.php";

$car = new Car("toyota", "prius");

$car->make = "junkyard";
$car->model = "my design";

echo "The car is currently going " . $car->getSpeed() . " miles per hour" . PHP_EOL;

$car->accelerate();

echo "The car is currently going " . $car->getSpeed() . " miles per hour" . PHP_EOL;
