<?php
session_start();
include_once 'partial/head.php';
if (isset($_GET['order_id'])) {
    $company = $_SESSION['company'];
    $t_name = "orders_" . $company;
        $id = mysqli_real_escape_string($con, $_GET['order_id']);
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
                // =============================================
            } else {
                $cng_status = "pending";             
            }
            $sql = "UPDATE $t_name  SET item_status='$cng_status' WHERE id='$id';";
            mysqli_query($con, $sql);



            header("Location:orders.php?title=Orders&msg=Order Status Updated ");
            exit();
        }
    }