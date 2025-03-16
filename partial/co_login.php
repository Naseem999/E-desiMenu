<?php
session_start();
include_once 'head.php';
$Err = "";

if (isset($_POST['c_login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if (empty($email) || empty($pass)) {
        $Err = "Fill All the Feilds To Login";
        header("Location:../index.php?error=$Err");
        exit();
    } else {

        $sql = "SELECT * FROM company WHERE email='$email';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch < 1) {
            $Err = "No Such User";
            header("Location:../company_login.php?error=$Err");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {

                //dehashing of password user type
                $hashedPwdCheck = password_verify($pass, $row['pass']);
                if ($hashedPwdCheck == false) {
                    $Err = "Invalid Login Password Not matched";
                    header("Location:../company_login.php?error=$Err");
                } elseif ($hashedPwdCheck == true) {
                    //log in the user in website here creating session verible for user
                        $_SESSION['c_name'] = $row['c_name'];
                        $_SESSION['c_email'] = $row['email'];
                        $_SESSION['c_username'] = $row['username'];
                       
                        header("Location:../index.php?msg=You Are Logged In Successfully");
                  
                    exit();
                }
            }
        }
    }
}
