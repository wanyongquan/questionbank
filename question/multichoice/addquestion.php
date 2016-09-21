<?php
    session_start();
    require_once '../../config.php';

    // get the form data submited by POST
    if (isset($_POST['qtype']) && isset($_POST['question_body'])){
        $qtype= $_POST['qtype'];
        $question_body= $_POST['question_body'];
        $difficultyLevel_id = $_POST['difficultyLevel_id'];
        $question_mark = $_POST['question_mark'];
        $user_id = $_SESSION['userid'];

        
            // start the transaction
            $DB->autocommit(false);
            
            // step1: insert question to table tk_questions and tk_questionmultichoise
            $now = date("Y-M-d H:i:s"); // Month, day, year, hour, minute,second 
            $query = "insert into tk_questions (question_body, point, difficultylevel_id, qtype, createdDate, createdBy)
                            values('$question_body',$question_mark , $difficultyLevel_id , '$qtype', '$now', $user_id);";
            $result = mysqli_query($DB, $query) or die(exit(mysqli_error($DB)));
            $question_id =  $DB->insert_id;
            
            // step2: insert question answer options info into tk_question_answers;
            $stmt = $DB->prepare(" insert into tk_question_answers(question_id, answer, iscorrectanswer) 
                    values( ?, ?,?)");
            $stmt->bind_param("iss", $question_id, $answer_option, $option_is_true_answer);
            // option1 
            $answer_option = $_POST['question_answer_option1'];
            $option_is_true_answer = isset($_POST['check_option1'])?true:false;
            $stmt->execute();
            
            // option2 
            $answer_option = $_POST['question_answer_option2'];
            $option_is_true_answer = isset($_POST['check_option2']) ? true : false;
            $stmt->execute();
            
            // option3
            $answer_option = $_POST['question_answer_option3'];
            $option_is_true_answer = isset($_POST['check_option3'])?true:false;
            $stmt->execute();
            
            // option4
            $answer_option = $_POST['question_answer_option4'];
            $option_is_true_answer = isset($_POST['check_option4'])?true:false;
            $stmt->execute();
            
            echo '1 question added';
            header("location:../question.php");
            
            $stmt->close();
            $DB->commit();
        
    }