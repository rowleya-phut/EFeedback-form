<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/configPDO.php';
include_once '../objects/evaluation.php';

//instantiate database and product object
$database = new Database();
$db = $database->getConnection();

//initialize object
$evaluation = new Evaluation($db);
$tempEvaluationId;

//query products
$stmt = $evaluation->read();
$num = $stmt->rowCount();

//check if more than 0 record found
if($num>0){

    //products array
    $evaluations_arr=array();
    $evaluations_arr["records"]=array();
    $evaluations_arr["records"]["quality"]=array();

    //retrieve our table contents
    //fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //extract row
        //this will make $row['name'] to
        //just $name only
        extract($row);
        $tempEvaluationId = "evaluationId";
        $evaluations_item=array(
            "evaluationId" => $evaluationId,
            
            "staffGroupId" =>  $staffGroupId,
            "departmentId" =>  $departmentId,
            "courseId" =>  $courseId,
            "attend_in_own_time" =>  $attend_in_own_time,
            "content_A_help_in_role" =>  $content_A_help_in_role,
            "content_B_meet_objectives" =>  $content_B_meet_objectives,
            "content_C_help_department" =>  $content_C_help_department,
            "content_D_previous_knowledge" =>  $content_D_previous_knowledge,
            "content_E_satisfied_with_content" =>  $content_E_satisfied_with_content,
            "learning_A_how_much_learned" =>  $learning_A_how_much_learned,
            "learning_B_how_much_improved" =>  $learning_B_how_much_improved,
            "learning_C_how_capable" =>  $learning_C_how_capable,
        
            // ["barry"] => $quality_A,
        
            "quality_B_trainer_rating" =>  $quality_B_trainer_rating,
            "quality_C_manual" =>  $quality_C_manual,
            "quality_D_other_materials" =>  $quality_D_other_materials,
            "quality_E_admin" =>  $quality_E_admin,
            "quality_F_environment" =>  $quality_F_environment,
        
            // public $impact_A = array();
        
            "free_comment" =>  $free_comment,
            "time_accessed" =>  $time_accessed,
            "roomId" =>  $roomId,
            "personal_name" =>  $personal_name,
            "job_title" =>  $job_title,
            "coursetypeId" =>  $coursetypeId

        );

        array_push($evaluations_arr["records"], $evaluations_item);

        // //NESTED QUERY//
        // //query products
        // $stmtQ = $evaluation->readQuality();
        // $numQ = $stmtQ->rowCount();
        // while ($row = $stmtQ->fetch(PDO::FETCH_ASSOC)){
        //     // "jerry" => $qualityA);    
        // }
        // //
        
    }
    

    //set response code - 200 OK
    http_response_code(200);

    //show products in json format
    echo json_encode($evaluations_arr);
} else {
    //set response code 404 not found
    http_response_code(404);

    //tell user that no users have been found
    echo json_encode(
        array("message" => "No evaluations found.") 
    );
}





?>