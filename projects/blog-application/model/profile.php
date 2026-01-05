<?php
include_once "../config/Database.php";

class user extends database {

    
    public function profilePic($user_id, $file){
        $file = $this->conn->real_escape_string($file); 
        $user_id = (int)$user_id; 
        return $this->conn->query("UPDATE users SET profile_pic = '$file' WHERE user_id = $user_id");
    }

    
    public function getProfilePic($user_id){
        $user_id = (int)$user_id;
        $res = $this->conn->query("SELECT profile_pic FROM users WHERE user_id=$user_id");
        $row = $res->fetch_assoc();
        return $row['profile_pic'] ?? '';
    }

     
    public function postCount($user_id){
        $res = $this->conn->query("SELECT COUNT(*) AS total FROM posts WHERE user_id = $user_id");
        $row = $res->fetch_assoc();
        return $row['total'];
    }

     
       public function userPost($user_id){
       $user_id = (int)$user_id;
       $sql = "SELECT posts.post_id, posts.user_id, posts.title, posts.content, posts.created_at 
            FROM posts 
            JOIN users ON posts.user_id = users.user_id 
            WHERE posts.user_id = $user_id
            ORDER BY posts.post_id DESC";
            $res = $this->conn->query($sql);
            return $res;
}

}
?>
