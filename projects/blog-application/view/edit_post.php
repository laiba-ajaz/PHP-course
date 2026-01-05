<?php
include '../controller/post_controller.php';

//redirecct if not logged in 
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])){
    echo "Invalid request.";
    exit;
}

$post_id = $_GET['id'];
$postObj = new post();
$res = $postObj->conn->query("SELECT * FROM posts WHERE post_id = $post_id");

if($res->num_rows > 0){
    $postData = $res->fetch_assoc();
    $title = $postData['title'];
    $content = $postData['content'];
} else {
    echo "Post not found!";
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-size: 14px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            margin-bottom: 18px;
            font-size: 14px;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .btns {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .save {
            background: #4CAF50;
            color: #fff;
        }

        .cancel {
            background: #e0e0e0;
        }

        .save:hover {
            background: #43a047;
        }

        .cancel:hover {
            background: #d5d5d5;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Post</h2>
        <form method="POST" action="../controller/post_controller.php">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <label>Title</label>
            <input type="text" name="title" value="<?= $title ?>" required>
            <label>Content</label>
            <textarea name="content" required><?= $content ?></textarea>
            <div class="btns">
                <button type="button" class="cancel" onclick="history.back()">Cancel</button>
                <button type="submit" name="update" class="save">Update Post</button>
            </div>
        </form>
    </div>
</body>

</html>