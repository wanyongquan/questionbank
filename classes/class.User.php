<?php
 /**
  * User class
  * @author Wanyongquan
  * last updated on : 2017/4/9
  */

class User
{
    private    $_id, $_username, $_fname, $_lname, $_password_hash, $_isLoggedIn, $role;
    
    public function __set($property_name, $value){
        $this->$property_name = $value;
        $this->SaveToSession();
    }
    public function __get($property_name){
        if (isset($this->$property_name)){
            return $this->$property_name;
        }else{
            return null;
        }
    }

    public function __construct($userid = null, $username = null, $password_hash = null)
    {
        
        $this->_id = $userid;
        $this->_username = $username;
        $this->_password_hash = $password_hash;
        $this->role= null;
    }
    private function _loadPages()
    {
        
    }
    public function login_user()
    {
        $this->_isLoggedIn = true;
        $this->SaveToSession();
        /* //序列化并保存到session
        $_SESSION['loggeduser'] =  $this; */
        

    }
    private function SaveToSession(){
        //序列化并保存到session
        $_SESSION['loggeduser'] =  $this;
    }
    public function exists()
    {
        return (!empty($this->_id)) ? true : false;
    }
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
    public function notLoggedInRedirect($location)
    {
        if ($this->_isLoggedIn){
            return true;
        }else {
            header('Location: '.$location);
        }
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
    }
    public function hasPermissionOnPage($id)
    {
       
    }

    
    // check password hash
    public function varify_password( $password){
        $tmppassword_hash = md5($password );
        if ($tmppassword_hash == $this->_password_hash){
            return true;
        }else
            return false;
    }
}  

?>