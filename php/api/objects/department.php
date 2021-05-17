<?php
class Department{

//database connection and table name
    private $conn;
    private $table_name = "department_tbl";

    //object properties
    public $departmentId;
    public $departmentName;

    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read users
    function read(){

        //select all query
        $query = "SELECT
        departmentId, departmentName
        FROM
        " . $this->table_name . "";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
    
}
?>