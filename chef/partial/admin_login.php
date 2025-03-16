<?php
session_start();
include_once 'head.php';
$Err = "";

if (isset($_POST['login_submit'])) {
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if (empty($uname) || empty($pass)) {
        $Err = "Fill All the Feilds To Login";
        header("Location:../index.php?error=$Err");
        exit();
    } else {

        $sql = "SELECT * FROM admin_tab WHERE username='$uname';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch < 1) {
            $Err = "No Such User";
            header("Location:../index.php?error=$Err");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {

                //dehashing of password user type
                $hashedPwdCheck = password_verify($pass, $row['pass']);
                if ($hashedPwdCheck == false) {
                    $Err = "Invalid Login Password Not matched";
                    header("Location:../index.php?error=$Err");
                } elseif ($hashedPwdCheck == true) {
                    //log in the user in website here creating session verible for user

                    if ($row['role'] == 0) {
                        $_SESSION['admin_id'] = $row['id'];
                        $_SESSION['admin_username'] = $row['username'];
                        $_SESSION['admin_email'] = $row['email'];
                        $_SESSION['company'] = $row['company'];
                        
                        $admin_email=$_SESSION['admin_email'];
                        $sql = "SELECT * FROM company WHERE email='$admin_email';";
                        $result = mysqli_query($con, $sql);
                        $resultch = mysqli_num_rows($result);
                        if ($resultch >0) {
                          $row=mysqli_fetch_assoc($result);
                          $_SESSION['c_logo']=$row['c_logo'];
                          
                        }

                        header("Location:../admin_dash.php?msg=You Are Logged In Successfully");
                    } elseif ($row['role'] == 1) {
                        header("Location:../Admin/hello.php?msg=You Are Logged In Successfully");
                        $_SESSION['A_id'] = $row['id'];
                        $_SESSION['A_username'] = $row['username'];
                        $_SESSION['A_email'] = $row['email'];
                        $_SESSION['A_company'] = $row['company'];
                        $_SESSION['A_logo'] = $row['company_logo'];
                    }
                    exit();
                }
            }
        }
    }
}
