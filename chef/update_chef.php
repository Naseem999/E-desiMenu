<?php
session_start();
include_once 'partial/head.php';
if (isset($_SESSION['chef_id'])) {

    $chef_id = $_SESSION['chef_id'];
    $company = $_SESSION['company'];
    $t_name3 = "chefs_" . $company;
    if (isset($_POST['update_chef_submit'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, $_POST['pass']);


        $sql = "SELECT * FROM $t_name3 WHERE id='$chef_id';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if (empty($username)) {
            $username = $row['name'];
        }
        if (empty($email)) {
            $email = $row['email'];
        }
        if (empty($pass)) {
            $pass = $row['pass'];
        }


        $sql = "UPDATE $t_name3 SET name='$username',email='$email',pass='$pass' WHERE id='$chef_id';";
        mysqli_query($con, $sql);
        header("Location:profile.php?title=Profile&msg=Chef Profile Updated ");
        exit();
    }
} else {
    header("Location:profile.php?title=Profile&error=$Err");
}
