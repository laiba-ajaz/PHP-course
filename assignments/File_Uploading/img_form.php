<?php
include "img_config.php";


$msg ="";
$msgType = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){

  $imgName = $_FILES['image']['name'];
  $tmpName = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];


  if($imgName != ""){
    $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

    $allowed = ['jpg','jpeg','png','gif'];

      if(!in_array($ext, $allowed)){
           
      $msg ="Your format is invalid. Only JPG, JPEG, PNG, and GIF are allowed.";
      $msgType = "alert alert-danger";
      }
      else{
        $folder = "uploads/images/";
      $filePath = $folder .$imgName;

      if(move_uploaded_file($tmpName,$folder.$imgName)){
        $query = "INSERT INTO images(img_name , img_size , img_path) VALUES ('$imgName','$imgSize','$filePath')";
        $res = mysqli_query($conn , $query);
      }
       $msg = "successfully uploaded";
      $msgType = "alert alert-success"; 
      }
  }
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Image Uploader</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
    }

    .upload-card {
      max-width: 450px;
      margin: auto;
      margin-top: 80px;
      border-radius: 15px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .message {
      font-size: 0.9rem;
      color: #6c757d;
      margin-top: 5px;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Image Uploader</a>
    </div>
  </nav>

  <div class="card upload-card p-4">
    <h4 class="text-center mb-4">Upload Your Image</h4>

    <form method="POST" enctype="multipart/form-data">

      <div class="mb-3">
        <label class="form-label">Choose Image</label>
        <input type="file" name="image" class="form-control" required>
        <div class="message">Only JPG, JPEG, PNG, and GIF images are allowed.</div>
      </div>
      <div class="mb-2">
        <?php if($msg != "") { echo '<div class="'.$msgType.' mt-2">'.$msg.'</div>'; } ?>
      </div>

      <div class="d-grid">
        <button type="submit" name="upload" class="btn btn-primary">Upload Image</button>
      </div>
    </form>
  </div>

  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header  text-center">
        <h6 class="mb-0 text-center fw-bold">Uploaded Images</h6>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered table-striped align-middle text-center mb-0">
          <thead class="table-dark">
            <tr>
              <th style="width:5%">#</th>
              <th>File Name</th>
              <th style="width:15%">Image</th>
              <th style="width:15%">File Size</th>
              <th style="width:15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
         $q = "SELECT * FROM images order by img_id DESC";
         $res = mysqli_query($conn , $q);
         $i = 1;

         if (mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_assoc($res)){
            ?>
            <tr>
              <td>
                <?=$i++?>
              </td>;
              <td>
                <?= $row["img_name"]?>
              </td>;
              <td>
                <img src="<?= $row['img_path'] ?>" alt="<?= $row['img_name'] ?>"
                  style="width:60px; height:60px; object-fit:cover; border-radius:5px;">
              </td>
              <td>
                <?= $row["img_size"]?>
              </td>;
              <td>
                <a href="delete_img.php?id=<?= $row['img_id']; ?>" class="btn btn-danger btn-sm"
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
              <td colspan="5">No files uploaded yet</td>
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