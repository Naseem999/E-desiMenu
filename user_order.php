<?php
session_start();
include_once 'partial/head.php';
$company = $_SESSION['company'];
$t_name = "orders_" . $company;
$t_name3 = "notifications_" . $company;

if (!isset($_SESSION['user_username'])) {
    header("Location:user_login.php");
} else {
    $order_by = $_SESSION['user_email'];

    if (isset($_POST['add_cart_submit'])) {
        $item_name = mysqli_real_escape_string($con, $_POST['item_name']);
        $item_price = mysqli_real_escape_string($con, $_POST['item_price']);
        $item_img = mysqli_real_escape_string($con, $_POST['item_img']);
        $item_quantity = mysqli_real_escape_string($con, $_POST['item_quantity']);
        $item_category = mysqli_real_escape_string($con, $_POST['item_category']);
        $parsel=mysqli_real_escape_string($con, $_POST['parsel']);
        if(empty($parsel)){
           $parsel='off';
        }
        if (empty($item_name) || empty($item_price) || empty($item_img) || empty($item_quantity) || empty($item_category)) {
            $Err = "Somthing went Wrong";
            header("Location:menu.php?error=$Err");
            exit();
        } else {
            

            $sql = "SELECT * FROM $t_name ";
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                $sql = "CREATE TABLE $t_name (
                    id int(255) NOT NULL AUTO_INCREMENT,
                    order_by varchar(255) NOT NULL,
                    item_name varchar(255) NOT NULL,
                    item_img varchar(255) NOT NULL,
                    item_price double(10,2) NOT NULL,
                    item_quantity int(255) NOT NULL,
                    item_category varchar(255) NOT NULL,
                    item_status varchar(255) NOT NULL,
                    table_no int(255) NOT NULL,
                    chef varchar(255) ,
                    payment varchar(255)NOT NULL ,
                    parsel enum('on', 'off') ,
                    wallet_pay_option enum('on', 'off'),
                    timestamp_ date,
                    PRIMARY KEY (id) 
                );";
                mysqli_query($con, $sql);
            }
            $tabel_no = mysqli_real_escape_string($con, $_POST['tabel_no']);
            $title = "New Order <b>: $item_name  </b>on Table No: <b>$tabel_no</b>";
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
VALUES('$title','$company',now());";
                mysqli_query($con, $sql1);
            }


            $sql = "INSERT INTO  $t_name (order_by,item_name,item_img,item_price,item_quantity,item_category,item_status,table_no,chef,payment,parsel,wallet_pay_option,timestamp_) 
            VALUES('$order_by','$item_name','$item_img','$item_price','$item_quantity','$item_category','pending','$tabel_no',NULL,'pending','$parsel','off',now());";
            mysqli_query($con, $sql);
            header("Location:menu.php?msg=Added  Placed");
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
