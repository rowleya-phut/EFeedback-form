<?php
class Course{

//database connection and table name
    private $conn;
    private $table_name = "course_tbl";

    //object properties
    public $courseId;
    public $courseTitle;

    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read users
    function read(){

        //select all query
        $query = "SELECT
        courseId, courseTitle
        FROM
        " . $this->table_name . "
        ORDER BY
        username ASC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
}
?>