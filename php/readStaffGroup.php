<?php
header("Access-Control-Allow-Origin: *");
include "config.php";
  
  $queryString = "
  SELECT * FROM staff_group_tbl 
  ";

	$result = mysqli_query($connection, $queryString);
    
    //Initialize array variable
    $dbdata = array();

  //Fetch into associative array
    while ( $row = $result->fetch_assoc())  {
      $dbdata[]=$row;
    }
  
  //Print array in JSON format
   echo json_encode($dbdata);
  
?>