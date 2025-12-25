<?php

include "img_config.php";

    $id = $_GET['id'];

   $q= "DELETE FROM images WHERE img_id = '$id'";
  $res = mysqli_query($conn, $q);

   if($res){
      header("Location: img_form.php");
      exit;
   }else {
    echo "error";
   }

   


?>
