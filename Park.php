<?php

/**
 * A Class for interacting with the national_parks database table
 *
 * contains static methods for retrieving records from the database
 * contains an instance method for persisting a record to the database
 *
 * Usage Examples
 *
 * Retrieve a list of parks and display some values for each record
 *
 *      $parks = Park::all();
 *      foreach($parks as $park) {
 *          echo $park->id . PHP_EOL;
 *          echo $park->name . PHP_EOL;
 *          echo $park->description . PHP_EOL;
 *          echo $park->areaInAcres . PHP_EOL;
 *      }
 * 
 * Inserting a new record into the database
 *
 *      $park = new Park();
 *      $park->name = 'Acadia';
 *      $park->location = 'Maine';
 *      $park->areaInAcres = 48995.91;
 *      $park->dateEstablished = '1919-02-26';
 *
 *      $park->insert();
 *
 */
class Park
{

    ///////////////////////////////////
    // Static Methods and Properties //
    ///////////////////////////////////

    /**
     * our connection to the database
     */
    public static $connection = null;

    /**
     * establish a database connection if we do not have one
     */
    public static function dbConnect() {

        if (! is_null(self::$connection)) {
            return;
        }
        
        require __DIR__ . '/database/db-connection.php';
        self::$connection = $connection;
    }

    /**
     * returns the number of records in the database
     */
    public static function count() {
        self::dbConnect();
        $statement = self::$connection->query("SELECT count(*) from parks");
        
        $count = $statement->fetch()[0];
        return $count;
    }

    /**
     * returns all the records
     */
    public static function all() {
        self::dbConnect();

        $select = "SELECT * from parks";

        $statement = self::$connection->query($select);
        return $statement->fetchAll(PDO::FETCH_OBJ); 
    }

    /**
     * returns $resultsPerPage number of results for the given page number
     */
    public static function paginate($pageNo, $limit = 4) {
        self::dbConnect();
        
        $offset = ($pageNo - 1) * $limit;

        $select = "SELECT * from parks limit :limit offset :offset";

        $statement = self::$connection->prepare($select);

        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);

        $result = $statement->execute();

        if($result) {
            return $statement->fetchAll(PDO::FETCH_OBJ); 
        } else {
            return [];
        }

    }

    /////////////////////////////////////
    // Instance Methods and Properties //
    /////////////////////////////////////

    /**
     * properties that represent columns from the database
     */
    public $id;
    public $name;
    public $location;
    public $dateEstablished;
    public $areaInAcres;
    public $description;

    /**
     * inserts a record into the database
     */
    public function insert() {
        self::dbConnect();
        $insert = "INSERT INTO parks (name, location, area_in_acres, date_established, description) VALUES (:name, :location, :area_in_acres, :date_established, :description);";
    
        $statement = self::$connection->prepare($insert);
        $statement->bindValue(":name", $this->name, PDO::PARAM_STR);
        $statement->bindValue(":location", $this->location, PDO::PARAM_STR);
        $statement->bindValue(":area_in_acres", $this->areaInAcres, PDO::PARAM_STR);
        $statement->bindValue(":date_established", $this->dateEstablished, PDO::PARAM_STR);
        $statement->bindValue(":description", $this->description, PDO::PARAM_STR);

        $statement->execute();

        $this->attributes['id'] = self::$connection->lastInsertId();

        return $this;

    }
}
