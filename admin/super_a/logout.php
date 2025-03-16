<?php

    session_start();
    if(isset($_SESSION['A_id'])){
	session_unset();
	session_destroy();
	header("Location:../index.php?error=You are logged out");
    exit();
}
