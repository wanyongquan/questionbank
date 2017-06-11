<?php
	require_once 'config.php';
	$user = new User();
	$user->logout();
	
	header("Location: login.php");
	
?>