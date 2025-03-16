<?php
session_start();
include_once 'head.php';
$company= $_SESSION['company'];
$t_name="users_".$company;
$Err = "";

if (isset($_POST['u_login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if (empty($email) || empty($pass)) {
        $Err = "Fill All the Feilds To Login";
        header("Location:../user_login.php?error=$Err");
        exit();
    } else {

        $sql = "SELECT * FROM $t_name WHERE user_email='$email';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch < 1) {
            $Err = "No Such User";
            header("Location:../user_login.php?error=$Err");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {

                //dehashing of password user type
                $hashedPwdCheck = password_verify($pass, $row['user_pass']);
                if ($hashedPwdCheck == false) {
                    $Err = "Invalid Login Password Not matched";
                    header("Location:../user_login.php?error=$Err");
                } elseif ($hashedPwdCheck == true) {
                    //log in the user in website here creating session verible for user
                        $_SESSION['user_email'] = $row['user_email'];
                        $_SESSION['user_username'] = $row['user_username'];
                        // echo $_SESSION['user_email'];
                        // echo $_SESSION['user_username'];
                       
                        header("Location:../menu.php?msg=You Are Logged In Successfully");
                  
                    exit();
                }
            }
        }
    }
}
