<?php
session_start();
include_once 'partial/head.php';
$Err = "";
$admin_id = $_SESSION['admin_id'];
$company = $_SESSION['company'];
$t_name = "menu_items_" . $company;
$t_name2="offers_" . $company;

if (isset($_POST['add_item_submit'])) {
    $item_name = mysqli_real_escape_string($con, $_POST['item_name']);
    $item_price = mysqli_real_escape_string($con, $_POST['item_price']);
    $item_category = mysqli_real_escape_string($con, $_POST['item_category']);
    // img
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
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
            move_uploaded_file($file_tmp, "img/" . $file_name);
            echo "Success";
        } else {
            print_r($errors);
        }
    }

    if (empty($item_name) || empty($file_name) || empty($item_price) || empty($item_category) ) {
        $Err = "Fill All the Feilds";
        header("Location:add_menu_item.php?title=Menu&error=$Err");
        exit();
    } else {

        $sql = "SELECT * FROM $t_name ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name (
            id int(255) NOT NULL AUTO_INCREMENT,
            item_name varchar(255) NOT NULL,
            item_img varchar(255) NOT NULL,
            item_price double(10,2) NOT NULL,
            item_category varchar(255) NOT NULL,
            PRIMARY KEY (id) 
        );";
            mysqli_query($con, $sql);
        }

        $sql = "SELECT * FROM $t_name WHERE item_name='$item_name';";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            header("Location:add_menu_item.php?title=Add To Menu &error=Item Already exsist in Menu");
            exit();
        } else {

            //INSERT USER INTO DATABASE
            $sql = "INSERT INTO $t_name(item_name, item_img, item_price, item_category) VALUES('$item_name','$file_name','$item_price','$item_category');";
            mysqli_query($con, $sql);

            header("Location:add_menu_item.php?title=Add To Menu &msg=Item Added To Menu");

            exit();
        }
    }
}



// ============================================================
if (isset($_POST['offers_submit'])) {
    $t_name2="offers_" . $company;
    $offer_name = mysqli_real_escape_string($con, $_POST['offer_name']);
    if (isset($_FILES['offer_thumbnail'])) {
        $file_name = $_FILES['offer_thumbnail']['name'];
    }

    if (empty($offer_name) || empty($file_name) ) {
        $Err = "Fill All the Feilds";
        header("Location:add_menu_item.php?title=Menu&error=$Err");
        exit();
    } else {
     
        $sql = "SELECT * FROM $t_name2";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name2 (
            id int(255) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            image varchar(255) NOT NULL,
            timestamp_ datetime,
            PRIMARY KEY (id) 
        );";
            mysqli_query($con, $sql);
        }
        if (isset($_FILES['offer_thumbnail'])) {
            $errors = array();
            $file_name = $_FILES['offer_thumbnail']['name'];
            $file_size = $_FILES['offer_thumbnail']['size'];
            $file_tmp = $_FILES['offer_thumbnail']['tmp_name'];
            $file_type = $_FILES['offer_thumbnail']['type'];
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
                move_uploaded_file($file_tmp, "img/" . $file_name);
                echo "Success";
            } else {
                print_r($errors);
            }
        }
      

        $sql = "INSERT INTO $t_name2(name, image, timestamp_) VALUES('$offer_name','$file_name',now());";
            mysqli_query($con, $sql);

            header("Location:add_menu_item.php?title=Add To Menu&msg=Offer Added");
    }
}

// delete note
if (isset($_GET['del_offer_id'])) {
    $del_id = mysqli_real_escape_string($con, $_GET['del_offer_id']);
    $sql2 = "DELETE FROM  $t_name2 WHERE id=$del_id";
    mysqli_query($con, $sql2);
    header("Location:add_menu_item.php?title=Add To Menu&msg=Offer  Deleted sucessfully ");

    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
