<?php
  /*
   * Question Bank 0.1
   */
?>
<?php  require_once '../../config.php';?>
<?php require_once $abs_doc_root.$app_root.'/helpers/questionhelpers.php';?>
<?php 
   
    $html = '<table class="table table-striped table-hover">';
    $html .= '   <thead>';
    $html .= '    <tr><th>ID</th><th>page</th><th>action</th></tr></thead>'; 
    $html .= '   <tbody>';
   
    $query = 'select * from tk_pages order by id';
    if (!$result = $DB->query ($query)){
        exit (mysqli_error($DB));
    }
    if ($result->num_rows > 0){
        foreach ($result as $page){
            $html .= '<tr>';
            $html .= '<td>'.$page['id'].'</td>';
            $html .= '<td><a href="'.$CFG->wwwroot.'/users/admin_page.php?id='.$page['id'].'">'.$page['page'].'</a></td>';
            $html .= '<td><a title="Edit" href="'.$app_root.'admin_page.php?id='.$page['id'].'">
                        <i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '&nbsp; <a data-id="'.$page['id'].'" data-toggle="modal" data-target="#del_page_modal"
                    " data-backdrop="false"><i class="glyphicon glyphicon-trash"></i></a></td>';
            $html .= '</tr>';
        }
    }else{
        $html = '<tr><td colspan="3">No data found</td></tr>';
    }
    echo $html;
?>  
 