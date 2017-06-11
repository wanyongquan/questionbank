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
<div id="container" class="container">

<div class="no-overflow">
    <div id="page-Rule">
        <h2>组卷规则</h2>
        <p>
       <!-- <div class="singlebutton">
            <form method="get" action="<?php  echo $CFG->wwwroot.'/Rule/editadvanced.php'?>">
            <div><input type="submit"  class="btn btn-success" value="添加课程" /><input type="hidden" name="id" value="-1" /></div></form>
        </div> -->
        <button class="btn btn-success "  data-toggle="modal" data-target="#add_new_Rule_modal"  data-backdrop="false">新增组卷规则</button>
        </p>

        <div class="rulescontent">
                  <!-- getRules() table starts here -->
        </div>
    </div>

    <!--  Modal dialog for add new Rule  -->
    <div id="add_new_rule_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" >
            <!--  Modal dialog content -->
            <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">新增 组卷规则</h4>
                </div>
                <div class="modal-body">
                  <form id="addRuleForm" class="form-horizontal" role="form" method="post" data-toggle="validator">
                     <div class="form-group">
                          <div class="controls">
                            <label for="first_name" class="col-xs-3 col-md-3 control-label">名称</label>
                            <div class="col-xs-6 col-md-6">
                            <input   type="text" id="rulename"
                                class="form-control" required data-error="Please enter Rule name"/>
                            <div class="help-block with-errors"></div>  </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-xs-3 control-label">描述</label>
                            <div class="col-xs-6"> 
                            <input type="text" id="description"
                                class="form-control" /></div>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary" id="btnAddRule"
                            >保存</button>
                    </div> <!-- End of modal footer -->
            </div> <!-- End of modal content -->
        </div> <!-- End of modal dialog -->
    </div> <!-- End of Modal -->
    <!--  end of modal new Rule-->

    <!-- Modal dialog for edit Rule -->
    <div id="edit_rule_modal" class="modal fade"  role="dialog" >
        <div class="modal-dialog" >
            <!-- Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" >编辑组卷规则</h4>
                    <input type="hidden" id="hidden_Rule_id">
                </div>
                <div class="modal-body">
                  <form id="edit_Rule_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                    <div class="form-group">
                        <label for="edit-Rulename" class="col-xs-3">名称</label>
                        <div class="col-xs-6 col-lg-6">
                        <input type="text" id="edit_Rulename"  class="form-control" required/>
                        <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-Ruledescription" class="col-xs-3">描述</label>
                        <div class="col-xs-6 col-lg-6">
                        <input type="text" id="edit_Ruledescription"  class="form-control"/>
                        </div>
                    </div>
                    </form>
                </div> <!-- end of moal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditRule">保存</button>
                </div><!--  end of modal-footer -->
            </div><!--  end of modal content -->
        </div><!--  end of modal dialog -->
    </div><!--  end of modal  -->
    <!--  End of modal dialog for edit Rule -->

       <!--  Modal dialog for delete Rule  -->
    <div id="delete_Rule_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Delete Rule</h4>
                </div>
                <div class="modal-body">
                      <p> Do you really want to delete this Rule?</p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">No</button>
                            <a class="btn btn-danger btn-ok" onclick="deleteRule(this)">Delete</a>
                    </div><!--  end of modal-footer -->
            </div><!--  end of modal-content -->
        </div><!--  end of modal-dialog -->
    </div><!--  end of modal -->
    <!--  end of modal delete Rule-->
    </div>
    </div>
     <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="../lib/jquery/jquery-3.1.1.min.js"></script>
   <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/form-validator.min.js" type="text/javascript"></script>
    <script src="Rule.js"  type="text/javascript"> </script>
    </body>
</html>