<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/configPDO.php';
include_once '../objects/department.php';

//instantiate database and product object
$database = new Database();
$db = $database->getConnection();

//initialize object
$department = new Department($db);

//query products
$stmt = $department->read();
$num = $stmt->rowCount();

//check if more than 0 record found
if($num>0){

    //products array
    $departments_arr=array();
    $departments_arr["records"]=array();

    //retrieve our table contents
    //fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //extract row
        //this will make $row['name'] to
        //just $name only
        extract($row);

        $departments_item=array(
            "departmentId" => $departmentId,
            "departmentName" => $departmentName
        );

        array_push($departments_arr["records"], $departments_item);
    }

    //set response code - 200 OK
    http_response_code(200);

    //show products in json format
    echo json_encode($departments_arr);
} else {
    //set response code 404 not found
    http_response_code(404);

    //tell user that no users have been found
    echo json_encode(
        array("message" => "No deparments found.") 
    );
}


?>