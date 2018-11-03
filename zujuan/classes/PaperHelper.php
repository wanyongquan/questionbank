<?php
// 
/**
 * Paper management helper class.
 * @package core_paper
 * @copyright 2018 Wan Yongquan
 */

namespace core_paper;


?>

<?php require_once '../../config.php'; ?>

<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';?>
<?php require_once  $abs_doc_root.$qb_url_root.'/classes/PaperGenerator.php'?>
<?php


/**
 * Papers management helper class.
 */
class PaperHelper{
    public static function getCourseSubjects($courseid){
        global $DB;
        $querystr = "select * from tk_subjects where courseid = $courseid";
        $result = mysqli_query($DB, $querystr);
        if ($result){
           
           $html = '<option value="all" selected>'.get_string('choosesubject') .'</option>';
           foreach($result as $vl){
               $html .= '<option value="' . $vl['subject_id'] . '" >' . $vl['subjectname'] . '</option>';
               
           }
        }
        echo $html;
    }
    
    public static function moveQuestionUp($cart , $questionid){
        if (!isset($questionid) || !isset($cart)){
            return false;
        }
        $questionCart = $cart;
        
        $qtypeArr = $cart['qtype_data'];
        $questionDetail = getQuestionDetails($questionid);
        $question = mysqli_fetch_assoc($questionDetail);
        $qtype = $question['qtype'];
        if (isset($qtypeArr[ $qtype])){
            $qid_arr = $qtypeArr[$qtype];
            $qid_arr =  self::array_swap_forward($qid_arr, $questionid);
            if ($qid_arr){
                $qtypeArr[$qtype] = $qid_arr;
            }
        }
        $questionCart['qtype_data'] = $qtypeArr;
        return $questionCart;
    }
    public static function moveQuestionDown($cart, $questionid){
        if (!isset($questionid) || !isset($cart)){
            return false;
        }
        $questionCart = $cart;
        
        $qtypeArr = $cart['qtype_data'];
        $questionDetail = getQuestionDetails($questionid);
        $question = mysqli_fetch_assoc($questionDetail);
        $qtype = $question['qtype'];
        if (isset($qtypeArr[ $qtype])){
            $qid_arr = $qtypeArr[$qtype];
            $qid_arr =  self::array_swap_back($qid_arr, $questionid);
            if ($qid_arr){
                $qtypeArr[$qtype] = $qid_arr;
            }
        }
        $questionCart['qtype_data'] = $qtypeArr;
        return $questionCart;
    }
    
    
    public static function array_swap_forward($arr,$elem)
    {
        $index = array_search($elem, $arr);
        if ($index == 0){
            // do nothing if the specified element is the first element in array;
            return false;
        }
        $ndx = array_search($elem,$arr) - 1;
        $before = array_slice($arr,0,$ndx);
        $mid = array_reverse(array_slice($arr,$ndx,2));
        $after = array_slice($arr,$ndx + 2);
        
        return array_merge($before,$mid,$after);
    }
    
    public static function array_swap_back($arr,$elem)
    {
        $index = array_search($elem, $arr);
        if ($index == count($arr) - 1){
            // do nothing if the speficied element is the last element in array;
            return false;
        }
        $ndx = array_search($elem,$arr);
        $before = array_slice($arr,0,$ndx);
        $mid = array_reverse(array_slice($arr,$ndx,2));
        $after = array_slice($arr,$ndx + 2);
        
        return array_merge($before,$mid,$after);
    }

