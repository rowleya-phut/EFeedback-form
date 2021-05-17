<?php
class Form{

//database connection and table name
    private $conn;
    private $table_name = "user_tbl";

    //object properties
    public $username;
    public $firstname;
    public $lastname;
    public $courseID;
    public $completion;

    //not include password for now

    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read users
    function read(){

        //select all query
        $query = "SELECT
        username, firstname, lastname
        FROM
        " . $this->table_name . "
        ORDER BY
        username DESC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

}

?>