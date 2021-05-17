<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/cmeDatabase.php';
include_once '../objects/user.php';

//instantiate database and product object
$database = new Database();
$db = $database->getConnection();

//initialize object
$user = new User($db);

//query products
$stmt = $user->read();
$num = $stmt->rowCount();

//check if more than 0 record found
if($num>0){

    //products array
    $courses_arr=array();
    $courses_arr["records"]=array();

    //retrieve our table contents
    //fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //extract row
        //this will make $row['name'] to
        //just $name only
        extract($row);

        $users_item=array(
            "courseId" => $courseId,
            "courseTitle" => $courseTitle
        );

        array_push($courses_arr["records"], $courses_item);
    }

    //set response code - 200 OK
    http_response_code(200);

    //show products in json format
    echo json_encode($courses_arr);
} else {
    //set response code 404 not found
    http_response_code(404);

    //tell user that no users have been found
    echo json_encode(
        array("message" => "No courses found.") 
    );
}


?>