<?php
class Evaluation{

//database connection and table name
    private $conn;
    private $table_name = "evaluation_tbl";
    private $table_quality = "eval_quality_trainer_tbl";
    private $table_impact = "eval_impact_trainer_tbl";
    private $table_quality_desc = "quality_a_trainer_tbl";
    private $table_impact_desc = "impact_f_experience_tbl";
    private $staff_group = "staff_group_tbl";
    private $department_tbl = "department_tbl";
    private $course_tbl = "course_tbl";

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
        " . $this->table_name . ".staffGroupId,
        " . $this->table_name . ".departmentId,
        " . $this->table_name . ".courseId,
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
        coursetypeId,
        " . $this->staff_group . ".staffGroupName,
        " . $this->department_tbl . ".departmentName,
        " . $this->course_tbl . ".courseTitle
        FROM
        " . $this->table_name . "
        INNER JOIN
        " . $this->staff_group . "
        ON 
        " . $this->staff_group . ".staffGroupId = " . $this->table_name . ".staffGroupId
        INNER JOIN
        " . $this->department_tbl . "
        ON 
        " . $this->department_tbl . ".departmentId = " . $this->table_name . ".departmentId
        INNER JOIN
        " . $this->course_tbl . "
        ON 
        " . $this->course_tbl . ".courseId = " . $this->table_name . ".courseId
        ORDER BY
        evaluationId ASC";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }


    

    //GET QUALITY RELATED DATA
    function readQualityRelated($evalId){
        $query = "SELECT
        " . $this->table_quality . ".trainingRatingId AS quality_A,
        " . $this->table_quality . ".courseTypeId,
        " . $this->table_quality_desc . ".trainerRatingDesc,
        " . $this->table_quality_desc . ".videoDescription
        FROM  
        " . $this->table_quality . " 
        INNER JOIN
        " . $this->table_quality_desc . "
        ON
        " . $this->table_quality_desc . ".trainingRatingId =  " . $this->table_quality . ".trainingRatingId
        WHERE   
        " . $this->table_quality . ".evaluationId = $evalId 
        ";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    //GET IMPACT RELATED DATA
    function readImpactRelated($evalId){
        $query = "SELECT
        " . $this->table_impact . ".impactId AS impact_A,
        " . $this->table_impact_desc . ".impactDesc
        FROM  
        " . $this->table_impact  . "  
        INNER JOIN 
        " . $this->table_impact_desc  . "  
        ON
        " . $this->table_impact_desc . ".impactId  =  " . $this->table_impact . ".impactId 
        WHERE   
        " . $this->table_impact  . ".evaluationId = $evalId 
        ";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }


}

?>