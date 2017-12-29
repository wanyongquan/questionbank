<?php
// This file is part of QuestionBank.
// This file provide utils for operating questions

function getQuestionInfo($questionId)
{
    GLOBAL $DB;
    $sql = "select * from tk_questions ";
    $sql.= " left join tk_subjects on tk_subjects.subject_id = tk_questions.subject_id";
    $sql.= " left join vw_difficultylevels on vw_difficultylevels.dictionary_id = tk_questions.difficultylevel_id";
    $sql.= " where tk_questions.question_id=".$questionId ;
    
    $result = mysqli_query($DB, $sql);
    return $result;
}
function getQuestionAnswers($questionId){
    global $DB;
    
    $sql = "select id, answer, iscorrectanswer from tk_question_answers ";
    $sql .= " where question_id=".$questionId;
    $result = mysqli_query($DB, $sql);
    return $result;
}

function getQuestionsByCourseId($courseId){
    global $DB;
    $sql = "select question_id, question_name,qtype,point,username as createdBy,createdDate,";
    $sql .= " subject_name, dictionary_value as difficultyLevel";
    $sql .= " from tk_questions left join tk_subjects on tk_questions.subject_id = tk_subjects.subject_id ";
    $sql .= " left join tk_users on tk_questions.createdby = tk_users.uid ";
    $sql .= " left join bs_dictionaryitems as dicts on tk_questions.difficultylevel_id = dicts.dictionary_id ";
    $sql .= " where tk_questions.course_id=".$courseId;
    $result = mysqli_query($DB, $sql);
    return $result;
}

