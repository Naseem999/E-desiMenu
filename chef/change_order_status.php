<?php
session_start();
include_once 'partial/head.php';
if (isset($_SESSION['chef_id'])) {
    $company = $_SESSION['company'];
    $t_name2 = "chefs_" . $company;
    $t_name = "orders_" . $company;
    $t_name3 = "notifications_" . $company;
    $chef_id = $_SESSION['chef_id'];
    $sql = "SELECT * FROM $t_name2 WHERE id='$chef_id'; ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $chef_name = $row['name'];

    if (isset($_POST['change_order_submit'])) {
        $id = mysqli_real_escape_string($con, $_POST['order_id']);
        if (empty($id)) {
            $Err = "Somthing went Wrong";
            header("Location:orders.php?title=Orders&error=$Err");
            exit();
        } else {
            $sql = "SELECT * FROM $t_name WHERE id='$id'; ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['item_status'] == 'pending') {
                $cng_status = "completed";

                // Notification TO admin 
                $timestamp1 = date("M,d,Y h:i a");
                $sql2 = "SELECT * FROM $t_name WHERE id=$id";
                $result2 = mysqli_query($con, $sql2);
                $resultch2 = mysqli_num_rows($result2);
                if ($resultch2 < 1) {
                } else {
                    $row1 = mysqli_fetch_assoc($result2);
                    $title = "By Chef:<b>" . $chef_name . "- Order  $cng_status</b> :" . $row1['item_name'] . " on Table No :" . $row1['table_no'];
                }
                $sql3 = "SELECT * FROM $t_name3 WHERE title='$title'";
                $result3 = mysqli_query($con, $sql3);
                $resultch3 = mysqli_num_rows($result3);
                if ($resultch3 < 1) {
                    $sql1 = "INSERT INTO $t_name3(title,n_for,timestamp_) 
VALUES('$title','$company',now());";
                    mysqli_query($con, $sql1);
                }
                // =============================================

            } else {
                $cng_status = "pending";
                $msg="Processing Order";
                $timestamp1 = date("M,d,Y h:i a");
                $sql2 = "SELECT * FROM $t_name WHERE id=$id";
                $result2 = mysqli_query($con, $sql2);
                $resultch2 = mysqli_num_rows($result2);
                if ($resultch2 < 1) {
                } else {
                    $row1 = mysqli_fetch_assoc($result2);
                    $title = "By Chef:<b>" . $chef_name . "- Order  $msg</b> :" . $row1['item_name'] . " on Table No :" . $row1['table_no'];
                }
                $sql3 = "SELECT * FROM $t_name3 WHERE title='$title'";
                $result3 = mysqli_query($con, $sql3);
                $resultch3 = mysqli_num_rows($result3);
                if ($resultch3 < 1) {
                    $sql1 = "INSERT INTO $t_name3(title,n_for,timestamp_) 
VALUES('$title','$company',now());";
                    mysqli_query($con, $sql1);
                }
            }
            $sql = "UPDATE $t_name  SET item_status='$cng_status' WHERE id='$id';";
            mysqli_query($con, $sql);



            header("Location:orders.php?title=Orders&msg=Order Status Updated ");
            exit();
        }
    }
} else {
    header("Location:index.php?error=invlid");
}
