<?php
$page_title = "题库系统";
$page_keywords = "Question Exam";
$page_desc = "Online Question Bank";

// inlucde("header.inc");

require_once ('config.php');

error_reporting ( E_ALL );
$error = "";

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    // get username and password from form;
    $username = Input::get ( 'username' );
    $password = Input::get ( 'password' );
    $user = new User ();
    $login = $user->login ( $username, $password );
    if ($login) {
        // redirect to custom login script
        header ( "location: index2.php" );
    }
    
    $mypassword = md5 ( htmlspecialchars ( $_REQUEST ['password'], ENT_QUOTES ) );
    
    $sql = "select uid from tk_users where username='$username' and password='$mypassword'";
    $result = mysqli_query ( $DB, $sql );
    
    $count = mysqli_num_rows ( $result );
    // if username and password matchs, result row must be 1 row;
    if ($count == 1) {
        // session_register("myusername");
        while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
            $_SESSION ['userid'] = $row ['uid'];
            $_SESSION ['username'] = $username;
        }
        
        header ( "location:index2.php" );
    } else {
        $error = "Username or password is wrong.";
    }
}

?>

<?php
require_once '/include/header.php';
// require_once $abs_doc_root.$app_root.'/include/navigation.php';
?>

    <nav class="navbar navbar-default nav-bar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <img style="margin: 10px 2px 2px 10px; float: left;" height="53" width="80" src="<?php echo $CFG->wwwroot.'/images/question.png'?>" alt="question bank" />
            <a class="navbar-brand" href="index2.php">燕老师题库</a>
        </div>
        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-right">
            <ul class="nav navbar-top-links">
          
          <?php if ($user->isLoggedIn() ){ //if logged in?>
          <li>
                    <a href="#">
                        <i class="fa fa-fw fa-user"></i><?=$user->username() ?></a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#">
                                <i class="fa fa-user fa-fw"></i>账号设置
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-gear fa-fw"></i>个人主页
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo $CFG->wwwroot?>/logout.php">
                                <i class="fa fa-sign-out fa-fw"></i>退出
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <?php } else { // no one is logged in, display default items?>
              <li>
                    <a href="<?=$CFG->wwwroot?>/login.php" class="">
                        <i class="fa fa-sign-in"></i>Login
                    </a>
                </li>
           <?php } ?>
        </ul>
            <!-- End of UL for navigation  -->
        </div>
        <!-- /.navbar-top-links -->
    </nav>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <form class="form-signin" role="form" action="<?php
            
            echo htmlspecialchars ( $_SERVER ['PHP_SELF'] );
            ?>" method="post">
                <h2 class="form-signin-heading">欢迎使用燕老师题库</h2>
                <h4 class="form-signin-heading"><?php echo $error; ?></h4>
                <label for="inputEmail">用户名:</label>
                <input type="text" id="inputEmail" class="form-control" name="username" placeholder="username" required autofocus>
                <label for="inputPassword">密码:</label>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="password" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me">记住登录状态
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">登录</button>
            </form>
        </div>
    </div>
<div style="font-size: 11px; color: #cc0000; margin-top: 10px"><?php echo $error; ?></div>
<?php require_once $abs_doc_root.$app_root.'/include/page_footer.php';?>
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
