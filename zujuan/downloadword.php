<?php
header("Content-type:text/html; charset=utf-8");

require_once '../config.php';
require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';
require_once 'classes/WordHelper.php';

$data = "what the fuck";
$paperId = $_REQUEST['id'];
$paperDetails = getPaperDetails($paperId);
$data = '';
$data .= '<h2 style="text-align:center">'. $paperDetails['title'] . '</h2>';
$data .= '<p>考试时间：90分钟</p>';

$paperQtypes = getPaperQtypes($paperId);
// prepare the <qtype-code, qtype-name> array;
$qtypeData = getQtypes();
$qtypeCodeNameMatch= array();
foreach($qtypeData as $vl){
    $qtypeCodeNameMatch[$vl['item_value']] = $vl['item_name'];
}
// process question types;
$qtypeOrder = 0;
foreach($paperQtypes as $vl){
    $qtypeOrder ++;
    $qtype = $vl['qtype'];
    $qtypeDisplayname = array_key_exists($qtype, $qtypeCodeNameMatch)? $qtypeCodeNameMatch[$qtype]: $qtype;
    
    $data .= '<p style="font-weight:bold">'.$qtypeOrder. '.' . $qtypeDisplayname. '('. $vl['qtypecomment']. ')</p>';
    $qtypeQuestionData = getQuestionsByPaperAndType($paperId, $vl['qtype']);
    $quesOrder = 0;
    // process questions
    foreach($qtypeQuestionData as $ques){
        $quesOrder ++;
        $questionId = $ques['questionid'];
        $questionDetail = getQuestionDetails($questionId);
        $question = mysqli_fetch_assoc($questionDetail);
        $data .= '<p>'. $quesOrder . '.' . $question['question_body'] . '</p>';
        
        // question answer options
        $quesAnswerData = getQuestionAnswers($questionId);
        $data .= '<pre>';
        foreach($quesAnswerData as $quesAnswer){
            $data .= '&#9;'. $quesAnswer['answerlabel'] . '.' .$quesAnswer['answer'] ; 
        }
        $data .= '</pre>';
    }
}

MSWord::saveAndDownload($data);