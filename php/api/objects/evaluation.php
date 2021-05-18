<?php
class Evaluation{

//database connection and table name
    private $conn;
    private $table_name = "evaluation_tbl";
    private $table_quality = "eval_quality_trainer_tbl";

    //object properties
    public $evaluationId;
    public $trainingRatingId;


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


}

?>