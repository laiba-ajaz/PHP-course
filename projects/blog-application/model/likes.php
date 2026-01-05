<?php
include_once "../config/Database.php";

class like extends database{

    public function likecheck($user_id , $post_id){
        $sql = "SELECT * FROM likes WHERE user_id = '$user_id' AND post_id = '$post_id'";
        $res= $this->conn->query($sql);
        
         if($res->num_rows > 0){
        return true;  
    } else {
        return false; 
    }
    }

    public function like($user_id , $post_id){
       $res = $this->conn->query("INSERT INTO likes (user_id , post_id) VALUES ('$user_id' , '$post_id')");
       
    }

    public function likeCount($post_id){
        $res = $this->conn->query("SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = $post_id");
        $row = $res->fetch_assoc();
        return $row['total_likes'];
    }
} 

?>