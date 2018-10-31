<?php

/*
 ***************************************************
 ** WanXin Test Paper Generator System            **
 **-----------------------------------------------**
 ** Developer: Wan Yongquan                       **
 ** Title: helper tools                           **
 ** Function: functions that serve system         **
 ***************************************************
 */
?>
<?php require_once $abs_doc_root.$qb_url_root.'/classes/Redirect.php';?>
<?php require_once $abs_doc_root.$qb_url_root.'/classes/SelectionPriority.php';?>
<?php
function closedb()
{
    global $DB;
    if(!$conn)
        mysqli_close($conn);
}

if(!function_exists('loginRequired')){
    function loginRequired($url){
        global $DB,$user;
       
        $abs_qb_root=$_SERVER['DOCUMENT_ROOT'];
        
        $self_path=explode("/", $_SERVER['PHP_SELF']);
        $self_path_length=count($self_path);
        $file_found=FALSE;
        
        for($i = 1; $i < $self_path_length; $i++){
            array_splice($self_path, $self_path_length-$i, $i);
            $qb_url_root=implode("/",$self_path)."/";
            
            if (file_exists($abs_qb_root.$qb_url_root.'z_qb_root.php')){
                $file_found=TRUE;
                break;
            }else{
                $file_found=FALSE;
            }
        }
        
        if(!$user || !$user->isLoggedIn() ){
            Redirect::to($qb_url_root.'login.php?returnurl='.$url);
            return false;
        }
        
        
        $urlRootLength = strlen($qb_url_root);
        $page = substr($url, $urlRootLength, strlen($url)- $urlRootLength);
        //retrieve page details
        $querystr = sprintf("SELECT id, pagepath, private FROM tk_pages WHERE pagepath='%s'", $page);
        $result = mysqli_query($DB, $querystr);

        $count = mysqli_num_rows($result);
        if ($count == 0){
            // check if user has administrator role;
        }
        $pageDetails = mysqli_fetch_assoc($result);
        if (empty($pageDetails)){
            // If page does not exist in DB, allow access;
            return true;
        }elseif($pageDetails['private'] == 0){
            // If page is public, allow access
            return true;
        }elseif(!$user->isLoggedIn()){
            // If user is not logged in , deny access;
            Redirect::to($qb_url_root.'login.php?returnurl='.$page);
            return false;
        }else{
            
            $pageId = $pageDetails['id'];
            
            // Retrieve list of roles with access to page
            $querystr = "SELECT roleid FROM tk_page_assigned_roles WHERE pageid= $pageId";
            $resultRole = mysqli_query($DB, $querystr);
            if ($resultRole){
                $pageRole = mysqli_fetch_assoc($resultRole);
                if (checkRole($pageRole)){
                    return true;
                }
            }
        }
        return false;
    }
}
// Retrieve all users
if (! function_exists ( 'getAllUsers' )) {
    function getAllUsers() {
        global $DB;
        $querystr = "select * from tk_users";
        $result = mysqli_query ( $DB, $querystr );
        
        return $result;
    }
}

// check if a user ID exists in the DB 
if (!function_exists('userIdExists')){
    function userIdExists($id){
        global $DB;
        $querystr = "select * from tk_users where uid=". $id;
        $result = mysqli_query($DB, $querystr);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount >0){
            return true;
        }
        else{
            return false;
        }
    }
}

// Retrieve complete user information by user ID or username 
if (!function_exists('getUserDetails')){
    function getUserDetails($uid = NULL, $username=NULL){
        if ($uid != NULL){
            $column = "uid";
            $value = $uid;
        }
        elseif($username != NULL){
            $column = "username";
            $value = $username;
        }
        global $DB;
        $querystr = "select * from tk_users where $column = $value limit 1";
        $result = mysqli_query($DB, $querystr);
        $row = NULL;
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }
}
// Retrieve all roles
if (! function_exists ( 'getAllRoles' )) {
    function getAllRoles() {
        global $DB;
        $querystr = "select * from tk_roles";
        $result = mysqli_query ( $DB, $querystr );
        
        return $result;
    }
}

// check if a role ID exists in the DB
if (!function_exists('roleIdExists')){
    function roleIdExists($id){
        global $DB;
        $querystr = "select * from tk_roles where id=". $id;
        $result = mysqli_query($DB, $querystr);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount >0){
            return true;
        }
        else{
            return false;
        }
    }
}

