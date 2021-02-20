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
    $items=array("VLE");
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

    $testMessage = "Thank you"

    $uniqueId = '1610964307';
    //print_r($uniqueId);
    $staffArray = array(1,2,3,4,5);
    $depArray = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16);
    $courseArray = array(1,2,3,4);
    $fourArray = array(1,2,3,4);
    $threeArray = array(1,2,3);
    $twoArray = array(1,2);
    $zeroarray = array(0,1,2,3,4);
    // $nameArray = array("Alice Alfred", "Bob Banjo", "Cara Carrot", "Dave Deacon");
    // $roleArray = array("Clerical on A4", "Clerical on B4", "Nurse on C2", "Admin on E4");

    #removed randomness for this test
    $staff = 1;
    $dep = 1;
    $course = 3;
    $attendInOwnTime = 2;
    $helpinWork = 4;
    $objectives = 4;
    $depGoals = 4;
    $preKnowledge = 2;
    $satisfied = 4;
    $howMuchLearned = 2;
    $howMuchImp = 3;
    $howCapable = 3;
    $rateTrainer = 4;
    $manual = 0;
    $otherMaterials = 4;
    $admin = 4;
    $environment = 4;
    $name = pickOneFromArray($nameArray);
    $role = pickOneFromArray($roleArray);


    $sqlNamed = "INSERT INTO evaluation_tbl(
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
        Personal_Name,
        Job_Title,
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
        1610963948,
        '$testRoom',
        '$name',
        '$role',
        '$testType'
    );";

    $sqlAnon = "INSERT INTO evaluation_tbl(
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

    $sqlArray = array($sqlAnon);

    $sql = pickOneFromArray($sqlArray);

    //trainer long description choices
    $trainerArray = array(1,4,5);

    //quality one word choices
    $impactArray = array(1,3,5,12);

    $testType == 'video'

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
