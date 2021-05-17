<?php
class StaffGroup{

//database connection and table name
    private $conn;
    private $table_name = "staff_group_tbl";

    //object properties
    public $staffGroupId;
    public $staffGroupName;

    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read users
    function read(){

        //select all query
        $query = "SELECT
        staffGroupId, staffGroupName
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