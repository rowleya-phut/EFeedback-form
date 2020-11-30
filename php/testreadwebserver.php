<?php

header("Access-Control-Allow-Origin: *");

include "config.php";
// 2. Select a database to use 
$db_select = mysqli_select_db($connection, $dbName);

if (!$db_select) {
    die("Database selection failed: " . mysqli_error($connection));
}else{
  


  
}
?>