<?php require_once ('config.php');?>
<?php require_once  $abs_doc_root.$qb_url_root.'/helpers/qb_helper.php';?>
<?php require_once  $abs_doc_root.$qb_url_root.'/lib/gongxinglib.php';?>
<?php
error_reporting ( E_ALL );
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_REQUEST['returnurl'])){
        $returnurl = $_REQUEST['returnurl'];
    }
}
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    
    // get username and password from form;
    $username = Input::get ( 'username' );
    $password = Input::get ( 'password' );
    $user = findUser ( $username );
    
    if ($user && $user->varify_password ( $password )) {
        $user->login_user ();
       
        
        if (isset ( $_REQUEST ['returnurl'] )) {
            $returnurl = $_REQUEST ['returnurl'];
        } else {
            $returnurl = 'index.php';
        }
        // redirect to custom login script
        header( "location:$returnurl" );
    } else {
        $_GLOBALS ['message'] = "Username or password is wrong.";
        $error = "Username or password is wrong.";
        ;
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo get_string('title'); ?> </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
          <div class="row">
          <div class="col-xs-12">
              <?php if(!$error=='') {?><div class="alert alert-danger"><?=$error;?></div><?php } ?>
           </div>
         </div>
      <div class="login_wrapper">
        <div class="animate form login_form">

          <section class="login_content">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">欢迎使用<?php echo get_string('title'); ?></h3>
                </div>
                <div class="panel-body">
                
            <form method="post" action="<?php echo htmlspecialchars ( $_SERVER ['PHP_SELF'] );?>" >
              <?php if (isset($returnurl) ){?><input type="hidden" name="returnurl" value="<?=$returnurl ?>">
              <?php } ?>
              <div>
                <input type="text" name="username" class="form-control" placeholder="请输入账号" required />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="请输入密码" required />
              </div>
              <div>
                <button class= "btn btn-primary btn-block" type="submit" name="login">登陆</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              <div class="row">
                
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <a href="admin/forgot_password.php" ><i class="fa fa-wrench"></i>忘记密码? </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <a class="to_register" href="register.php"><i class="fa fa-plus-square"></i> 注册账号</a>
                </div>
                
                </div>

                <div class="clearfix"></div>
                <br />

              </div>
            </form>
            </div>
           </div>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">欢迎使用<?php echo get_string('title'); ?>系统</h3>
                    <p></p>
                </div>
                <div class="panel-body">
                
            <form method="post" action="<?php echo htmlspecialchars ( $_SERVER ['PHP_SELF'] );?>" >
              <div>
                <input type="text" id="username"  name="username" class="form-control" placeholder="请输入账号" required autofocus/>
              </div>
              <!-- <div>
                <input type="email" class="form-control" placeholder="Email" required />
              </div> -->
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="请输入密码" required />
              </div>
              <div>
                <input type="password" id="password2" name="password2" class="form-control" placeholder="请确认密码" required />
              </div>
              <div>
                <input class="btn btn-default submit" type="submit" value="注册"/>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">已有账号？
                  <a href="#signin" class="to_register"> 登陆 </a>
                </p>

                <div class="clearfix"></div>
                <br />

              </div>
            </form>
                        </div>
           </div>
          </section>
        </div>
      </div>
    </div>
    <script src="lib/jquery/jquery-3.1.1.min.js"></script>
    <script src="lib/jqueryvalidation/jquery.validate.js"></script>
    <script>
        $("form").validate();
    </script>
  </body>
</html>



