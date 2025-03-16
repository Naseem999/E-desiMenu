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
        $t_name2 = "chefs_" . $company;
        $t_name = "messages_" . $company;

        $t_name3 = "orders_" . $company;

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

            if ($e_kitchen == 'off') {
                echo "<script>alert('Invalid Accress/ Service Not In plan');
                window.location.assign('logout.php');
                </script>";
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
                    if($qr_code=='on'){
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
                        <li id="orders_link" class="active">
                            <a href="e-kitchen.php?title=E-Kitchen">
                                <i class="material-icons">kitchen</i>
                                <p>E-Kitchen</p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <!-- ======================================== -->

                    <li id="orders_link">
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


                <!--=========================================================================================== -->

                <?php
                $sql = "SELECT * FROM  $t_name2 ";
                $chefs_count = 0;
                $resultch = 0;
                if (mysqli_query($con, $sql)) {
                    $result = mysqli_query($con, $sql);
                    $resultch = mysqli_num_rows($result);
                }
                if ($resultch < 1) {
                    $chefs_count = 0;
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $chefs_count++;
                    }
                }

                // employee count
                $sql = "SELECT * FROM $t_name ";
                $employee_count = 0;
                $resultch = 0;
                if (mysqli_query($con, $sql)) {
                    $result = mysqli_query($con, $sql);
                    $resultch = mysqli_num_rows($result);
                }
                if ($resultch < 1) {
                    $employee_count = 0;
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $employee_count++;
                    }
                }
                ?>
                <!-- main section -->
                <div class="row main_sec">
                    <div class="col m1 l1 hide-on-med-and-down"></div>
                    <div class="col s12 m5 l5" style="padding-top: 0px;">
                        <a href="#chefs" style="color: #a3a3a3;">
                            <div class="card z-depth-1  cards1" style="border-radius: 8px;">
                                <div class="card-content white-text">
                                    <div class="row" style="margin-bottom: 0px; border-bottom: 1px solid #d9dddd;">
                                        <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                            <div class="card" style="  height: 7em;      background: linear-gradient(60deg, #ffa726, #fb8c00); box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4); border-radius: 5px;">
                                                <div class="card-image cneter-align">
                                                    <p style="text-align: center;">
                                                        <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-utensils fa-3x"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m6 l6" style="margin-top: 0px">
                                            <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Chefs</p>
                                            <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                <?php echo $chefs_count; ?></h1>
                                        </div>
                                    </div>
                                    <p style="color: #a3a3a3;margin-top: 1em;"> Add Chef <a href="#add_chef" class="modal-trigger"> <i style=" color: gray;" class="right material-icons  ">person_add</i></a></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ============================================================================================================================== -->
                    <!--add Note Modal Structure -->
                    <div id="add_chef" class="modal md" style="border-radius: 10px;">
                        <div class="modal-content">
                            <form action="crud_e-kitchen.php" method="post">
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;">
                                            <input name="name" placeholder="Name" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                        </p>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;">
                                            <input name="email" placeholder="Email" required type="email" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                        </p>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;">
                                            <input name="pass" placeholder="Id" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                        </p>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;">
                                            <input name="speciality" placeholder="speciality" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                        </p>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;">
                                            <input name="restaurant_name" placeholder="restaurant_name" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                        </p>
                                    </div>
                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;">
                                            <input name="salary" placeholder="salary" required type="number" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                        </p>
                                    </div>

                                    <div class="input-field col s12 m12 l12">
                                        <p style="text-align: center;margin-top: 1em;">
                                            <button name="add_chef_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                                Add
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- ============================================================================================================================== -->
                    <!-- add Employee -->
                    <div class="col s12 m5 l5" style="padding-top: 0px;">
                        <a href="#employees" style="color: #a3a3a3;">
                            <div class="card z-depth-1 cards1" style="border-radius: 8px;">
                                <div class="card-content white-text">
                                    <div class="row" style="margin-bottom: 0px; border-bottom: 1px solid #d9dddd;">
                                        <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                            <div class="card" style="  height: 7em;  background: linear-gradient(60deg, #66bb6a, #43a047);    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4); border-radius: 5px;">
                                                <div class="card-image cneter-align">
                                                    <p style="text-align: center;">
                                                        <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-comments fa-3x"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m6 l6" style="margin-top: 0px">
                                            <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Messages</p>
                                            <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                <?php echo $employee_count; ?></h1>
                                        </div>
                                    </div>
                                    <p style="color: #a3a3a3;margin-top: 1em;">Commnicate<a href="#send_messages"> <i style=" color: gray;" class="right material-icons  ">send</i></a></p>

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col m1 l1 hide-on-med-and-down"></div>




                    <!-- ============================================================================================================================== -->
                </div>

                <!-- inbox==================================================================================================================== -->

                <!-- orders  -->

                <div class="col s12 m12 l12" id="send_messages" style="margin-top: 5em;">
                    <div class="card z-depth-3 cards " style="border-radius: 8px;">
                        <div class="card-content " style="padding: 18px;">
                            <div class="card" style=" padding: 17px;background: linear-gradient(60deg, #ffa726, #fb8c00); 
                         margin-top: -4em;   box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);   border-radius: 5px;">
                                <div class="card-image white-text cneter-align">
                                    <p class="valign-wrapper" style="text-align: left;   font-size: 2em; ">
                                        Inbox
                                    </p>
                                    <p class="valign-wrapper" style="text-align: left;  font-size: 1.8vh; ">
                                        All The messages from chefs shown here
                                    </p>
                                </div>
                            </div>
                            <table class="responsive-table striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Message</th>
                                        <th>Timestamp</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody" id="send_messages">
                                    <?php
                                    $show = false;
                                    $sql = "SELECT * FROM $t_name  order by id desc ";
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
                                            $m_from = $row['m_from'];
                                            $message = $row['message'];
                                            $m_to = $row['m_to'];
                                            $timestamp_ = $row['timestamp_'];

                                            if ($m_from != $company) {


                                                $sql1 = "SELECT * FROM $t_name2 WHERE id ='$m_from' ";
                                                $resultch1 = 0;
                                                if (mysqli_query($con, $sql1)) {
                                                    $result1 = mysqli_query($con, $sql1);
                                                    $resultch1 = mysqli_num_rows($result1);
                                                }

                                                if ($resultch1 > 0) {
                                                    $row1 = mysqli_fetch_assoc($result1);
                                                    $m_from = $row1['name'];
                                                }
                                            } else {
                                                $m_from = "You";
                                            }
                                            // ===============================================================================
                                            if ($m_to != $company) {


                                                $sql1 = "SELECT * FROM $t_name2 WHERE id ='$m_to' ";
                                                $resultch1 = 0;
                                                if (mysqli_query($con, $sql1)) {
                                                    $result1 = mysqli_query($con, $sql1);
                                                    $resultch1 = mysqli_num_rows($result1);
                                                }

                                                if ($resultch1 > 0) {
                                                    $row1 = mysqli_fetch_assoc($result1);
                                                    $m_to = $row1['name'];
                                                }
                                            } else {
                                                $m_to = "You";
                                            }
                                        ?>
                                            <tr>

                                                <td>
                                                    <?php
                                                    echo $m_from;
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <?php
                                                    echo $m_to;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $message;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $timestamp_;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="messages.php?del_id=<?php echo $row['id']; ?>" style="  text-align: center; margin-left: 1.6em; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                        <i style=" color: gray;" class=" material-icons  ">delete</i>
                                                    </a>
                                                </td>


                                            </tr>
                                            <!-- ============================================================================================================================== -->

                                            <div id="<?php echo $row1['email']; ?>" class="modal md" style="border-radius: 10px;">
                                                <div class="modal-content">
                                                    <form action="messages.php" method="post">
                                                        <input type="hidden" name="chef_id" value="<?php echo $row1['id']; ?>">
                                                        <div class="row">
                                                            <div class="input-field col s12 m12 l12">
                                                                <p style="text-align: center;">
                                                                    <textarea name="message" placeholder="Message" required class="materialize-textarea" style="width: 80%; height: 20vh; text-align: left; font-size: 2.5vh;"></textarea>
                                                                </p>
                                                            </div>

                                                            <div class="input-field col s12 m12 l12">
                                                                <p style="text-align: center;margin-top: 1em;">
                                                                    <button name="send_chef_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                                                        Send
                                                                    </button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- ============================================================================================================================== -->
                                    <?php

                                        }
                                    }
                                    ?>

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <!-- ============================================================================================================================= -->

                <!-- orders  -->

                <div class="col s12 m12 l12" id="send_messages" style="margin-top: 5em;">
                    <div class="card z-depth-3 cards " style="border-radius: 8px;">
                        <div class="card-content " style="padding: 18px;">
                            <div class="card" style=" padding: 17px;background: linear-gradient(60deg, #ffa726, #fb8c00); 
                         margin-top: -4em;   box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);   border-radius: 5px;">
                                <div class="card-image white-text cneter-align">
                                    <p class="valign-wrapper" style="text-align: left;   font-size: 2em; ">
                                        Assigned Orders
                                    </p>
                                    <p class="valign-wrapper" style="text-align: left;  font-size: 1.8vh; ">
                                        All The Records related Order Assigments to chef shown Here
                                    </p>
                                </div>
                            </div>
                            <table class="responsive-table striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Chef</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody" id="send_messages">
                                    <?php
                                    $show = false;
                                    $sql = "SELECT * FROM $t_name3 order by id desc ";
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
                                            $order_name = $row['item_name'];
                                            $order_status = $row['item_status'];
                                            $chef_id = $row['chef'];
                                            if ($chef_id != NULL) {

                                                $sql2 = "SELECT * FROM $t_name2 WHERE id ='$chef_id' ";
                                                $resultch2 = 0;
                                                if (mysqli_query($con, $sql2)) {
                                                    $result2 = mysqli_query($con, $sql2);
                                                    $resultch2 = mysqli_num_rows($result2);
                                                }

                                                if ($resultch2 > 0) {
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                    $chef_name = $row2['name'];
                                                    $chef_email = $row2['email'];


                                        ?>
                                                    <tr>

                                                        <td>
                                                            <?php
                                                            echo $order_name;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $chef_name;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $order_status;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="#<?php echo $row2['email']; ?>" class=" left modal-trigger " style=" border-radius: 10px; text-align: left;  height: 100%; background-color:transparent;   box-shadow: none; ">
                                                                <i style=" color: gray;" class=" material-icons  ">send</i>
                                                            </a>
                                                        </td>


                                                    </tr>
                                                    <!-- ============================================================================================================================== -->

                                                    <div id="<?php echo $row2['email']; ?>" class="modal md" style="border-radius: 10px;">
                                                        <div class="modal-content">
                                                            <form action="messages.php" method="post">
                                                                <input type="hidden" name="chef_id" value="<?php echo $row1['id']; ?>">
                                                                <div class="row">
                                                                    <div class="input-field col s12 m12 l12">
                                                                        <p style="text-align: center;">
                                                                            <textarea name="message" placeholder="Message" required class="materialize-textarea" style="width: 80%; height: 20vh; text-align: left; font-size: 2.5vh;"></textarea>
                                                                        </p>
                                                                    </div>

                                                                    <div class="input-field col s12 m12 l12">
                                                                        <p style="text-align: center;margin-top: 1em;">
                                                                            <button name="send_chef_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                                                                Send
                                                                            </button>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <!-- ============================================================================================================================== -->
                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <!-- ================================================================================================================================= -->

                <!-- chefs -->
                <div class="row">
                    <div class="col s12 m12 l12" id="chefs" style="margin-top: 5em;">
                        <div class="card z-depth-3 cards " style="border-radius: 8px;">
                            <div class="card-content " style="padding: 18px;">
                                <div class="card" style=" padding: 17px;background: linear-gradient(60deg, #ffa726, #fb8c00); 
                         margin-top: -4em;   box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);   border-radius: 5px;">
                                    <div class="card-image white-text cneter-align">
                                        <p class="valign-wrapper" style="text-align: left;   font-size: 2em; ">
                                            Chefs
                                        </p>
                                        <p class="valign-wrapper" style="text-align: left;  font-size: 1.8vh; ">
                                            All The Records related to chef can be edited and Deleted Here
                                        </p>
                                    </div>
                                </div>
                                <table class="responsive-table striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Spaciality</th>
                                            <th>Salary</th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody">
                                        <?php
                                        $show = false;
                                        $sql = "SELECT * FROM $t_name2 order by id desc ";
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
                                                $name = $row['name'];
                                                $email = $row['email'];
                                                $speciality = $row['speciality'];
                                                $salary = $row['salary'];


                                            ?>
                                                <tr>

                                                    <td>
                                                        <?php
                                                        echo $name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $email;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $speciality;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo "$" . $salary . " /m";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="#update_chef<?php echo $row['id']; ?>" class=" left modal-trigger " style=" border-radius: 10px; text-align: left;  height: 100%; background-color:transparent;   box-shadow: none; ">
                                                            <i style=" color: gray;" class=" material-icons  ">edit</i>
                                                        </a>

                                                        <a href="crud_e-Kitchen.php?del_id=<?php echo $row['id']; ?>" style="  text-align: center; margin-left: 1.6em; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                            <i style=" color: gray;" class=" material-icons  ">delete</i>
                                                        </a>
                                                    </td>

                                                </tr>
                                                <!-- ============================================================================================================================== -->
                                                <!--add Note Modal Structure -->
                                                <div id="update_chef<?php echo $row['id'] ?>" class="modal md" style="border-radius: 10px;">
                                                    <div class="modal-content">
                                                        <form action="crud_e-kitchen.php" method="post">
                                                            <input type="hidden" name="chef_id" value="<?php echo $row['id']; ?>">
                                                            <div class="row">
                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;">
                                                                        <input name="name" placeholder=" <?php echo $name; ?>" type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                                    </p>
                                                                </div>
                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;">
                                                                        <input name="email" placeholder="<?php echo $email; ?>" type="email" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                                    </p>
                                                                </div>
                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;">
                                                                        <input name="pass" placeholder="<?php echo $row['pass']; ?>" type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                                    </p>
                                                                </div>
                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;">
                                                                        <input name="speciality" placeholder="<?php echo $speciality; ?>" type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                                    </p>
                                                                </div>
                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;">
                                                                        <input name="restaurant_name" placeholder="<?php echo $row['restaurant_name']; ?>" type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                                    </p>
                                                                </div>
                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;">
                                                                        <input name="salary" placeholder="<?php echo $salary; ?>" type="number" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                                    </p>
                                                                </div>

                                                                <div class="input-field col s12 m12 l12">
                                                                    <p style="text-align: center;margin-top: 1em;">
                                                                        <button name="update_chef_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                                                            Update
                                                                        </button>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                                <!-- ============================================================================================================================== -->
                                        <?php
                                            }
                                        }
                                        ?>

                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>






                    <!-- ============================================================================================================= -->


                </div>

                <!-- =============================================================================================== -->
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
        $('.modal').modal();

        $('.parallax').parallax();
        $('.tooltipped').tooltip();

        $('select').formSelect();
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

    .main_sec {
        margin: 30px;
        margin-top: 9vh;
    }

    .side_sec {
        margin: 30px;
    }

    .card-panel {
        box-shadow: none;
        border-radius: 10px;
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

    #price1 {
        text-align: center;
        font-size: 2.5vh;
        color: #727475;
        font-weight: 600;

    }

    #total {
        text-align: center;
        font-size: 2.5vh;
        color: #ea4e60;
        font-weight: 600;

    }

    .cards1 {
        margin-top: 0px;
    }

    @media only screen and (max-width: 600px) {
        .cards1 {
            margin-top: 3em;
        }

        .side_sec {
            margin: 0px;
        }


        .main_sec {
            margin: 6px;
            margin-top: 0px;
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

        #price1 {
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