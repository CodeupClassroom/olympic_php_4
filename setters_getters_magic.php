<?php
class Datastore
{
    // Array to store our key/value data
    private $data = [];

    // Magic setter to populate $data array
    public function __set($name, $value)
    {
        // Set the $name key to hold $value in $data
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }
}

$product = new Datastore();
$product->price = 120;
$product->description = 'DVD';
$product->department = 'Entertainment';

echo $product->price, ' ', $product->description, ' ', $product->department, PHP_EOL;

echo $product->foo, PHP_EOL;

var_dump($product);


class Model {
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value; // Variable variables
    }
}

class Student extends Model {
    protected $name;
    protected $cohort;
    protected $languages = [];
}

class User extends Model {
    protected $username;
    protected $password;

    /*public function __get($name)
    {
        if ($name === 'username') {
            return $this->username;
        } elseif ($name === 'password') {
            return '**********';
        }
    }

    public function __set($name, $value)
    {
        $this->$name = $value; // Variable variables

        /*if ($name === 'username') {
            $this->username = $value;
        } elseif ($name === 'password') {
            $this->password = $value;
        }
    }*/
}

$luis = new User();
$luis->username = 'Luis'; // $luis->__set('username', 'Luis');
echo $luis->username, PHP_EOL; // $luis->__get('username'), PHP_EOL;
$luis->password = '.ilovemyjob';
echo $luis->password;

$dwayne = new Student();
$dwayne->cohort = 'Lassen';

echo $dwayne->cohort;