    public static function reloadQuestionCart(){
       
        if (!isset($_SESSION['paper_generator']))
        {
            echo '试题篮中没有试题！';
            return false;
        }
        else{
            $paper_generator = try_get_paper_generator();
            $courseId = $paper_generator->courseId;
            $qtypeArr = $paper_generator->question_type_groups;
            
//             $courseid = $questionCart ['courseid'];
//             $qtypeArr = $questionCart ['qtype_data'];
            
            $qtypeData = getQtypes();
            // qtype order-displaytext map
            $qtypeDisplayTextArr = array();
            $html = '';
            $outindex = 0;
            $outLength = count($qtypeArr);
            //foreach ( $qtypeArr as $qtype => $qid_arr ) {           
            foreach ( $qtypeArr as $qtypeGroup) {
                $outindex ++ ;
                // disable / enable styles for move up/down buttons for question group;
                $disableclass= "btn disabled";
                $disable_outter_moveup = $outindex == 1? $disableclass : '';
                $disable_outter_movedown= $outindex == $outLength ? $disableclass : '';
                
                // find the question type display string by type value;
                foreach ( $qtypeData as $vl){    
                    if ($vl['item_value'] == $qtypeGroup->quesType){
                        $qtypeName = $vl['item_name'];
                        break;
                    }
                }
                if (empty($qtypeName)){
                    $qtypeName =  $qtypeGroup->quesType;
                }
                $html .= '<div class="x_panel">
                          <div class="x_title">
                            <h2>'.PaperHelper::getSerialNumberText($outindex) . '. ' . $qtypeName . ' </h2>
                            <ul class="nav navbar-right widget-toolbar">';
                $html .= '  <li><a class="collapse-link ' .$disable_outter_moveup . '"><i class="fa fa-arrow-up"></i>'.get_string('moveup') .'</a>  </li>';
                $html .= '  <li><a class="collapse-link '. $disable_outter_movedown . '"><i class="fa fa-arrow-down"></i>'.get_string('movedown') .'</a>  </li>';
                $html .= '  </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">';
                $innerIndex = 0;
                $innerLength = $qtypeGroup->getQuestionCount();
                // list all questions in the type group;
                foreach ( $qtypeGroup->questionArr as $vl ) {
                    $innerIndex ++;
                    $questionData = getQuestionDetails ( $vl->questionId );
                    $ques = mysqli_fetch_assoc ( $questionData );
                    $disable_inner_moveup = $innerIndex == 1 ? $disableclass: '';
                    $disable_inner_movedown = $innerIndex == $innerLength ? $disableclass : '';
                    $referedCount= \getQuestionReferedCount($vl->questionId);
                    
                    $subjectId = $ques['subjectid'];
                    $subjectNameDetail = \getSubjectName($subjectId);
                    $subjectArr = mysqli_fetch_assoc($subjectNameDetail);
                    
                    $html .= '<div class="panel panel-default">
                                <div class="panel-heading">
                                <h5 style="float:left; margin: 5px 0 6px;">难度：easy  组卷次数：'.$referedCount.' 入库时间： 2018-8-1</h5>
                                <ul class="nav navbar-right widget-toolbar" >';
                    $html .= ' <li style="float:left"><a class="collapse-link '. $disable_inner_moveup . '" data-id="' . $vl->questionId . '" onclick="movequestionup(this)"><i class="fa fa-arrow-up"></i>'.get_string('moveup') .'</a></li>';
                    
                    $html .= '  <li style="float:left"><a class="collapse-link '. $disable_inner_movedown . '" data-id="' . $vl->questionId . '" onclick="movequestiondown(this)"><i class="fa fa-arrow-down"></i>'. get_string('movedown').'</a> </li>';
                    
                    $html .= ' <li style="float:left"><a class="collapse-link" data-id="<?=$vl?>"><i class="fa fa-trash-o"></i>'. get_string('removecart').'</a></li>';
                    
                    $html .= ' </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">'.$innerIndex. '. ' . $ques ['question_body'] . '          </div>
                                <div class="panel-footer">知识点：'.$subjectArr['subjectname'] .'</div>
                              </div>';
                }
                $html .= '</div>
                        </div>';
            }
            return $html;
        }
    }

