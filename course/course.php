<?php
    include('../session.php');
    error_reporting(0);
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
    </head>
   <body>
    <?php
    /****************/
    if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
    }
    ?>
<div id="container" class="container">

    <div class="nav">
        <form name="frmcourse" action="course.php" method="post">

                    <?php if (isset($_SESSION['username'])){?>

                    <?php include '../include/menus.php';?>
                    <?php }?>

        </form>

    </div>
<div class="no-overflow">
    <div id="page-course">
        <h2>Coureses</h2>
        <p>
       <!-- <div class="singlebutton">
            <form method="get" action="<?php  echo $CFG->wwwroot.'/course/editadvanced.php'?>">
            <div><input type="submit"  class="btn btn-success" value="添加课程" /><input type="hidden" name="id" value="-1" /></div></form>
        </div> -->
        <button class="btn btn-success "  data-toggle="modal" data-target="#add_new_course_modal"  data-backdrop="false">新增课程</button>
        </p>

        <div class="coursescontent">
        <table class="table table-striped">
            <thread>
             <tr>
                <th>Course name</th>
                <th>Description</th>
                <th>Operations</th>
             </tr>
            </thread>
            <tbody>
                <tr>
                    <td>Linux core</td>
                    <td>deep inside the linux operation system.</td>
                    <td><a title="Edit"
                        href="http://localhost/user/editadvanced.php?id=2&amp;course=1"><img
                            src="<?php echo $CFG->wwwroot.'/images/gear.png'?>"
                            alt="edit" class="iconsmall" /></a></td>
                 </tr>
                 <tr>
                     <td>Java programming</td>
                     <td>learn how to programming with java</td>
                     <td><a title="Edit"
                        href="http://localhost/user/editadvanced.php?id=2&amp;course=2"><img
                            src="<?php echo $CFG->wwwroot.'/images/gear.png'?>"
                            alt="edit" class="iconsmall" /></a></td>
                  </tr>
                  <tr>
                     <td>PHP MySql Web site development</td>
                     <td>develop a dynamic web site with PHP and mysql</td>
                     <td><a title="Edit"
                        href="http://localhost/user/editadvanced.php?id=2&amp;course=2"><img
                            src="<?php echo $CFG->wwwroot.'/images/gear.png'?>"
                            alt="edit" class="iconsmall" /></a></td>
                  </tr>
                  <!-- getCourses() -->
            </tbody>
        </table>
        </div>
    </div>

    <!--  Modal dialog for add new course  -->
    <div id="add_new_course_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Add New Course</h4>
                </div>
                <div class="modal-body">
                      <div class="form-group">
                            <label for="first_name">Course Name</label> <input
                                type="text" id="coursename"
                                placeholder="Course Name"
                                class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="last_name">Description</label> <input
                                type="text" id="description"
                                placeholder="Description"
                                class="form-control" />
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="addCourse()">Add Record</button>
                    </div>
            </div>
        </div>
    </div>
    <!--  end of modal new course-->

    <!-- Modal dialog for edit course -->
    <div id="edit_course_modal" class="modal fade"  role="dialog" >
        <div class="modal-dialog" >
            <!-- Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" >Edit course</h4>
                    <input type="hidden" id="hidden_course_id">
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-coursename">Course Name</label>
                        <input type="text" id="edit_coursename" placeholder="Course Name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="edit-coursedescription">Description</label>
                        <input type="text" id="edit_coursedescription" placeholder = "Description" class="form-control"/>
                    </div>
                </div> <!-- end of moal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateCourseDetails()">Save</button>
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
                    <h4 class="modal-title"> Delete Course</h4>
                </div>
                <div class="modal-body">
                      <p> Do you really want to delete this course?</p>

                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary btn-ok" id="btnConfirmDel"
                            onclick="deleteCourse(this);">Delete</button>
                            <a class="btn btn-danger btn-ok" onclick="deleteCourse(this)">Delete</a>
                    </div>
            </div>
        </div>
    </div>
    <!--  end of modal delete course-->
    </div>
    </div>
     <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="course.js"  type="text/javascript"> </script>
    </body>
</html>