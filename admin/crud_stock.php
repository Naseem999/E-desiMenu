<?php
session_start();
include_once 'partial/head.php';
$admin_id = $_SESSION['admin_id'];
$company= $_SESSION['company'];
$t_name="inventory_".$company;
$t_name2="inventory_prodcuts_".$company;

$Err = "";
if (isset($_POST['add_order_submit'])) {
    $product = mysqli_real_escape_string($con, $_POST['product']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $vendor = mysqli_real_escape_string($con, $_POST['vendor']);
    $vendor_email = mysqli_real_escape_string($con, $_POST['vendor_email']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    if (empty($product) || empty($date) || empty($quantity) || empty($vendor) || empty($vendor_email)|| empty($price)) {
        $Err = "Fill All the Feilds";
        header("Location:stock.php?title=Stocks&error=$Err");
        exit();
    } else {
        $sql = "SELECT * FROM $t_name ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name (
                id int(255) NOT NULL AUTO_INCREMENT,
                product varchar(255) NOT NULL,
                price varchar(255) NOT NULL,
                quantity varchar(255) NOT NULL,
                vendor varchar(255) NOT NULL,
                vendor_email varchar(255) NOT NULL, 
                date date,
                PRIMARY KEY (id) 
            );";
            mysqli_query($con, $sql);
        }
      
            //INSERT orders INTO DATABASE
            $sql = "INSERT INTO $t_name(product, price,quantity, vendor,vendor_email,date) VALUES('$product','$price','$quantity','$vendor','$vendor_email','$date');";
            mysqli_query($con, $sql);

            header("Location:stock.php?title=Stocks&msg=Order Record Added ");

            exit();
        
    }
}
// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// add product
if (isset($_POST['update_order_submit'])) {
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    $product = mysqli_real_escape_string($con, $_POST['product']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $vendor = mysqli_real_escape_string($con, $_POST['vendor']);
    $vendor_email = mysqli_real_escape_string($con, $_POST['vendor_email']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    $sql = "SELECT * FROM  $t_name WHERE id=$order_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if (empty($product)) {
        $product = $row['product'];
    }
    if (empty($price)) {
        $price = $row['price'];
    }
    if (empty($quantity)) {
        $quantity = $row['quantity'];
    }
    if (empty($vendor)) {
        $vendor = $row['vendor'];
    }
    if (empty($vendor_email)) {
        $vendor_email = $row['vendor_email'];
    }
    if (empty($date)) {
        $date = $row['date'];
    }

    $sql1 =  "UPDATE  $t_name SET product='$product',price='$price',quantity='$quantity',vendor='$vendor',vendor_email='$vendor_email',date='$date' WHERE id='$order_id';";
    mysqli_query($con, $sql1);

    header("Location:stock.php?title=Stocks&msg=Order Record updtaed sucessfully ");

    exit();
}
// delete note
if (isset($_GET['del_id'])) {
    $del_id = mysqli_real_escape_string($con, $_GET['del_id']);
    $sql2 = "DELETE FROM  $t_name WHERE id=$del_id";
    mysqli_query($con, $sql2);
    header("Location:stock.php?title=Stocks&msg=Order Record Deleted sucessfully ");

    exit();
}


// ================================================================////=================================


if (isset($_POST['add_product_submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);
    $brand = mysqli_real_escape_string($con, $_POST['brand']);

    if (empty($name) || empty($quantity) || empty($rate) || empty($brand) ) {
        $Err = "Fill All the Feilds";
        header("Location:stock.php?title=Stocks&error=$Err");
        exit();
    } else {
        $sql = "SELECT * FROM $t_name2 ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name2 (
                id int(255) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                quantity varchar(255) NOT NULL,
                rate varchar(255) NOT NULL,
                brand varchar(255) NOT NULL,
                PRIMARY KEY (id) 
            );";
            mysqli_query($con, $sql);
        }
      
            //INSERT orders INTO DATABASE
            $sql = "INSERT INTO $t_name2(name,quantity, rate,brand) VALUES('$name','$quantity','$rate','$brand');";
            mysqli_query($con, $sql);

            header("Location:stock.php?title=Stocks&msg=Product Record Added ");

            exit();
        
    }
}
// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// add product
if (isset($_POST['update_product_submit'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);
    $brand = mysqli_real_escape_string($con, $_POST['brand']);

    $sql = "SELECT * FROM  $t_name2 WHERE id=$product_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if (empty($name)) {
        $name = $row['name'];
    }
    if (empty($quantity)) {
        $quantity = $row['quantity'];
    }
    if (empty($rate)) {
        $rate = $row['rate'];
    }
    if (empty($brand)) {
        $brand = $row['brand'];
    }

    $sql1 =  "UPDATE  $t_name2 SET name='$name',quantity='$quantity',rate='$rate',brand='$brand' WHERE id='$product_id';";
    mysqli_query($con, $sql1);

    header("Location:stock.php?title=Stocks&msg=Product Record updtaed sucessfully ");

    exit();
}
// delete note
if (isset($_GET['del_id2'])) {
    $del_id2 = mysqli_real_escape_string($con, $_GET['del_id2']);
    $sql2 = "DELETE FROM  $t_name2 WHERE id=$del_id2";
    mysqli_query($con, $sql2);
    header("Location:stock.php?title=Stocks&msg=Product Record Deleted sucessfully ");

    exit();
}