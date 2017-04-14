<?php
require_once __DIR__ . "/Person.php";

// Superhero is a Person
// Boat is a Vehicle  class Boat extends Vehicle {}
// Car is a Vehicle   class Car extends Vehicle {}
// Dog is an Animal   class Dog extends Animal {}
// Lion is an Animal  class Lion extends Animal {}

class SuperHero extends Person
{
    public $alterEgo;

    public function alterEgo()
    {
        return $this->alterEgo;
    }
}

$luis = new Person("Luis", "Montealegre");
echo $luis->fullName(), PHP_EOL;

$dareDevil = new SuperHero("Matt", "Murdock");
$dareDevil->alterEgo = "Daredevil";

echo $dareDevil->alterEgo(), PHP_EOL;