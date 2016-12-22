<?php
    include("../../config.php");

    // write the table header;
    $data = '<table class="table table-striped table-hover">
                <thead><tr><th>知识点</th><th>课程</th><th>操作</th></tr></thead>
                <tbody>';
    $query = 'select subject_id,coursename, subjectName from tk_subjects, tk_courses where tk_subjects.course_id = tk_courses.course_id order by subjectname;';
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));

    if ($result->num_rows>0){
        foreach ($result as $row){
            $data .= '<tr><td>'.$row['subjectName'].'</td>';
            $data .= '<td>'.$row['coursename'].'</td>';
            $data .= '<td><a title="Edit" onclick="getSubjectDetails('.$row['subject_id'].')"
                        data-toggle="modal" data-target="#edit_subject_modal" data-backdrop="false" >
                        <i class="glyphicon glyphicon-edit"></i></a>
                        <a class="delete_product" data-id="'.$row['subject_id'].'"
                            data-toggle="modal" data-target="#delete_subject_modal" data-backdrop="false">
                            <i class="glyphicon glyphicon-trash"></i></a></td>';

            $data .= '</tr>';
        }
    }else{
        $data .= '<tr><td colspan="2">No data found</td></tr>';
    }

    echo $data;