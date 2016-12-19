<?php
    session_start();
    
    include_once '../../config.php';
    
    if (!empty($_POST ) && isset($_POST['questiontype'])){
        $questiontype = $_POST['questiontype'];
        $_SESSION['questiontype'] = $questiontype;
        
        $forwardurl = "";
        switch($questiontype){
            case "multichoice":
                $forwardurl = "multichoice/edit.php";
            case "fillblank":
                $forwardurl = "fillblank/edit.php";
        }
        echo $forwardurl;
        //header("location: multichoice/edit.php", true, 303);
    }
    