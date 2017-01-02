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
                break;
            case "fillblank":
                $forwardurl = "fillblank/edit.php";
                break;
            case "shortanswer":
                $forwardurl ="shortanswer/edit.php";
                break;
            case "truefalse":
                $forwardurl ="truefalse/edit.php";
                break;
        }
        echo $forwardurl;
        //header("location: multichoice/edit.php", true, 303);
    }
    