<?php
    session_start();
    
    include_once '../../config.php';
    
    if (!empty($_POST ) && isset($_POST['questiontype'])){
        $questiontype = $_POST['questiontype'];
        $_SESSION['questiontype'] = $questiontype;
        
        echo "multichoice/edit.php";
        //header("location: multichoice/edit.php", true, 303);
    }
    