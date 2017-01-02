<?php
    include_once ('../config.php');

    error_reporting(1);
    session_start();
    if (!isset($_SESSION['username'])){
        $_GLOBALS['message'] = 'Session Timeout. Click here to <a href=\"'.$CFG->wwwroot.'\login.php\">Log in</a>';

    }else if (isset($_REQUEST['logout'])) {
        unset($_SESSION['username']);
        $_GLOBALs['message'] = "You are logged out.";
        header('Location:'.$CFG->wwwroot.'/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
     <!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Question Bank </title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
   <body>
    <?php
    /****************/
    if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
    }
    ?>
    <?php if (isset($_SESSION['username'])){?>
        <?php include '../include/menus.php';?>
        <?php }?>
        <div class="container">
          <div class="no-overflows">

            <div class="page-subject">
                <h2>知识点</h2>
                <div><button class="btn btn-success" data-toggle="modal" data-target="#add_subject_modal" data-backdrop="false">新增知识点</button></div>
            </div>
            <div class="subject_content">
                <!-- subject content table starts here -->
            </div>
          </div>
          <!-- Modal dialog for add new subject -->
          <div id="add_subject_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!--  Modal dialog content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">新增  知识点</h4>
                    </div>
                    <div class="modal-body">
                    <form id="add_subject_form" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="subject_name" class="col-xs-3">subject Name</label>
                            <div class="col-xs-8">
                            <input type="text" id="subject_name" placeholder="" required data-error="Please enter subject name" class="form-control"/>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="qitem_course_id" class="col-xs-3">Course</label>
                                <div class="col-sm-8">
                                    <select id="qitem_course_id"
                                        name="qitem_course_id"
                                        class="form-control ">
                                        <option value="">请选择课程</option>
                                        <?php
                                        $courses = getCourses ();
                                        if ($courses->num_rows > 0) {
                                            foreach ( $courses as $course ) {
                                                $courseselected = ($course_id == $course ['course_id']) ? "selected" : "";
                                                echo '<option value="' . $course ['course_id'] . '" ' . $courseselected . ' >' . $course ['coursename'] . '</option>';
                                            }
                                        }
                                        ?>    
                                     </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnAddSubject"
                            >Add Subject</button>
                    </div> <!-- End of modal footer -->
                </div><!-- End of modal content -->
            </div> <!-- End of modal dialog -->
          </div> <!-- End of Modal  -->

          <!-- Modal dialog for edit subject -->
          <div id="edit_subject_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!--  Modal dialog content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">编辑 知识点</h4>
                        <input type="hidden" id="hidden_subject_id">
                    </div>
                    <div class="modal-body">
                      <form id="edit_subject_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                        <div class="form-group">
                            <label for="edit_subject_name" class="col-xs-3">subject Name</label>
                            <div class="col-xs-8">
                            <input type="text" id="edit_subject_name" placeholder="" required data-error="Please enter subject name" class="form-control"/>
                            <div class="help-block with-errors"></div></div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnEditSubject"
                            >Save</button>
                    </div> <!-- End of modal footer -->
                </div><!-- End of modal content -->
            </div> <!-- End of modal dialog -->
          </div> <!-- End of Modal  -->

    <!--  Modal dialog for delete subject  -->
    <div id="delete_subject_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Delete subject</h4>
                    <input type="hidden" id="hidden_edit_subject_id">
                </div>
                <div class="modal-body">
                      <p> Do you really want to delete this subject?</p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">No</button>
                            <a class="btn btn-danger btn-ok" onclick="deleteSubject()">Delete</a>
                    </div><!--  end of modal-footer -->
            </div><!--  end of modal-content -->
        </div><!--  end of modal-dialog -->
    </div><!--  end of modal -->
    <!--  end of modal delete subject-->
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../lib/jquery/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/form-validator.min.js" type="text/javascript"></script>
    <script src="subject.js" type="text/javascript"></script>
</body>
</html>