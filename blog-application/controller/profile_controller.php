<?php

include_once "../model/profile.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../view/login.php");
    exit;
}

$profile = new user();

//update profile into database
if(isset($_FILES['profile_pic'])){
    $user_id = $_SESSION['user_id'];
    $fileName = $_FILES['profile_pic']['name'];
    $tmpName = $_FILES['profile_pic']['tmp_name'];
    $fileSize = $_FILES['profile_pic']['size'];
    $folder = "../upload/";
      //img size check 
    $maxSize = 2 * 1024 * 1024; 
    if($fileSize > $maxSize){
    echo "File is too large. Maximum 2MB allowed.";
    exit;
    }
    
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = "user_".$user_id.".".$ext;

    if(move_uploaded_file($tmpName, $folder.$newFileName)){
        $profile->profilePic($user_id, $newFileName);
        header("Location: ../view/profile.php");
        exit;
    }

}

//Fetch  profile pic from database to display on profile page
$profilePic = $profile->getProfilePic($_SESSION['user_id']);


//total number of posts by this user
$postCount = $profile->postCount($_SESSION['user_id']);

//fetch user post who is logged in 
$user_post = $profile->userPost($_SESSION['user_id']);

?>