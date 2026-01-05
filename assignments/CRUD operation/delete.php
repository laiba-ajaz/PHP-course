<?php

include "config.php";

$id = $_GET["id"];
$q = "DELETE FROM EMPLOYEES WHERE emp_id = $id";
$r= mysqli_query($conn , $q);
if($r){
    header("location:index.php");
    exit;
}else{
    echo "error";
}

?>