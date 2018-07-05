<?php
ob_start();


/**
 * Yan Lao Shi Ti Ku
 * An PHP Question Bank Management System
 * @author Wanyongquan
 */

?>
<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';?>
<?php require_once  $abs_doc_root.$qb_url_root.'/lib/gongxinglib.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<title><?php echo get_string('title'); ?></title>
 	<!-- Bootstrap -->
    <link href="<?php echo $qb_url_root?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $qb_url_root?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $qb_url_root?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Table Sorting and Such -->
    <link href="<?=$qb_url_root?>/css/datatables.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $qb_url_root?>/css/custom.min.css" rel="stylesheet"> 
    <link href="<?php echo $qb_url_root?>/css/admin.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script> 
   <!-- jQuery Fallback -->
    <script type="text/javascript">
    if (typeof jQuery == 'undefined') {
        document.write(unescape("%3Cscript src='<?=$qb_url_root?>/js/jquery.js' type='text/javascript'%3E%3C/script%3E"));
    }
    </script>

  </head>

<body class="nav-md">