    /**
     * Show questions that match user filter on page;
     * @param array $questionArr
     * @return boolean|string
     */
    public static function reloadCandidateQuestions($questionArr){
        if(!isset($questionArr) ){
            return false;
        }
        $paper_generator = try_get_paper_generator();
        $qtypeData = \getQtypes();
        $difficultyData = \getDifficultyLevels();
        
        $html = "";
        foreach($questionArr as $vl){
            $incart = $paper_generator->question_exists( $vl['question_id']);
            $btnclass= $incart? 'remove-btn': 'add-btn';
            
            $btntext = ($incart)?get_string('removecart'): get_string('addcart');
            
            $qtypename = self::getQtypeName($qtypeData, $vl['qtype']);
            $difficultyname = self::getDifficultyName($difficultyData, $vl['difficultylevel_id']);
            $referedCount = \getQuestionReferedCount($vl['question_id']);
            
            $html .= '<div class="panel panel-default question-wrap">';
            $html .= '<div class="panel-heading">';
            $html .= '<div class="col-md-9 col-sm-9 col-xs-9 question-head-left">';
            $html .= '<span>'.get_string('difficulty').':' . $difficultyname .'</span>';
            $html .= '<span>'.get_string('questiontype'). ':'. $qtypename .'</span>';
            $html .= '<span>'.get_string('usedtimes').'：'. $referedCount.'</span>';
            $html .= '</div><div class="question-head-right col-md-3 col-sm-3 col-xs-3">';
            $html .= '<a class="pull-right '. $btnclass.'" href="#" data-id="'.$vl['question_id'] .'" onclick="addtocart(this)">';
            $html .= ''. $btntext .' </a></div><div class="clearfix"></div>';
            $html .= ' </div>';
            $html .= ' <div class="panel-body">';
            $html .= '    <div class="ques-body">'. $vl['question_body'] .'</div>';
            $html .= '    <div class="ques_answer">';
            $quesAnswer = getQuestionAnswers($vl['question_id']);
            foreach($quesAnswer as $ques){    
                 $html .= '  <div class="col-md-3 col-sm-3 col-xs-12">';
                 $html .= $ques['answerlabel'] .'<span>.</span><span>' .$ques['answer'] .'></span>';
                 $html .= '  </div>';
             } 
             $html .= ' </div>
                          </div>
                        </div>';
                
         }
         return $html;
    }
    
    public static function getQtypeName($qtypeArr, $qtype){
        if (!isset($qtypeArr) || !isset($qtype)){
            return false;
        }
        foreach($qtypeArr as $vl){
            if ($vl['item_value'] == $qtype){
                return $vl['item_name'];
            }
        }
        return false;
    }
    public static function getDifficultyName($difficultyArr, $difficultyLevelId){
        if (!isset($difficultyArr) || !isset($difficultyLevelId)){
            return false;
        }
        foreach ($difficultyArr as $vl){
            if ($vl['id'] == $difficultyLevelId){
                return $vl['item_name'];
            }
        }
        return false;
    }
    
    public static function createAndSaveAsWord($content, $filename='newdoc1.doc'){
        
    }
    
    public static function prepareForEditPaper($paperId){
        //clear the existing paper in session;
        unset($_SESSION['paper_generator']);
        
        // build a new Paper_Generator
        
        //update courseId in cart;
        $paperDetails = \getPaperDetails($paperId);
        
        $courseId= $paperDetails['courseid'];
        
        $paper_generator = new \core_qb\PaperGenerator($paperId);
        $paper_generator->courseId= $courseId;
        
        
        // update question information of paper_generator object in session
        
        $paperQuestions =  getPaperQuestions($paperId);
        
         foreach($paperQuestions as $vl){
            $questionid = $vl['questionid'];
            
            $paper_generator->add_question_id($questionId);
            

        }
        //update cart in session
        $_SESSION['paper_generator'] = $paper_generator;
    }

    public static function reloadTestPapersTable(){
        global $DB, $user;
        // table columns: ID, title, examduration, createdtime, operations
        if(isset($_REQUEST['order'])){
            $orderby = null;
            $order = $_REQUEST['order'];
            $orderdir = $order[0]['dir'];
            switch($order[0][column]){
                case 0:
                    $orderby = 'id';
                    break;
                case 1:
                    $orderby = 'title';
                    break;
            }
        }
        $paperData = \getAllTestPapersByCreatorId($user->_id);
        $responseArr = array();
        $responseArr['draw'] = $_REQUEST['draw'];
        $responseArr['recordsTotal'] = mysqli_num_rows($paperData);
        $responseArr['recordsFiltered'] = mysqli_num_rows($paperData);
        $dataArr = array();
        foreach($paperData as $vl){
            
            $rowArr = array($vl['id'], $vl['title'],$vl['coursename'], $vl['examduration'], $vl['createdtime']);
            $rowArr[] = ' <a title="' .get_string('edit') .'" class="operationbtn" data-id="' .$vl['id'] .'" onClick="beforeEditPaper(this)" ><span class="blue"><i class="fa fa-edit"></i></span></a>
                          <a title="'. get_string('delete') .'" class="operationbtn" data-id="' . $vl['id'] .'" data-toggle="modal" data-target="#delete_paper-modal" data-backdrop="true"><span class="red"><i class="fa fa-trash-o"></i></span></a>';
            $dataArr[] = $rowArr;
        }
        $responseArr['data'] = $dataArr;
        return json_encode($responseArr);
    }
    
