<?php
session_start();
include_once 'partial/head.php';
$chef_id = $_SESSION['chef_id'];
$company= $_SESSION['company'];
$t_name="messages_".$company;

$Err = "";
if (isset($_POST['send_chef_submit'])) {
    $m_to = mysqli_real_escape_string($con, $_POST['admin_id']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    if (empty($m_to) || empty($message)  ) {
        $Err = "Fill All the Feilds";
        header("Location:e-kitchen.php?title=E-Kitchen&error=$Err");
        exit();
    } else {
        $sql = "SELECT * FROM $t_name ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name (
                id int(255) NOT NULL AUTO_INCREMENT,
                m_to varchar(255) NOT NULL,
                m_from varchar(255) NOT NULL,
                message varchar(255) NOT NULL,
                timestamp_ datetime,
                PRIMARY KEY (id) 
            );";
            mysqli_query($con, $sql);
        }
      

            //INSERT chef INTO DATABASE
            $sql = "INSERT INTO $t_name(m_to, m_from,message, timestamp_) VALUES('$m_to','$chef_id','$message',now());";
            mysqli_query($con, $sql);

            header("Location:e-kitchen.php?title=E-Kitchen&msg=Messgage Sent  ");

            exit();
        
    }
}

// delete note
if (isset($_GET['del_id'])) {
    $del_id = mysqli_real_escape_string($con, $_GET['del_id']);
    $sql2 = "DELETE FROM  $t_name WHERE id=$del_id";
    mysqli_query($con, $sql2);
    header("Location:e-kitchen.php?title=E-kitchen&msg=Message Deleted sucessfully ");

    exit();
}
