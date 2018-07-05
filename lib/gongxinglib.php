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
    
?>