// Retrieve complete role information by role ID or name
if (!function_exists('getRoleDetails')){
    function getRoleDetails($uid = NULL, $username=NULL){
        if ($uid != NULL){
            $column = "id";
            $value = $uid;
        }
        elseif($username != NULL){
            $column = "name";
            $value = $username;
        }
        global $DB;
        $querystr = "select * from tk_roles where $column = $value limit 1";
        $result = mysqli_query($DB, $querystr);
        $row = NULL;
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }
}


// Retrieve list of user belong to Role 
if (!function_exists('getRoleUsers')){
    function getRoleUsers($id = NULL){
        
        global $DB;
        $querystr = "select * from tk_user_assigned_roles where roleid = $id";
        $result = mysqli_query($DB, $querystr);
        
        return $result;
    }
}

// Retrieve all pages
if (! function_exists ( 'getAllPages' )) {
    function getAllPages() {
        global $DB;
        $querystr = "select * from tk_pages";
        $result = mysqli_query ( $DB, $querystr );
        
        return $result;
    }
}

// Retrieve list of pages with the role access
if (!function_exists('getRolePages')){
    function getRolePages($id = NULL){
        
        global $DB;
        $querystr = "select * from tk_page_assigned_roles where roleid = $id";
        $result = mysqli_query($DB, $querystr);
        
        return $result;
        
    }
}

// remove users from role 
if (!function_exists('removeUsers')){
    function removeUsers($roleid, $members){
        global $DB;
        if (is_array($members)){
            $memberStr = '';
            foreach($members as $vl){
                $memberStr .= $vl . ',';
            }
            // trim the last ',';
            $memberStr = rtrim($memberStr, ',');
            
            $query = "delete from tk_user_assigned_roles where roleid=". $roleid." AND userid IN ({$memberStr})";
            $result = mysqli_query($DB, $query);
            
        }
    }
}

// add users from role
if (!function_exists('addUsers')){
    function addUsers($roleid, $members){
        global $DB;
        $i= 0;
        if (is_array($members)){
            foreach($members as $vl){
                $query = sprintf("insert into tk_user_assigned_roles (roleid, userid) values(%d, %d); ", $roleid, $vl);
                $result = mysqli_query($DB, $query);
                $i ++;
            }
        }
        return $i;
    }
}

// remove users from role
if (!function_exists('removePages')){
    function removePages($roleid, $members){
        global $DB;
        if (is_array($members)){
            $memberStr = '';
            foreach($members as $vl){
                $memberStr .= $vl . ',';
            }
            // trim the last ',';
            $memberStr = rtrim($memberStr, ',');
            
            $query = "delete from tk_page_assigned_roles where roleid=". $roleid." AND pageid IN ({$memberStr})";
            $result = mysqli_query($DB, $query);
            
        }
    }
}

// add users from role
if (!function_exists('addPages')){
    function addPages($roleid, $members){
        global $DB;
        $i= 0;
        if (is_array($members)){
            foreach($members as $vl){
                $query = sprintf("insert into tk_page_assigned_roles (roleid, pageid) values(%d, %d); ", $roleid, $vl);
                $result = mysqli_query($DB, $query);
                $i ++;
            }
        }
        return $i;
    }
}
// get list of all courses 
if (!function_exists('fetchAllCourses')){
    function fetchAllCourses(){
        global $DB;
        
        $sql = "select * from tk_courses order by coursename";
        $result = mysqli_query($DB, $sql);
        return $result;
    }
}

// check if a course ID exists in the DB
if (!function_exists('courseIdExists')){
    function courseIdExists($id){
        global $DB;
        $querystr = "select * from tk_courses where course_id=". $id;
        $result = mysqli_query($DB, $querystr);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount >0){
            return true;
        }
        else{
            return false;
        }
    }
}

// Retrieve complete course information by course id
if (!function_exists('getCourseDetails')){
    /**
     * @param int $id , courseid
     * @return array , associate array of course details;
     */
    function getCourseDetails($id = NULL){

        global $DB;
        $querystr = "select * from tk_courses where course_id = $id limit 1";
        $result = mysqli_query($DB, $querystr);
        $row = NULL;
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }
}

