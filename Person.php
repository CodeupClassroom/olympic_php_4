<?php

class Person {
    public $firstName;
    public $lastName;

    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function fullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}