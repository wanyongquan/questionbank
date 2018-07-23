<?php 
    
    
    error_reporting ( 1 );
?>

<?php require_once '../../config.php'; ?>
<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';?>
<?php require_once '../classes/zujuan_helper.php'; ?>
<?php require_once '../../lib/datelib.php'; ?>
<?php
/**
 * Performs zujuan management ajax actions.
 * 
 * @package core_zujuan
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$action = $_REQUEST['action'];

global $DB, $user;

switch( $action){
    case 'getsubjectofcourse':
        $courseid = $_REQUEST['courseId'];
        echo core_paper\PaperHelper::getCourseSubjects($courseid);
        break;
    case 'addquestiontocart':
        /**
         *  the data structure of querstioncart stored in $_session: array of  <key=questiontype, value=questionidarray>
         * 
         * 
         */
        
        $questionid = $_REQUEST['questionid'];
        // put question information in session
        
        // step 1: check if this question is already in session;
        $questionCart = $_SESSION['question_cart'];
        if (cart_question_exists($questionid, $questionCart)){
            // remove the question from cart if it exits in cart;
            ///$questionCart = removeArrayAt($questionCart, $questionid);
            $questionCart = removeQuestionFromCart($questionid, $questionCart);
            $btn_text = get_string('addcart');
        }else{
            ///$questionDetails = getQuestionDetails($questionid);
            ///$row = mysqli_fetch_assoc($questionDetails);
            ///$questionArr = array($questionid => array('qid'=>$questionid, 'qbody'=>$row['qbody'], 'difficulty'=>$row['difficulty_id'], 'subject'=>$row['subjectid']));
            ///foreach($questionArr as $key =>$value){
            ///    $questionCart[$key] = $value;
            ///}
            $questionCart = addQuestionToCart($questionid, $questionCart);
            $btn_text = get_string('removecart');
        }
        //update cart in session
        $_SESSION['question_cart'] = $questionCart;
        echo $btn_text;
        break;
    case 'updatecartinfo':
        // get question cart info from session;
//         $questioncart = $_SESSION['question_cart'];
//         foreach($questioncart as $vl){
//             $qid  .= $vl['qid'];
//             //$quesarry = $vl['']
//         }
        $count = cartQuestionCount();
        echo $count;
        break;
    case 'updatecartbrief':
            $questionCart = $_SESSION['question_cart'];
            $courseId = $questionCart['courseid'];
            $qtypeArr= $questionCart['qtype_data'];
            
            $html = ''; 
            foreach($qtypeArr as $key=>$value){
                $qtypeDisplayStr = getQuesTypeDisplayStr($key);
                $html .= '<li><a><span>';
                $html .= ' <span>' . $qtypeDisplayStr . ':</span>';
                $html .= ' <span>' .count($value) .'</span>';
                $html .= '</span></a> </li>';    
            } // end of foreach 
            $html .='  <li><div class="text-center">
                        <a href="' . $qb_url_root .'/zujuan/maketestpaper.php?courseid="'. $courseId  .'">' .
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
        $questionCart = $_SESSION['question_cart'];
        $courseid = $_REQUEST['courseid'];
        $papertitle = Input::get('papertitle');
        
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
            foreach($questionCart as $qtype=>$qid_arr){
                $qtypeorder ++;
                $qtypecomment =  '每题1分，共10分';
                $stmt->bind_param("isis", $paperid, $qtype, $qtypeorder, $qtypecomment);
                $result = $stmt->execute();
                if (!$result){
                    returnError($stmt->get_warnings());
                }
            }
            
            // step 3: save questions info in table tk_testpaper_questions
            $sql = "insert into tk_testpaper_questions (paperid, questionid, questionorder, qtype) ";
            $sql .= " values (?,?,?,?)";
            $stmt = $DB->prepare($sql);
            foreach($questionCart as $qtype=>$qid_arr){
                $quesorder = 0;
                foreach($qid_arr as $vl){
                    $quesorder ++;
                    $stmt->bind_param("iiis",$paperid, $vl, $quesorder, $qtype);
                    $stmt->execute();
                }
            }
            $stmt->close();
            $DB->commit();
            // remove the question cart info from session;
            unset($_SESSION['question_cart']);
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
    case 'getallpapers':
        global $DB, $user;
        $paperData = getAllTestPapers();
        $html = '';
        foreach ($paperData as $vl){
            $html .= '<tr>';
            $html .= ' <td><a class="nounderline" href="">'. $vl['id'] .'</a></td>';
            $html .= ' <td><a class="" href="">'. $vl['title'] . '</a></td>';
            $html .= ' <td>'. $vl['examduration'] . get_string('minutes') .'</td>';
            $html .= ' <td>'. $vl['createdtime'] . '</td>';
            $html .= ' <td><a title="' .get_string('edit') .'" class="operationbtn" data-id="' .$vl['id'] .'" data-toggle="modal" data-target="#editpaper" data-backdrop="false"><span class="blue"><i class="fa fa-edit"></i></span></a>';
            $html .= ' <a title="'. get_string('delete') .'" class="operationbtn" data-id="' . $vl['id'] .'" data-toggle="modal" data-target="#deletepaper" data-backdrop="false"><span class="red"><i class="fa fa-trash-o"></i></span></a>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        echo $html;
        break;
    case 'reloadpaperstable':
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
            $rowArr[] = ' <a title="' .get_string('edit') .'" class="operationbtn" data-id="' .$vl['id'] .'" data-toggle="modal" data-target="#editpaper" data-backdrop="false"><span class="blue"><i class="fa fa-edit"></i></span></a>
                          <a title="'. get_string('delete') .'" class="operationbtn" data-id="' . $vl['id'] .'" data-toggle="modal" data-target="#deletepaper" data-backdrop="false"><span class="red"><i class="fa fa-trash-o"></i></span></a>';
            $dataArr[] = $rowArr;
        }
        $responseArr['data'] = $dataArr;
        echo json_encode($responseArr);
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
        $questionCart = $_SESSION['question_cart'];
        $questionCart =  core_paper\PaperHelper::moveQuestionUp($questionCart, $questionid);
        $_SESSION['question_cart'] = $questionCart;
        break;
    case 'movequestiondown':
        $questionid = $_REQUEST['questionid'];
        $questionCart = $_SESSION['question_cart'];
        $questionCart =  core_paper\PaperHelper::moveQuestionDown($questionCart, $questionid);
        $_SESSION['question_cart'] = $questionCart;
        break;
    case 'reloadquestioncart':
        $questionCart = $_SESSION['question_cart'];
        $html = core_paper\PaperHelper::reloadQuestionCart($questionCart);
        echo $html;
        break;
}