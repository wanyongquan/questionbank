<?php
/*
 * ****************************************************
 * ** Yan Lao Shi Question Management System        ***
 * **-----------------------------------------------***
 * ** Developer: Wan Yongquan                       ***
 * ** Title: User Management                        ***
 * ** Function: Edit, Password&Role Settings        ***
 * ****************************************************
 */

/*
 * ***********************************************
 * ---------------*
 * PHP goes here  *
 * ---------------*
 
 Case 1: Edit -  update user information;
 Case 2: Password - update new password;
 *************************************************
 */

?>
<?php require_once '../config.php';?>

<?php require_once '../includes/html_header.php';?>
<?php require_once '../classes/Redirect.php';?>
<?php 
    if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

    $courseId = $_REQUEST['cid'];
    // check if selected user exists
    if (!courseIdExists($courseId)){
        Redirect::to($qb_url_root.'/course/admin_courses.php?err=That Role does not exist.'); die();
    }
    $courseDetails = getCourseDetails($courseId);
    
   
    // TODO : update the logic to update Role information;
    if (isset($_REQUEST['submitCourse'])){
        /************Case 1: Edit ***********************/
        //updating the modified values;
        if ($courseDetails['name'] != $_REQUEST['rolename'] ){
            if (empty($_POST['rolename'])){
                $GLOBALS['message']='Some of the required field are empty. Nothing updated';
            }else{
                // get value from the form
                $rolename = htmlspecialchars($_REQUEST['rolename'], ENT_QUOTES);
                
                $query = "update tk_roles set rolename='". $rolename ."' where id=" . $courseId .";";
                global $DB;
                if (! mysqli_query($DB, $query)){
                    $GLOBALS['message'] = mysqli_error();
                }else{
                    $GLOBALS['message'] = "Role information is successfully updated.";
                }
            }
        }
        // remove membership
        if (!empty($_POST['removeUser'])){
            $removeUsers = $_POST['removeUser'];
            removeUsers($roleid, $removeUsers);
        }
        if (!empty($_POST['addUser'])){
            $addUsers = $_POST['addUser'];
            addUsers($courseId, $addUsers);
        }
    }
    // get list of subjects belong to Course
    $courseSubjects = getCourseSubjects($courseId);
    
?>
    <div class="container body">
      <div class="main_container">
        <?php require_once $abs_doc_root.$qb_url_root.'/includes/menu.php';?>
        
        <!-- top navigation -->
        <?php   require_once $abs_doc_root.$qb_url_root."/includes/topnavigation.php";  ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>知识点管理</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>课程-知识点</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a class="pull-right" href="#" data-toggle="modal" data-target="#addsubject"><i class="glyphicon glyphicon-plus"></i> 新增知识点</a>
              
                    <div class="col-md-3 col-sm-3 col-xs-12 ">
                      <h3>Course Name</h3>
                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i>Creator</li>
                        
                      </ul>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="col-xs-12 col-sm-12">
                        <table id="paginate" class="table  table-hover table-list-search">
                            <thead>
                             <tr>
                                <th>知识点</th><th>Action</th>
                             </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($courseSubjects as $vl){
                            ?>
                                <tr><td><a class="nounderline row-link" href="admin_course.php?id=<?=$vl['subject_id']?>"><?=$vl['subjectname'] ?></a></td>
                                <td><div class=" action-buttons">
                                
                                
                                <a title="编辑" onclick="getCourseDetails(<?=$vl['subject_id'] ?>)" data-toggle="modal" data-target="#edit_course_modal" data-backdrop="false"
                                    data-href="http://localhost/user/editadvanced.php?id=2&amp;course=<?=$vl['subject_id'] ?>">
                                    <span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>
                                <a title="删除" class="delete_product" data-id="'.$vl['subject_id'].'"  data-toggle="modal" data-target="#delete_course_modal" data-backdrop="false">
                                    <span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></div></td>
                                            
                            <?php } ?>
                            </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

    <!-- Modal dialog for add new subject -->
    <div id="addsubject" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">新增 知识点</h4>
                </div>
                <div class="modal-body">
                    <form id="add_subject_form" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="subject_name" class="col-xs-3">知识点</label>
                            <div class="col-xs-8">
                                <input type="text" id="subject_name" placeholder="" required data-error="Please enter subject name" class="form-control" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnAddSubject">保存</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of add_subject_modal  -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo get_string('title'); ?> 技术支持：Wan Yongquan
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../js/custom.min.js"></script>
  </body>
</html>
