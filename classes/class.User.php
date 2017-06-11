<?php
 /**
  * User class
  * @author Wanyongquan
  * last updated on : 2017/4/9
  */

class User
{
    private   $_id, $_username, $_password, $_isLoggedIn, $role;
    
    public function username(){
        return $this->_username;
    }
    public function __construct($user = null)
    {
        if (!$user){
            if (isset($_SESSION['userid'])){
                $user = $_SESSION['userid'];
                
                if($this->find($user)) 
                {
                    $this->_isLoggedIn = true;
                }else{
                    // logout
                }
            }
        }else{
            $this->find($user);
        }
    }
    private function _loadPages()
    {
        
    }
    public function login($username = null, $password=null)
    {
        if (!$username && !$password && $this->exists())
        {
            $_SESSION['userid'] =  $this->_id ;
            $_SESSION['username'] =  $this->_username ;
        }else{
            $founduser = $this->find($username, $password);
            // find user in DB
            if ($founduser){
                $_SESSION['userid'] =  $this->_id ;
                $_SESSION['username']= $username;
                $this->_isLoggedIn = true;
                $this->_username = $username;
                // todo: if remember me ,set cookie
                
                // todo: update user last login info
                return true;
            }
        }
        return false;
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
    public function find($user = null){
        global $DB;
        if ($user){
            $query = "select * from tk_users where";
            if (is_numeric($user)){
                $query .= " uid = $user";
            }else{
                $query .= " username = '$user'";
            }
            
            $result = mysqli_query($DB, $query);
            $count = mysqli_num_rows($result);
            if ($count == 1){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $this->_id = $row['uid'];
                    $this->_username = $row['username'];
                    return true;
                }
            }
            return false;
        }
    }
    public function find2($username = null, $password = null)
    {
        global $DB;
        if (!$username || !$password)
            return false;
        $passwordmd5 = md5($password);
        $query = "select uid from tk_users where username='$username' and password='$passwordmd5'";
        $result = mysqli_query($DB, $query);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $this->_id = $row['uid'];
                $this->_username = $row['username'];
                return true;
            }
        }
        return false;
    }
}  
?>