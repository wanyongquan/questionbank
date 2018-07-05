<?php
include_once 'classes/class.User.php';
require_once 'config.php';
	
	//$user = $_SESSION['loggeduser'];
	$user->logout();
	
	$_SESSION['loggeduser'] = null;
	
	header("Location: login.php");
	
?>