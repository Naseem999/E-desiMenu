<?php
include_once 'partial/head.php';
session_start();

if (isset($_POST['custom_submit'])) {
    $plan = mysqli_real_escape_string($con, $_POST['plan_type']);

    echo $plan;
    if (isset($_POST['menu_customization'])) {
        $menu_customization = mysqli_real_escape_string($con, $_POST['menu_customization']);
    } else {
        $menu_customization = 'off';
        // echo $menu_customization;
    }
    if (isset($_POST['task'])) {
        $task = mysqli_real_escape_string($con, $_POST['task']);
    } else {
        $task = 'off';
        // echo $task;
    }
    if (isset($_POST['employee_managment'])) {
        $employee_managment = mysqli_real_escape_string($con, $_POST['employee_managment']);
    } else {
        $employee_managment = 'off';
        // echo $employee_managment;
    }
    if (isset($_POST['e_kitchen'])) {
        $e_kitchen = mysqli_real_escape_string($con, $_POST['e_kitchen']);
    } else {
        $e_kitchen = 'off';
        // echo $e_kitchen;
    }

    if (isset($_POST['wallet'])) {
        $wallet = mysqli_real_escape_string($con, $_POST['wallet']);
    } else {
        $wallet = 'off';
        // echo $wallet;
    }
    if (isset($_POST['feedback'])) {
        $feedback = mysqli_real_escape_string($con, $_POST['feedback']);
    } else {
        $feedback = 'off';
        // echo $feedback;
    }
    if (isset($_POST['parsel'])) {
        $parsel = mysqli_real_escape_string($con, $_POST['parsel']);
    } else {
        $parsel = 'off';
        // echo $parsel;
    }
    if (isset($_POST['stock'])) {
        $stock = mysqli_real_escape_string($con, $_POST['stock']);
    } else {
        $stock = 'off';
        // echo $stock;
    }
    if (isset($_POST['qr_code'])) {
        $qr_code = mysqli_real_escape_string($con, $_POST['qr_code']);
    } else {
        $qr_code = 'off';
        // echo $qr_code;
    }


    if (!isset($_SESSION['c_email'])) {
        echo "<script>alert('Login or Signup');
        window.location.assign('company_login.php');
        </script>";
    } else {
        $c_email = $_SESSION['c_email'];
        $init = $_SESSION['c_name'];
        $c_name = str_replace(array("#", "'", ";"), '', $init);

        $sql = "SELECT * FROM subscriptions ";
        $resultCheck = 0;
        if (mysqli_query($con, $sql)) {
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);
        }
        $check = 0;
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['c_name'] == $c_name) {
                    if ($row['plan'] == $plan) {
                        echo "<script>alert('You Already Subscribed to This');
                    window.location.assign('admin/index.php');
                    </script>";
                        $check = 1;
                        exit();
                    }
                    if ($plan == 'Custom') {
                        if ($row['plan'] == 'Demo') {
                            $plan_id1 = $row['plan_id'];
                            $sql = "DELETE FROM `subscriptions` WHERE email = '$c_email' ";
                            mysqli_query($con, $sql);
                            $sql1 = "DELETE FROM `services` WHERE plan_id = '$plan_id1' ";
                            mysqli_query($con, $sql1);
                        }
                    }
                }
            }
        }


        if ($check == 0) {
            $c_email = $_SESSION['c_email'];

            echo $c_name1;
            $plan_id = $c_name . "_" . $plan . "_" . uniqid();
            $satus = "activated";
            date_default_timezone_set('Asia/Kolkata');
            $today_date = date('Y-m-d');

            $d = strtotime("+1 Months");
            $end = date('Y-m-d', $d);


            $sql1 = "INSERT INTO `subscriptions` (`plan_id`, `c_name`, `email`, `plan`, `start`, `end`, `status`) VALUES ( '$plan_id', '$c_name', '$c_email', '$plan', '$today_date', '$end', 'activated');";
            if (mysqli_query($con, $sql1)) {
                if ($plan == 'Custom') {
                    $sql = "INSERT INTO services(plan_id,c_name,c_email,menu_customization,task,employee_managment,e_kitchen,wallet,feedback,parsel,stock,qr_code) 
                    VALUES('$plan_id','$c_name','$c_email','$menu_customization','$task','$employee_managment','$e_kitchen','$wallet','$feedback','$parsel','$stock','$qr_code');";
                    if (mysqli_query($con, $sql)) {
                        $admin_username = "admin_" . $c_name;
                        $hashedpwd = $c_name . uniqid();
                        $sql = "INSERT INTO admin_tab(username,pass,email,role,company) VALUES('$admin_username','$hashedpwd','$c_email','0','$c_name');";

                        if (mysqli_query($con, $sql)) {


                            $sql4 = "SELECT * FROM  notifications_edesimenu";
                            $result = mysqli_query($con, $sql4);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck < 1) {
                                $sql = "CREATE TABLE notifications_edesimenu (
                         id int(255) NOT NULL AUTO_INCREMENT,
                         title varchar(255) NOT NULL,
                         n_for varchar(255) NOT NULL,
                         timestamp_ datetime,
                         PRIMARY KEY (id) 
                     );";
                                mysqli_query($con, $sql);
                            }

                            $sql2 = "INSERT INTO notifications_edesimenu(title, n_for,timestamp_) VALUES('New User Subscribes To Plan:$plan','edesimenu',now());";
                            mysqli_query($con, $sql2);




                            include_once 'logout.php';
                            echo "<script>alert('You Will Recieve an Email With Login Details within 24 hours');
                                    window.location.assign('admin/index.php');
                                    </script>";
                        }
                    }
                }
            } else {
                echo "<br>its not done";
            }
            exit();
        }
    }
}


