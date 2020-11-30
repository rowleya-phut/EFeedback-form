<?php
header("Access-Control-Allow-Origin: *");
include "config.php";
//echo("PHP feedback: ");
print_r($_POST);

//print_r($_SERVER['REMOTE_ADDR']);

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
    RoomId
    ) VALUES (
    $uniqueId,
    '".$_POST["staffGroup"]."',
    '".$_POST["department"]."',
    '".$_POST["course"]."',
    '".$_POST["in_own_time"]."',
    '".$_POST["help_in_role"]."',
    '".$_POST["meet_objectives"]."',
    '".$_POST["help_department"]."',
    '".$_POST["previous_knowledge"]."',
    '".$_POST["satisfied_with_content"]."',
    '".$_POST["how_much_learned"]."',
    '".$_POST["how_much_improved"]."',
    '".$_POST["how_capable"]."',
    '".$_POST["trainer_rating"]."',
    '".$_POST["manual"]."',
    '".$_POST["other_materials"]."',
    '".$_POST["admin"]."',
    '".$_POST["environment"]."',
    '".$_POST["Free_comment"]."',
    '".$_POST["timeAccessed"]."', 
    '".$_POST["room"]."'
);";

    //NOTE FOR WRITE UP THE TIME accessed has been adding three extra digits ONLY when trying to submit 
    //to the moodle server e.g. 1583767597 (is good) versus 1583767597088 (is bad) - I only found this was
    //an issue by copying in data that failed to send from the form and going through changing them 
    //one by one to see which one was causing the failure.
    //FIX was to 
    // var timePageAccessed = Date.now();
    // var timePageAccessed = Math.floor(timePageAccessed /1000);
    //in js file

    //make a post request for each ticked check box of for trainer description and add to main query
    foreach($_POST["trainer_desc"] as $value){
        //print_r($value);
        $tr_sql = "INSERT INTO eval_quality_trainer_tbl(
            evaluationId,
            trainingRatingId
            ) VALUES (
                $uniqueId,
                $value 
            );";
        $sql = $sql.$tr_sql;
    }

    //make a post request for each ticked check box of for impact description and add to main query
    foreach($_POST["impact_desc"] as $value){
        //print_r($value);
        $tr_sql = "INSERT INTO eval_impact_trainer_tbl(
            evaluationId,
            impactId
            ) VALUES (
                $uniqueId,
                $value 
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

