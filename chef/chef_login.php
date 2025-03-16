<?php
session_start();
include_once 'partial/head.php';
$Err = "";

if (isset($_POST['chef_login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $company_name = mysqli_real_escape_string($con, $_POST['company_name']);

    if (empty($email) || empty($pass) || empty($company_name)) {
        $Err = "Fill All the Feilds To Login";
        header("Location:index.php?error=$Err");
        exit();
    } else {
        $t_name = "chefs_" . $company_name;

        $sql = "SELECT * FROM $t_name WHERE email='$email';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch < 1) {
            $Err = "Invalid Login";
            header("Location:index.php?error=$Err");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {

                //dehashing of password user type

                if ($pass == $row['pass']) {
                    //log in the user in website here creating session verible for user
                    $sql = "SELECT * FROM company WHERE c_name='$company_name';";
                    $result = mysqli_query($con, $sql);
                    $resultch = mysqli_num_rows($result);
                    if ($resultch > 0) {
                        $row1 = mysqli_fetch_assoc($result);
                        $_SESSION['c_logo'] = $row1['c_logo'];
                        $_SESSION['company'] = $row1['c_name'];
                    }

                    $_SESSION['chef_id'] = $row['id'];
                    $_SESSION['chef_email'] = $row['email'];
                

                    header("Location:chef_dash.php?login=You Are Logged In Successfully");
                    exit();
                } else {
                    $Err = "Invalid Login Password Not matched";
                    header("Location:index.php?error=$Err");
                }
            }
        }
    }
}
