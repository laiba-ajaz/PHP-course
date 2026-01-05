<?php
session_start();
include '../model/search.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../view/login.php");
    exit();
}


$searchTerm = $_GET['search'] ?? '';

$searchModel = new ContentSearch();
$content = $searchModel->search($searchTerm);

include '../view/search_results.php';
?>
