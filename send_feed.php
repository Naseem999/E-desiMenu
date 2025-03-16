<?php
session_start();
include_once 'partial/head.php';
$company = $_SESSION['company'];
$t_name = "feedbacks_" . $company;
if (!isset($_SESSION['user_username'])) {
    header("Location:user_login.php");
} else {

    if (isset($_POST['feed_submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $message = mysqli_real_escape_string($con, $_POST['message']);

        if (empty($name) || empty($email) || empty($message) ) {
            $Err = "Somthing went Wrong";
            header("Location:user_dash.php?error=$Err");
            exit();
        } else {
            

            $sql = "SELECT * FROM $t_name ";
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                $sql = "CREATE TABLE $t_name (
                    id int(255) NOT NULL AUTO_INCREMENT,
                    name varchar(255) NOT NULL,
                    email varchar(255) NOT NULL,
                    message varchar(255) NOT NULL,
                    timestamp_ date,
                    PRIMARY KEY (id) 
                );";
                mysqli_query($con, $sql);
            }
         

            $sql = "INSERT INTO  $t_name (name,email,message,timestamp_) 
            VALUES('$name','$email','$message',now());";
            mysqli_query($con, $sql);
            header("Location:user_dash.php?msg=Feedback Sent");
        }
    }

}

