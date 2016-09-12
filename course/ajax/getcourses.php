<?php
    // include database file
    include("../../config.php");

    // write the table header

    $data = '<table class="table table-striped">
            <thread>
             <tr>
                <th>Course name</th>
                <th>Description</th>
                <th>Operations</th>
             </tr>
            </thread>
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
            $data .= '<td><a title="Edit" onclick="getCourseDetails('.$course['course_id'].')" data-toggle="modal" data-target="#edit_course_modal" data-backdrop="false"
                            data-href="http://localhost/user/editadvanced.php?id=2&amp;course='.$course['course_id'].'">
                            <img src="'. $CFG->wwwroot.'/images/gear.png"
                                alt="edit" class="iconsmall" /></a>
                        <a class="delete_product" data-id="'.$course['course_id'].'"  data-toggle="modal" data-target="#delete_course_modal" data-backdrop="false">
                            <i class="glyphicon glyphicon-trash"></i></a></td>';

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
                    <td>'.$row['coursename'].'</td>
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
    echo $data;

?>

