<?php
include_once '../model/authentication.php';
session_start();



$user = new authentication();

if(!empty($_POST['email']) && !empty($_POST['password'])){
    if($user->login($_POST['email'], $_POST['password'])){
        setcookie('success', "Successfully logged in", time() + 5, '/');
        header('Location: ../view/main.php');
        exit;
    } else {
        setcookie('error', "Invalid Email or Password", time() + 5, '/');
        header('Location: ../view/login.php');
        exit;
    }
}
?>
