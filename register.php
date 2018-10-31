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
    $passwordcfm = Input::get('passwordcfm');
    // step 1: check if username been used ever;
    $user = findUser ( $username );
    if ($user != null){
        $error = "用户名已经存在！请选择其他用户名。";
    }else{
    
    // step 2: register as valid user;
        //$error="test";
        $password_hash = md5($password);
        addUser($username, $password_hash);
        $user = findUser ( $username );
        $user->login_user();
        header ( "location:index.php" );
        //login the user and  redirect to home page
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
    <div class="container">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
          
      <div class="login_wrapper">
            <div class="row">
          <div class="col-xs-12">
              <?php if(!$error=='') {?><div class="alert alert-danger"><?=$error;?></div><?php } ?>
           </div>
         </div>

        <div id="register" class="animate form ">
          <section class="login_content">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">欢迎使用<?php echo get_string('title'); ?></h3>
                    <p></p>
                </div>
                <div class="panel-body">
                
            <form method="post" id="registerform" action="<?php echo htmlspecialchars ( $_SERVER ['PHP_SELF'] );?>" >
              
              <div>
                <input type="text" id="username"  name="username" class="form-control" placeholder="账号" required autofocus/>
              </div>
              <!-- <div>
                <input type="email" class="form-control" placeholder="Email" required />
              </div> -->
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="密码" required />
              </div>
              <div>
                <input type="password" id="passwordcfm" name="passwordcfm" class="form-control" placeholder="确认密码" required />
              </div>
              <div>
                <button class="btn btn-primary submit btn-block" type="submit" >注册</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">已有账号？
                  <a href="login.php" class="to_register"> 登陆 </a>
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

    <script src="js/register.js"></script>
  </body>
</html>



