<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT file_path FROM cv_files WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $filePath = $file['file_path'];

    
        if (file_exists($filePath)) {
            unlink($filePath); 
        }

        
        $delQuery = "DELETE FROM cv_files WHERE id='$id'";
        mysqli_query($conn, $delQuery);
    }
}


header("Location: cv_form.php");
exit;
?>
