<?php
	$page_title="Question Bank";
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
		
		
		$sql = "select uid from user where username='$myusername' and password='$mypassword'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		//$active = $row['active'];
		
		$count = mysqli_num_rows($result);
		// if username and password matchs, result row must be 1 row;
		if ($count ==1 ){
			//session_register("myusername");
			$_SESSION['loggedin_user'] = $myusername;
			
			header("location:welcome.php");
		}else{
			$error = "Username or password is wrong.";
			
		}
		
	}

?>
<html lang="en">
  <head>
  	<title><?php echo $page_title?></title>
  	<link href="css/bootstrap.css" rel="stylesheet">
  </head>
  
  <body>
   <div class="container">
    
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               <form class = "form-signin" role = "form" 
		            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
		            ?>" method = "post">
		            <h4 class = "form-signin-heading"><?php echo $error; ?></h4>
		            <label>UserName  :</label><br>
		            <input type = "text" class = "form-control" 
		               name = "username" placeholder = "username = admin" 
		               required autofocus></br>
		            <label>Password  :</label><br>
		            <input type = "password" class = "form-control"
		               name = "password" placeholder = "password = 1234" required><br>
		            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
		               name = "login">Login</button>
		         </form>
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         
			
      </div>
  </body>
</html>
