<?php

if (isset($_POST['login_submit'])) {
    session_start();
include_once 'head.php';
include_once 'eeEncrypt.php';
$Err = "";

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

                $pwd=$row['pass'];
                $hashedpwd=password_hash($pwd,PASSWORD_DEFAULT);
                //dehashing of password user type
                $hashedPwdCheck = password_verify($pass,$hashedpwd);
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
                        $_SESSION['cid'] = encrypt_url($_SESSION['company']);

                        $admin_email = $_SESSION['admin_email'];
                        $sql = "SELECT * FROM company WHERE email='$admin_email';";
                        $result = mysqli_query($con, $sql);
                        $resultch = mysqli_num_rows($result);
                        if ($resultch > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['c_logo'] = $row['c_logo'];
                        }
                        // =========================================================================================
                        $sql1 = "SELECT * FROM subscriptions WHERE email='$admin_email';";
                        $result1 = mysqli_query($con, $sql1);
                        $resultch1 = mysqli_num_rows($result1);
                        if ($resultch1 > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            $_SESSION['plan'] = $row1['plan'];
                            $_SESSION['plan_id'] = $row1['plan_id'];
                            $_SESSION['plan_status'] = $row1['status'];
                            date_default_timezone_set('Asia/Kolkata');
                            $today_date = date('Y-m-d');
                            if ($row1['end'] == $today_date) {
                                $sql1 = "UPDATE subscriptions SET status='expired' WHERE email='$admin_email';";
                                $result1 = mysqli_query($con, $sql1);
                                $Err = "Your Plan Expired";
                                header("Location:../index.php?error=$Err");
                                exit();
                            }
                        }
                        header("Location:../admin_dash.php?msg=You Are Logged In Successfully");

                        // Super Admin ==========================================================================
                    } elseif ($row['role'] == 1) {
                        header("Location:../super_a/admin_dash.php?msg=You Are Logged In Successfully");
                        $_SESSION['A_id'] = $row['id'];
                        $_SESSION['A_username'] = $row['username'];
                        $_SESSION['A_email'] = $row['email'];
                        $_SESSION['A_company'] = $row['company'];
                        $_SESSION['A_logo'] = "img/lo.png";


                        // $sql1 = "SELECT * FROM subscriptions ";
                        // $result1 = mysqli_query($con, $sql1);
                        // $resultch1 = mysqli_num_rows($result1);
                        // if ($resultch1 > 0) {
                        //     while($row1=mysqli_fetch_assoc($result1)){
                        //         include_once 'phpqrcode/qrlib.php';

                        //         $c_name=$row1['c_name'];
                        //         $menu_url=encrypt_url($c_name);
                        //         $path = '../super_a/img/QR/';
                        //         $file = $path . $c_name . "_QR.png";
                        //         QRcode::png("http://localhost:82/e-desimenu/menu.php?cid=$menu_url", $file, 'L', 10);
                        //     }
                        // }
                    }
                    exit();
                }
            }
        }
    }
}
