<?php
    require_once '../../config.php';
    require_once '../../lib/datelib.php';
    // get the form data submited by POST
    $courseId = $_POST['courseid'];
    $returnurl = $_POST['returnurl'];
    if (isset($_POST['qtype']) && isset($_POST['question_body'])){
        $qtype= $_POST['qtype'];
        $courseId = $_POST['courseid'];
        $question_body= $_POST['question_body'];
       
        $subject_id = $_POST['subject_id'];
        $cognitionId = $_POST['ques_cognitionid'];
        $difficultyLevelId = $_POST['difficultyLevel_id'];
        $question_mark = $_POST['question_mark'];
        //$user_id = $_SESSION['userid'];
        $user_id = 1;

            // start the transaction
            $DB->autocommit(false);

            // step1: insert question to table tk_questions and tk_questionmultichoise
            $now = getCurrentDatetime(); // Month, day, year, hour, minute,second
            $query = "insert into tk_questions (question_body, point, ";
            $query .= " courseid, subjectid, cognitionid, ";
            $query .= " difficultylevel_id, qtype, createdDate, creatorID)";
            $query .= " values('$question_body',$question_mark ,";
            $query .= $courseId ."," . $subject_id ."," . $cognitionId . ', ';
            $query .= " $difficultyLevelId , '$qtype', '$now', $user_id);";

            $result = mysqli_query($DB, $query) or die(exit(mysqli_error($DB)));
            $question_id =  $DB->insert_id;

            // step2: insert question answer options info into tk_question_answers;
            $stmt = $DB->prepare(" insert into tk_question_answers(question_id, answer, iscorrectanswer, answerlabel)
                    values( ?, ?, ?, ?)");
            $stmt->bind_param("isss", $question_id, $answer_option, $option_is_true_answer, $answerlabel);
            // option1
            $answer_option = $_POST['optiona'];
            $option_is_true_answer = isset($_POST['is_correct_a'])?true:false;
            $answerlabel = "A";
            $stmt->execute();

            // option2
            $answer_option = $_POST['optionb'];
            $option_is_true_answer = isset($_POST['is_correct_b']) ? true : false;
            $answerlabel = "B";
            $stmt->execute();

            // option3
            $answer_option = $_POST['optionc'];
            $option_is_true_answer = isset($_POST['is_correct_c'])?true:false;
            $answerlabel = "C";
            $stmt->execute();

            // option4
            $answer_option = $_POST['optiond'];
            $option_is_true_answer = isset($_POST['is_correct_d'])?true:false;
            $answerlabel = "D";
            $stmt->execute();

            $stmt->close();
            $DB->commit();
            header("location:$returnurl", true, 303);



    }