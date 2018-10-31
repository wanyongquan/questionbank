<?php
 /**
  * Question Bank 0.1
  * hold the functions;
  */ 
 
function fetchPageDetails($id){
    global $DB;
    $query = "select * from tk_pages where id = $id";
    $result = mysqli_query($DB, $query);
    if (mysqli_num_rows($result) > 0){
        $row =  mysqli_fetch_assoc($result);
    }
    return $row;
}

function fetchPageRoleAssignments($pageId){
    Global $DB;
    $query = "select id, role_id from tk_page_role_assignment where page_id = $pageId";
    $result = mysqli_query($DB, $query);
    return $result;
}

function fetchAllRoles(){
    global $DB;
    $query = "select * from tk_roles";
    $result = mysqli_query($DB, $query);
    
    return $result;
}

// remove role access that assigned to a page
function removeRoleforPage($pageId, $removeIds){
    GLOBAL $DB;
    if (is_array($removeIds)){
        $ids ='';
        for ($i= 0; $i< count($removeIds); $i++){
            $ids .= $removeIds[$i].',';
        }
        $ids = rtrim($ids, ','); // trim the last ','
        $query = "delete from tk_page_role_assignment where role_id in ({$ids}) and page_id=$pageId";
        $result = mysqli_query($DB, $query);
        return $result;
    }
}

