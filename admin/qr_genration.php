<?php
session_start();
if (isset($_SESSION['admin_username'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
        $company = $_SESSION['company'];

        
        if (isset($_SESSION['plan'])) {
            if ($_SESSION['plan_status'] == 'expired') {
                echo "<script>alert('Plan Expired');
                window.location.assign('logout.php');
                </script>";
            }
            if (isset($_SESSION['plan_id'])) {
                // echo "<center>{$_SESSION['plan_id']}<center>";
                $plan_id = $_SESSION['plan_id'];
                $sql1 = "SELECT * FROM services WHERE plan_id='$plan_id';";
                $result1 = mysqli_query($con, $sql1);
                $resultch1 = mysqli_num_rows($result1);
                if ($resultch1 > 0) {
                    $row1 = mysqli_fetch_assoc($result1);
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
            }

        }

        ?>

        <title>Motel-Admin Profile</title>
    </head>

    <body style="background-color: #f1f5f6;">
        <div class="row" style="margin-bottom: 7vh;">
            <nav class="show-on-small" style=" display: none;  background-color:transparent ; backdrop-filter: blur(40px); box-shadow: 10px 10px 10px rgba(46,54,68,0.03);">
                <div class="nav-wrapper">
                    <div class="row  z-depth-5" style=" background-color: white; ">
                        <div class="col s9 m9" style="height: 10vh;">
                            <a href="h7.php"> <img class="responsive-image" src="img/logo1.png" style=" height:9vh; 
                 width:30vw; margin: 0.5;   object-fit:contain;  ">
                            </a>
                        </div>
                        <div class="col s3 m3 valign-wrapper" style="height: 10vh;">
                            <a href="" data-target="mobile-demo" style="  color: black;  " class="sidenav-trigger   ">
                                <i class="material-icons">menu</i>
                            </a>
                        </div>

                    </div>

            </nav>
        </div>
        <div class="sidenav z-depth-5 sidenav-fixed" style="background: linear-gradient(145deg, #ffffff, #d9dddd);
" id="mobile-demo">
            <div class=" ">
                <div class="col s12 m12 l12" style=" border-bottom: 1px solid ligh;">
                    <img class="responsive-image" src="img/<?php echo $_SESSION['c_logo']; ?>" style=" height:7vh; 
                 width: 100% ;  margin: 0.7vh;   object-fit:contain;  ">
                    <hr style="    width: calc(100% - 4 0px); height:0px; border: 1px solid lightgray;">
                </div>
            </div>
            <div class="row" style="margin: 20px;">
            <ul>
                    <li id="dash_link" >
                        <a href="admin_dash.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li id="profile_link" >
                        <a href="profile.php?title=Profile">
                            <i class="material-icons">person</i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <?php
                    if($qr_code=='on'){
                    ?>
                    <li id="orders_link" class="active">
                        <a href="qr_genration.php?title=QR Code">
                            <i style="font-size: 1.6em;" class="fas fa-qrcode fa-2x"></i>
                            <p>QR-Code</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                    if($task=='on'){
                    ?>
                    <li id="_link" >
                        <a href="todo.php?title=Todo-List">
                            <i class="material-icons">content_paste</i>
                            <p>Todo List</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                     <?php
                    if($employee_managment=='on'){
                    ?>
                    <li id="_link" >
                        <a href="employee.php?title=Employees">
                            <i class="material-icons">people</i>
                            <p>Employees</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <li>
                        <a href="notifications.php?title=Notifications">
                            <i class="material-icons">notifications</i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li id="s_menu_link">
                        <a href="menu.php?title=Menu">
                            <i class="material-icons">restaurant_menu</i>
                            <p> Menu</p>
                        </a>
                    </li>
                    <li id="s_menu_link">
                        <a href="categories.php?title=Categories">
                            <i class="material-icons">view_module</i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li id="a_menu_link" >
                        <a href="add_menu_item.php?title=Menu">
                            <i class="material-icons">add_box</i>
                            <p>Add To Menu</p>
                        </a>
                    </li>
                  <!-- =================================== -->
                  <?php
                    if ($e_kitchen == 'on') {
                    ?>
                        <li id="orders_link" >
                            <a href="e-kitchen.php?title=E-Kitchen">
                                <i class="material-icons">kitchen</i>
                                <p>E-Kitchen</p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <!-- ======================================== -->
                    <li id="orders_link" >
                        <a href="orders.php?title=Orders">
                            <i class="material-icons">attach_money</i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <!-- =================================== -->
                    <?php
                    if($parsel=='on'){
                    ?>
                    <li id="orders_link" >
                        <a href="parsel.php?title=Parsels">
                            <i class="material-icons">card_giftcard</i>
                            <p>Parsels</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <!-- ======================================== -->
                    <?php
                    if($feedback=='on'){
                    ?>
                    <li id="orders_link" >
                        <a href="feedbacks.php?title=Feedbacks">
                            <i class="material-icons">feedback</i>
                            <p>Feedbacks</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <!-- ========================== -->
                    <?php
                    if($stock=='on'){
                    ?>
                    <li id="orders_link" >
                        <a href="stock.php?title=Inventory">
                            <i style="font-size: 1.6em;" class="fas fa-cubes fa-2x"></i>
                            <p>Inventory</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>


                </ul>
            </div>
        </div>

        <div class="row side_sec">

            <div class="col s12 m9 l9 right" style=" margin-left: 0px;">
                <div class="row" style="margin-top: 0px;">
                    <?php
                    include_once 'partial/nav.php';
                    include_once 'partial/phpqrcode/qrlib.php';
                    include_once 'partial/eeEncrypt.php';

                    if (isset($_GET['gen'])) {
                        if ($_GET['gen'] == 'true') {
                            $company = $_SESSION['cid'];
                            $company_name = $_SESSION['company'];
                            $path = 'img/QR/';
                            $file = $path . $company_name . "_QR.png";
                            QRcode::png("http://localhost:82/e-desimenu/menu.php?cid=$company", $file, 'L', 10);
                        }
                    }
                    ?>

                    <div class="col s12 m8 l8 ">
                        <div class="card z-depth-0" style="border-radius: 20px;">
                            <div class="card-image">
                                <p style="text-align: center; margin-top: 3em;">
                                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_jmd7aruv.json" background="transparent" speed="0.5" style="filter: opacity(100%); height:100%;" loop autoplay></lottie-player>
                                </p>
                            </div>
                            <div class="card-action" style="border-radius:20px;">
                                <p style="text-align: center; margin-top: 2em;">
                                    <a class="btn  waves-effect waves-green z-depth-1" href="qr_genration.php?title=QR Code&gen=true" style=" border-radius: 3px; font-weight: bold; border: 1px solid lightgray; background-color: transparent; color: #1c1c1c;">
                                        Genrate
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4 l4" style="margin-top: 3em;">
                        <div class="card z-depth-5" style="border-radius: 20px;">
                            <div class="card-image">
                                <?php
                                if (isset($file)) {
                                ?>
                                    <p style="text-align: center;"><img src='<?php echo $file; ?>' style="border-radius: 20px; width: 100%;" class="responsive-img">
                                    </p>
                                <?php
                                } else {
                                ?>
                                    <p style="text-align: center;"> <img src='img/image1.svg' style="width: 100%;" class="responsive-img">
                                    </p>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="card-action" style="border-radius:20px;height: 6em;">
                                <?php
                                if (isset($file)) {
                                ?>
                                    <p style="text-align: center; margin-top: 0em;">
                                        <a class="btn  waves-effect waves-light z-depth-5" href="<?php echo $file; ?>" download style=" border-radius:4px; background-color: #1c1c1c; ">
                                            Download
                                        </a>
                                    </p>
                                <?php
                                }else{
                                   ?>
                                   <p style="font-size: 2em; text-align: center; margin-top: 0px; font-weight: bold; color: #d9dddd;">Your Qr</p>
                                   <?php 
                                }
                                ?>
                            </div>

                        </div>



                    </div>

                </div>

            </div>
        </div>

        <?php
        include_once 'partial/scripts.php';
        ?>
    </body>

    </html>
<?php
} else {
    header("Location:admin_log.php?error=Login As Admin");
}
?>
<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });
    AOS.init();
</script>
<?php
if (isset($_GET['error'])) {
?>
    <script>
        var toastHTML = "<span style='color:#e57373' ><?php echo $_GET['error']; ?></span>"
        var toastElement = document.querySelector('.toast');
        M.toast({
            html: toastHTML,


        });
    </script>
<?php
}
?>
<?php
if (isset($_GET['msg'])) {
?>
    <script>
        var toastHTML = "<span style='color:#66bb6a' ><?php echo $_GET['msg']; ?></span>"
        var toastElement = document.querySelector('.toast');
        M.toast({
            html: toastHTML,


        });
    </script>
<?php
}
?>

<style>
    ::-webkit-scrollbar {
        width: 0px;
    }

    .z-depth-3 {
        box-shadow: 0 24px 38px 3px rgba(244, 67, 54, 0.2), 0 9px 46px 8px rgba(244, 67, 54, 0.2), 0 11px 15px -7px rgba(0, 0, 0, 0.2);
    }

    .main_sec {
        margin: 30px;
        margin-top: 9vh;
    }

    .side_sec {
        margin: 30px;
    }

    .cards {
        margin-top: 10vh;
    }

    @media only screen and (max-width: 600px) {
        .side_sec {
            margin: 0px;
        }

        .main_sec {
            margin: 6px;
            margin-top: 0px;
        }
    }

    li>a {
        border-radius: 5px !important;
    }

    li {
        border-radius: 5px !important;
    }


    li.active>a {
        background-color: #1c1c1c;
        box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
    }


    li.active>a:hover {
        background-color: #1c1c1c;
        box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
    }

    li.active>a>p {
        color: #eee;
    }

    li.active>a>i {
        color: #eee !important;
    }
</style>