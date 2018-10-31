<?php
/*
 *  Zhixing TIKU
 *  A Question Management and Test Paper Generator System
 *
 *  Developer: Wan Yongquan
 *  Copyright: 2018
 */
?>
<?php  require_once '../config.php';?>
<?php require_once '../includes/html_header.php';?>
<?php 
    global $user ;
     
    $userDetails = getUserDetails($user->_id, NULL);
    
    if (!empty($_POST)){
        // Form posted
        if ($user->_fname != $_POST['fname']){
            $fname = ucfirst(Input::get("fname"));
            
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
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="nav" style="float:left; font-size:16px;">
                   <ul class="breadcrumb">
                     <li class=""><i class="fa fa-home"></i> <a href="#"><?=get_string('home'); ?></a></li>
                     <li class=""><a href="#">用户信息</a></li>
                     
                   </ul>
                </div>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2></h2>
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
                   <div class="col-md-2 col-sm-2 col-xs-12 profile_left">
                        <div class="profile_img">
                          <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="img-responsive avatar-view" src="../images/img.jpg" alt="Avatar" title="Change the avatar">
                          </div>
                        </div>
                        <h3> <?php echo $userDetails['username']?></h3>
                        <ul class="list-unstyled user_data">
                          <li> <i class="fa fa-map-marker user-profile-icon"></i> <?=$user->_firstname ?> . <?=$user->_lastname ?>
                          </li>
                          <li><i class="fa fa-briefcase user-profile-icon"></i><?php echo $userDetails['role']?>
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
                      <div class="col-md-10 col-sm-10 col-xs-12">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="alert alert-danger" style="display:none"><ul id="alert-errors"><li>First name updated.</li></ul></div>
                                        <div class="alert alert-success" style="display:none"><ul id="alert-msg"></ul></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                          
                              <div class="panel panel-default">
                                <div class="panel-heading">用户信息设置</div>
                                <div class="panel-body">
                                <form class="form" id="editUserForm" name="editUserForm"  method="post">
                                    <div class="form-group">
                                        <label> 注册时间: </label> <?php echo $userDetails['joindate']?><br/>
                                        <label>最新登录:</label> <?php if ( isset($userDetails['lastlogin']) ){echo $userDetails['lastlogin'];} else {?><i>Never</i><?php }?><br/>
                                    </div>
                                    <div class="form-group">
                                        <label>用户名:</label> 
                                        <input class='form-control' type='text' name='username' value='<?php echo $user->_username?>' readonly><br/>
                                    </div>
                                     <div class="form-group">
                                      <label>姓:</label>
                                      <input class='form-control' type='text' id="fname" name='fname' value='<?=$userDetails['fname']?>'/>
                                       </div>
                                   <div class="form-group">
                                      <label>名:</label>
                                      <input class='form-control' type='text' id="lname" name='lname' value='<?=$userDetails['lname']?>'/>
                                       </div>
                                   <div class="form-group">
                                      <label>邮箱:</label>
                                      <input class='form-control' type='text' id="email" name='email' value='<?=$userDetails['email']?>'/>
                                   </div>
                                   <div class="form-group">
                                      <label>电话:</label>
                                      <input class='form-control' type='text' id="tel" name='tel' value='<?=$userDetails['tel']?>'/>
                                  </div>
                                  <div class="form-group">                          
                                      <div class="pull-right command-block" >
                                        <div class="btn-group"><input class="btn btn-primary" type="submit" value="保存" name="btnsaveuser" class="submit"/></div>
                                       
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                             
                              </form>
                              
                                </div> 
                                                                
                              </div>
                             
                            
                          </div>
                         
                          <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">安全信息
                                </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#password">修改密码</button>
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
          </div>
        </div>
        <!-- /page content -->
        <div id="password" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                            data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?=get_string('updatepassword')?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?=get_string('oldpassword')?></label>
                            <input class='form-control' type='password'
                                name='old-password' />
                        </div>
                        <div class="form-group">
                            <label><?=get_string('newpassword')?></label>
                            <input class='form-control' type='password'
                                name='password' />
                        </div>
                        <div class="form-group">
                            <label><?=get_string('confirmpassword')?></label> <input
                                class='form-control' type='password'
                                name='confirm' />
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <input
                                class='btn btn-primary'
                                type='submit'
                                value='<?=get_string('save')?>'
                                class='submit' />
                        </div>
                        <div class="btn-group">
                            <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal"><?=get_string('close')?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="<?php echo $qb_url_root?>/lib/bootstrap-validator/validator.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>
