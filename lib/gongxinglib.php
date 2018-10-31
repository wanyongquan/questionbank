<?php
require_once $abs_doc_root.$qb_url_root.'/lang/gongxing.php';
    
function get_string($identifier){
    global $string;
    $result = null;
    if (isset( $string[$identifier] )){
        $result = $string[$identifier];
    }
   
    return $result;
}

function remove_Array_Value($arrData, $value){
    if (!is_array($arrData)){
        return false;
    }
    $key = array_search( $value, $arrData );
    
    if ($key !== false) {
        array_splice ( $arrData, $key, 1 ); // remove the element with $key found
    }
    return $arrData;
}
function getQuesTypeDisplayStr($qtype) {
    global $string;
    if (! isset ( $qtype ) || ! array_key_exists ( $qtype, $string )) {
        return false;
    }
    return get_string ( $qtype );
}

// todo:[2018-10-30] seemed this function can be deprecated;
function refreshQuestionCart($courseId) {
    if (! isset ( $_SESSION ['current_courseid'] )) {
        // add to session
        $_SESSION ['current_courseid'] = $courseId;
    } else {
        $currCourseId = $_SESSION ['current_courseid'];
        
        if ($courseId != $currCourseId) {
            // if the new course is not the same as in session, then update current courseid and clear question cart;
            $_SESSION ['current_courseid'] = $courseId;
            // Wan 2018.10.30
            unset($_SESSION['paper_generator']);
        }
    }
}
?>