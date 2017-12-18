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
<!-- Bootstrap core CSS -->
<link href="<?=$app_root?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="<?=$app_root?>/lib/sb-admin-2/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
<!-- SB Admin 2 CSS -->
<link href="<?=$app_root?>/lib/sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Font Awesome CSS -->
<link href="<?=$app_root?>/lib/sb-admin-2/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Custom css -->
<link href="<?=$app_root?>/css/footer.css" rel="stylesheet">
<link href="<?=$app_root?>/css/all.css" rel="stylesheet">
</head>
<body>
      <?php
    /**
     * *************
     */
    if (isset ( $_GLOBALs ['message'] )) {
        echo "<div class=\"message\">" . $_GLOBALS ['message'] . "</div>";
    }
    ?>
       
      
    <?php
    require_once $abs_doc_root . $app_root . '/include/navigation.php';
    ?>
   
      <div id="container" class="container"></div>
      <?php require_once $abs_doc_root.$app_root.'/include/page_footer.php';?>
      <?php require_once $abs_doc_root.$app_root.'/include/scripts.php';?>
    </body>
</html>