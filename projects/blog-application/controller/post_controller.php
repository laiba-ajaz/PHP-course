<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once '../model/post.php';


$post = new post();


// create post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['create'])) {

    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $post->create($_SESSION['user_id'], $_POST['title'], $_POST['content']);
        setcookie("success", "Post uploaded successfully", time() + 5, '/');
        header("Location: ../view/main.php");
        exit();

    } else {
        setcookie("error", "Please fill in all required fields.", time() + 5, '/');
        header("Location: ../view/create-post.php");
        exit();
    }
}

// fetch all posts
$allpost = $post->allpost();


// delete post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $postId = $_POST['post_id'];
    $dltpost = $post->dltPost($postId);

    header("Location: ../view/main.php");
    exit();
}

// update post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $postID = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

   $updatePost = $post->update_post($postID, $title, $content);

    header("Location: ../view/main.php");
    exit();
}

?>
