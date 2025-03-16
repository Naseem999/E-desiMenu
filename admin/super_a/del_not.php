<?php
session_start();
include_once 'partial/head.php';
if(isset($_GET['del_noti_submit'])){
    $company = $_SESSION['A_company'];
$t_name = "notifications_edesimenu";
    $id=$_GET['noti_id'];
    $sql = "DELETE FROM $t_name WHERE id=$id";
    mysqli_query($con, $sql);
        header("Location:notifications.php?title=Notifications&msg=Notification Removed");

}
