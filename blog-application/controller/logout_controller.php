<?php

include_once '../model/authentication.php';
session_start();

session_unset();
session_destroy();

header("Location: ../view/login.php");
exit;

?>