    public static function getSerialNumberText($serialNumber){
        if (!\is_int($serialNumber)){
            return false;
        }
        switch($serialNumber){
            case 1:
                return "一";
            case 2:
                return "二";
            case 3:
                return "三";
            case 4:
                return "四";
            case 5:
                return "五";
            case 6:
                return "六";
            case 7:
                return "七";
            case 8:
                return "八";
            case 9:
                return "九";
            case 10:
                return "十";
        }
    }
    
    public static function save_paper()
    {
        $paperGenerator = try_get_paper_generator();
        
        if (isset($paperGenerator->paperId))
        {
            self::update_testpaper();
        }
        else
        {
            self::add_testpaper();
        }
    }
    public static function add_testpaper()
    {
        global $DB, $user;
        
        $courseId = $paperGenerator->courseId;
        $paperTitle = $paperGenerator->paperTitle;
        
        try{
            // set autocommit false to begin a transaction;
            $DB->autocommit(false);
            
            // step 1： insert a question into table tk_testpaper;
            $sql = sprintf("insert into tk_testpapers (title, examduration, createdtime, createdby, courseid) values('%s', %d, '%s', %d, %d)", 
                                $paperTitle, 90, getCurrentDatetime(), $user->_id, $courseId);
            $result = mysqli_query($DB, $sql);
            if (!$result){
                returnError(mysqli_error($DB));
            }
            // get the id of the new created paper;
            $paperid = mysqli_insert_id($DB);
            
            // step 2: save question type order info in table tk_testpaper_qtypes
            $sql = "insert into tk_testpaper_qtypes (paperid, qtype, qtypeorder, qtypecomment) ";
            $sql .= " values (?, ?, ?, ?) ;";
            $stmt = $DB->prepare($sql);
            $qtypeorder = 0;
            foreach($questionCart as $qtype=>$qid_arr){
                $qtypeorder ++;
                $qtypecomment =  '每题1分，共10分';
                $stmt->bind_param("isis", $paperid, $qtype, $qtypeorder, $qtypecomment);
                $result = $stmt->execute();
                if (!$result){
                    returnError($stmt->get_warnings());
                }
            }
        }
        catch(\Exception $e)
        {
            if ($stmt != null)
            {
                $stmt->close();
            }
            returnError(mysqli_error($DB));
        }
        finally 
        {
            $DB->autocommit(true);
        }
        
    }
    
    public static function update_testpaper()
    {
        
    }
    
    /**
     * @desc Automatically generate a test paper and put those question in session cart according to the conditions passed in .
     * @param int $courseId
     * @param int $difficulty
     * @param array $subjectIdArr
     * @param array $qtypeCountArr

     */
    public static function generatePaper($courseId, $difficulty, $subjectIdArr, $qtypeCountArr){
        if (empty($courseId) || empty($difficulty) || empty($subjectIdArr) || empty($qtypeCountArr)){
            return false;
        }
        // automatically pick the questions using random algrithem
        $paperGenerator = \try_get_paper_generator(); //new \core_qb\PaperGenerator();
        $paperGenerator->courseId = $courseId;
        $paperGenerator->difficultyId = $difficulty;
        $paperGenerator->setRequiredQuestionTypeAndNumbers($qtypeCountArr);
        $paperGenerator->setRequiredSubjects( $subjectIdArr);
        
        $paperGenerator->AutoPickQuestions();
        
        unset($_SESSION['paper_generator']);
        $_SESSION['paper_generator']= serialize($paperGenerator);

        return true;
    }
    
