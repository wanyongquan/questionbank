<?php
/*
 ****************************************************
 ** WanXin Test Paper Generator System             **
 **------------------------------------------------**
 ** Developer: Wan Yongquan                        **
 ** Title: User Profile                            **
 ** Function: Edit,Password Settings, Role Settings**
 ****************************************************
 */

/* 
 * ***********************************************
 * ---------------*
 * PHP Section    *
 * ---------------*
 
    Case 1: Edit -  update user information;
    Case 2: Password - update new password;
 *************************************************
 */

?>
<?php require_once '../config.php';?>

<?php require_once '../includes/html_header.php';?>
<?php 
    
    if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

    $userId = $_REQUEST['id'];
    // check if selected user exists
    if (!userIdExists($userId)){
        Redirect::to($qb_url_root.'admin_users.php?err=That user does not exist.'); die();
    }
    
    
    if (isset($_REQUEST['saveuser'])){
        /************Case 1: Edit ***********************/
        //updating the modified values;
        if (empty($_REQUEST['username']) || empty($_REQUEST['fname'])){
            $GLOBALS['message']='Some of the required field are empty. Nothing updated';
        }else{
            // get value from the form
            $username = htmlspecialchars($_REQUEST['username'], ENT_QUOTES);
            $fname = htmlspecialchars($_REQUEST['fname'], ENT_QUOTES);
            $lname = htmlspecialchars($_REQUEST['lname'], ENT_QUOTES);
            $email = htmlspecialchars($_REQUEST['email'], ENT_QUOTES);
            $tel = htmlspecialchars($_REQUEST['tel'], ENT_QUOTES);
            
            $query = "update tk_users set username='". $username ."', fname='". $fname ."', lname='" . $lname ."', email='" . $email . "', tel='" . $tel ."' where uid=" . $userId .";";
            global $DB;
            if (! mysqli_query($DB, $query)){
                $GLOBALS['message'] = mysqli_error();
            }else{
                $GLOBALS['message'] = "User information is successfully updated.";
               
                
            }
            
        }
    }
    $userDetails = getUserDetails($userId, NULL);
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
                <div class="nav" style="float:left; font-size:16px;">
                   <ul class="breadcrumb">
                     <li class=""><i class="fa fa-home"></i> <a href="<?php echo $qb_url_root?>/index.php"><?=get_string('home'); ?></a></li>
                     <li class=""><a href="<?php echo $qb_url_root?>/admin/admin_users.php"><?=get_string('usermanagement');?></a></li>
                     <li class=""><a href="#"><?=get_string('userprofile');?></a></li>
                     
                   </ul>
                </div>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_string('userprofile')?></h2>
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
                      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                          <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="img-responsive avatar-view" src="../images/img.jpg" alt="Avatar" title="Change the avatar">
                          </div>
                        </div>
                        <h3> <?php echo $userDetails['username']?></h3>
                        <ul class="list-unstyled user_data">
                          <li> <i class="fa fa-user user-profile-icon"></i>&nbsp; <?=$userDetails['lname']?> <?=$userDetails['fname']?>
                          </li>
                          <li><i class="fa fa-shield user-profile-icon"></i> &nbsp;<?php echo $userDetails['role']?>
                          </li>
                        </ul>
                        <!--  courses -->
                        <h4> 课程</h4>
                        <ul class="list-unstyled user_data">
                          <li>
                            <p> Linux系统与应用</p>
                          </li>
                          <li>
                            <p>移动应用开发</p>
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          
                          <div class="col-xs-12 col-sm-12">
                            <form class="form" id="adminUser" name="adminUser" action="admin_user.php?id=<?=$userId?>" method="post">
                              <div class="panel panel-default">
                                <div class="panel-heading">User ID: <?php echo $userDetails['uid']?></div>
                                <div class="panel-body">
                                  <label><?=get_string('registered')?> </label> <?php echo $userDetails['joindate']?><br/>
                                  <label><?=get_string('lastlogin')?></label> <?php if ( isset($userDetails['lastlogin']) ){echo $userDetails['lastlogin'];} else {?><i>Never</i><?php }?><br/>
                                  <label><?=get_string('username')?></label> 
                                  <input class='form-control' type='text' name='username' value='<?php echo $userDetails['username']?>'><br/>
                                  <label><?=get_string('firstname')?></label>
                                  <input class='form-control' type='text' name='fname' value='<?=$userDetails['fname']?>'/>
                                  <label><?=get_string('lastname')?></label>
                                  <input class='form-control' type='text' name='lname' value='<?=$userDetails['lname']?>'/>
                                  <label><?=get_string('email')?></label>
                                  <input class='form-control' type='text' name='email' value='<?=$userDetails['email']?>'/>
                                  <label><?=get_string('tel')?></label>
                                  <input class='form-control' type='text' name='tel' value='<?=$userDetails['tel']?>'/>
                                  
                                </div>  
                              </div>
                              
                              
                              <div class="panel panel-default">
                                <div class="panel-heading"><?=get_string('securityInfo')?>
                                </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#password"><?=get_string('passwordSettings')?></button>
                                    </div>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roles"><?=get_string('roleSettings')?></button>
                                      </div>
                                  </div>
                                </div>
                              </div>
                                
<div id="password" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?=get_string('updatepassword')?></h4>
      </div>
      <div class="modal-body">
                  <div class="form-group">
                        <label><?=get_string('newpassword')?></label>
                        <input class='form-control' type='password' name='password' />
                  </div>

                  <div class="form-group">
                        <label><?=get_string('confirmpassword')?></label>
                        <input class='form-control' type='password' name='confirm' />
                  </div>
                      <label><input type="checkbox" name="sendPwReset" id="sendPwReset" /> Send Reset Email?</label><br>
                                  
      </div>
      <div class="modal-footer">
          <div class="btn-group"><input class='btn btn-primary' type='submit' value='<?=get_string('save')?>' class='submit' /></div>
         <div class="btn-group"><button type="button" class="btn btn-default" data-dismiss="modal"><?=get_string('close')?></button></div>
      </div>
    </div>

  </div>
</div>                                
                                
                              <div class="pull-right">
                                <div class="btn-group"><input class="btn btn-primary" type="submit" value="<?=get_string('save')?>" name="submit" class="submit"/></div>
                                <div class="btn-group"><a class="btn btn-warning" href="admin_users.php"><?=get_string('cancel')?></a></div><br/><Br/>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div><!--  /xcontent -->
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
