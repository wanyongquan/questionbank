<?php
/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System
 * @author Wanyongquan
 */
/*
 * This page is user management dashboard. it shows all users in a grid .
 */
require_once '../config.php';

require_once '../includes/html_header.php';

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

$courseData = fetchAllCourses();

?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Administrator</span></a>
            </div>
			
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $qb_url_root?>/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Super Admin</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php require_once "../includes/sidebar.php"?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

         <!-- top navigation -->
        <?php   require_once "../includes/topnavigation.php";  ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>课程管理</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>课程管理<small><i class="ace-icon fa fa-angle-double-right"></i>新增、编辑、删除课程</small></h2>
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
                      <div class="row">
                       <div class="panel panel-default">
                         <div class="panel-heading">Courses
                            <a class="pull-right" href="#" data-toggle="modal" data-target="#add_new_course_modal"><i class="glyphicon glyphicon-plus"></i> 新增课程</a>
              
                         </div>
                         <div class="panel-body">
                           <div class="coursescontent">
                            <!-- TODO：display list of courses here -->
                            <table id="paginate" class="table  table-hover table-list-search">
                                <thead>
                                 <tr>
                                    <th>课程名称</th><th>描述</th><th>Action</th>
                                 </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($courseData as $vl){
                                ?>
                                    <tr><td><a class="nounderline row-link" href="admin_course.php?cid=<?=$vl['course_id']?>"><?=$vl['coursename'] ?></a></td>
                                    <td><a class="nounderline row-link" href="admin_course.php?cid=<?=$vl['course_id']?>"><?=$vl['description'] ?></a></td>
                                    <td><div class=" action-buttons">
                                    <a class="btn btn-warning" href="../admin/admin_subjects.php?cid=<?=$vl['course_id'] ?>">知识点管理</a>
                                    <a class="btn btn-warning" href="../question/admin_questions.php?courseid=<?=$vl['course_id'] ?>">题库管理</a>
                                    
                                    <a class="btn btn-warning" href="../admin/admin_users.php">组卷规则管理</a>
                                    
                                    <a title="编辑" onclick="getCourseDetails(<?=$vl['course_id'] ?>)" data-toggle="modal" data-target="#edit_course_modal" data-backdrop="false"
                                        data-href="http://localhost/user/editadvanced.php?id=2&amp;course=<?=$vl['course_id'] ?>">
                                        <span class="green"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>
                                    <a title="删除" class="delete_product" data-id="<?=$vl['course_id'] ?>"  data-toggle="modal" data-target="#delete_course_modal" data-backdrop="false">
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
          </div>
        </div>
        <!-- /page content -->

    <!--  Modal dialog for add new course  -->
    <div id="add_new_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
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
                                    <input type="text" id="coursename" placeholder="请输入课程名称" class="form-control" required data-error="Please enter course name" />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-xs-3 control-label">描述</label>
                            <div class="col-xs-6">
                                <input type="text" id="description" placeholder="Description" class="form-control" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" id="btnAddCourse">保存</button>
                </div>
                <!-- End of modal-footer -->
            </div>
            <!-- End of modal-content -->
        </div>
        <!-- End of modal-dialog -->
    </div>
    <!--  end of add_new_course_modal-->
    
    <!-- Modal dialog for edit course -->
    <div id="edit_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">编辑 课程</h4>
                    <input type="hidden" id="hidden_course_id">
                </div>
                <div class="modal-body">
                    <form id="edit_course_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                        <div class="form-group">
                            <label for="edit-coursename" class="col-xs-3">课程名称</label>
                            <div class="col-xs-6">
                                <input type="text" id="edit_coursename" placeholder="Course Name" class="form-control" required />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit-coursedescription" class="col-xs-3">描述</label>
                            <div class="col-xs-6">
                                <input type="text" id="edit_coursedescription" placeholder="Description" class="form-control" />
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of moal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditCourse">保存</button>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
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
                    <p>你确定要删除本课程吗?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteCourse(this)">删除</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
    <!--  end of delete_course_modal -->    
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
    <script src="<?php echo $qb_url_root?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $qb_url_root?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
     
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $qb_url_root?>/js/custom.min.js"></script>
    
    <script src="<?php echo $qb_url_root?>/lib/js/bootstrap-validator/validator.min.js"></script>
    
     <!-- Place any per-page javascript here -->
     <!-- Custom Theme Scripts -->
   
     <script src="course.js" type="text/javascript"> </script>
       
    <script>
    $(document).ready(function() {
        $('#paginate').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
    } );
    </script>
    <script src="../js/pagination/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/pagination/dataTables.js" type="text/javascript"></script>
  </body>
</html>
