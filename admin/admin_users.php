<?php
/*
 ****************************************************
 ** WanXin Test Paper Generator System            **
 **-----------------------------------------------**
 ** Developer: Wan Yongquan                       **
 ** Title: User Management                        **
 ** Function: Add,Edit,Delete user                **
 ***************************************************
 */

require_once '../config.php';
require_once '../includes/html_header.php';
require_once '../classes/Redirect.php';

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}
// show all users information
$userData = getAllUsers();
$showAllUsers = null;
if (isset($_GET['showAllUsers']) ){
    $showAllUsers = $_GET['showAllUsers'];
}
$form_valid = true;
if (!empty($_POST['addUser'])){
    $username = $_POST['username'];
    $join_date = date("Y-m-d H:i:s");
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm'];
    
    $form_valid = false;
    //Todo: ui input validation 
    if (True){
        $form_valid = true;
        try{
            $password_hash = md5($password);
            $query = sprintf("insert into tk_users (username, fname, lname, email, tel, joindate) values ('%s', '%s', '%s', '%s','%s', '%s');" , $username, $fname, $lname, $email, $tel, $join_date);
            global $DB;
            if (! mysqli_query($DB, $query)){
                $GLOBALS['message'] = mysqli_error($DB);
            }else{
                $newUserId = mysqli_insert_id($DB);
                // add default role Student;
                $addNewRole = sprintf("insert into tk_user_assigned_roles (userid, roleid) values (%d, %d) ;", $newUserId, 3);
                mysqli_query($DB, $addNewRole);
                Redirect::to("admin_user.php?id=". $newUserId);
            }
        }catch(Exception $ex){
            die($e->getMessage());
        }
    }
}
?>
    <div class="container body">
      <div class="main_container">
        <?php require_once $abs_doc_root.$qb_url_root.'/includes/menu.php';?>
        
        <!-- top navigation -->
        <?php   require_once $abs_doc_root.$qb_url_root."/includes/topnavigation.php";  ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
                <div class="row">
            <div class="col-xs-12">
              <?php if(isset($error)) {?><div class="alert alert-danger"><?=$error;?></div><?php } ?>
           </div>
        </div>
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="nav" style="float:left; font-size:16px;">
                   <ul class="breadcrumb">
                     <li class=""><i class="fa fa-home"></i> <a href="<?php echo $qb_url_root?>/index.php"><?=get_string('home'); ?></a></li>
                     <li class=""><a href="#"><?=get_string('usermanagement');?></a></li>
                     
                   </ul>
                </div>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_string('usermanagement');?></h2>
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
                     
                  <!-- Page Heading -->
        <div class="row">
        <div class="col-md-12">
           <div class="row">
              <hr />
              <a class="pull-right" href="#" data-toggle="modal" data-target="#adduser"><i class="glyphicon glyphicon-plus"></i> 新增用户</a>
              <div class="row">
                <div class="col-xs-12">
                  <div class="alluinfo">&nbsp;</div>
                  <div class="allutable">
                     <table id="paginate" class='table table-hover table-list-search'>
                      <thead>
                        <tr>
                          <th>序号</th><th>用户名</th><th>姓名</th><th>邮箱</th>
                          <th>最近登录</th><th>状态</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        //Cycle through users
                        foreach ($userData as $v1) {
                          ?>
                          <tr>
                            <td><a class="nounderline" href='admin_user.php?id=<?=$v1['uid']?>'><?=$v1['uid']?></a></td>
                            
                            <td><a class="nounderline" href='admin_user.php?id=<?=$v1['uid']?>'><?=$v1['username']?></a></td>
                            <td><?=$v1['lname']?>&nbsp;<?=$v1['fname']?> </td>
                            <td><?=$v1['email']?></td>
                            <td><?php if($v1['lastlogin'] != 0) { echo $v1['lastlogin']; } else {?> <i>Never</i> <?php }?></td>
                            
                            
                            <td>
                            <a title="编辑用户信息" href="<?=$qb_url_root ?>/admin/admin_user.php?id=<?=$v1['uid']?>">
                                        <span class="blue"><i class="fa fa-edit bigger-120"></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a title="删除" class="deleteuser" data-id="'.$vl['uid'].'"  data-toggle="modal" data-target="#deleteUser" data-backdrop="false">
                            <span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>  
                   
                  </div>
                </div>
              </div><br>
            </div>
            <!--  Add User modal dialog -->
            <div id="adduser" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">新增用户</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-signup" action="admin_users.php" method="POST" id="payment-form">
                      <div class="panel-body">
                        
                          <label>用户名: </label>&nbsp;&nbsp;<span id="usernameCheck" class="small"></span>
                          <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required>
                          <label>名: </label>
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="请输入名字" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required>
                          <label>姓: </label>
                          <input type="text" class="form-control" id="lname" name="lname" placeholder="请输入姓" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required>
                          <label>邮箱: </label>
                          <input  class="form-control" type="text" name="email" id="email" placeholder="请输入电子邮箱地址" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required >
                           <label>电话: </label>
                          <input  class="form-control" type="text" name="tel" id="tel" placeholder="请输入手机号码" value="<?php if (!$form_valid && !empty($_POST)){ echo $tel;} ?>"  >
                          <label>密码: </label>
                          <div class="input-group" data-container="body">
                            <span class="input-group-addon password_view_control" id="addon1"><span class="glyphicon glyphicon-eye-open"></span></span>
                            <input  class="form-control" type="password" name="password" id="password" value=""  placeholder="请输入密码" required aria-describedby="passwordhelp">
                            
                          </div>
                          <label>再次输入密码: </label>
                          <div class="input-group" data-container="body">
                            <span class="input-group-addon password_view_control" id="addon1"><span class="glyphicon glyphicon-eye-open"></span></span>
                            <input  type="password" id="confirm" name="confirm" value=""  class="form-control" placeholder="请再次输入密码" required >
                            
                          </div>
                         <!--  <label><input type="checkbox" name="sendEmail" id="sendEmail"  /> 发送邮件?</label> -->
                          <br />
                        </div>
                        <div class="modal-footer">
                          <div class="btn-group">
                            <input type="hidden" name="csrf" value="<?=123?>" />
                            <input class='btn btn-primary' type='submit' id="addUser" name="addUser" 
                                value='保存' class='submit' /></div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
     <div id="deleteUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">删除用户</h4>
                </div>
                <div class="modal-body">
                    <p>你确定要删除该用户吗?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteUser(this)">删除</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div> <!-- /end of deleteUser dialog -->
              </div>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

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
   
    <script>
    $(document).ready(function() {
        $('#paginate').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
    } );
    </script>
    <script src="../js/pagination/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/pagination/dataTables.js" type="text/javascript"></script>
  </body>
</html>
