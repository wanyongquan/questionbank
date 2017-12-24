<?php
include_once ('../config.php');

error_reporting ( 1 );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>燕子题库</title>
<!-- Bootstrap core CSS -->
<link href="../lib/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="../lib/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
<!-- SB Admin 2 CSS -->
<link href="../lib/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
<!-- Font Awesome CSS -->
<link href="../lib/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Custom css -->
<link href="../css/footer.css" rel="stylesheet">
<link href="../css/all.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php
        require_once $abs_doc_root . $app_root . '/include/navigation.php';
        ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">知识点管理</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            知识点
                            <div class="pull-right">
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_subject_modal" data-backdrop="false">新增知识点</button>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="subject_content">
                                        <!-- subject content table starts here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.page-wrapper -->
    </div>
    <!-- /.wrapper -->
    <!-- Modal dialog for add new subject -->
    <div id="add_subject_modal" class="modal fade" role="dialog">
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
                        <div class="form-group">
                            <label for="qitem_course_id" class="col-xs-3">课程</label>
                            <div class="col-sm-8">
                                <select id="qitem_course_id" name="qitem_course_id" class="form-control ">
                                    <option value="">请选择课程</option>
                                        <?php
                                        $courses = getCourses ();
                                        if ($courses->num_rows > 0) {
                                            foreach ( $courses as $course ) {
                                                $courseselected = ($course_id == $course ['course_id']) ? "selected" : "";
                                                echo '<option value="' . $course ['course_id'] . '" ' . $courseselected . ' >' . $course ['course_name'] . '</option>';
                                            }
                                        }
                                        ?>    
                                     </select>
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
    <!-- End of Modal  -->
    <!-- Modal dialog for edit subject -->
    <div id="edit_subject_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">编辑 知识点</h4>
                    <input type="hidden" id="hidden_subject_id">
                </div>
                <div class="modal-body">
                    <form id="edit_subject_form" class="form-horizontal" role="form" method="post" data-toggle="validator">
                        <div class="form-group">
                            <label for="edit_subject_name" class="col-xs-3">知识点名称</label>
                            <div class="col-xs-8">
                                <input type="text" id="edit_subject_name" placeholder="" required data-error="Please enter subject name" class="form-control" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnEditSubject">保存</button>
                </div>
                <!-- End of modal footer -->
            </div>
            <!-- End of modal content -->
        </div>
        <!-- End of modal dialog -->
    </div>
    <!-- End of Modal  -->
    <!--  Modal dialog for delete subject  -->
    <div id="delete_subject_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal dialog content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">删除知识点</h4>
                    <input type="hidden" id="hidden_edit_subject_id">
                </div>
                <div class="modal-body">
                    <p>确定要删除该知识点吗?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-danger btn-ok" onclick="deleteSubject()">删除</a>
                </div>
                <!--  end of modal-footer -->
            </div>
            <!--  end of modal-content -->
        </div>
        <!--  end of modal-dialog -->
    </div>
    <!--  end of modal -->
    <!--  end of modal delete subject-->
    <!-- jQuery -->
    <script src="<?=$qb_url_root?>/lib/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=$qb_url_root?>/lib/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Sb Admin 2 Theme JavaScript -->
    <script src="<?=$qb_url_root?>/lib/sb-admin-2/js/sb-admin-2.js"></script>
    <!-- Form validation JavaScript -->
    <script src="<?=$qb_url_root?>/script/form-validator.min.js" type="text/javascript"></script>
    <script src="subject.js" type="text/javascript"></script>
</body>
</html>