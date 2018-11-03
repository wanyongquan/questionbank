<?php 

/*
 *******************************************************************************
 ** WanXin Test Paper Generator System                                        **
 **---------------------------------------------------------------------------**
 ** Developer: Wan Yongquan                                                   **
 ** Title: Generator route page                                               **
 ** Function:  Accept  client request and call the responsed method;          **
 *******************************************************************************
 */
   

error_reporting ( 1 );
?>

<?php require_once '../../config.php'; ?>
<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';?>
<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/helper.php';?>
<?php require_once '../classes/PaperHelper.php'; ?>
<?php require_once '../../lib/datelib.php'; ?>
<?php
/**
 * Performs zujuan management ajax actions.
 * 
 * @package core_zujuan
 */

$action = $_REQUEST['action'];

global $DB, $user;

switch( $action){
    case 'getsubjectofcourse':
        // return the UI ' option ' elements for subjects select tag.
        $courseid = $_REQUEST['courseId'];
        echo \core_paper\PaperHelper::getCourseSubjects($courseid);
        break;
    case 'addquestiontocart':
        
        $questionid = $_REQUEST['questionid'];
        // put question information in session
        $paper_generator = try_get_paper_generator();
        if ($paper_generator != null){
            if (!$paper_generator->question_exists($questionid)){
                // add the question to paper if it is not in the paper;
                $paper_generator->add_question_by_id($questionid); // a question object need here
                //todo: courseid is not set in papergenerator object;
                $responseArr['btn'] = 'remove';
                $responseArr['btn_text'] = get_string('removecart');
               
            }
            else{
                // remove the question from paper if the quesitonid is already in paper;
                $paper_generator->remove_question_by_id($questionid);
                
                $responseArr['btn']='add';
                $responseArr['btn_text'] = get_string('addcart');
            }
            
        }
        
        //update cart in session
        $_SESSION['paper_generator'] = serialize( $paper_generator);
        echo json_encode($responseArr, JSON_UNESCAPED_UNICODE);
        break;
    case 'updatecartinfo':
        // get count of question which is in paper_generator;
        $paper_generator = try_get_paper_generator();
        echo $paper_generator->getQuestionCount();
        break;
    case 'updatecartbrief':
        $paper_generator = try_get_paper_generator();
            $courseId = $paper_generator->courseId;
            $qtypeArr= $paper_generator->question_type_groups;
            
            $html = ''; 
            //[2018-10-30 refactored]
            foreach($qtypeArr as $qtypeGroup){
                $qtypeDisplayStr = getQuesTypeDisplayStr($qtypeGroup->quesType);
                $html .= '<li><a><span>';
                $html .= ' <span>' . $qtypeDisplayStr . ':</span>';
                $html .= ' <span>' .$qtypeGroup->getQuestionCount() .'</span>';
                $html .= '</span></a> </li>';    
            } // end of foreach 
            $html .='  <li><div class="text-center">
                        <a href="' . $qb_url_root .'/zujuan/maketestpaper.php?courseid='. $courseId  .'">' .
                          '<strong>进入组卷中心</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>';
            echo $html;
            break;
    case 'savepaper':
        global $DB, $user;
        $reponseArr = array();
        
        $data = $_POST['returnurl'];
        // [2018-10-30] refactored
        $paper_generator = try_get_paper_generator();
        
        $courseid = $paper_generator->courseId;
        $papertitle = $paper_generator->paperTitle;
        
        try {            
            // start the transaction
            $DB->autocommit(false);
            
            // step 1: insert a record in table tk_testpaper;
            $sql = sprintf("insert into tk_testpapers (title, examduration, createdtime, createdby, courseid) values('%s', %d, '%s', %d, %d)", $papertitle, 90, getCurrentDatetime(), $user->_id, $courseid);
            $result = mysqli_query($DB, $sql);
            if (!$result){
                returnError(mysqli_error($DB));
            }
            $paperid = mysqli_insert_id($DB);
            // step 2: save question type order info in table tk_testpaper_qtypes
            $sql = "insert into tk_testpaper_qtypes (paperid, qtype, qtypeorder, qtypecomment) ";
            $sql .= " values (?, ?, ?, ?) ;";
            $stmt = $DB->prepare($sql);
            $qtypeorder = 0;
            foreach($paper_generator->question_type_group as $qtypeGroup){
                $qtypeorder ++;
                $qtypecomment =  '每题1分，共10分'; // need to fix the constant issue, using text that user input;
                $stmt->bind_param("isis", $paperid, $qtypeGroup->quesType, $qtypeorder, $qtypecomment);
                $result = $stmt->execute();
                if (!$result){
                    returnError($stmt->get_warnings());
                }
                
                // save the questions under this question type;
                // step 3: save questions info in table tk_testpaper_questions
                $sql = "insert into tk_testpaper_questions (paperid, questionid, questionorder, qtype) ";
                $sql .= " values (?,?,?,?)";
                $stmt = $DB->prepare($sql);
                
                $quesorder = 0;
                foreach($qtypeGroup->questionArr as $question){
                    $quesorder ++;
                    $stmt->bind_param("iiis",$paperid, $question->questionId, $quesorder, $qtypeGroup->quesType);
                    $stmt->execute();
                }
                
                
            }
            
            
            $stmt->close();
            $DB->commit();
            // remove the question cart info from session after successfully saved to database;
            unset($_SESSION['paper_generator']);
            $reponseArr['success']=true;
            echo json_encode($reponseArr, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            if ($stmt != null){
                $stmt->close();
            }
            returnError( mysqli_error($DB));
        }
        finally {
            $DB->autocommit(true);
        }
        break;
//     case 'getallpapers':
//         global $DB, $user;
//         $paperData = getAllTestPapers();
//         $html = '';
//         foreach ($paperData as $vl){
//             $html .= '<tr>';
//             $html .= ' <td><a class="nounderline" href="">'. $vl['id'] .'</a></td>';
//             $html .= ' <td><a class="" href="">'. $vl['title'] . '</a></td>';
//             $html .= ' <td>'. $vl['examduration'] . get_string('minutes') .'</td>';
//             $html .= ' <td>'. $vl['createdtime'] . '</td>';
//             $html .= ' <td><a title="' .get_string('edit') .'" class="operationbtn" data-id="' .$vl['id'] .'" data-toggle="modal" data-target="#editpaper" data-backdrop="false"><span class="blue"><i class="fa fa-edit"></i></span></a>';
//             $html .= ' <a title="'. get_string('delete') .'" class="operationbtn" data-id="' . $vl['id'] .'" data-toggle="modal" data-target="#deletepaper" data-backdrop="false"><span class="red"><i class="fa fa-trash-o"></i></span></a>';
//             $html .= '</td>';
//             $html .= '</tr>';
//         }
//         echo $html;
//         break;
    case 'reloadpaperstable':
        echo core_paper\PaperHelper::reloadTestPapersTable();
        break;
    case 'deletepaper':
        global $DB;
        $paperid = $_REQUEST['paperid'];
        
        try{
            // start transaction;
            $DB->autocommit(false);
            
            // step 1: delete records in tk_testpaper_questions
            $querystr= "delete  from tk_testpaper_questions where paperid=" . $paperid;
            $result = mysqli_query($DB , $querystr);
            if (!$result){
                die(mysqli_get_warnings($DB));
            }
            // step 2: delete records in tk_testpaper_qtypes
            $querystr = "delete  from tk_testpaper_qtypes where paperid= ". $paperid;
            $result = mysqli_query($DB , $querystr);
            if (!$result){
                die(mysqli_error($DB));
            }
            // step 3: delete record in tk_testpapers
            $querystr = "delete  from tk_testpapers where id=" . $paperid;
            $result = mysqli_query($DB , $querystr);
            if (!$result){
                die(mysqli_error($DB));
            }
            $DB->commit();
        }catch(Exception $e){
            returnError( mysqli_error($DB));
        }finally {
            $DB->autocommit(true);
        }
        break;
    case 'movequestionup':
        $questionid = $_REQUEST['questionid'];
        
        $paper_generator = try_get_paper_generator();
        $paper_generator->moveQuestionUp($questionid);
        // put updated paper_generator back in Session;
        $_SESSION['paper_generator'] = $paper_generator;
        break;
    case 'movequestiondown':
        $questionid = $_REQUEST['questionid'];
        
        $paper_generator=$_SESSION['paper_generator'];
        $paper_generator->moveQuestionDown($questionId);
        
        //put updated paper_generator back in Session
        $_SESSION['paper_generator'] = $paper_generator;
        break;
    case 'reloadquestioncart':
        //TODO: working: change code to using paper_generator;
        
        $html = core_paper\PaperHelper::reloadQuestionCart();
        echo $html;
        break;
    case 'editpaper':
        $paperid = $_REQUEST['paperid'];
        
        break;
    case 'fetchcandidatequestion':
        $courseid = $_REQUEST['courseid'];
        $subjectid = $_REQUEST['subjectid'];
        $qtype = $_REQUEST['qtype'];
        $difficultyid = $_REQUEST['difficultyid'];
        
        $questionData = getQuestiongsBy($courseid, $subjectid, $qtype, $difficultyid);
        if (!$questionData){
            die(mysqli_error($DB));
        }
        
        echo core_paper\PaperHelper::reloadCandidateQuestions($questionData);
        
        break;
    case 'prepareforeditpaper':
        $paperId = $_REQUEST['paperid'];
        // fetch paper information and reset questioncart in session;
       
        
        core_paper\PaperHelper::prepareForEditPaper($paperId);
        $url = $qb_url_root.'/zujuan/maketestpaper.php?action=edit';
        echo $url;
        break;
    case 'clearcart':
        unset($_SESSION['paper_generator']);
        
        break;
    case 'getQtypeInCart':
        $questionCart = try_get_paper_generator();
        $qtypeArr = $questionCart->question_type_groups;
        $qtypeStatistic = array();
        
        // get the value-name pair array of qtype;
        $qtypeData = getQtypes();
        
        $qtypeValueNameMap = array();
        foreach($qtypeData as $vl){
            $qtypeValueNameMap[$vl['item_value']] = $vl['item_name'];
        }
        // calculate the subtotal of questions per qtype;
        foreach($qtypeArr as $questionTypeGroup){
            $qtypeCount = $questionTypeGroup->getQuestionCount();
            $qtypeItem['qtype']= $qtypeValueNameMap[$qtype];
            $qtypeItem['quesCount'] = $qtypeCount;
            $qtypeStatistic[]=$qtypeItem;
            
        }
        
        echo json_encode($qtypeStatistic, JSON_UNESCAPED_UNICODE);
        break;
    case 'getSubjectInCart':
        $result =  core_paper\PaperHelper::getSubjectReportInPaper();
        echo $result;
        break;
    case 'getDifficultyInCart':
        $result = core_paper\PaperHelper::getDifficultyReportInPaper();
        echo $result;
        break;
    case 'getoverallreport':
       $result = core_paper\PaperHelper::getOverallReportInPaper();
       echo $result;
        break;
    case 'getcoursesubjects':
        // return subjects array of specified course;
        global $DB;
        $courseId = $_REQUEST['courseId'];
        $subjectData = getCourseSubjects($courseId);
        $responseArr= array();
        foreach($subjectData as $vl){
            $subjectArr['id'] = $vl['subject_id'];
            $subjectArr['subjectname'] = $vl['subjectname'];
            $responseArr [] = $subjectArr;
        }
        echo json_encode($responseArr, JSON_UNESCAPED_UNICODE);
        break;
    case 'getAvailableQuestionCount':
        global $DB;
        $courseId = $_REQUEST['courseId'];
        $subjectIdArr = $_REQUEST['subjectIds'];
        $questionSubtotalData =  getQuestionSubtotal($courseId, $subjectIdArr);
        
        //$questionSubtotal = mysqli_fetch_assoc($questionSubtotalData);
        foreach($questionSubtotalData as $vl){
            $subtotalArr['qtype'] =$vl['qtype'] ;
            $subtotalArr['QC' ] = $vl['QC'];
            $responseArr[] = $subtotalArr;
        }
        echo json_encode($responseArr, JSON_UNESCAPED_UNICODE);
        break;
    case 'generatepaper':
        $courseId = $_REQUEST['courseId'];
        $difficultyId = $_POST['difficulty_option'];
        $subjectIdArr = $_POST['choosensubjects'];
        $choice_demand = $_POST['multichoice_demand'];
        $shortanswer_demand = $_POST['shortanswer_demand'];
        $requiredQuesTypeAndNumber = array();
        if ($choice_demand != null){
            $item['qtype'] = 'multichoice';
            $item['needCount'] = $choice_demand;
            $requiredQuesTypeAndNumber[] = $item;
        }
        if ($shortanswer_demand != null)
        {
            $item['qtype'] = 'shortanswer';
            $item['needCount'] = $shortanswer_demand;
            $requiredQuesTypeAndNumber[] = $item;
        }
        
        
        // TODO: automatic generate questions and put them in cart;
        core_paper\PaperHelper::generatePaper($courseId, $difficultyId, $subjectIdArr, $requiredQuesTypeAndNumber);
        //  return status and redirect to maketestpaper.php
        $responseArr = array();
        $responseArr['success'] = true;
        $responseArr['returnurl'] = $qb_url_root .'/zujuan/maketestpaper.php';
        
        echo json_encode($responseArr, JSON_UNESCAPED_UNICODE);
        break;
}