// Retrieve list of subjects belong to course
if (!function_exists('getCourseSubjects')){
    function getCourseSubjects($id = NULL){
        
        global $DB;
        $querystr = "select * from tk_subjects where courseid = $id";
        $result = mysqli_query($DB, $querystr);
        if (!result ){
            die(mysqli_error($DB));
        }
        return $result;
        
    }
}

// Retrieve list of questions belong to Course
function getCourseQuestions($courseId){
    global $DB;
    $sql = "select question_id, question_body, qtype,point,username as creator,createdDate,";
    $sql .= " subjectname, item_name as difficulty";
    $sql .= " from tk_questions left join tk_subjects on tk_questions.subjectid = tk_subjects.subject_id ";
    $sql .= " left join tk_users on tk_questions.creatorid = tk_users.uid, ";
    $sql .= " tk_dictionary_types dicts ";
    $sql .= " left join tk_dictionary_items as dictData on  dicts.id= dictData.type_id  ";
    $sql .= " where dicts.id = 1 and tk_questions.difficultylevel_id = dictData.id and  tk_questions.courseid=".$courseId;
    $result = mysqli_query($DB, $sql);
    if (!$result){
        echo mysqli_error($DB);
    }
    return $result;
}

if (!function_exists('getQuestionDetails')){
    function getQuestionDetails($qid){
        global $DB;
        $querystr = "select question_id, question_body, qtype, point, createdDate,";
        $querystr .= " subjectname, subjectid, Q.courseid, cognitionid, difficultylevel_id, item_name as difficulty ";
        $querystr .= " from tk_questions Q left join tk_subjects S on Q.subjectid = S.subject_id ";
        $querystr .= " left join tk_dictionary_items as dicts on Q.difficultylevel_id = dicts.id ";
        $querystr .= " where question_id = $qid";
        $result = mysqli_query($DB, $querystr);
        if (!$result){
            echo( mysqli_error($DB));
        }
        
        return $result;
    }
}

if (!function_exists('getQuestionAnswers')){
    function getQuestionAnswers($questionId){
        global $DB;
        $querystr = "select * from tk_question_answers where question_id = $questionId  order by answerlabel";
        $result = mysqli_query($DB, $querystr);
        return $result;
    }
}

if (!function_exists('findUser')){
    function findUser($username=NULL){
        global $DB;
        $querystr = "select * from tk_users where username='$username'";
        $result = mysqli_query($DB, $querystr);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $uid = $row['uid'];
                $password_hash = $row['password'];
                global $user;
                $user = new User($uid, $username, $password_hash);
                $user->__set('_fname', $row['fname']);
                $user->_lname=  $row['lname'];
                return $user;
            }
        }
        return false;
    }
}

if(!function_exists('addUser')){
    function addUser($username, $password){
        global $DB;
        // Step 1: add the user 
        $querystr = sprintf("insert into tk_users (username, password) values ('%s', '%s')", $username, $password);
        $result = mysqli_query($DB, $querystr);
        $newUserId = mysqli_insert_id($DB);
        // Step 2: assign user with default role;
        $addNewRole = sprintf("insert into tk_user_assigned_roles (userid, roleid) values (%d, %d) ;", $newUserId, 3);
        mysqli_query($DB, $addNewRole);
        return true;
    }
}

if (!function_exists('checkRole')){
    function checkRole($role){
        global $DB, $user;
        $access = 0;
        //foreach ($role as $vl){
            if ($access == 0){
                $query = sprintf("SELECT id FROM tk_user_assigned_roles WHERE userid=%d and roleid=%d", $user->_id, $role['roleid']);
                $result = mysqli_query($DB, $query);
                if (mysqli_num_rows($result) >0){
                    $access = 1;
                    //break;
                }
            }
        //}
        if($access == 1){
            return true;
        }
        if ($user->_id == 1){
            // default admin user;
            return true;
        }else{
            return false;
        }
        
    }
}


if (!function_exists('getDifficultyLevels')){
    /**
     * @desc get list of difficulty levels;
     * @return  mysqli_result 
     */
    function getDifficultyLevels(){
        global $DB;
        $querystr = "select dictData.item_name, dictData.item_value, dictData.id from tk_dictionary_items dictData, tk_dictionary_types dicts" ;
        $querystr .= " where dicts.id = dictData.type_id and dicts.id = 1 order by itemorder";
        $result = mysqli_query($DB, $querystr);
        if (!$result ){
            echo mysqli_error($DB);
        }
        return $result;
    }
}

