<?php
class Person
{
    public $name;
    public $lastName;
    public $languages;

    // for php 5.x the string type hint is invalid
    public function __construct($name, $lastname)
    {
        // We'll have a lesson about this later
        /*if (!is_string($name)) {
            throw new Exception('Names should be a string');
        }*/
        $this->name = $name;
        $this->lastName = $lastname;
    }

    public function fullName()
    {
        return $this->name . ' ' . $this->lastName;
    }
}

/*$person = new Person('Zach', ['Java']); // Enforce rules when you construct an object

echo $person->name, PHP_EOL;
print_r($person->languages);*/

/*var person = {
    name: 'Jacob',
    languages: ['php', 'css', 'js']
};

var ryan = Object.create(person);
ryan.name = 'Ryan';
ryan.languages = ['php', 'js', 'clojure'];

var mario

mario.languaes = null;*/
