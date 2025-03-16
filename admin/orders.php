<?php
session_start();
if (isset($_SESSION['admin_username'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
        $admin_id = $_SESSION['admin_id'];
        $company = $_SESSION['company'];
        $t_name = "orders_" . $company;
        $t_name2 = "chefs_" . $company;
        $t_name3 = "users_" . $company;


        if (isset($_GET['user_id'])) {
            $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
            $total = mysqli_real_escape_string($con, $_GET['total']);

            $sql3 = "SELECT * FROM $t_name3 WHERE user_email='$user_id'";
            $result3 = mysqli_query($con, $sql3);
            $resultch3 = mysqli_num_rows($result3);
            if ($resultch3 > 0) {
               $row3=mysqli_fetch_assoc($result3);
               $bal=$row3['balance'];
               $new_bal=$bal+$total;
               $sql2 = "UPDATE  $t_name3 SET balance='$new_bal' WHERE user_email='$user_id';";
               mysqli_query($con, $sql2);

               $sql = "DELETE  FROM $t_name WHERE order_by='$user_id'";
               $result1 = mysqli_query($con, $sql);
               
               echo "<script>alert('User Account Settled Down With Wallet');
               window.location.assign('orders.php');
               </script>";
            }

       
        }


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

        <title>Motel-Menu</title>
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
                    <li id="dash_link">
                        <a href="admin_dash.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li id="profile_link">
                        <a href="profile.php?title=Profile">
                            <i class="material-icons">person</i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <?php
                    if ($qr_code == 'on') {
                    ?>
                        <li id="orders_link">
                            <a href="qr_genration.php?title=QR Code">
                                <i style="font-size: 1.6em;" class="fas fa-qrcode fa-2x"></i>
                                <p>QR-Code</p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($task == 'on') {
                    ?>
                        <li id="_link">
                            <a href="todo.php?title=Todo-List">
                                <i class="material-icons">content_paste</i>
                                <p>Todo List</p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($employee_managment == 'on') {
                    ?>
                        <li id="_link">
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
                    <li id="a_menu_link">
                        <a href="add_menu_item.php?title=Menu">
                            <i class="material-icons">add_box</i>
                            <p>Add To Menu</p>
                        </a>
                    </li>
                    <!-- =================================== -->
                    <?php
                    if ($e_kitchen == 'on') {
                    ?>
                        <li id="orders_link">
                            <a href="e-kitchen.php?title=E-Kitchen">
                                <i class="material-icons">kitchen</i>
                                <p>E-Kitchen</p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <!-- ======================================== -->
                    <li id="orders_link" class="active">
                        <a href="orders.php?title=Orders">
                            <i class="material-icons">attach_money</i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <!-- =================================== -->
                    <?php
                    if ($parsel == 'on') {
                    ?>
                        <li id="orders_link">
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
                    if ($feedback == 'on') {
                    ?>
                        <li id="orders_link">
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
                    if ($stock == 'on') {
                    ?>
                        <li id="orders_link">
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
                    ?>
                </div>
                <!-- =========================================================================================== -->
                <?php
                $orders = 0;
                $total_rev = 0;
                $admin_id = $_SESSION['admin_id'];
                $sql = "SELECT * FROM  $t_name WHERE parsel='off'  ";
                $resultch = 0;
                if (mysqli_query($con, $sql)) {
                    $result = mysqli_query($con, $sql);
                    $resultch = mysqli_num_rows($result);
                }

                if (!$resultch < 1) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['item_status'] == 'completed') {
                            $orders++;
                            $i = $row['item_price'] * $row['item_quantity'];
                            $total_rev = $total_rev + $i;
                        }
                    }
                }


                ?>
                <!-- main section -->
                <div class="row main_sec">
                    <div class="col s12 m12 l12" style="padding-top: 0px;">
                        <div class="col m1 l1"></div>
                        <div class="col s12 m5 l5">
                            <div class="card z-depth-1 card1" style="border-radius: 8px;">
                                <div class="card-content white-text">
                                    <div class="row" style="margin-bottom: 0px;">
                                        <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                            <div class="card" style="  height: 7em;      background: linear-gradient(60deg, #ffa726, #fb8c00); box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4); border-radius: 5px;">
                                                <div class="card-image cneter-align">
                                                    <p style="text-align: center;">
                                                        <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-tachometer-alt fa-3x"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m6 l6" style="margin-top: 0px">
                                            <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Orders Completed</p>
                                            <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                <?php echo $orders; ?></h1>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px;">
                                    <p style="color: #a3a3a3;margin-top: 1em;">Just Updated </p>

                                </div>
                            </div>
                        </div>
                        <div class="col s12 m5 l5">
                            <div class="card z-depth-1 card1 " style="border-radius: 8px;">
                                <div class="card-content white-text">
                                    <div class="row" style="margin-bottom: 0px;">
                                        <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                            <div class="card" style="  height: 7em;  background: linear-gradient(60deg, #66bb6a, #43a047);    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4); border-radius: 5px;">
                                                <div class="card-image cneter-align">
                                                    <p style="text-align: center;">
                                                        <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-funnel-dollar fa-3x"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m6 l6" style="margin-top: 0px">
                                            <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Revenue</p>
                                            <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                <?php echo "$" . $total_rev; ?></h1>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px;">
                                    <p style="color: #a3a3a3;margin-top: 1em;">Till Now Total</p>

                                </div>
                            </div>
                        </div>
                        <div class="col m1 l1"></div>
                    </div>
                    <div class="col s12 m12 l12" style="margin-top: 5em;">


                        <div class="card z-depth-1 cards " style="border-radius: 8px;">
                            <div class="card-content " style="padding: 18px;">
                                <div class="card" style=" padding: 17px; background: linear-gradient(60deg, #66bb6a, #43a047); 
                     margin-top: -4em;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                                    <div class="card-image white-text cneter-align">
                                        <p style="text-align: center;   font-size: 1.5em; ">
                                            Orders
                                        </p>
                                    </div>
                                </div>

                                <table class="responsive-table ">
                                    <thead>
                                        <tr>
                                            <th data-field="id">Item Name</th>
                                            <th data-field="name">Price</th>
                                            <th data-field="name">Table No.</th>
                                            <th data-field="price">Quantity</th>
                                            <th data-field="price">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody">

                                        <?php
                                        $show = false;
                                        date_default_timezone_set('Asia/Kolkata');
                                        $today_date = date('Y-m-d');

                                        $sql = "SELECT * FROM $t_name  WHERE parsel='off'  order by id desc ";
                                        $resultch = 0;
                                        if (mysqli_query($con, $sql)) {
                                            $result = mysqli_query($con, $sql);
                                            $resultch = mysqli_num_rows($result);
                                        }

                                        if ($resultch < 1) {
                                        ?>

                                            <p style="text-align: center;">
                                                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                                <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_Cpzev8.json" background="transparent" speed="0.7" style=" height:50vh;" loop autoplay></lottie-player>
                                            </p>
                                            <?php
                                        } else {
                                            $subtotal = 0;
                                            $show = true;
                                            while ($row = mysqli_fetch_assoc($result)) {


                                                if ($row['payment'] == 'done') {

                                            ?>

                                                    <tr>
                                                        <?php
                                                        $item_name = $row['item_name'];
                                                        $table_no = $row['table_no'];
                                                        $quantity = $row['item_quantity'];
                                                        $item_status = $row['item_status'];
                                                        $total = $row['item_price'] * $row['item_quantity'];
                                                        ?>

                                                        <td>
                                                            <?php
                                                            if ($row['item_status'] == 'pending' && $row['timestamp_'] == $today_date) {
                                                            ?>
                                                                <?php echo $item_name; ?> <span class='center new badge red'></span>

                                                            <?php
                                                            } else {
                                                                echo $item_name;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo "$" . $row['item_price']; ?></td>
                                                        <td><?php echo $table_no; ?></td>
                                                        <td><?php echo $quantity; ?></td>
                                                        <td>
                                                            <?php
                                                            $id = $row['id'];
                                                            if ($item_status == 'pending') {

                                                                echo "<a href='change_order_status.php?order_id=$id'     class='d status'><i style='color:#ea4e60;'  class=' fas fa-circle'></i> Pending</a>";
                                                            }

                                                            if ($item_status == 'completed') {
                                                                echo "<a href='change_order_status.php?order_id=$id'    class='- status'><i style='color:#648813;'  class=' fas fa-circle'></i> Completed</a>";
                                                            }
                                                            if ($item_status == 'cancled') {
                                                                echo "<a href='change_order_status.php?order_id=$id'style='color:red'    class='- status'><i style='color:red;'  class=' fas fa-circle'></i> Cancled</a>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php
                                                        if ($item_status != 'cancled') {
                                                            if ($e_kitchen == 'on') {
                                                        ?>
                                                                <td>
                                                                    <form action="assign_order.php" method="get">
                                                                        <input name="item_id" type="hidden" value="">
                                                                        <a href="#<?php echo "assign" . $row['id'] ?>" data-position='top' data-tooltip='Assign Order' class="valign-wrapper tooltipped modal-trigger" name="assign_order_submit" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                                            <i style="margin-left: 0px; color: #3C4858;" class="left material-icons">assignment_ind</i>
                                                                        </a>
                                                                    </form>
                                                                </td>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <a href="orders.php?user_id=<?php echo $row['order_by']; ?>&total=<?php echo $total; ?>" class="valign-wrapper" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                                    Refund
                                                                </a>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>



                                                        <!-- Modal Structure -->
                                                        <div id="<?php echo "assign" . $row['id'] ?>" class="modal" style="width: 100vw !important;">
                                                            <div class="modal-content">
                                                                <div class="row">
                                                                    <p style=" text-align: center;color: #3C4858; font-size: 2vh; font-weight: bold;">CHEFS</p>
                                                                    <hr style="width: 100px;">
                                                                </div>
                                                                <div class="row" style="border: 1px solid #dedede;  border-radius: 8px;">

                                                                    <div class="col s4 m4 l4">
                                                                        <p style=" text-align: center;color: #3C4858; font-size: 2.5vh; font-weight: bold;">Name</p>
                                                                    </div>
                                                                    <div class="col s4 m4 l4">
                                                                        <p style="text-align: center; color: #3C4858; font-size: 2.5vh; font-weight: bold;">Spaciality</p>
                                                                    </div>
                                                                    <div class="col s4 m4 l4">
                                                                        <p style="text-align: center; color: #3C4858; font-size: 2.5vh; font-weight: bold;">Assign</p>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $sql1 = "SELECT * FROM $t_name2  ";
                                                                $result1 = mysqli_query($con, $sql1);
                                                                $resultch1 = mysqli_num_rows($result1);
                                                                if ($resultch1 < 1) {
                                                                ?>

                                                                    <p style="text-align: center;">
                                                                        No Chef Yet
                                                                    </p>
                                                                    <?php
                                                                } else {
                                                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                                                    ?>


                                                                        <form action="assign_order.php" method="get">
                                                                            <input type="hidden" name="order_id" value="<?php echo  $row['id']; ?>">
                                                                            <input type="hidden" name="chef_id" value="<?php echo  $row1['id']; ?>">
                                                                            <div class="row" style="border: 1px solid #dedede;  border-radius: 8px;">
                                                                                <div class="col s4 m4 l4">
                                                                                    <p style="font-size: 2vh; color: #999999; margin-top: 3vh; text-align: center;"><?php echo $row1['name']; ?></p>
                                                                                </div>
                                                                                <div class="col s4 m4 l4">
                                                                                    <p style="font-size: 2vh; color: #999999; margin-top: 3vh; text-align: center;"><?php echo $row1['speciality']; ?></p>
                                                                                </div>
                                                                                <div class="col s4 m4 l4 center-align">
                                                                                    <p><button class="btn-floating btn waves-effect waves-light white" type="submit" name="assign_to_chef">
                                                                                            <i style=" color: #3C4858;" class="left material-icons">assignment_turned_in
                                                                                            </i>
                                                                                        </button></p>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>

                                                        </div>
                                                    </tr>


                                        <?php
                                                }
                                            }
                                        }
                                        ?>

                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================================================ -->
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
<script>
    $(document).ready(function() {
        $('.modal').modal();
    });
</script>

<style>
    ::-webkit-scrollbar {
        width: 0px;
    }



    .side_sec {
        margin: 30px;
    }

    .card-panel {
        box-shadow: none;
        border-radius: 10px;
    }

    .card1 {
        margin-top: 1em;
        margin-bottom: 2em;

    }

    #number {
        text-align: center;
        border: none;
        width: 70%;
        font-size: 3.5vh;
        color: #727475;
        font-weight: 500;
        margin-top: 3.8vh;

    }

    .para_modal1 {
        text-align: center;
        margin-top: 2.5vw;
        color: #727475;
        font-size: 3vh;
        font-weight: 300;
    }


    .para_modal2 {
        text-align: center;
        margin-top: 5vh;
        color: #727475;
        font-size: 3vh;
        font-weight: 300;
    }

    .text {
        color: #a3a3a3;
        font-size: 2.5vh;
        text-align: left;
        font-weight: 600;

    }

    .quant {
        color: #727475;
        font-size: 2.5vh;
        text-align: left;
        font-weight: 600;
        margin-top: 0px;
    }

    .main_sec {
        margin: 30px;
        margin-top: 9vh;
    }


    .header_sec {
        margin: 23px;

    }



    #price {
        text-align: center;
        font-size: 2.5vh;
        color: #727475;
        font-weight: 600;

    }

    .status {
        text-align: center;
        font-size: 2vh;
        color: #727475;
        font-weight: 600;

    }

    #total {
        text-align: center;
        font-size: 2.5vh;
        color: #ea4e60;
        font-weight: 600;

    }

    @media only screen and (max-width: 600px) {
        .side_sec {
            margin: 0px;
        }

        .card1 {
            margin-top: 2em;
            margin-bottom: 1em;

        }

        .sub_total {
            margin-right: -8px;
            text-align: left;
            font-weight: 700;
            font-size: 3vh;
            color: #585858;
        }

        .card-panel {
            border-radius: 10px;
        }

        .para_modal1 {
            text-align: center;
            margin-top: 3.6vh;
            color: #727475;
            font-size: 3vh;
            font-weight: 300;
        }

        .para_modal2 {
            text-align: center;
            margin-top: 1vh;
            color: #727475;
            font-size: 2.3vh;
            font-weight: 300;
        }

        .header_sec {
            margin: 0px;
            margin-bottom: 50px;
        }

        #price {
            text-align: center;
            width: 100%;
            border: none;
            font-size: 2vh;
            margin-top: 8px;
            color: #727475;
            font-weight: 500;
        }

        .status {
            text-align: center;
            width: 100%;
            border: none;
            font-size: 2vh;
            margin-top: 8px;
            color: #727475;
            font-weight: 500;
        }

        #total {
            text-align: center;
            width: 100%;
            border: none;
            font-size: 2vh;
            margin-top: 8px;
            color: red;
            font-weight: 500;
        }


        .text {
            color: #727475;
            font-size: 2vh;
            text-align: center;
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