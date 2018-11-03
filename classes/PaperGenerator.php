<?php

namespace core_qb;

require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';
require_once $abs_doc_root.$qb_url_root.'/classes/Question.php';
require_once $abs_doc_root.$qb_url_root.'/classes/QuestionTypeGroup.php';
require_once 'SelectionPriority.php';
/***
 * This class represent a test paper;
 * @author wanyongquan
 *
 */
class PaperGenerator
{
    /**
     * Data Structure:
     * {
     *      paperId: string,
     *      timeDuration: string,
     *      courseId: string,
     *      difficultyId: string,
     *      question_type_groups: array{
     *        QuestionTypeGroup_obj1 : Object,
     *        QuestionTypeGroup_obj2 : Object
     *      }
     * }
     */
    
    private $paperId, $paperTitle, $timeDuration;
    private $courseId;
    private $difficultyId;
    private $requiredQuestionTypeAndNumbers;
    private $requiredSubjects;
    
    private $question_type_groups;
    
    public function __construct($_paperId= -1)
    {
        $this->paperId = $_paperId;
        $this->paperTitle = null;
        $this->courseId = null;
        $this->difficultyId = null;
        $this->timeDuration = null;
        $this->requiredQuestionTypeAndNumbers = null;
        $this->requiredSubjects = null;
        $this->question_type_groups = array();
        
    }
    
    public function __get($property_name){
        if(isset($this->$property_name))
        {
            return($this->$property_name);
        }else
        {
            return(NULL);
        }
    }
    
