<?php
namespace core_qb;

class Question
{
    /**
     * Data Structure:
     * {
     *   quesType : string,
     *   difficultId : int,
     *   subjectId: int,
     *   questionId: int
     */
    
    private $quesType, $difficultId, $subjectId, $questionId;
    /**
     * Create a new Question instance。
     * @param string $quesType
     * @param int $difficultId
     * @param int $subjectId
     * @param int $questionId
     */
    public function __construct($quesType, $difficultId, $subjectId, $questionId){
        $this->quesType = $quesType;
        $this->difficultId = $difficultId;
        $this->subjectId = $subjectId;
        $this->questionId = $questionId;
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
}

