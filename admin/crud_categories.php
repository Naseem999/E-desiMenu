<?php
session_start();
include_once 'partial/head.php';
$admin_id = $_SESSION['admin_id'];
$company = $_SESSION['company'];
$t_name = "category_" . $company;
$Err = "";
if (isset($_POST['add_category_submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);



    if (empty($name) || empty($description)) {
        $Err = "Fill All the Feilds";
        header("Location:categories.php?Title=Categories&error=$Err");
        exit();
    } else {

        if (isset($_FILES['thumbnail'])) {
            $errors = array();
            $file_name = $_FILES['thumbnail']['name'];
            $file_size = $_FILES['thumbnail']['size'];
            $file_tmp = $_FILES['thumbnail']['tmp_name'];
            $file_type = $_FILES['thumbnail']['type'];
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
            } else {
                print_r($errors);
            }
        }
        $sql = "SELECT * FROM $t_name ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            $sql = "CREATE TABLE $t_name (
            id int(255) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            description varchar(255) NOT NULL,
            thumbnail varchar(255) NOT NULL,
            PRIMARY KEY (id) 
        );";
            mysqli_query($con, $sql);
        }
        $sql = "SELECT * FROM $t_name WHERE name='$name';";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            header("Location:categories.php?Title=Categories&error=Category Already exsist");
            exit();
        } else {
            //INSERT note INTO DATABASE
            $sql = "INSERT INTO $t_name(name, description,thumbnail) VALUES('$name','$description','$file_name');";
            mysqli_query($con, $sql);
            header("Location:categories.php?Title=Categories&msg=Category Added ");

            exit();
        }
    }
}

// edit note
if (isset($_POST['update_category_submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $file_name = $_FILES['thumbnail']['name'];

    $sql = "SELECT * FROM $t_name WHERE id='$category_id';";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if (empty($name)) {
        $name = $row['name'];
    }
    if (empty($description)) {
        $description = $row['description'];
    }

    if (empty($file_name)) {
        $file_name = $row['thumbnail'];
    } else {
        //get image path
        $imageUrl = 'img/' . $row['thumbnail'];
        //check if image exists
        if (file_exists($imageUrl)) {
            //delete the image
            unlink($imageUrl);
        }
        $errors = array();
        $file_name = $_FILES['thumbnail']['name'];
        $file_size = $_FILES['thumbnail']['size'];
        $file_tmp = $_FILES['thumbnail']['tmp_name'];
        $file_type = $_FILES['thumbnail']['type'];
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

    //INSERT note INTO DATABASE
    $sql1 =  "UPDATE $t_name SET name='$name',description='$description',thumbnail='$file_name' WHERE id='$category_id';";
    mysqli_query($con, $sql1);

    header("Location:categories.php?Title=Categories&msg=Category updtaed sucessfully ");

    exit();
}
// delete note
if (isset($_GET['del_id'])) {
    $del_id = mysqli_real_escape_string($con, $_GET['del_id']);
    $sql2 = "DELETE FROM $t_name WHERE id=$del_id";
    mysqli_query($con, $sql2);
    header("Location:categories.php?Title=Categories&msg=Category Deleted sucessfully ");

    exit();
}
