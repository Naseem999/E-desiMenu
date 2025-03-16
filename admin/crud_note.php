<?php
session_start();
include_once 'partial/head.php';
$admin_id=$_SESSION['admin_id'];
$company= $_SESSION['company'];
$t_name="todo_".$company;
$Err = "";
if (isset($_POST['add_note_submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $desc = mysqli_real_escape_string($con, $_POST['desc']);
    

if (empty($title) || empty($desc) ) {
    $Err = "Fill All the Feilds";
    header("Location:todo.php?Title=Todo-List&error=$Err");
    exit();
} else {


    $sql = "SELECT * FROM $t_name";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        $sql = "CREATE TABLE $t_name (
            id int(255) NOT NULL AUTO_INCREMENT,
            title varchar(255) NOT NULL,
            description varchar(255) NOT NULL,
            note_for varchar(255) NOT NULL,
            timestamp_ datetime,
            PRIMARY KEY (id) 
        );";
        mysqli_query($con, $sql);
    }
     //INSERT note INTO DATABASE
     $sql = "INSERT INTO $t_name(title, description,note_for, timestamp_) VALUES('$title','$desc','$admin_id',now());";
     mysqli_query($con, $sql);

     header("Location:todo.php?Title=Todo-List&msg=Note Added ");

     exit();
}
}

// edit note
if (isset($_POST['update_note_submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['edit_title']);
    $desc = mysqli_real_escape_string($con, $_POST['edit_desc']);
    $note_id= mysqli_real_escape_string($con, $_POST['note_id']);


     //INSERT note INTO DATABASE
     $sql1 =  "UPDATE $t_name SET title='$title',description='$desc',timestamp_= now() WHERE id='$note_id';";
     mysqli_query($con, $sql1);

 header("Location:todo.php?Title=Todo-List&msg=Note updtaed sucessfully ");

     exit();
}
// delete note
if (isset($_GET['del_id'])) {
    $del_id= mysqli_real_escape_string($con, $_GET['del_id']);
     $sql2 = "DELETE FROM $t_name WHERE id=$del_id";
    mysqli_query($con, $sql2);
 header("Location:todo.php?Title=Todo-List&msg=Note Deleted sucessfully ");

     exit();
}
