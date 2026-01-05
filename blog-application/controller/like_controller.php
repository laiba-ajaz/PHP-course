<?php
include_once "../model/likes.php";
session_start();


if(!isset($_SESSION['user_id'])){
    header("Location: ../view/login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

$like = new like();

$already_like = $like->likecheck($user_id, $post_id);

if(!$already_like){
 $like->like($user_id, $post_id);
}

header("Location: ../view/main.php");
exit;



?>
