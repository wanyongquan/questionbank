<?php


print_r($_POST);

session_start();

if (!empty($_POST)){
    $username = $_POST['user'];
    $_SESSION['user'] = $username;
    echo 'user processed';
    
    header("location: form1.php");
}