    /**
     * return report data of subject statistics;
     * @return array
     */
    public static function getSubjectReportInPaper(){
        $paper_generator = \try_get_paper_generator();
        $questionIdArr = $paper_generator->getQuestionIdList();
        
        $qidRange = '('; // array of all question ids in the cart;
        foreach($questionIdArr as $questionId){
            $qidRange .= $questionId .',';
        }
        
        if (strlen($qidRange) >1 ){
            // get rid of the last ',';
            $qidRange = rtrim($qidRange, ',');
        }
        $qidRange .= ')';
        global $DB;
        $querystr = "select subjectname, count(*) QC from tk_questions Q, tk_subjects S where Q.subjectid = S.subject_id and Q.question_id in " .$qidRange . ' group by subjectname';
        $result = mysqli_query($DB, $querystr);
        $responseArr = array();
        if (!$result ){
            die(mysqli_error($DB));
        }
        foreach($result as $vl){
            $subjectItem['subject'] = $vl['subjectname'];
            $subjectItem['QC'] = $vl['QC'];
            $responseArr[] = $subjectItem;
        }
        return  json_encode($responseArr, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * Return report data of difficulty statistics;
     * @return array
     */
    
    public static function getDifficultyReportInPaper(){
        $paper_generator = \try_get_paper_generator();
        $questionIdArr = $paper_generator->getQuestionIdList();

        $qidRange = '('; // array of all question ids in the cart;
        foreach($questionIdArr as $questionId){
            $qidRange .= $questionId .',';
        }
        
        if (strlen($qidRange) >1 ){
            // get rid of the last ',';
            $qidRange = rtrim($qidRange, ',');
        }
        $qidRange .= ')';
        
        global $DB;
        
        $querystr = "select item_name Difficulty, count(*) QC from tk_questions Q, tk_dictionary_items D  where Q.difficultylevel_id =D.id and Q.question_id in " .$qidRange . ' group by Difficulty';
        $result = mysqli_query($DB, $querystr);
        $responseArr = array();
        if (!$result ){
            die(mysqli_error($DB));
        }
        foreach($result as $vl){
            $difficultyItem['Difficulty'] = $vl['Difficulty'];
            $difficultyItem['QC'] = $vl['QC'];
            $responseArr[] = $difficultyItem;
        }
        
        return json_encode($responseArr, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * return report data of overall statistics;
     * @return string
     */
    public static function getOverallReportInPaper(){
        $paper_generator = \try_get_paper_generator();
        
//         $questionCart = $_SESSION['question_cart'];
//         $qtype_arr = $questionCart['qtype_data'];
        
        // get the value-name pair array of qtype;
        $qtypeData = getQtypes();
        $qtypeValueNameMap = array();
        foreach($qtypeData as $vl){
            $qtypeValueNameMap[$vl['item_value']] = $vl['item_name'];
        }
        
        $html = '<table class="table table-hover table-striped">';
        $html .= '<thead><tr><td>题型</td><td>知识点</td><td>试题数量</td></tr></thead>';
//         foreach($qtype_arr as $qtype=>$qid_arr){
        global $DB;
        foreach($paper_generator->question_type_groups as $typeGroup){
            $questionIdArr = $typeGroup->getQuestionIdList();
            $qidRange = '(';
            foreach($questionIdArr as $vl){
                $qidRange .= $vl. ',';
            }
            if (strlen($qidRange) > 1){
                $qidRange  = rtrim($qidRange, ','); //  get rid of the ',' at the end;
            }
            $qidRange .= ')';
            $querystr = "select  subjectname, count(*) QC from tk_questions Q , tk_subjects S where Q.subjectid= S.subject_id and Q.question_id in " . $qidRange . ' group by  subjectname';
            $result = mysqli_query($DB, $querystr);
            if ($result ){
                $rowCount = mysqli_num_rows($result);
                
                $index = 0;
                foreach($result as $vl){
                    $html .="<tr>";
                    $index ++;
                    $rowspan = '';
                    // the first column is need in one cell;
                    if ( $index ==1)
                    {
                        if ($rowCount > 1){
                            $rowspan = 'rowspan="' . $rowCount . '"';
                            
                        }
                        $html .= '<td ' . $rowspan . '>' . $qtypeValueNameMap [$typeGroup->quesType] . '</td>';
                    }
                    
                    $html .= '<td>'.$vl['subjectname'] .'</td><td>'. $vl['QC'].'</td>';
                    $html .= '</tr>';
                }
                
            }
            
            
        }
        
        return $html;
    }
}