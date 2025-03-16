<?php
session_start();
include_once 'partial/head.php';
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    if (isset($_POST['update_admin_submit'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, $_POST['pass']);


        $sql = "SELECT * FROM  admin_tab WHERE id=$admin_id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if (empty($username)) {
            $username = $row['username'];
        }
        if (empty($email)) {
            $email = $row['email'];
        }
        if (empty($pass)) {
            $pass = $row['pass'];
        }


        $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE admin_tab SET username='$username',email='$email',pass='$hashedpwd' WHERE id='$admin_id';";
        mysqli_query($con, $sql);
        header("Location:profile.php?title=Profile&msg=Admin Profile Updated ");
        exit();
    }
} else {
    header("Location:profile.php?title=Profile&error=$Err");
}
