<?php
    session_start();
    require_once '../../config.php';
    require_once '../../lib/datelib.php';
    // get the form data submited by POST
    if (isset($_POST['qtype']) && isset($_POST['question_body'])){
        $qtype= $_POST['qtype'];
        $question_name = $_POST['question_name'];
        $question_body= $_POST['question_body'];
        $course_id = $_POST['qitem_course_id'];
        $subject_id = $_POST['subject_id'];
        $difficultyLevel_id = $_POST['difficultyLevel_id'];
        $question_mark = $_POST['question_mark'];
        $user_id = $_SESSION['userid'];

            // start the transaction
            $DB->autocommit(false);

            // step1: insert question to table tk_questions and tk_questionmultichoise
            $now = getCurrentDatetime(); // Month, day, year, hour, minute,second
            $query = "insert into tk_questions (question_name,question_body, point, ";
            $query .= " course_id, subject_id,";
            $query .= " difficultylevel_id, qtype, createdDate, createdBy)";
            $query .= " values('$question_name','$question_body',$question_mark ,";
            $query .= $course_id ."," . $subject_id .",";
            $query .= " $difficultyLevel_id , '$qtype', '$now', $user_id);";

            $result = mysqli_query($DB, $query) or die(exit(mysqli_error($DB)));
            $question_id =  $DB->insert_id;

            // step2: insert question answer options info into tk_question_answers;
            $stmt = $DB->prepare(" insert into tk_question_answers(question_id, answer, iscorrectanswer)
                    values( ?, ?,?)");
            $stmt->bind_param("iss", $question_id, $answer_option, $option_is_true_answer);
            // option1
            $answer_option = $_POST['qitem_answer1'];
            $option_is_true_answer = isset($_POST['check_options'][0])?true:false;
            $stmt->execute();

            // option2
            $answer_option = $_POST['qitem_answer2'];
            $option_is_true_answer = isset($_POST['check_options'][1]) ? true : false;
            $stmt->execute();

            // option3
            $answer_option = $_POST['qitem_answer3'];
            $option_is_true_answer = isset($_POST['check_options'][2])?true:false;
            $stmt->execute();

            // option4
            $answer_option = $_POST['qitem_answer4'];
            $option_is_true_answer = isset($_POST['check_options'][3])?true:false;
            $stmt->execute();

           
            header("location:../question.php", true, 303);

            $stmt->close();
            $DB->commit();

    }