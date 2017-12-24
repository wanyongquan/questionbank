<?php
    
    include_once '../../config.php';
    
    if (!empty($_POST ) && isset($_POST['questiontype'])){
        $questiontype = $_POST['questiontype'];
        $_SESSION['questiontype'] = $questiontype;
        $courseId = $_POST['courseid'];
        $forwardurl = "";
        switch($questiontype){
            case "multichoice":
                $forwardurl = "multichoice/edit.php";
                break;
            case "fillblank":
                $forwardurl = "fillblank/edit.php";
                break;
            case "shortanswer":
                $forwardurl ="shortanswer/edit.php?courseid=".$courseId;
                break;
            case "truefalse":
                $forwardurl ="truefalse/edit.php";
                break;
        }
        echo $forwardurl;
        //header("location: multichoice/edit.php", true, 303);
    }
    