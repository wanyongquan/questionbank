<?php
/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System
 * @author Wanyongquan
 */
?>

<?php require_once $abs_doc_root.$qb_url_root.'/classes/Redirect.php';?>

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
            
            if (file_exists($abs_qb_root.$qb_url_root.'index.php')){
                $file_found=TRUE;
                break;
            }else{
                $file_found=FALSE;
            }
        }
        
        if(!$user || !$user->isLoggedIn() ){
            Redirect::to($qb_url_root.'/login.php?returnurl='.$url);
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
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
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
        $querystr .= " subjectname, subjectid, tk_questions.courseid, difficultylevel_id, item_name as difficulty ";
        $querystr .= " from tk_questions left join tk_subjects on tk_questions.subjectid = tk_subjects.subject_id ";
        $querystr .= " left join tk_dictionary_items as dicts on tk_questions.difficultylevel_id = dicts.id ";
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
if (!function_exists('cart_question_exists')){
    function cart_question_exists($questionid, $cart){
        if (!isset($cart) || !is_array($cart)){
            return false;
        }
        if (!isset($cart['qtype_data'])){
            return false;
        }
        $qtypeArr = $cart['qtype_data'];
        foreach($qtypeArr as $qtype=>$qid_arr){
            if (in_array($questionid, $qid_arr)){
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('removeQuestionFromCart')){
    function removeQuestionFromCart($questionid, $cart){
        if (!isset($cart) || !is_array($cart)){
            return false;
        }
        if(!isset($cart['qtype_data'])){
            return false;
        }
        $qtypeArr = $cart['qtype_data'];
        foreach($qtypeArr as $qtype=>$qid_arr){
            if (in_array($questionid, $qid_arr)){
                // remove the questionid from array
                $arrData = remove_Array_Value($qid_arr, $questionid);
                $cart[$qtype] = $arrData;
                return $cart;
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
                $qid_arr[] = $questionid;
                $qtypeArr[$qtype] = $qid_arr;
                $questionCart['qtype_data'] = $qtypeArr;
            }else{
                // add the qtype and qid_arr to qtype_data
                $qid_arr = array($questionid);
                $qtypeArr[] = array($qtype=>$qid_arr);
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

if (!function_exists('cartQuestionCount')){
    function cartQuestionCount(){
        if (!isset($_SESSION['question_cart'])){
            return 0;
        }
        
        $questionCart = $_SESSION['question_cart'];
        if (!is_array($questionCart)){
            return 0;
        }
        if (!isset($questionCart['qtype_data']))
            return 0;
        
        $count = 0;
        $qtypeArr = $questionCart['qtype_data'];
        foreach($qtypeArr as $key=>$value){
            $count += count($value);
        }
        return $count;
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