<?php
	$page_title="题库系统";
	$page_keywords="Question Exam";
	$page_desc="Online Question Bank";

	//inlucde("header.inc");

	include ('config.php');
	ob_start();
	session_start();

	error_reporting(E_ALL);
	$error = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// get username and password from form;
		$myusername = mysqli_real_escape_string($db, $_POST['username']);
		//$mypassword = mysqli_real_escape_string($db, $_POST['password']);
		$mypassword = md5(htmlspecialchars($_REQUEST['password'],ENT_QUOTES));

		$sql = "select uid from tk_users where username='$myusername' and password='$mypassword'";
		$result = mysqli_query($DB, $sql);

		$count = mysqli_num_rows($result);
		// if username and password matchs, result row must be 1 row;
		if ($count ==1 ){
			//session_register("myusername");
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			    $_SESSION['userid'] = $row['uid'];
			    $_SESSION['username'] = $myusername;
			}

			header("location:welcome.php");
		}else{
			$error = "Username or password is wrong.";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
  	<title><?php echo $page_title?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">

  	<link href="css/bootstrap.css" rel="stylesheet">
  </head>

  <body>
   <div class="container">
		<div class="header">
            <?php require'/include/header.php';?>
        </div>

               <form class = "form-signin" role = "form"
		            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
		            ?>" method = "post">
                    <h2 class="form-signin-heading">Please Sign in</h2>
		            <h4 class = "form-signin-heading"><?php echo $error; ?></h4>
		            <label for="inputEmail" >用户名:</label>
		            <input type = "text"  id="inputEmail" class = "form-control"
		               name = "username" placeholder = "username"
		               required autofocus>
		            <label for="inputPassword" >密码:</label>
		            <input type = "password"  id="inputPassword" class = "form-control"
		               name = "password" placeholder = "password" required>
                       <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me">Remember me
                            </label>
                       </div>
		            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
		               name = "login">登录</button>
		         </form>
              <!--
              <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
                -->
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

      </div>
  </body>
</html>
