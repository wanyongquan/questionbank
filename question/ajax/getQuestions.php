<?php
    include_once '../../config.php';

    // write the html table header
    $data = '<table class="table table-striped table-hover">
               <thead<tr><th>名称</th>
                            <th>题型</th>
                            <th>难度</th>
                            <th>课程</th>
                            <th>知识点</th>
                            <th>分数</th>
                            <th>创建人</th>
                            <th>创建日期</th>
                            <th>操作</th></thead>
            <tbody>';
    $query = 'select * from tk_questions left join bs_dictionaryitems as dictdata '
            .'on tk_questions.difficultylevel_id = dictdata.dictionary_id  left join'
            .' tk_users on tk_users.uid = tk_questions.createdby left join '
            .' tk_subjects on tk_subjects.subject_id = tk_questions.subject_id ';
    $query .= 'left join tk_courses on tk_subjects.course_id = tk_courses.course_id order by question_id;';
    $result = $DB->query($query) or die(exit(mysqli_error($DB)));

    if ($result->num_rows > 0){
        foreach ($result as $row){
            $questiontype = $row['qtype'];
            $data .= '<tr><td>'.$row['question_name'].'</td>';
            $data .= '<td>'.$row['qtype'].'</td>';
            $data .= '<td>'.$row['dictionary_value'].'</td>';
            $data .= '<td>'.$row['coursename'].'</div>';
            $data .= '<td>'.$row['subjectName'].'</td>';
            $data .= '<td>'.$row['point'].'</td>';
            $data .= '<td>'.$row['username'].'</td>';
            $data .= '<td>'.$row['createdDate'].'</td>';
            
            $data .= '<td><a title="Edit" href="' .$questiontype .'/edit.php?id='.$row['question_id'].'"><i class="glyphicon glyphicon-edit"></i></a>
                        <a  data-id="'.$row['question_id'].'"
                           data-toggle="modal" data-target="#delete_question_modal"
                           data-backdrop="false"><i class="glyphicon glyphicon-trash"></i></a></td>';
            $data .= '</tr>';
        }
    }else{
        $data .= '<tr><td colspan="3">No data found</td></tr>';
    }

    echo $data;