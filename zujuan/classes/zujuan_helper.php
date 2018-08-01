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
            $qid_arr =  array_swap_back($qid_arr, $questionid);
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

    public static function reloadQuestionCart($questionCart){
        
        if (!isset($questionCart)){            
           echo  ' you have add no question in cart';
        }else{
            $courseid = $questionCart ['courseid'];
            $qtypeArr = $questionCart ['qtype_data'];
            
            $qtypeData = getQtypes();
            // qtype order-displaytext map
            $qtypeDisplayTextArr = array();
            $html = '';
            $outindex = 0;
            $outLength = count($qtypeArr);
            foreach ( $qtypeArr as $qtype => $qid_arr ) {
                $outindex ++ ;
                $disableclass= "btn disabled";
                $disable_outter_moveup = $outindex == 1? $disableclass : '';
                $disable_outter_movedown= $outindex == $outLength ? $disableclass : '';
                
                foreach ( $qtypeData as $vl){
                    if ($vl['item_value'] == $qtype){
                        $qtypeName = $vl['item_name'];
                        break;
                    }
                }
                if (empty($qtypeName)){
                    $qtypeName =  $qtype;
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
                $innerLength = count($qid_arr);
                foreach ( $qid_arr as $vl ) {
                    $innerIndex ++;
                    $questionData = getQuestionDetails ( $vl );
                    $ques = mysqli_fetch_assoc ( $questionData );
                    $disable_inner_moveup = $innerIndex == 1 ? $disableclass: '';
                    $disable_inner_movedown = $innerIndex == $innerLength ? $disableclass : '';
                    $referedCount= \getQuestionReferedCount($vl);
                    
                    $subjectId = $ques['subjectid'];
                    $subjectNameDetail = \getSubjectName($subjectId);
                    $subjectArr = mysqli_fetch_assoc($subjectNameDetail);
                    
                    $html .= '<div class="panel panel-default">
                                <div class="panel-heading">
                                <h5 style="float:left; margin: 5px 0 6px;">难度：easy  组卷次数：'.$referedCount.' 入库时间： 2018-8-1</h5>
                                <ul class="nav navbar-right widget-toolbar" >';
                    $html .= ' <li style="float:left"><a class="collapse-link '. $disable_inner_moveup . '" data-id="' . $vl . '" onclick="movequestionup(this)"><i class="fa fa-arrow-up"></i>'.get_string('moveup') .'</a></li>';
                    
                    $html .= '  <li style="float:left"><a class="collapse-link '. $disable_inner_movedown . '" data-id="' . $vl . '" onclick="movequestiondown(this)"><i class="fa fa-arrow-down"></i>'. get_string('movedown').'</a> </li>';
                    
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

    public static function reloadCandidateQuestions($questionArr){
        if(!isset($questionArr) ){
            return false;
        }
        $questionCart = $_SESSION['question_cart'];
        $qtypeData = \getQtypes();
        $difficultyData = \getDifficultyLevels();
        
        $html = "";
        foreach($questionArr as $vl){
            $incart = cart_question_exists($vl['question_id'], $questionCart);
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
        unset($_SESSION['question_cart']);
        
        $questionCart = array();
        $questionCart['paperid'] = $paperId;
        
        //update courseId in cart;
        $paperDetails = \getPaperDetails($paperId);
        
        $courseId= $paperDetails['courseid'];
        if ( !array_key_exists('courseid', $questionCart)){
            $questionCart['courseid'] = $courseId;
        }
        
        // update question information in question_cart in session
        
        $paperQuestions =  getPaperQuestions($paperId);
        
         foreach($paperQuestions as $vl){
            $questionid = $vl['questionid'];
           
            
//             // step 1: check if this question is already in session;
//             //$questionCart = $_SESSION['question_cart'];
//             if (cart_question_exists($questionid, $questionCart)){
//                 // remove the question from cart if it exits in cart;
//                 ///$questionCart = removeArrayAt($questionCart, $questionid);
//                 $questionCart = removeQuestionFromCart($questionid, $questionCart);
//                 $responseArr['btn']='add';
//                 $responseArr['btn_text'] = get_string('addcart');
//                 $btn_text = get_string('addcart');
//             }else{
//                 ///$questionDetails = getQuestionDetails($questionid);
//                 ///$row = mysqli_fetch_assoc($questionDetails);
//                 ///$questionArr = array($questionid => array('qid'=>$questionid, 'qbody'=>$row['qbody'], 'difficulty'=>$row['difficulty_id'], 'subject'=>$row['subjectid']));
//                 ///foreach($questionArr as $key =>$value){
//                 ///    $questionCart[$key] = $value;
//                 ///}
                $questionCart = addQuestionToCart($questionid, $questionCart);
//                 $responseArr['btn'] = 'remove';
//                 $responseArr['btn_text'] = get_string('removecart');
//                 $btn_text = get_string('removecart');
//             }
        }
        //update cart in session
        $_SESSION['question_cart'] = $questionCart;
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
        $paperData = getAllTestPapers($orderby, $orderdir);
        $responseArr = array();
        $responseArr['draw'] = $_REQUEST['draw'];
        $responseArr['recordsTotal'] = mysqli_num_rows($paperData);
        $responseArr['recordsFiltered'] = mysqli_num_rows($paperData);
        $dataArr = array();
        foreach($paperData as $vl){
            
            $rowArr = array($vl['id'], $vl['title'], $vl['examduration'], $vl['createdtime']);
            $rowArr[] = ' <a title="' .get_string('edit') .'" class="operationbtn" data-id="' .$vl['id'] .'" onclick="beforeEditPaper(this)" ><span class="blue"><i class="fa fa-edit"></i></span></a>
                          <a title="'. get_string('delete') .'" class="operationbtn" data-id="' . $vl['id'] .'" data-toggle="modal" data-target="#deletepaper" data-backdrop="false"><span class="red"><i class="fa fa-trash-o"></i></span></a>';
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
}