<?php
    require_once '../../config.php';

    // get the form data submited by POST
    if (isset($_POST['qtype']) && isset($_POST['question_body'])){
        $qtype= $_POST['qtype'];
        $question_body= $_POST['question_body'];
        $difficultyLevel_id = $_POST['difficultyLevel_id'];
        $question_mark = $_POST['question_mark'];
        $userid = $_SESSION['userid'];

        // insert question to table tk_questions and tk_questionmultichoise
        $query = "insert into tk_questions (question_body, point, difficultylevel_id, qtype, createdDate, createdBy)
                        values('$question_body',$question_mark , $difficultyLevel_id , '$qtype', 'date.now', $user_id);";
        $result = mysqli_query($DB, $query) or die(exit(mysqli_error($DB)));

        echo '1 question added';
        header("localtion:question/question.php");
    }