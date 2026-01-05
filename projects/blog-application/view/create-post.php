<?php

include '../controller/post_controller.php';

//redirecct if not logged in 
if(!isset($_SESSION['user_id'])){
   header("Location: login.php");
   exit;
}


$success = $_COOKIE['success'] ?? "";
 $error = $_COOKIE['error'] ?? "";
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Create Post</title>
     <style>
          * {
               margin: 0;
               padding: 0;
               box-sizing: border-box;
               font-family: Arial, sans-serif;
          }

          body {
               background: #f4f6f9;
          }

          /* Navbar */
          .navbar {
               background: linear-gradient(120deg, #6a11cb, #2575fc);
               color: #fff;
               padding: 15px 30px;
               display: flex;
               justify-content: space-between;
               align-items: center;
          }

          .navbar a {
               text-decoration: none;
               color: #fff;
               font-weight: bold;
          }

          /* Container */
          .container {
               max-width: 700px;
               margin: 30px auto;
               background: #fff;
               padding: 30px;
               border-radius: 10px;
               box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
          }

          /* Form */
          form {
               display: flex;
               flex-direction: column;
          }

          form input[type="text"],
          form textarea {
               padding: 10px;
               margin: 10px 0;
               border-radius: 5px;
               border: 1px solid #ccc;
               outline: none;
               font-size: 14px;
          }

          form input[type="text"]:focus,
          form textarea:focus {
               border-color: #2575fc;
          }

          form textarea {
               resize: none;
               height: 150px;
          }

          form button {
               padding: 10px;
               background: #2575fc;
               color: #fff;
               border: none;
               border-radius: 5px;
               cursor: pointer;
               margin-top: 10px;
               font-size: 16px;
          }

          form button:hover {
               background: #1a5ed8;
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
     <!-- Navbar -->
     <div class="navbar">
          <div><a href="main.php">← Dashboard</a></div>
     </div>
     <!-- Container -->
     <div class="container">
          <h2>Create New Post</h2>
          <form method="POST" action="../controller/post_controller.php">
               <input type="hidden" name="create">

               <input type="text" name="title" placeholder="Post Title" required>
               <textarea name="content" placeholder="Write your post here..." required></textarea>
               <button type="submit">Publish Post</button>
               <div class="msg-box">

                    <p class="error">
                         <?= $error ?? "" ?>
                    </p>
                    <p class="success">
                         <?= $success ?? "" ?>
                    </p>
               </div>
          </form>
     </div>


</body>

</html>