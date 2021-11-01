<?php 
	session_start();
    require_once "Controller/deleteLearnerController.php";
    $obj=new delete();
    $obj->delete_account($_SESSION['username']);
    setcookie("delete_message", "Account Deleted!", time() + 5);

	if (isset($_SESSION['username'])) {
		session_destroy();
		header("location: login.php");
	}
	else{
		header("location: login.php");
	}

 ?>