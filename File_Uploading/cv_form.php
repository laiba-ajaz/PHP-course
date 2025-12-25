<?php
include "config.php";

$msg ="";
$msgType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){

  $fileName = $_FILES['pdf']['name'];
  $tmp_name =$_FILES['pdf']['tmp_name'];
  $fileSize = $_FILES['pdf']['size'];
  $fileSize = round($fileSize / 1024, 2) . " KB";



  if($fileName != ""){
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

     
    if($ext != "pdf"){
      $msg =" your format is invalid, only <i> <b>pdf</b></i> format is allowed. ";
      $msgType = "alert alert-danger";
    }else{
      
      $folder = "uploads/cv/";
      $filePath = $folder .$fileName;

      if(move_uploaded_file($tmp_name,$folder.$fileName)){
        $query = "INSERT INTO cv_files(file_name , file_size , file_path) VALUES ('$fileName','$fileSize','$filePath')";
        $res = mysqli_query($conn , $query);
      }
       $msg = "successfully uploaded";
      $msgType = "alert alert-success"; 
    }
  }
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PDF Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="text-center">
  <h2 class="mt-4 mb-4 fw-bold fst-italic text-primary border-bottom border-dark pb-2 d-inline-block"> CV Uploader </h2>
</div>

   
    <div class="container mt-5">
        <div class="card p-4">
            <h5 class="mb-3">Upload PDF</h5>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- File Input -->
                <div class="mb-2">
                    <input class="form-control" type="file" id="pdfFile" name="pdf">
                    <?php if($msg != "") { echo '<div class="'.$msgType.' mt-2">'.$msg.'</div>'; } ?>
                </div>


                <!-- Helper Text -->
                <small class="text-muted">
                    Only PDF files are allowed.
                </small>


                <!-- Upload Button -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" name="upload">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="container mt-5">


        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0 text-center fw-bolder">Uploaded PDF Files</h6>
            </div>

            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>File Name</th>
                            <th style="width: 15%;">File Size</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>

                   <tbody>
<?php
$q = "SELECT * FROM cv_files ORDER BY id DESC";
$result = mysqli_query($conn, $q);
$i = 1;

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>
    <tr>
        <td><?= $i++; ?></td>
        <td><?= $row['file_name']; ?></td>
        <td><?= $row['file_size']; ?></td>
        <td>
            <a href="delete_cv.php?id=<?= $row['id']; ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confdlt()">
                Delete
            </a>
        </td>
    </tr>
<?php
    }
}else{
?>
    <tr>
        <td colspan="4">No files uploaded yet</td>
    </tr>
<?php } ?>
</tbody>



                </table>
            </div>
        </div>
    </div>
    <script>
        function confdlt() {
            return confirm("Are you sure you want to delete this file record!?");
        }
    </script>
</body>

</html>