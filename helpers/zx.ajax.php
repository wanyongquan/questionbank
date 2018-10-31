<?php
error_reporting ( 1 );
?>

<?php require_once '../config.php'; ?>
<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';?>

<?php
/**
 * Performs zujuan management ajax actions.
 * 
 * @package core_zujuan
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$action = $_REQUEST['action'];

switch($action){
    case 'updatecartinfo':
        // get question cart info from session;
        // todo:[2018-10-30] need to check if this code is necessary and correct?
//         $count = cartQuestionCount();
//         echo $count;
        
        break;
}