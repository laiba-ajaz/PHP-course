<?php
include_once '../config/Database.php';

  class authentication extends database{


    //registration 
   function register($username , $email , $password){
    $hash = password_hash($password , PASSWORD_DEFAULT);
    $this->conn->query("INSERT INTO users (user_name ,user_email ,password )
    VALUES('$username','$email','$hash')");
   }
   
     //login
    function login($email , $password){
      $email = trim($email);
      $res =$this->conn->query("SELECT * FROM users WHERE user_email = '$email'"); 
      if($row = $res->fetch_assoc()){
      if(password_verify($password, $row['password'])){ 
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['user_name'];
        return true;
       }
     } 
        return false;
   } 


  } 
?>