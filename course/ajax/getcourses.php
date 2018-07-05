<?php
    // include database file
    include("../../config.php");

    // write the table header

    $data = '<table id="paginate" class="table  table-hover table-listsearch">
            <thead>
             <tr>
                <th>课程名称</th>
                <th>描述</th>
                <th>Action</th>
             </tr>
            </thead>
            <tbody>';

    $query= 'select * from tk_courses order by coursename';

    if (!$result = $DB->query($query)){
        exit(mysqli_error($DB));
    }
    if ($result->num_rows > 0){
        foreach ($result  as $course){
             $data .= '<tr>';
            $data .= '<td>'.$course['coursename'].'</td>';
            $data .= '<td>'.$course['description'].'</td>';
            $data .= '<td> ';
            $data .= ' <div class="hidden-sm hidden-xs action-buttons"><a class="btn btn-warning" href="../admin/admin_users.php">知识点管理</a><a class="btn btn-warning" href="../admin/admin_users.php">组卷规则管理</a><a title="编辑知识点" onclick="getCourseDetails('.$course['course_id'].')" data-toggle="modal" data-target="#edit_course_modal" data-backdrop="false"
                            data-href="http://localhost/user/editadvanced.php?id=2&amp;course='.$course['course_id'].'">
                            <span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a><a title="编辑" onclick="getCourseDetails('.$course['course_id'].')" data-toggle="modal" data-target="#edit_course_modal" data-backdrop="false"
                            data-href="http://localhost/user/editadvanced.php?id=2&amp;course='.$course['course_id'].'">
                            <span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>
                        <a title="删除" class="delete_product" data-id="'.$course['course_id'].'"  data-toggle="modal" data-target="#delete_course_modal" data-backdrop="false">
                            <span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></div></td>';
            $data .= '</tr>';
        }
    }else{
        $data .= "<tr><td>No data found</td></tr>";
}




/*     // fatch the rows and show in table
    if (mysqli_num_rows($result) > 0){
        $number = 1;
        while ($row = mysqli_fetch_assoc($result)){
            $data .= '<tr>
                    <td>'.$row['course_name'].'</td>
                    <td>'.$row['description'].'</td>
                    <td><a title="Edit"
                        href="http://localhost/user/editadvanced.php?id=2&amp;course=1"><img
                            src="'. $CFG->wwwroot.'/images/gear.png"
                            alt="edit" class="iconsmall" /></a></td>
                 </tr>';
            $number ++;
        }
     }else{
            // no courses found
            $data .= '<tr><td colspan="6"> No courses found!</td></tr>';
        } */
    $data .= "</tbody></table>";
    //echo $data;
    $html ='<table id="paginate" class="table table-hover table-list-search dataTable no-footer" role="grid" aria-describedby="paginate_info">
                      <thead>
                        
                          <tr role="row"><th class="sorting" tabindex="0" aria-controls="paginate" rowspan="1" colspan="1" aria-label="id: activate to sort column ascending" style="width: 58px;">id</th><th class="sorting" tabindex="0" aria-controls="paginate" rowspan="1" colspan="1" aria-label="Page Path: activate to sort column ascending" style="width: 270px;">Page Path</th><th class="sorting" tabindex="0" aria-controls="paginate" rowspan="1" colspan="1" aria-label="Page Name: activate to sort column ascending" style="width: 239px;">Page Name</th><th class="sorting" tabindex="0" aria-controls="paginate" rowspan="1" colspan="1" aria-label="Access: activate to sort column ascending" style="width: 125px;">Access</th></tr></thead>
                      <tbody>
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  
                                              <tr role="row" class="odd">
                            <td>1</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=1">admin/admin_users.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=1">User Manager</a></td>
                            <td>1 </td>
                          </tr><tr role="row" class="even">
                            <td>2</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=2">admin/admin_user.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=2">User Manager</a></td>
                            <td>1 </td>
                          </tr><tr role="row" class="odd">
                            <td>3</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=3">admin/admin_roles.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=3">Role Manager</a></td>
                            <td>0 </td>
                          </tr><tr role="row" class="even">
                            <td>4</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=4">admin/admin_role.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=4">Role Manager</a></td>
                            <td>0 </td>
                          </tr><tr role="row" class="odd">
                            <td>5</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=5">admin/admin_pages.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=5">Page Manager</a></td>
                            <td>0 </td>
                          </tr><tr role="row" class="even">
                            <td>6</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=6">question/question.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=6">Question Manager</a></td>
                            <td>0 </td>
                          </tr><tr role="row" class="odd">
                            <td>7</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=7">index.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=7">Home</a></td>
                            <td>1 </td>
                          </tr><tr role="row" class="even">
                            <td>8</td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=8">examination.php</a></td>
                            <td><a class="nounderline row-link" href="admin_page.php?id=8">Examination Manager</a></td>
                            <td>1 </td>
                          </tr></tbody>
                    </table>';
    echo $html;

?>

