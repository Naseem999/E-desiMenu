<?php

    session_start();
    include_once '../eeEncrypt.php';
    $incry = $_SESSION['company'];
    $company=encrypt_url($incry);
    if(isset($_SESSION['user_email'])){
	session_unset();
	session_destroy();
	header("Location:../menu.php?cid=$company");
    exit();
}
