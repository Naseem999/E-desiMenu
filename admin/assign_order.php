<?php
session_start();
include_once 'partial/head.php';
$company = $_SESSION['company'];
$t_name = "orders_" . $company;
$t_name2 = "chefs_" . $company;
$t_name3 = "notifications_" . $company;

if (isset($_GET['assign_to_chef'])) {
    $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
    $chef_id = mysqli_real_escape_string($con, $_GET['chef_id']);
    $sql = "UPDATE $t_name SET chef='$chef_id' WHERE id=$order_id;";
    mysqli_query($con, $sql);
    $timestamp1 = date("M,d,Y h:i a");
    $sql2 = "SELECT * FROM $t_name WHERE id=$order_id";
    $result2 = mysqli_query($con, $sql2);
    $resultch2 = mysqli_num_rows($result2);
    if ($resultch2 < 1) {
    } else {
        $row1 = mysqli_fetch_assoc($result2);
        $title = "From:Admin-New Order :<b>" . $row1['item_name'] . " </b>on Table No :<b>" . $row1['table_no']."</b>";

        // send notification to chef for order
        $sql = "SELECT * FROM $t_name3 ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name3 (
                id int(255) NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                n_for varchar(255) NOT NULL,
                timestamp_ datetime,
                PRIMARY KEY (id) 
            );";
            mysqli_query($con, $sql);
        }
        $sql3 = "SELECT * FROM $t_name3 WHERE timestamp_=now()";
        $result3 = mysqli_query($con, $sql3);
        $resultch3 = mysqli_num_rows($result3);
        if ($resultch3 < 1) {
            $sql1 = "INSERT INTO $t_name3(title,n_for,timestamp_) 
VALUES('$title','$chef_id',now());";
            mysqli_query($con, $sql1);
            header("Location:orders.php?title=Orders&msg=Order Assigned To Chef=$chef_id");
            exit();
        } else {
            header("Location:orders.php?title=Orders&msg=Already Assigned This Order");
        }
    }
}
