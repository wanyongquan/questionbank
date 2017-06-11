<?php
session_start();

if (!empty($_POST)){
    $username = $_POST['user'];
    $SESSION['user'] = $username;
    echo 'user processed';
    
    //header("location: form2.php?qtype=".$username);
}