<?php

include "config.php";


    $id = $_GET['id'];
    $sql = "SELECT * FROM EMPLOYEES WHERE emp_id = $id";
    $res = mysqli_query($conn ,$sql);
    $emp = mysqli_fetch_assoc($res);


   if (isset($_POST['update'])) {
    
        $editname = $_POST["name"];
        $editemail = $_POST["email"];
        $editdep = $_POST["department"];
        $editsalary = $_POST["salary"];

    

$query = "UPDATE employees 
          SET emp_name='$editname',
              emp_email='$editemail',
              emp_dep='$editdep',
              emp_salary='$editsalary'
          WHERE emp_id = $id";
     $exe = mysqli_query($conn , $query);

     if($exe){
        header("Location: index.php");
        exit;
     
    }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">

                <div class="card-header bg-warning text-dark text-center">
                    <h4>Edit Employee Information</h4>
                </div>

                <div class="card-body">
                    <form method="post" action="">
                        


                        <div class="mb-3">
                            <label class="form-label">Employee Name</label>
                            <input type="text" name="name" class="form-control" value="<?= $emp['emp_name']  ?>" placeholder="Enter employee name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"  value="<?= $emp['emp_email']  ?>" placeholder="Enter email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" class="form-control"  value="<?= $emp['emp_dep']  ?>" placeholder="e.g. IT, HR">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Salary</label>
                            <input type="number" name="salary" class="form-control"  value="<?= $emp['emp_salary']  ?>" placeholder="Enter salary">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">
                                Back
                            </a>

                            <button type="submit" name="update" class="btn btn-warning">
                                Update Employee
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