if (!function_exists('getQtypes')){
    /**
     * @desc get list of question types;
     * @return false|mysqli_result return FALSE on failure. return a mysqli_result object for successful query.
     */
    function getQtypes(){
        global $DB;
        $querystr = "select dictData.id, item_name, item_value,itemorder,isfixed, type_id ";
        $querystr .= " from tk_dictionary_items dictData , tk_dictionary_types dictType "; 
        $querystr .= " where dictData.type_id = dictType.id and dictType.dictionary_value='qtype'";
        $querystr .= " order by itemorder";
        $result = mysqli_query($DB, $querystr);
        if (!$result ){
            die(mysqli_error($DB));
        }
        
        return $result;
    } 
}

if (!function_exists('returnError')){
    function returnError($errorMsg){
        $responseArr = [];
        $responseArr['success'] = true;
        $responseArr['error'] = true;
        $responseArr['errorMsg'] = $errorMsg;
        // do not encode unicode characters;
        die(json_encode($responseArr, JSON_UNESCAPED_UNICODE));
    }
}
/**
 * ****************************
 * Question Cart Section      *
 * ****************************
 */


if (!function_exists('removeQuestionFromCart')){
    function removeQuestionFromCart($questionid, $cart){
        if (!isset($cart) || !is_array($cart)){
            return false;
        }
        if(!isset($cart['qtype_data'])){
            return false;
        }
        $questionCart = $cart;
        $qtypeArr = $cart['qtype_data'];
        foreach($qtypeArr as $qtype=>$qid_arr){
            if (in_array($questionid, $qid_arr)){
                // remove the questionid from array
                $arrData = remove_Array_Value($qid_arr, $questionid);
                $qtypeArr[$qtype] = $arrData;
                $questionCart['qtype_data'] = $qtypeArr;
                return $questionCart;
            }
        }
    }
}

if (!function_exists('addQuestionToCart')){
    function addQuestionToCart($questionid, $cart){
        /**
         * example data of question cart
         * { 'courseid': 1,
         *   'qtype_data' : [
         *      ['qtype_1': [1, 3, 5]],
         *      ['qtype_2': [2, 4, 6]]
         *     ]
         *  }
         * @var Ambiguous $questionCart
         */
        
        $questionDetail = getQuestionDetails($questionid);
        $question = mysqli_fetch_assoc($questionDetail);
        $courseId = $question['courseid'];
        $qtype= $question['qtype'];
        
        if (!isset($cart)){
            // if the cart is empty, then add the question
            $questionCart= array();
            $questionCart['courseid'] = $courseId;
            $qtypeArr = array();
            $qtypeArr[$qtype] = array($questionid);
            $questionCart['qtype_data'] = $qtypeArr;
        }else{
            $questionCart = $cart;
            $qtypeArr = $cart['qtype_data'];
            if (array_key_exists($qtype, $qtypeArr)){
                //if the qtype is in array, then add the question id to the type array;
                $qid_arr = $qtypeArr[$qtype];
                // add new id in array;
                $qid_arr[] = $questionid;
                $qtypeArr[$qtype] = $qid_arr;
                $questionCart['qtype_data'] = $qtypeArr;
            }else{
                // add the qtype and qid_arr to qtype_data
                $qid_arr = array($questionid);
                $qtypeArr[$qtype] = $qid_arr;
                $questionCart['qtype_data'] = $qtypeArr;
            }
            
        }
//         if (isset($cart['qtype_data']) || array_key_exists($qtype, $cart['qtype_data']) ){
//             // if the qtype already exists in cart, then add qid to related array;
//             $qid_arr = $questionCart[$qtype];
//             $qid_arr[] = $questionid;
//             $questionCart[$qtype] = $qid_arr;
//         }else{
//             // if the qtype not exists in cart, then add new item for the qtype;
//             $qid_arr = array($questionid);
//             $qtype_arr = array($qtype=>$qid_arr);
//             //$cart[$qtype] = $qid_arr;
//             foreach($qtype_arr as $key=>$value){
//                 $questionCart[$key] = $value;
//             }
//         }
        return $questionCart;
    }
}

    

