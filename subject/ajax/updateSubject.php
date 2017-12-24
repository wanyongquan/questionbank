<?php
     require_once '../../config.php';

     // check request
     if (isset($_POST['subjectid'])){
         $subjectid = $_POST['subjectid'];

         $subjectname= $_POST['subjectname'];

         // update database table
         $query = "update tk_subjects set subject_name='$subjectname' where subject_id=$subjectid";
         if (!$result = mysqli_query($DB, $query)){
             exit (mysqli_error($DB));
         }
     }