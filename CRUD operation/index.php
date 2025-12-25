<?php
include "config.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
   if(isset($_POST['name'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $depart = $_POST["department"];
    $salary = $_POST["salary"];

    $query = "INSERT INTO employees(emp_name, emp_email , emp_dep, emp_salary)VALUES ('$name','$email','$depart','$salary')";
    $res = mysqli_query($conn, $query);
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Employee Basic Information</h4>
                    </div>
                    <div class="card-body">

                        <form method="post" action="">

                            <div class="mb-3">
                                <label class="form-label">Employee Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter full name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control" placeholder="e.g. IT, HR">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Salary</label>
                                <input type="number" name="salary" class="form-control" placeholder="Enter salary">
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="save" class="btn btn-success">
                                    Save Employee
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0 text-center">Employees Record</h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
            
                $q = "SELECT * FROM EMPLOYEES";
                $result = mysqli_query($conn , $q);
                $fetchCount = mysqli_num_rows($result);
                $i = 1;

                if($fetchCount > 0){
                    while( $emp = mysqli_fetch_assoc($result)){
                        
                ?>
                        <tr>

                            <td>
                                <?= $i++ ?>
                            </td>
                            <td>
                                <?= $emp['emp_name']; ?>
                            </td>
                            <td>
                                <?= $emp['emp_email']; ?>
                            </td>
                            <td>
                                <?= $emp['emp_dep']; ?>
                            </td>
                            <td>
                                <?= $emp['emp_salary']; ?>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $emp['emp_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= $emp['emp_id']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>

                        </tr>
                        <?php
                               }  
                            }else{
                         ?>


                        <tr>
                            <td colspan="6">No records found</td>
                        </tr>
                        <?php
                };?>



                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>

</html>