if (!function_exists('getAllTestPapers')){
    function getAllTestPapers($orderby , $orderdir){
        global $DB;
        $querystr = "select * from tk_testpapers";
        if (isset($orderby )){
            $querystr .= " order by " .$orderby;
            if (isset($orderdir)){
                $querystr .= " ".$orderdir;
            }
        }
        
        $result = mysqli_query($DB, $querystr);
        if (!$result){
            returnError(mysqli_error($DB));
        }
        return $result;
    }
}

if (!function_exists('getAllTestPaperByCreatorId')){
    function getAllTestPapersByCreatorId($creatorId){
        global $DB;
        $querystr = "select id, title, examduration, createdtime, createdby, P.courseid, coursename, finaldraft ";
        $querystr .= " from tk_testpapers P, tk_courses C ";
        $querystr .= " where P.courseid = C.course_id and P.createdby = $creatorId ";
        $result = mysqli_query($DB, $querystr);
        if (!result ){
            returnError(mysqli_error($DB));
        }
        return $result;
    }
}

if(!function_exists('getQuestionsBy')){
    /**
     * return questions match the given conditions;
     * @param int $courseId
     * @param int $subjectId
     * @param string $qtype
     * @param int $difficultylevelid
     * @return mysqli_result
     */
    function getQuestiongsBy($courseId, $subjectId, $qtype, $difficultylevelid){
        global $DB;
        $querystr = "select question_id, question_body, qtype, point, creatorid, createddate, ques.courseid ,ques.subjectid, subjectname, difficultylevel_id ";
        $querystr .= " from tk_questions ques, tk_subjects sub where ques.subjectid = sub.subject_id and ques.courseid= " . $courseId;
        if (isset($subjectId) && $subjectId != -1){
            $querystr .= " and subjectid = " . $subjectId;
        }
        if (isset($qtype) && $qtype!= 'all'){
            $querystr .= " and qtype = '" . $qtype . "'";
        }
        if (isset($difficultylevelid) && $difficultylevelid != -1){
            $querystr .= " and difficultylevel_id =" . $difficultylevelid; 
        }
        $result = mysqli_query($DB, $querystr);
        return $result;
    }
}

if (!function_exists('getQuestionReferedTimes')){
    function getQuestionReferedCount($questionId){
        global $DB;
        $querystr = "select questionid , count(*) as referedCount from tk_testpaper_questions where questionid=" . $questionId .' group by questionid';
        $result = mysqli_query($DB, $querystr);
        if (!$result ){
            die(mysqli_error($DB));
        }
        $resultArr = mysqli_fetch_assoc($result);
        $referedCount = $resultArr['referedCount'];
        return $referedCount;
    }
}

if (!function_exists('getPaperDetails')){
    function getPaperDetails($paperId){
        global $DB;
        $querystr = "select * from tk_testpapers where id=" . $paperId;
        $result= mysqli_query($DB, $querystr);
        if (!result){
            die(mysqli_error($DB));
        }
        $paperDetails = mysqli_fetch_assoc($result);
        return $paperDetails;
    }
}
if (!function_exists('getPaperQtypes')){
    function getPaperQtypes($paperId){
        global $DB;
        $querystr = "select * from tk_testpaper_qtypes where paperid = ". $paperId;
        $result = mysqli_query($DB, $querystr);
        return $result;
    }
}

if (!function_exists('getQuestionsByPaperAndType')){
    function getQuestionsByPaperAndType($paperId, $qtype="all"){
        global $DB;
        $querystr = "select * from tk_testpaper_questions where paperid= " . $paperId ;
        if ($qtype != "all"){
            $querystr .=  " and qtype='". $qtype. "'";
        }
        $result = mysqli_query($DB, $querystr);
        return $result;
    }
}

if (!function_exists('getPaperQuestions')){
    function getPaperQuestions($paperId){
        global $DB;
        return getQuestionsByPaperAndType($paperId);
    }
}

if (!function_exists('getSubjectName')){
    function getSubjectName($subjectId){
        global $DB;
        $querystr = "select subjectname from tk_subjects where subject_id=". $subjectId;
        $result = mysqli_query($DB, $querystr) or die(mysqli_error($DB));
        
        return $result;
    }
}
if (!function_exists('getMyTopNQuestions')){
    /**
     * @desc return top-N questions that current loggedin user created.
     * @param int $top
     * @return object result
     */
    function getMyTopNQuestions($top = 5){
        
        global $DB, $user;
        $querystr = "select question_id, question_body, qtype, courseid, subjectid, date(createdDate) Created_Date from tk_questions  where creatorid = " .$user->_id .' order by createdDate desc limit '.$top; 
        $result = mysqli_query($DB, $querystr);
        if (!result){
            die(mysqli_error($DB));
        }
        return $result;
    }
}

