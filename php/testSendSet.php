<?php
header("Access-Control-Allow-Origin: *");
include "config.php";

//generate random message to identify the test
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function pickTestRoom(){
    $items=array("E371","AlbertHall","VLE");
    return $items[array_rand($items)];
} 

function pickTestType(){
    $items=array("video","trainer");
    return $items[array_rand($items)];
} 

function pickOneFromArray($items){
    return $items[array_rand($items)];
}

function pickTestArray($items){
    return $items[array_rand($items)];
} 

for( $i = 0; $i<1; $i++ ) {

    $testMessage = generateRandomString();

    $testRoom = pickTestRoom();

    $testType = pickTestType();

    $testMessage = $testMessage . " ; " . $testRoom . " ; " . $testType;

    $uniqueId = time();
    //print_r($uniqueId);
    $staffArray = array(1,2,3,4,5);
    $depArray = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
    $courseArray = array(1,2,3,4);
    $fourArray = array(1,2,3,4);
    $threeArray = array(1,2,3);
    $twoArray = array(1,2);
    $zeroarray = array(0,1,2,3,4);

    $staff = pickOneFromArray($staffArray);
    $dep = pickOneFromArray($depArray);
    $course = pickOneFromArray($courseArray);
    $attendInOwnTime = pickOneFromArray($threeArray);
    $helpinWork = pickOneFromArray($fourArray);
    $objectives = pickOneFromArray($fourArray);
    $depGoals = pickOneFromArray($fourArray);
    $preKnowledge = pickOneFromArray($twoArray);
    $satisfied = pickOneFromArray($fourArray);
    $howMuchLearned = pickOneFromArray($threeArray);
    $howMuchImp = pickOneFromArray($fourArray);
    $howCapable = pickOneFromArray($fourArray);
    $rateTrainer = pickOneFromArray($fourArray);
    $manual = pickOneFromArray($zeroarray);
    $otherMaterials = pickOneFromArray($fourArray);
    $admin = pickOneFromArray($fourArray);
    $environment = pickOneFromArray($fourArray);

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
        CourseTypeId
        ) VALUES (
        $uniqueId,
        $staff,
        $dep,
        $course,
        $attendInOwnTime,
        $helpinWork,
        $objectives,
        $depGoals,
        $preKnowledge,
        $satisfied,
        $howMuchLearned,
        $howMuchImp,
        $howCapable,
        $rateTrainer,
        $manual,
        $otherMaterials,
        $admin,
        $environment ,
        '$testMessage',
        $uniqueId,
        '$testRoom',
        '$testType'
    );";

    //test arrays
    $videoTrainer0 = array(1,4,5);
    $videoTrainer1 = array(3,7);
    $videoTrainer2 = array(1,3,5);
    $videoTrainer3 = array(8);

    $videoArray = array($videoTrainer0, $videoTrainer1, $videoTrainer2, $videoTrainer3);

    $videoArray = pickTestArray($videoArray);

    $trainerTrainer0 = array(1,2,3);
    $trainerTrainer1 = array(3,6,7);
    $trainerTrainer2 = array(4,5,6);
    $trainerTrainer3 = array(8);

    $trainerArray = array($trainerTrainer0, $trainerTrainer1, $trainerTrainer2, $trainerTrainer3);

    $trainerArray = pickTestArray($trainerArray);

    $impactArray0 = array(1,3,5,12);
    $impactArray1 = array(2,4,10,11);
    $impactArray2 = array(1,8,6);
    $impactArray3 = array(13);

    $impactArray = array($impactArray0, $impactArray1, $impactArray2, $impactArray3);

    $impactArray = pickTestArray($impactArray);

    if($testType == 'video'){
        $trainerArray = $videoArray;
    } else {
        $trainerArray = $trainerArray;
    }

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
                '$testType' 
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
                '$testType' 
            );";
        $sql = $sql.$tr_sql;
    }
 
print_r($sql);


$result = mysqli_multi_query($connection,$sql);

if($result){
    print_r("Success\r\n");
    //header("Location: prototypeAComplete.html");
}
else{
    print_r("Fail\r\n");
}

echo(" ");

}
?>
