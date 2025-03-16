<?php
session_start();
include_once 'head.php';
$company= $_SESSION['company'];
$t_name="users_".$company;
$Err = "";
if (isset($_POST['company_signup_submit'])) {
    $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_pass = mysqli_real_escape_string($con, $_POST['user_pass']);
    $user_phone = mysqli_real_escape_string($con, $_POST['user_phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    

    if (empty($user_username) || empty($user_email) || empty($user_pass) || empty($user_phone) || empty($address)) {
        $Err = "Fill All the Feilds";
        header("Location:../user_register.php?&error=$Err");
        exit();
    } else {
        $sql = "SELECT * FROM $t_name ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name (
                id int(255) NOT NULL AUTO_INCREMENT,
                user_username varchar(255) NOT NULL,
                user_email varchar(255) NOT NULL,
                user_pass varchar(255) NOT NULL,
                user_phone varchar(255) NOT NULL,
                address varchar(255) NOT NULL,
                balance double(10,2) NOT NULL,
                PRIMARY KEY (id) 
            );";
            mysqli_query($con, $sql);
        }

        $sql = "SELECT * FROM $t_name WHERE user_email='$user_email';";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            header("Location:../user_register.php?error=User Already exsist");
            exit();
        } else {
            $hashedpwd=password_hash($user_pass,PASSWORD_DEFAULT);
            //INSERT USER INTO DATABASE
            $sql = "INSERT INTO $t_name(user_username, user_email,user_pass,user_phone,address,balance) VALUES('$user_username','$user_email','$hashedpwd','$user_phone','$address','0.00');";
            mysqli_query($con, $sql);

            header("Location:../user_login.php?&msg=User Registered");

            exit();
        }
    }
}
