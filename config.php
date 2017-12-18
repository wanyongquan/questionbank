<?php
//version 1.0

session_start() ;

define('dbserver', 'localhost:3306'); // MySQL host 
define('dbusername', 'root'); // db user name
define('dbpassword', 'root');// db user password

define('database', 'questionbank');
$db = mysqli_connect(dbserver, dbusername, dbpassword, database);

// question bank configuration file
unset($CFG);
global $CFG;

$CFG = new stdClass();
$CFG->dbhost    ='localhost';
$CFG->dbname    = 'questionbank';
$CFG->dbuser    ='root';
$CFG->dbpass    ='root';
$CFG->wwwroot   ='http://localhost/questionbank';
$CFG->admin     ='admin';

$abs_doc_root = $_SERVER['DOCUMENT_ROOT'];
$self_path = explode("/", $_SERVER['PHP_SELF']);
$self_path_length=count($self_path);
$file_found=FALSE;

for($i = 1; $i < $self_path_length; $i++){
    array_splice($self_path, $self_path_length-$i, $i);
    $qb_url_root=implode("/",$self_path);

    if (file_exists($abs_doc_root.$qb_url_root.'/login.php')){
        $file_found=TRUE;
        break;
    }else{
        $file_found=FALSE;
    }
}
$app_root= '/questionbank';

$copyrightmessage=" This is copymessage";
require_once($abs_doc_root.$app_root.'/lib/setup.php');

require_once ('classes\class.Input.php');
require_once ('classes\class.User.php');

$timezone_string="Asia/Shanghai";
date_default_timezone_set($timezone_string);

$user = new User();
?>
<?php require_once $abs_doc_root.$app_root.'/helpers/questionhelpers.php';?>
