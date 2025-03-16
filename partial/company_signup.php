<?php
session_start();
include_once 'head.php';
$Err = "";
if (isset($_POST['company_signup_submit'])) {
    $username_filter = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $c_name_filter = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_des_filter = mysqli_real_escape_string($con, $_POST['c_des']);
    $num_tables = mysqli_real_escape_string($con, $_POST['num_tables']);
    // img
    $username = str_replace(array("#", "'", ";"), '', $username_filter);
    $c_name = str_replace(array("#", "'", ";"), '', $c_name_filter);
    $c_des = str_replace(array("#", "'", ";"), '', $c_des_filter);


    if (isset($_FILES['c_logo'])) {
        $errors = array();
        $file_name = $_FILES['c_logo']['name'];
        $file_size = $_FILES['c_logo']['size'];
        $file_tmp = $_FILES['c_logo']['tmp_name'];
        $file_type = $_FILES['c_logo']['type'];
        $expl = explode('.', $file_name);
        $file_ext = strtolower(end($expl));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../admin/img/" . $file_name);
            echo "Success";
        } else {
            print_r($errors);
        }
    }

    if (empty($username) || empty($email) || empty($pass) || empty($c_name) || empty($c_des) || empty($num_tables)) {
        $Err = "Fill All the Feilds";
        header("Location:../register.php?&error=$Err");
        exit();
    } else {
        $sql = "SELECT * FROM company WHERE email='$email';";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            header("Location:../register.php?error=Company Already exsist");
            exit();
        } else {
            $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);
            //INSERT USER INTO DATABASE
            $sql = "INSERT INTO company(username, pass,email,c_name,num_tables,c_des,c_logo,timestamp_) VALUES('$username','$hashedpwd','$email','$c_name','$num_tables','$c_des','$file_name',now());";
            mysqli_query($con, $sql);


            // send notification to chef for order
            $sql4 = "SELECT * FROM  notifications_edesimenu";
            $result = mysqli_query($con, $sql4);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                $sql = "CREATE TABLE notifications_edesimenu (
         id int(255) NOT NULL AUTO_INCREMENT,
         title varchar(255) NOT NULL,
         n_for varchar(255) NOT NULL,
         timestamp_ datetime,
         PRIMARY KEY (id) 
     );";
                mysqli_query($con, $sql);
            }

            $sql2 = "INSERT INTO notifications_edesimenu(title, n_for,timestamp_) VALUES('New User Registered: username:$username','edesimenu',now());";
            mysqli_query($con, $sql2);

            header("Location:../company_login.php?&msg=Compnay Registered");

            exit();
        }
    }
}
