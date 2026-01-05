

<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    
    header("Location: dashboard.php"); 
    
    exit(); 
}

$correctUsername = "laiba";
$correctPassword = "laiba2006";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($correctUsername === $username && $correctPassword === $password) {
      $_SESSION["name"]=$username;
      $_SESSION["login"]=true;

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #5b6df0;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-container button:hover {
            background-color: #4a57c8;
        }
         .error-message {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php echo "<div class ='error-message'> $error</div>"?>
        <form  method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>