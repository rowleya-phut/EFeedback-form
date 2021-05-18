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

//query products
$stmt = $evaluation->readQualityRelated();


// function getQualityData($evalId){
    
//     $quality_arr=array();
//     //retrieve our table contents
//     //fetch() is faster than fetchAll()
//     while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
//         //extract row
//         //this will make $row['name'] to
//         //just $name only
//         extract($row);
//         array_push($quality_arr, $quality_A);
//     }
//     return $quality_arr;
// }

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


        $evaluations_item=array(
            "evaluationId" => $evaluationId,
            "staffGroupId" => $staffGroupId,
        );

        //NESTED QUERY
        $evaluations_item["quality_A"]=array();
        $stmt2 = $evaluation->readQualityRelated2($evaluationId);
        $quality_arr=array();
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            array_push($evaluations_item["quality_A"], $quality_A);
        }
        //END OF NESTED QUERY

        array_push($evaluations_arr["records"], $evaluations_item);
    }
    //set response code - 200 OK
    http_response_code(200);

    //show products in json format
    echo json_encode($evaluations_arr);
    echo json_encode($quality_arr); //TODO - DELETE ONE OF THESE
} else {
    //set response code 404 not found
    http_response_code(404);

    //tell user that no users have been found
    echo json_encode(
        array("message" => "No evaluation quality data found.") 
    );
}




?>