// =================================================================================================================================

if (isset($_POST['take_plan'])) {
    if (!isset($_SESSION['c_email'])) {
        echo "<script>alert('Login or Signup');
        window.location.assign('company_login.php');
        </script>";
    } else {
        $c_email = $_SESSION['c_email'];
        $init = $_SESSION['c_name'];
        $c_name = str_replace(array("#", "'", ";"), '', $init);

        $plan = mysqli_real_escape_string($con, $_POST['plan_type']);
        $sql = "SELECT * FROM subscriptions ";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);

        $check = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['c_name'] == $c_name) {
                if ($row['plan'] == $plan) {
                    echo "<script>alert('You Already Subscribed to This');
                        window.location.assign('admin/index.php');
                        </script>";
                    $check = 1;
                    exit();
                }
                if ($plan == 'Premium') {
                    if ($row['plan'] == 'Demo') {
                        $sql = "DELETE FROM `subscriptions` WHERE email = '$c_email' ";
                        mysqli_query($con, $sql);
                    }
                }
                if ($plan == 'Premium') {
                    if ($row['plan'] == 'Custom') {
                        echo "<script>alert('You Already Subscribed {$row['plan']}. Contact To us to Upgrade To Premium Plan');
                        window.location.assign('admin/index.php');
                        </script>";
                        $check = 1;
                        exit();
                    }
                }
            }
        }

        if ($check == 0) {
            $plan_id = $c_name . "_" . $plan . "_" . uniqid();
            $satus = "activated";
            date_default_timezone_set('Asia/Kolkata');
            $today_date = date('Y-m-d');


            if ($plan == 'Demo') {
                $d = strtotime("+15 days");
                $end = date('Y-m-d', $d);
                echo $end;
            }

            if ($plan == 'Premium') {
                $d = strtotime("+1 Months");
                $end = date('Y-m-d', $d);
            }

            $sql = "INSERT INTO subscriptions(plan_id,c_name, email, plan,start,end,status) VALUES('$plan_id','$c_name','$c_email','$plan','$today_date','$end','$satus');";
            if (mysqli_query($con, $sql)) {
                if ($plan == 'Demo' || $plan == 'Premium') {
                    $sql = "INSERT INTO services(plan_id,c_name,c_email,menu_customization,task,employee_managment,e_kitchen,wallet,feedback,parsel,stock,qr_code) 
                    VALUES('$plan_id','$c_name','$c_email','on','on','on','on','on','on','on','on','on');";
                    if (mysqli_query($con, $sql)) {
                        $admin_username = "admin_" . $c_name;
                        $hashedpwd = $c_name . uniqid();

                        $sql = "INSERT INTO admin_tab(username,pass,email,role,company) VALUES('$admin_username','$hashedpwd','$c_email','0','$c_name');";
                        if (mysqli_query($con, $sql)) {

                            // send noti to main Admin

                            $sql4 = "SELECT * FROM  notifications_edesimenu";
                            $result = mysqli_query($con, $sql4);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck < 1) {
                                $sql = "CREATE TABLE notifications_edesimenu (
                         id int(255) NOT NULL AUTO_INCREMENT,
                         title varchar(255) NOT NULL,
                         n_for varchar(255) NOT NULL,
                         timestamp_ datetime,
                         PRIMARY KEY (id) 
                     );";
                                mysqli_query($con, $sql);
                            }

                            $sql2 = "INSERT INTO notifications_edesimenu(title, n_for,timestamp_) VALUES('New User Subscribes To Plan:$plan','edesimenu',now());";
                            mysqli_query($con, $sql2);
                            // ===================================================================
                            include_once 'logout.php';
                            echo "<script>alert('You Will Recieve an Email With Login Details within 24 hours');
                                    window.location.assign('admin/index.php');
                                    </script>";
                        }
                    }
                }
            }


            exit();
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
