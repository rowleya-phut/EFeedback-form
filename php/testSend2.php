<?php
header("Access-Control-Allow-Origin: *");
include "config.php";
//echo("PHP feedback: ");
print_r($_POST);

//print_r($_SERVER['REMOTE_ADDR']);

//generate random message to identify the test
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomString = '021220 test 1';
    return $randomString;
}
$testMessage = generateRandomString();

function pickTestRoom(){
    $items=array("E371","AlbertHall");
    return $items[array_rand($items)];
} 

$testRoom = pickTestRoom();

$uniqueId = time();
//print_r($uniqueId);

$sql = "INSERT INTO evaluation_tbl(
    evaluationId,
    StaffGroupId, 
    DepartmentId, 
    CourseId, 
    Attend_in_own_time, 
    Content_A_help_in_role, 
    Content_B_meet_objectives, 
    Content_C_help_department, 
    Content_D_previous_knowledge, 
    Content_E_satisfied_with_content, 
    Learning_A_how_much_learned, 
    Learning_B_how_much_improved, 
    Learning_C_how_capable, 
    Quality_B_trainer_rating, 
    Quality_C_manual, 
    Quality_D_other_materials, 
    Quality_E_admin, 
    Quality_F_environment, 
    Free_Comment,
    Time_accessed,
    RoomId,
    CourseType
    ) VALUES (
    $uniqueId,
    5,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    '$testMessage',
    $uniqueId,
    '$testRoom',
    'video'
);";

    $trainerArray = array(1,2,3);
    $impactArray = array(1,2,3);

    //make a post request for each ticked check box of for trainer description and add to main query
    foreach($trainerArray as $value){
        //print_r($value);
        $tr_sql = "INSERT INTO eval_quality_trainer_tbl(
            evaluationId,
            trainingRatingId,
            CourseTypeId
            ) VALUES (
                $uniqueId,
                $value,
                'video' 
            );";
        $sql = $sql.$tr_sql;
    }

    //make a post request for each ticked check box of for impact description and add to main query
    foreach($impactArray as $value){
        //print_r($value);
        $tr_sql = "INSERT INTO eval_impact_trainer_tbl(
            evaluationId,
            impactId,
            CourseTypeId
            ) VALUES (
                $uniqueId,
                $value,
                'video' 
            );";
        $sql = $sql.$tr_sql;
    }
 
print_r($sql);


$result = mysqli_multi_query($connection,$sql);

if($result){
    print_r("Success");
    //header("Location: prototypeAComplete.html");
}
else{
    print_r("Fail");
}
?>
