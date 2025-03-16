<?php

    session_start();
    if(isset($_SESSION['c_email'])){
	session_unset();
	session_destroy();
	header("Location:../index.php?error=You are logged out");
    exit();
}
