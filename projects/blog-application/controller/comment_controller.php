<?php

include_once '../model/comment.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


  $comment = new comment();

  //insert comments into database logic 
if ($_SERVER['REQUEST_METHOD'] === "POST") {
     
    if (isset($_POST['add_comment']) && !empty($_POST['comment_text'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    $comment_text = $_POST['comment_text'];

    $createComment = $comment->create_comment($post_id, $user_id, $comment_text);
    header("Location: ../view/main.php");
    exit;
    }
    
}

    // Update existing comment
    if (isset($_POST['update']) && !empty($_POST['comment_text'])) {
        $comment_id = $_POST['comment_id'];
        $comment_text = $_POST['comment_text'];

        $updateComments = $comment->update_comment($comment_id, $comment_text);
        header("Location: ../view/main.php");
        exit;
    }


   //delete comment logic
    if(isset($_POST['delete_comment'])){
       $commentId = $_POST['comment_id'];

       $dltComm = $comment->dltComment($commentId);
       header("Location: ../view/main.php");
       exit;

}
?>