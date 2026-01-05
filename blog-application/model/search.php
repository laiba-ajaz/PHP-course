<?php
 include_once '../config/Database.php';

 class ContentSearch extends database{

    public function  search($search){
        
     $search = $this->conn->real_escape_string($search);
    $query ="SELECT  posts.post_id, posts.title, posts.content, users.user_name ,users.profile_pic FROM posts JOIN users ON posts.user_id = users.user_id WHERE posts.content LIKE '%$search%' OR users.user_name LIKE '%$search%' ";
     $res = $this->conn->query($query);
     return $res;
    }
 }
?>