    //__set()方法用来设置私有属性
    function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }
    
    public function setRequiredQuestionTypeAndNumbers($_requiredQuestionTypeAndNumbers){
        $this->requiredQuestionTypeAndNumbers = $_requiredQuestionTypeAndNumbers;
        
        // initialize the question type group array;
        if (isset($this->requiredQuestionTypeAndNumbers)){
            foreach($this->requiredQuestionTypeAndNumbers as $vl)
            {
                $quesType = $vl['qtype'];
                $requiredNumber = $vl['needCount'];
                $question_type_group = new QuestionTypeGroup($quesType, $requiredNumber);
                $this->question_type_groups[] = $question_type_group;
            }
        }
    }
    
    public function setRequiredSubjects($_subjects){
        $this->requiredSubjects = $_subjects;
    }
    
    public function AutoPickQuestions()
    {
        // Phase 1: go through the required question type and subject, try to find a question for each question type and subject;
        foreach($this->requiredQuestionTypeAndNumbers as $vl)
        {
            $quesType = $vl['qtype'];
            $number = $vl['needCount'];
            
            //get all available questions which subjectid is in the required subject list;
            $candidateQuestions = get_questions($this->courseId, $this->difficultyId, $quesType, $this->requiredSubjects);
            
            foreach($candidateQuestions as $vl)
            {
                $candidateQuestionIdArr[] = $vl['question_id'];
            }
            // get random question ids out of candidate array;
            $rand_questionIds  = array_random($candidateQuestionIdArr, $number);
            
            // reset the mysqli_result point ;
            \mysqli_data_seek($candidateQuestions, 0);
             while($row = mysqli_fetch_assoc($candidateQuestions))
            {
                $temp_questionId = $row['question_id'];
                // pick the question if it's id in random picked array;
                if (\in_array($temp_questionId, $rand_questionIds))
                {
                    $quesType = $row['qtype'];
                    $difficultyId = $row['difficultylevel_id'];
                    $courseId = $row['courseid'];
                    $subjectId = $row['subjectid'];
                    $questionId = $row['question_id'];
                    $paperItem = new Question($quesType, $difficultyId, $courseId, $subjectId, $questionId);
                    
                    $this->AddQuestion($paperItem);
                }
            }
            
        }
    }
    
    /**
     * Add a question to paper generator
     * @param Question $_paperItem
     */
    public function AddQuestion(Question $_paperItem)
    {
        // 0. set the course id if the first question is been added.
        if (!isset($this->courseId)){
            $this->courseId = $_paperItem->courseId;
            
        }
        // 1. check if the question type exists in paper;
        if (! $this->contains_question_type($_paperItem->quesType)){
            // create the question group and add to paper;
            $questionGroup = new QuestionTypeGroup($_paperItem->quesType);
            
            $this->question_type_groups[] = $questionGroup;
        }
        
        // step 2: add question to question type group;
        foreach($this->question_type_groups as $vl)
        {
            if($vl->quesType == $_paperItem->quesType)
            {
                // add the question to question_type_group;
                $vl->add_question($_paperItem);
            }
        }
//         // step 2: record this subject in working list;
//         if (!in_array($_paperItem->subjectId, $this->workingSubjects ))
//         {
//             $this->workingSubjects[] = $_paperItem->subjectId;
//         }
//         // step 3: record this question type in working list;
//         if (!\array_key_exists($_paperItem->questionType, $this->workingPaperTypeAndNumbers))
//         {
//             $this->workingPaperTypeAndNumbers[$_paperItem->questionType] = 1;
//         }
//         else{
//             $this->workingPaperTypeAndNumbers[$_paperItem->questionType] += 1;
        
//         }
    }
    
    public function add_question_by_id($questionId){
        $query_result = \getQuestionDetails($questionId);
        $questionDetail = mysqli_fetch_assoc($query_result);
        
        $quesType = $questionDetail['qtype'];
        $difficultyId = $questionDetail['difficultylevel_id'];
        $courseId = $questionDetail['courseid'];
        $subjectId = $questionDetail['subjectid'];
        
        $question = new Question($quesType, $difficultyId, $courseId, $subjectId, $questionId);
        
        $this->AddQuestion($question);
    }
    
    public function remove_question_by_id($questionId){
        if (isset($questionId))
        {
            return false;
        }
        
        foreach($this->question_type_groups as $questionTypeGroup ){
            
            // traverse the question type group
            if ($questionTypeGroup->question_exists($questionId)){
                // remove the question if find one match the questionid;
                $questionTypeGroup->remove_question($questionId);
                break;
            }
        }
                
    }
    
    public function getQuestionCount(){
        $totalCount = 0;
        foreach($this->question_type_groups as $qtypeGroup){
            $totalCount += $qtypeGroup->getQuestionCount();
            
        }
        return $totalCount;
    }

    public function getQuestionIdList(){
        $questionIdArr = array();
        foreach($this->question_type_groups as $type_group){
            foreach($type_group->questionArr as $question){
                $questionIdArr[] = $question->questionId;
            }
        }
        return $questionIdArr;
    }
    
    public function moveQuestionUp($questionId){
        // todo: [2018-10-30] to be implemented;
    }
    
    public function moveQuestionDown($questionId){
        // todo: [2018-10-30] to be implemented;
    }
    
    public function moveQuestionGroupUp(){
        // todo: [2018-10-30] to be implemented;
    }
    
    public function moveQuestionGroupDown(){
        // todo: [2018-10-30] to be implemented;
    }
    
    public function question_exists($questionId){
        foreach($this->question_type_groups as $qtypeGroup){
            if ($qtypeGroup->questionId_exists($questionId))
                return true;
        }
        return false;
    }
    
    public function contains_question_type($question_type){
        $findType= false;
        foreach($this->question_type_groups as $qtypeGroup){
            if ($qtypeGroup->quesType == $question_type){
                $findType = true;
                break;
            }
        }
        return $findType;
    }
    
    public function __isset($property){
        return isset($this->$property);
    }
    

//     /**
//      * Return an array of question types for questions in the working list;
//      */
//     public function get_question_types()
//     {
//         $questionTypes = array();
//         foreach($this->paperItemList as $item)
//         {
//             if(!\in_array($item->quesType, $questionTypes))
//             {
//                 $questionTypes[] = $item->quesType;
//             }
//         }
//         return $questionTypes;
//     }

//     /**
//      * Return an array of PaperItem for a specified question type;
//      * @param string $quesType
//      * @return $paperItem[]
//      */
//     public function get_question_of_type($quesType)
//     {
//         $result = array();
//         foreach($this->paperItemList as $item)
//         {
//             if ($item->quesType == $quesType)
//             {
//                 $result[] = $item;
//             }
//         }
//         return $result;
//     }

  
}



