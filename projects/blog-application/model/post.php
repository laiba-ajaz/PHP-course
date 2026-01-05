<?php
   include_once '../config/Database.php';
   

       class post extends database{
        
        //insert post
         public function create($user_id, $title, $content){
           $res =$this->conn->query("INSERT INTO posts(user_id, title, content)VALUES ('$user_id','$title','$content')");
        } 
        
        //fetch posts from database
         public function allpost(){
            $sql = "SELECT posts.post_id, posts.user_id, posts.title, posts.content, posts.created_at, users.user_name, users.profile_pic 
            FROM posts 
            JOIN users ON posts.user_id = users.user_id 
            ORDER BY posts.post_id DESC";
            $res = $this->conn->query($sql);
            return $res;
        }   
        
        //update posts
         public function update_post($post_id, $title, $content){
            $q = "UPDATE posts SET title = '$title', content = '$content' WHERE post_id = $post_id";
            $res = $this->conn->query($q);
            return $res;
        }
        
        //delete posts
          public function dltPost($post_id){
            $query = "DELETE FROM posts WHERE post_id = '$post_id'";
            $res = $this->conn->query($query);
            return $res;

        }
       } 
?>