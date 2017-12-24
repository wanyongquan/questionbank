<?php
include ('session.php');
error_reporting ( 0 );

if (! isset ( $_SESSION ['username'] )) {
    $_GLOBALS ['message'] = 'Session Timeout. Click here to <a href=\"login.php\">Log in</a>';

} else if (isset ( $_REQUEST ['logout'] )) {
    unset ( $_SESSION ['username'] );
    $_GLOBALs ['message'] = "You are logged out.";
    header ( 'Location:' . $CFG->wwwroot . '/login.php' );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>燕子题库</title>
    <!-- Bootstrap core CSS -->
    <link href="lib/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="lib/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="lib/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="lib/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom css -->
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php
        require_once $abs_doc_root . $app_root . '/include/navigation.php';
        ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">仪表盘</h1>
                </div>
            </div>
        </div>
        <!-- /.page-wrapper -->
    </div>
    <!-- /.wrapper -->
    
    <!-- jQuery -->
    <script src="lib/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="lib/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="lib/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Sb Admin 2 Theme JavaScript -->
    <script src="lib/sb-admin-2/js/sb-admin-2.js"></script>
    </body>
</html>