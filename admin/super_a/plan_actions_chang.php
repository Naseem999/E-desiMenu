<?php
include_once 'partial/head.php';
if (isset($_GET['ser'])) {
    $plan_id = mysqli_real_escape_string($con, $_GET['plan_id']);
    $ser = mysqli_real_escape_string($con, $_GET['ser']);
    $status = mysqli_real_escape_string($con, $_GET['status']);
    if ($status == 'on') {
        $change_status = 'off';
    } elseif ($status == 'off') {
        $change_status = 'on';
    }

    $sql = "SELECT * FROM subscriptions WHERE plan_id='$plan_id' ";
    $resultch = 0;
    if (mysqli_query($con, $sql)) {
        $result2 = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
    }
    if ($resultch  > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $status_main = $row2['status'];
    }

    if ($status == 'activated') {
        $change_status = 'expired';
    } elseif ($status == 'expired') {
        $change_status = 'activated';
    }



    $sql = "UPDATE  services SET $ser='$change_status' WHERE plan_id='$plan_id'";
    mysqli_query($con, $sql);
    header("Location:plan_actions.php?plan_id=$plan_id");
}




if (isset($_GET['action'])) {
    $plan_id = mysqli_real_escape_string($con, $_GET['plan_id']);
    $action = mysqli_real_escape_string($con, $_GET['action']);
    $status = mysqli_real_escape_string($con, $_GET['status']);

    if ($status == 'activated') {
        $change_status = 'expired';
    } elseif ($status == 'expired') {
        $change_status = 'activated';
    }

    $sql = "SELECT * FROM services WHERE plan_id='$plan_id' ";
    $resultch = 0;
    if (mysqli_query($con, $sql)) {
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
    }
    if ($resultch  > 0) {
        $row1 = mysqli_fetch_assoc($result);
        $menu_customization = $row1['menu_customization'];
        $task = $row1['task'];
        $employee_managment = $row1['employee_managment'];
        $e_kitchen = $row1['e_kitchen'];
        $wallet = $row1['wallet'];
        $feedback = $row1['feedback'];
        $parsel     = $row1['parsel'];
        $stock     = $row1['stock'];
        $qr_code     = $row1['qr_code'];
    }

    $sql = "UPDATE  subscriptions SET status='$change_status' WHERE plan_id='$plan_id'";
    mysqli_query($con, $sql);

    $sql2 = "UPDATE  services SET menu_customization='$menu_customization',task='$task',employee_managment='$employee_managment',e_kitchen='$e_kitchen',wallet='$wallet',
        feedback='$feedback',parsel='$parsel', stock='$stock', qr_code='$qr_code' WHERE plan_id='$plan_id'";
    mysqli_query($con, $sql2);

    header("Location:plan_actions.php?plan_id=$plan_id");
}
