<?php
    include('../session.php');
    error_reporting(0);
    
    require_once '../config.php';
    
    if (!isset($_SESSION['username'])){
        $_GLOBALS['message'] = 'Session Timeout. Click here to <a href=\"'.$CFG->wwwroot.'\login.php\">Log in</a>';

    }else if (isset($_REQUEST['logout'])) {
        unset($_SESSION['username']);
        $_GLOBALs['message'] = "You are logged out.";
        header('Location:'.$CFG->wwwroot.'/login.php');
    }
 ?>
 <?php 
     require_once $abs_doc_root.$app_root.'/include/header.php';
     require_once $abs_doc_root.$app_root.'/include/navigation.php';
 ?>

<div  class="container">
    <div id="page-course" >
        <h2>课程</h2>
        <p>
       <!-- <div class="singlebutton">
            <form method="get" action="<?php  echo $CFG->wwwroot.'/course/editadvanced.php'?>">
            <div><input type="submit"  class="btn btn-primary" value="添加课程" /><input type="hidden" name="id" value="-1" /></div></form>
        </div> -->
        <button class="btn btn-primary "  data-toggle="modal" data-target="#add_new_course_modal"  data-backdrop="false">新增课程</button>
        </p>

        <div class="coursescontent">
                  <!-- getCourses() table starts here -->
        </div>
    </div>

    <!--  Modal dialog for add new course  -->
    <div id="add_new_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" >
            <!--  Modal dialog content -->
            <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">新增 课程</h4>
                </div>
                <div class="modal-body">
                  <form id="addCourseForm" class="form-horizontal" role="form" method="post" data-toggle="validator">
                     <div class="form-group">
                          <div class="controls">
                            <label for="first_name" class="col-xs-3 col-md-3 control-label">课程名称</label>
                            <div class="col-xs-6 col-md-6">
                            <input   type="text" id="coursename"
                                placeholder="Course Name"
                                class="form-control" required data-error="Please enter course name"/>
                            <div class="help-block with-errors"></div>  </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-xs-3 control-label">描述</label>
                            <div class="col-xs-6"> <input
                                type="text" id="description"
                                placeholder="Description"
                                class="form-control" /></div>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary" id="btnAddCourse">保存</button>
                    </div> <!-- End of modal footer -->
            </div> <!-- End of modal content -->
        </div> <!-- End of modal dialog -->
    </div> <!-- End of Modal -->
    <!--  end of modal new course-->

    <!-- Modal dialog for edit course -->
    <div id="edit_course_modal" class="modal fade"  role="dialog" >
        <div class="modal-dialog" >
            <!-- Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" >编辑 课程</h4>
                    <input type="hidden" id="hidden_course_id">
                </div>
                <div class="modal-body">
                  <form id="edit_course_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                    <div class="form-group">
                        <label for="edit-coursename" class="col-xs-3">课程名称</label>
                        <div class="col-xs-6">
                        <input type="text" id="edit_coursename" placeholder="Course Name" class="form-control" required/>
                        <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-coursedescription" class="col-xs-3">描述</label>
                        <div class="col-xs-6">
                        <input type="text" id="edit_coursedescription" placeholder = "Description" class="form-control"/>
                        </div>
                    </div>
                    </form>
                </div> <!-- end of moal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditCourse">保存</button>
                </div><!--  end of modal-footer -->
            </div><!--  end of modal content -->
        </div><!--  end of modal dialog -->
    </div><!--  end of modal  -->
    <!--  End of modal dialog for edit course -->

       <!--  Modal dialog for delete course  -->
    <div id="delete_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">删除课程</h4>
                </div>
                <div class="modal-body">
                      <p> 你确定要删除本课程吗?</p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">取消</button>
                            <a class="btn btn-danger btn-ok" onclick="deleteCourse(this)">删除</a>
                    </div><!--  end of modal-footer -->
            </div><!--  end of modal-content -->
        </div><!--  end of modal-dialog -->
    </div><!--  end of modal -->
    <!--  end of modal delete course-->

    </div>

<?php require_once $abs_doc_root.$app_root.'/include/page_footer.php';?>
<?php require_once $abs_doc_root.$app_root.'/include/scripts.php';?>
    <script src="course.js"  type="text/javascript"> </script>
<?php require_once $abs_doc_root.$app_root.'/include/html_footer.php';?>  
