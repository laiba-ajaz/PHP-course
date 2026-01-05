<?php
include_once '../config/Database.php';


class comment extends database {
    
    //insert comment 
    public function create_comment($post_id, $user_id, $comment_text) {
        $sql = "INSERT INTO comments (post_id, user_id, comment_text) VALUES ('$post_id', '$user_id', '$comment_text')";
        return $this->conn->query($sql);
    }

    //fetch comments
    public function allComment($post_id) {
        $post_id = (int)$post_id;
        $sql = "SELECT comments.*, users.user_name , users.profile_pic  FROM comments JOIN users ON comments.user_id = users.user_id  WHERE comments.post_id = '$post_id' ORDER BY comments.created_at ASC";
        $res = $this->conn->query($sql);
        return $res;
    }

    //update comments
    public function update_comment($comment_id , $comment_text){
        $user_id = $_SESSION['user_id'];
        $q = "UPDATE comments SET comment_text ='$comment_text' WHERE comment_id = '$comment_id' AND user_id ='$user_id'";
        $res = $this->conn->query($q);
        return $res;
    }
     
    //delete comments
     public function dltComment($comment_id){
        $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
        $res = $this->conn->query($query);
        return $res;

    }
}
?>