if(!function_exists('getMyTopNPapers')){
    /**
     * @desc return top-N papers that created by current logged in user;
     * @param number $top
     * @return object result
     */
    function getMyTopNPapers($top = 5){
        global $DB, $user;
        $querystr = "select id, title , date(createdtime) Created_Date from tk_testpapers where createdby = $user->_id order by createdtime desc limit $top";
        $result = mysqli_query($DB, $querystr);
        if (!$result){
            die(mysqli_error($DB));
        }
        return $result;
    }
}

if (!function_exists('getCongnitions')){
    function getCognitions(){
        global $DB;
        $querystr = "select id,item_name CognitionName, item_value CognitionValue, itemorder, isfixed from tk_dictionary_items where type_id=3";
        $result = mysqli_query($DB, $querystr);
        if (!$result){
            returnError(mysqli_error($DB));
        }
        return $result;
    }
}

if (!function_exists('getQuestionSubtotal')){
    /**
     * @desc return an array of question subtotal per qtype;
     * @param int $courseId
     * @param int $subjectIdArr
     * @return boolean|array 
     */
    function getQuestionSubtotal($courseId, $subjectIdArr){
        if (empty($courseId) || empty($subjectIdArr)){
            return false;
        }
        if (!is_array($subjectIdArr)){
            return false;
        }
        global $DB;
        $subjectIdRange = '';
        foreach($subjectIdArr as $vl){
            $subjectIdRange .= $vl . ',';
        }
        $subjectIdRange = rtrim($subjectIdRange, ',');
                
        $querystr = "select qtype, count(*) QC from tk_questions where courseid = $courseId and subjectid in ( $subjectIdRange ) group by qtype";
        $result = mysqli_query($DB,$querystr);
        if (!$result){
            die(mysqli_error($DB));
        }
        return $result;
   
    }
}

if (!function_exists('findQuestions')){
    /**
     * @desc find the  questions that satisfied all requirements;
     * @param int $courseId
     * @param int $difficulty
     * @param string $qtype
     * @param int $subjectId
     * @param  $priority
     * @return false|mysqli_result return false on failure. return a mysqli_result for successfully query. 
     */
    function findQuestions($courseId, $difficulty, $qtype, $subjectId, $priority){
        global $DB;
        switch($priority){
            case  core_qb\SelectionPriority::LatestCreateFirst:
                $querystr = "select * from tk_questions where courseid = $courseId ";
                $querystr .= " and qtype='$qtype' and subjectid= $subjectId ";
                $querystr .= " order by createdDate desc";
                break;
            case core_qb\SelectionPriority::LessUsedFirst:
                $querystr = "select  from tk_questions Q left join ";
                $querystr .= " (select questionid, count(*) usedTimes from tk_testpaper_questions group by questionid) Used "; 
                $querystr .= " on Q.question_id = Used.questionid";
                $querystr .= " order by usedTimes ";
                break;                  
          }
          $result = mysqli_query($DB, $querystr);
          if(!$result ){
              die(mysqli_error($DB));
          }
          return $result;
    }
}

function get_questions($courseId, $difficultyId, $qtype, $subjectIdArr){
    global $DB;
    
    if (is_array($subjectIdArr))
    {   
        foreach($subjectIdArr as $vl)
        {
            $subjectStr = $vl . ',';
        }
        // remove the last ',' at the end of line;
        $subjectStr = rtrim($subjectStr, ',');
        // add the start and end parentheses;
        $subjectStr = '(' . $subjectStr . ')';
        
    }else{
        die('$subjectIdArr must be an array.');
    }
    $querystr = "select * from tk_questions where courseId = $courseId";
    $querystr .= sprintf(" and qtype='%s'  and subjectid in $subjectStr ", $qtype);
    $result = mysqli_query($DB, $querystr);
    if (!$result){
        die(mysqli_error($DB));
    }
    $row = mysqli_fetch_assoc($result);
    return $result;
}

function array_random($arr, $num=1)
{
    shuffle($arr);
    
    $result = array();
    for ($i = 0; $i <$num; $i ++)
    {
        $result[] = $arr[$i];
    }
    return $result;
}

