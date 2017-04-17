<?php 

require_once "Rectangle.php";
require_once "Square.php";


$square = new Square(4);
echo $square->perimeter() . PHP_EOL;
echo $square->area() . PHP_EOL;

$rectangle = new Rectangle(9, 4);
echo $rectangle->getHeight(), PHP_EOL;
echo $rectangle->perimeter() . PHP_EOL;
echo $rectangle->area() . PHP_EOL;