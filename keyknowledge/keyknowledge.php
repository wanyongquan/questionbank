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
    </head>
   <body>
    <?php
    /****************/
    if (isset($_GLOBALs['message'])){
        echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
    }
    ?>
        <div class="container">
          <div class="nav">
            <form name="frmknowledge"  method="post">

                        <?php if (isset($_SESSION['username'])){?>

                        <?php include '../include/menus.php';?>
                        <?php }?>

            </form>
            <div class="page-knowledge">
                <h2>Key Knowledge</h2>
                <div><button class="btn btn-success" data-toggle="modal" data-target="#add_keyknowledge_modal" data-backdrop="false">新增知识点</button></div>
            </div>
            <div class="knowledge_content">
                <!-- knowledge content table starts here -->
            </div>
          </div>
          <!-- Modal dialog for add new keyknowledge -->
          <div id="add_keyknowledge_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!--  Modal dialog content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <buton type="button" class="close" data-dismiss="modal">&times;</buton>
                        <h4 class="modal-title">Add New 知识点</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="knowledge_name">Knowledge Name</label>
                            <input type="text" id="knowledge_name" placeholder="" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="addKnowledge()">Add Knowledge</button>
                    </div> <!-- End of modal footer -->
                </div><!-- End of modal content -->
            </div> <!-- End of modal dialog -->
          </div> <!-- End of Modal  -->
          <!-- Modal dialog for edit keyknowledge -->
          <div id="edit_keyknowledge_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!--  Modal dialog content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <buton type="button" class="close" data-dismiss="modal">&times;</buton>
                        <h4 class="modal-title">edit  知识点</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="knowledge_name">Knowledge Name</label>
                            <input type="text" id="knowledge_name" placeholder="" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="addKnowledge()">Save</button>
                    </div> <!-- End of modal footer -->
                </div><!-- End of modal content -->
            </div> <!-- End of modal dialog -->
          </div> <!-- End of Modal  -->
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>