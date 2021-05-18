<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/configPDO.php';
include_once '../objects/evaluation.php';
include_once '../utils/convertUNIX.php';
include_once '../utils/calculateTimeTaken.php';

//instantiate database and product object
$database = new Database();
$db = $database->getConnection();

//initialize object
$evaluation = new Evaluation($db);

//query products
$stmt = $evaluation->read();

$num = $stmt->rowCount();

//check if more than 0 record found
if($num>0){

    //products array
    $evaluations_arr=array();
    $evaluations_arr["records"]=array();
    //retrieve our table contents
    //fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        //extract row
        //this will make $row['name'] to
        //just $name only
        extract($row);

        $evalId = "evaluationId";
        $readAbleDateEnd = convertUnix($evaluationId);
        $readAbleDateStart = convertUnix($time_accessed);
        $timeTaken = calcTimeTaken($time_accessed,$evaluationId );


        $evaluations_item=array(
            "evaluationId" => $evaluationId,
            "readableEndtime" => $readAbleDateEnd,
            "timeTakenInSeconds" => $timeTaken,
            "staffGroupId" =>  $staffGroupId,
            "staffGroupName" => $staffGroupName,
            "departmentId" =>  $departmentId,
            "departmentName" => $departmentName,
            "courseId" =>  $courseId,
            "courseTitle" => $courseTitle,
            "attend_in_own_time" =>  $attend_in_own_time,
            "content_A_help_in_role" =>  $content_A_help_in_role,
            "content_B_meet_objectives" =>  $content_B_meet_objectives,
            "content_C_help_department" =>  $content_C_help_department,
            "content_D_previous_knowledge" =>  $content_D_previous_knowledge,
            "content_E_satisfied_with_content" =>  $content_E_satisfied_with_content,
            "learning_A_how_much_learned" =>  $learning_A_how_much_learned,
            "learning_B_how_much_improved" =>  $learning_B_how_much_improved,
            "learning_C_how_capable" =>  $learning_C_how_capable,

            "quality_B_trainer_rating" =>  $quality_B_trainer_rating,
            "quality_C_manual" =>  $quality_C_manual,
            "quality_D_other_materials" =>  $quality_D_other_materials,
            "quality_E_admin" =>  $quality_E_admin,
            "quality_F_environment" =>  $quality_F_environment,

            "free_comment" =>  $free_comment,
            "time_accessed" =>  $time_accessed,
            "readAbleStart" => $readAbleDateStart,
            "roomId" =>  $roomId,
            "personal_name" =>  $personal_name,
            "job_title" =>  $job_title,
            "coursetypeId" =>  $coursetypeId

        );

        // NESTED QUERY
        $evaluations_item["quality_A"]=array();
        $stmt2 = $evaluation->readQualityRelated($evaluationId);
        $quality_arr=array();
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            array_push($evaluations_item["quality_A"], ["qualityId" => $quality_A, "courseTypeId" => $courseTypeId, "trainerDescription" => $trainerRatingDesc, "videoDescription" => $videoDescription]);
        }
        // END OF NESTED QUERY

        // NESTED QUERY
        $evaluations_item["impact_A"]=array();
        $stmt3 = $evaluation->readImpactRelated($evaluationId);
        $impact_arr=array();
        while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            array_push($evaluations_item["impact_A"], ["impactId" => $impact_A, "impactDescription" => $impactDesc]);
        }
        // END OF NESTED QUERY

        array_push($evaluations_arr["records"], $evaluations_item);
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
        array("message" => "No evaluation data found.") 
    );
}

?>