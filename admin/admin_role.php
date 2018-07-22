<?php
/*
 * ****************************************************
 * ** Yan Lao Shi Question Management System        ***
 * **-----------------------------------------------***
 * ** Developer: Wan Yongquan                       ***
 * ** Title: Role Management                        ***
 * ** Function: Edit role information               ***
 * **           Add, Remove Users;Add,Remove Pages  ***
 * ****************************************************        
 */

/* 
 * ***********************************************
 * ---------------*
 * PHP goes here  *
 * ---------------*
 
    Case 1: Edit -  update Role information;
    Case 2: Remove users;
    Case 3: Add users;
    Case 4: Remove pages;
    Case 5: Add pages
 *************************************************
 */

?>
<?php require_once '../config.php';?>

<?php require_once '../includes/html_header.php';?>


<?php 

   if (!loginRequired($_SERVER['REQUEST_URI'])){die();}

    $roleId = $_REQUEST['id'];
    // check if selected user exists
    if (!roleIdExists($roleId)){
        Redirect::to($qb_url_root.'admin_roles.php?err=That Role does not exist.'); die();
    }
    $roleDetails = getRoleDetails($roleId);
    
   
    // TODO : update the logic to update Role information;
    if (isset($_REQUEST['submitRole'])){
        /************Case 1: Edit ***********************/
        // -------Case 1: updating the modified values;---------
        if ($roleDetails['name'] != $_REQUEST['rolename'] ){
            if (empty($_POST['rolename'])){
                $GLOBALS['message']='Some of the required field are empty. Nothing updated';
            }else{
                // get value from the form
                $rolename = htmlspecialchars($_REQUEST['rolename'], ENT_QUOTES);
                
                $query = "update tk_roles set rolename='". $rolename ."' where id=" . $roleId .";";
                global $DB;
                if (! mysqli_query($DB, $query)){
                    $GLOBALS['message'] = mysqli_error();
                }else{
                    $GLOBALS['message'] = "Role information is successfully updated.";
                }
            }
        }
        // --------Case 2: remove membership--------
        if (isset($_POST['removeUser'])){
            $removeUsers = $_POST['removeUser'];
            removeUsers($roleid, $removeUsers);
        }
        // --------Case 3: add assigned user---------
        if (isset($_POST['addUser'])){
            $addUsers = $_POST['addUser'];
            addUsers($roleId, $addUsers);
        }
        // --------Case 4: remove pages for role-------
        if (isset($_POST['removePage'])){
            $removePages = $_POST['removePage'];
            removePages($roleId, $removePages);
        }
        
        // --------Case 5: add pages for role---------- 
        if (isset($_POST['addPage'])){
            $addPages = $_POST['addPage'];
            addPages($roleId, $addPages);
        }
    }
    // get list of users belong to Role
    $roleUsers = getRoleUsers($roleId);
    
    // get list of pages with this Role access
    $rolePages = getRolePages($roleId);
    
    // get all users;
    $userData = getAllUsers();
    
    // get all pages;
    $pageData = getAllPages();
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
                <h3>Page Title</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Role</h2>
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
                        <div class="col-xs-12">
                          <h1>Configure settings for this Role</h1>
                          <form name="roleForm" action="<?=$_SERVER['REQUEST_URI']?>?id=<?=$roleId?>" method="post">
                            <input name="submitRole" class="btn btn-primary" type="submit"  value="Update Role" class="submit"/>
                            
                            <a class="btn btn-warning" href="admin_roles.php">Cancel</a><br><br>
                          
                          <div  class="col-xs-6">
                            <h3>Role Information</h3>
                            <div>
                             <label>Role ID:</label> <?php echo $roleDetails['id']?><br>
                             <label>Role Name:</label>
                             <input  type='text' name='rolename' value='<?php echo $roleDetails['name']?>'><br/>
                                  
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <h3> Role Membership</h3>
                             <div id="regbox">
                               <p><strong> Remove Members:</strong>
                               <?php 
                                 $role_userIDs = [];
                                 foreach($roleUsers as $value){
                                    $role_userIDs[] = $value['userid'];
                                 }
                                 foreach($userData as $value){
                                     if (in_array($value['uid'], $role_userIDs)){?>
                                     <br><label class="normal"><input type="checkbox" name="removeUser[]" id="removeUser[]" value="<?=$value['uid'] ?>"> <?= $value['username']?></label>
                                  <?php
                                     }
                                 }
                               ?>
                               </p><strong>Add Members:</strong>
                               <?php 
                                 $role_userIDs = [];
                                 foreach($roleUsers as $value){
                                    $role_userIDs[] = $value['userid'];
                                 }
                                 foreach($userData as $value){
                                     if (!in_array($value['uid'], $role_userIDs)){?>
                                     <br><label class="normal"><input type="checkbox" name="addUser[]" id="addUser[]" value="<?=$value['uid'] ?>"> <?= $value['username']?></label>
                                  <?php
                                     }
                                 }
                               ?>
                             </div>
                          </div>
                        
                        <div class="col-xs-12">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              Role Access
                            </div>
                            <div class="panel-body">
                               <div class="col-xs-6">
                                 <div id="regbox">
                                   <p> <br><strong> Remove Page Access for this Role:</strong>
                                    <?php 
                                    // display list of pages with this role access
                                    $page_Ids = [];
                                    foreach($rolePages as $value){
                                        $page_Ids[] = $value['pageid'];
                                    }
                                    foreach($pageData as $value){
                                        if (in_array($value['id'], $page_Ids)){?>
                                        <br><label class="normal"><input type="checkbox" name="removePage[]" id="removePage[]" value="<?=$value['id'] ?>"> <?= $value['pagepath']?></label>
                                      <?php
                                         }
                                    }
                                    ?>
                                   </p>
                                 </div>
                               </div>
                               <div class="col-xs-6">
                                 <div id="regbox">
                                  <p><br><strong>Add Pages access for Role:</strong>
                                   <?php 
                                     $page_Ids = [];
                                     foreach($rolePages as $value){
                                         $page_Ids[] = $value['pageid'];
                                     }
                                     foreach($pageData as $value){
                                         if (!in_array($value['id'], $page_Ids)){?>
                                         <br><label class="normal"><input type="checkbox" name="addPage[]" id="addPage[]" value="<?=$value['id'] ?>"> <?= $value['pagepath']?></label>
                                      <?php
                                         }
                                     }
                                   ?></p>
                                 </div>
                               </div>
                            </div>
                          </div>
                        </div>
                         </form>
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
