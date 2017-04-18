<?php

class Input
{
    // getNumber throws an exception if the value at $key ain't numeric.
    public static function getNumber($key) {
        $input = self::get($key);

        if(!is_numeric($input)) {
            throw new Exception("Input for $key must be a number.");
        } else if(empty($input)) {
            throw new Exception("Input for $key cannot be empty");
        }

        return $input;
    }

    public static function getString($key) {
        $input = self::get($key);

        if(is_numeric($input) || !is_string($input)) {
            throw new Exception("Input for $key must be a string");
        } else if(empty($input)) {
            throw new Exception("Input for $key cannot be empty");
        }

        return $input;

    }

    public static function getDate($key) {
        $input = self::get($key);

        $date = DateTime::createFromFormat('Y-m-d', $input);

        if(!$date) {
            throw new Exception("$key must be in the YYYY-MM-DD format");
        }

        return $input;
        
    }

    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key)
    {
        return isset($_REQUEST[$key]);
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        // check if the $_REQUEST has a given $key set, if so, return it
        if(self::has($key)) {
            return $_REQUEST[$key];
        } else {
            return $default;
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
