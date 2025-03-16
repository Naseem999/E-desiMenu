<?php
session_start();
include_once 'partial/head.php';
$admin_id = $_SESSION['admin_id'];
$company= $_SESSION['company'];
$t_name="chefs_".$company;
$Err = "";
if (isset($_POST['add_chef_submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $speciality = mysqli_real_escape_string($con, $_POST['speciality']);
    $restaurant_name = mysqli_real_escape_string($con, $_POST['restaurant_name']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);


    if (empty($name) || empty($email) || empty($pass) || empty($speciality) || empty($restaurant_name) || empty($salary)) {
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
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                pass varchar(255) NOT NULL,
                speciality varchar(255) NOT NULL,
                restaurant_name varchar(255) NOT NULL,
                salary double(10,2) NOT NULL,
                PRIMARY KEY (id) 
            );";
            mysqli_query($con, $sql);
        }

        $sql = "SELECT * FROM $t_name WHERE email='$email ';";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            header("Location:e-kitchen.php?title=E-Kitchen&error=Chef Already exsist");
            exit();
        } else {
            //INSERT chef INTO DATABASE
            $sql = "INSERT INTO $t_name(name, email,pass, speciality,restaurant_name,salary) VALUES('$name','$email','$pass','$speciality','$restaurant_name','$salary');";
            mysqli_query($con, $sql);

            header("Location:e-kitchen.php?title=E-Kitchen&msg=chef Added ");

            exit();
        }
    }
}
// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// edit chef
if (isset($_POST['update_chef_submit'])) {
    $chef_id = mysqli_real_escape_string($con, $_POST['chef_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $speciality = mysqli_real_escape_string($con, $_POST['speciality']);
    $restaurant_name = mysqli_real_escape_string($con, $_POST['restaurant_name']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);

    $sql = "SELECT * FROM $t_name WHERE id=$chef_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if (empty($name)) {
        $name = $row['name'];
    }
    if (empty($email)) {
        $email = $row['email'];
    }
    if (empty($pass)) {
        $pass = $row['pass'];
    }
    if (empty($speciality)) {
        $speciality = $row['speciality'];
    }
    if (empty($restaurant_name)) {
        $restaurant_name = $row['restaurant_name'];
    }
    if (empty($salary)) {
        $salary = $row['salary'];
    }

    $sql1 =  "UPDATE $t_name SET name='$name',email='$email',pass='$pass',speciality='$speciality',restaurant_name='$restaurant_name',salary='$salary' WHERE id='$chef_id';";
    mysqli_query($con, $sql1);

    header("Location:e-kitchen.php?title=E-Kitchen&msg=Chef Data updtaed sucessfully ");

    exit();
}
// delete note
if (isset($_GET['del_id'])) {
    $del_id = mysqli_real_escape_string($con, $_GET['del_id']);
    $sql2 = "DELETE FROM $t_name WHERE id=$del_id";
    mysqli_query($con, $sql2);
    header("Location:e-kitchen.php?title=E-Kitchen&msg=Chef Deleted sucessfully ");

    exit();
}
