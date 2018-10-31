<?php
/**
 *  Update user information for user profile section; 
 */
?>
<?php require_once '../../config.php'; ?>
<?php 

global $DB, $user;
if (!empty($_POST)){
    if ($user->_fname != $_POST['fname']){
        
        //fname changed;
        $fname = $_POST['fname'];
        // validate the field;
        // validate option: required
        if (strlen($fname) == 0){
            $errors[] = "First Name is required";
        }
        else{
            // update the field;
            $query = "update tk_users set fname='{$fname}' where uid={$user->_id}";
            mysqli_query($DB, $query);
            $user->_fname=$fname;
            $successes[] = "名已更新。";
        }
        /* // validate option: unique
        $query = "select * from tk_users where uid!= {$user->_id} and username= {$fname}";
        $result = mysqli_query($DB, $query);
        if ($result->count()){
            $error[] = "First Name already exists. Please choose anothor one";
        } */
    }
    if ($user->_lname != $_POST['lname']){
        $lname = $_POST['lname'];
        // validate option: required.
        if (strlen($lname) == 0){
            $errors[] = "Last name is required";
        }
        else{
            $query = "update tk_users set lname='{$lname}' where uid={$user->_id}";
            mysqli_query($DB, $query);
            $user->_lname= $lname;
            $successes[] = "姓已更新。";
        }
    }
    if ($user->_email != $_POST['email']){
        $email = $_POST['email'];
        if (strlen($email) == 0){
            $errors[] = "email is required.";
        }else{
            $query = "update tk_users set email = '{$email}' where uid={$user->_id}";
            mysqli_query($DB, $query);
            $user->_email = $email;
            $successes[] = "电子邮箱已更新。";
        }
    }
    if ($user->_tel != $_POST['tel']){
        $tel = $_POST['tel'];
        if (strlen($tel) == 0){
            $errors[] = "Tel is required";
        }
        else{
            $query = "update tk_users set tel = '{$tel}' where uid={$user->_id}";
            mysqli_query($DB, $query);
            $user->_tel = $tel;
            $successes[] = "联系电话已更新。";
        }
    }
    $responseArr = array();
    $responseArr['errors'] = $errors;
    $responseArr['successes'] = $successes;
    echo json_encode($responseArr, JSON_UNESCAPED_UNICODE);
    
}