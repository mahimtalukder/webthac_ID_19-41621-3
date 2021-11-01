<?php 
	session_start();

	if (isset( $_SESSION['quiz_no'])) {
        unset($_SESSION['quiz_no']);
    }

	if (isset($_SESSION['course'])) {
        unset($_SESSION['course']);
        header("location:dashboard.php");
	}
	else{
        header("location:dashboard.php");
	}

 ?>