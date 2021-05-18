<?php
class Evaluation{

//database connection and table name
    private $conn;
    private $table_name = "evaluation_tbl";
    private $table_quality = "eval_quality_trainer_tbl";

    //object properties
    public $evaluationId;
    public $staffGroupId;
    public $departmentId;
    public $courseId;
    public $attend_in_own_time;
    public $content_A_help_in_role;
    public $content_B_meet_objectives;
    public $content_C_help_department;
    public $content_D_previous_knowledge;
    public $content_E_satisfied_with_content;
    public $learning_A_how_much_learned;
    public $learning_B_how_much_improved;
    public $learning_C_how_capable;

    public $quality_A;

    public $quality_B_trainer_rating;
    public $quality_C_manual;
    public $quality_D_other_materials;
    public $quality_E_admin;
    public $quality_F_environment;

    public $impact_A = array();

    public $free_comment;
    public $time_accessed;
    public $roomId;
    public $personal_name;
    public $job_title;
    public $coursetypeId;


    //constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read users
    function read(){

        //select all query
        $query = "SELECT
        evaluationId,
        staffGroupId,
        departmentId,
        courseId,
        attend_in_own_time,
        content_A_help_in_role,
        content_B_meet_objectives,
        content_C_help_department,
        content_D_previous_knowledge,
        content_E_satisfied_with_content,
        learning_A_how_much_learned,
        learning_B_how_much_improved,
        learning_C_how_capable,
        quality_B_trainer_rating,
        quality_C_manual,
        quality_D_other_materials,
        quality_E_admin,
        quality_F_environment,
        free_comment,
        time_accessed,
        roomId,
        personal_name,
        job_title,
        coursetypeId
        FROM
        " . $this->table_name . "
        ORDER BY
        evaluationId ASC";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    function readQuality(){
        $query = "SELECT 
        trainingRatingId,
        evaluationId
        FROM 
        " . $this->table_quality . "
        ";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    function readQualityRelated(){

        $query = "SELECT 
        " . $this->table_name . ".evaluationId,
        " . $this->table_name . ".staffGroupId,
        " . $this->table_name . ".departmentId,
        " . $this->table_quality . ".trainingRatingId AS quality_A
        FROM 
        " . $this->table_name . "
        INNER JOIN
        " . $this->table_quality. " ON " . $this->table_quality. ".evaluationId = " . $this->table_name . ".evaluationId
        ";


        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        // return $stmt;
        return $stmt;

    }

    function readQualityRelated2($evalId){
        $query = "SELECT
        " . $this->table_quality . ".trainingRatingId AS quality_A
        FROM  
        " . $this->table_quality . "    
        WHERE   
        " . $this->table_quality . ".evaluationId = $evalId 
        ";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }


}

?>