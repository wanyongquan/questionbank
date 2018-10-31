<?php


/*
 *******************************************************************************
 ** WanXin Test Paper Generator System                                        **
 **---------------------------------------------------------------------------**
 ** Developer: Wan Yongquan                                                   **
 ** Title: general helper file                                                **
 ** Function:  helper functions                                               **
 *******************************************************************************
 */
 include_once '../config.php';
 require_once  $abs_doc_root.$qb_url_root.'/classes/PaperGenerator.php';
 require_once  $abs_doc_root.$qb_url_root.'/classes/Class.User.php';

/**
 * Get the paper generator stored in session if there is one; otherwise, create and return a new Paper Generator object.
 * @param int $courseId
 * @return \core_qb\PaperGenerator
 */
function try_get_paper_generator($courseId = null){
    if (isset($_SESSION['paper_generator']) ){
        return unserialize($_SESSION['paper_generator']);
    }
    
    // create a new Paper Generator if there is  no one;
    
    $paper_generator = new \core_qb\PaperGenerator();
    // store it in session;
    $_SESSION['paper_generator'] = serialize($paper_generator);
    return $paper_generator;
}