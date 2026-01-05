<?php

$error = $_COOKIE['error'] ?? "";
$success = $_COOKIE['success'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #fff;
            width: 380px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 18px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        input:focus {
            border-color: #4e73df;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            background: #4e73df;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        .btn:hover {
            background: #3c5edb;
        }

        .text {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .text a {
            color: #4e73df;
            text-decoration: none;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Create Account</h2>

        <form action="../controller/register_controller.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>


            <div class="form-group">
                <label> Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>


            <p class="error">
                <?= $error ?? "" ?>
            </p>
            <p class="success">
                <?= $success ?? "" ?>
            </p>

            <button class="btn" type="submit">Register</button>

            <p class="text">
                Already have an account?
                <a href="login.php">Login</a>
            </p>


        </form>
    </div>

</body>

</html>