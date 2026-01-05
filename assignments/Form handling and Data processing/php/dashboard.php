<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
}


$username = $_SESSION["name"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #eef2ff;
            margin: 0;
        }

        p {
            font-size: 24px;
            font-weight: bold;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background: #5b6df0;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .logout-btn:hover {
            background: #4a57c8;
        }
    </style>

</head>

<body>

    <p> Welcome,
        <?php echo $username ?>!
    </p>

    <form action="logout.php" method="post">
        <a href="logout.php?logout=true" class="logout-btn">Logout</a>

    </form>

</body>

</html>