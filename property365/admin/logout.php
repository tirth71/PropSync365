<?php
	require("conection.php");
	$obj=new Config();
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin']);
	$obj->redirect("login.php");
?>