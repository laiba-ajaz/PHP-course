<?php
include_once '../model/authentication.php';

$user = new authentication();

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
    if($_POST['password'] === $_POST['confirm_password']){
        $user->register($_POST['username'], $_POST['email'], $_POST['password']);
        header('location: ../view/login.php'); 
        exit;
    } else {
        setcookie('error', "Passwords do not match", time() + 5, '/');  
        header('location: ../view/register.php'); 
        exit;
    }
}


?>
