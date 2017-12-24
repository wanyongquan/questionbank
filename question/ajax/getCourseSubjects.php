<?php
    include_once '../../config.php';
    include_once '../../lib/dblib.php';
    if (isset($_POST['course_id'])){
        $course_id = $_POST['course_id'];
        $subjects = getSubjectsByCourseId($course_id);
        $html = "";
        if ($subjects->num_rows>0){
            foreach($subjects as $subject){
                $option =  '<option value="'.$subject['subject_id'].'" '.$courseselected.' >'.$subject['subject_name'].'</option>';
                $html .= $option;            
            }
        
        }
        echo $html;
    }