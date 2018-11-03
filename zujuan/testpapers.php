<?php
/**
 *************************************************************************
 ** WanXin Test Paper Generator System                                  **
 ** Developer: Wan Yongquan                                             **
 ** Title:  Test papers management:                                     **
 ** Function:   edit,delete test papers                                 **
 *************************************************************************
 */

require_once '../config.php';

require_once '../includes/html_header.php';

if (!loginRequired($_SERVER['REQUEST_URI'])){die();}
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
                     <li class=""><i class="fa fa-home"></i> <a href="#"><?=get_string('home') ?></a></li>
                     <li class=""><a href="#"><?=get_string('testpapers') ?></a></li>
                   </ul>
                 </div>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_string('mypapers'); ?></h2>
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
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="paperstable" class="table table-hover">
                          <thead><tr>
                              <th>ID</th>
                              <th><?=get_string('papertitle') ?></th>
                              <th><?=get_string('coursename') ?></th>
                              <th><?=get_string('examduration') ?></th>
                              <th><?=get_string('createdtime') ?></th>
                              <th><?=get_string('operations') ?></th>
                          </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
     <div id="confirmEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=get_string('prompt') ?></h4>
                </div>
                <div class="modal-body">
                    <h5 class="warningtext"><?=get_string('confirmeditpaper') ?> </h5>
                    <p class="warningtext"><span class="red"><?=get_string('editpaperwarning') ?></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-primary btn-ok" onclick="editpaper(this)"><?=get_string('ok'); ?></a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div> <!-- /end of confirmEdit dialog -->
    <!--  Modal dialog for delete paper  -->
    <div id="delete_paper-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">删除试卷</h4>
                </div>
                <div class="modal-body">
                    <p>你确定要删除本试卷吗?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-danger btn-ok" onclick="delete_paper(this)">删除</a>
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
    <!-- FastClick -->
    <script src="<?php echo $qb_url_root?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $qb_url_root?>/vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $qb_url_root?>/js/custom.min.js"></script>
    <script src="../js/pagination/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/pagination/dataTables.js" type="text/javascript"></script>
    <script src="../js/papers.js"></script>
  </body>
</html>
