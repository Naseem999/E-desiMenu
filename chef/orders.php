<?php
session_start();
if (isset($_SESSION['chef_email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
        $chef_id = $_SESSION['chef_id'];
        $company = $_SESSION['company'];
        $t_name = "orders_" . $company;
        $t_name2 = "chefs_" . $company;

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
                        <a href="chef_dash.php">
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
                    <li id="_link">
                        <a href="todo.php?title=Todo-List">
                            <i class="material-icons">content_paste</i>
                            <p>Todo List</p>
                        </a>
                    </li>

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

                    <li id="orders_link" class="active">
                        <a href="orders.php?title=Orders">
                            <i class="material-icons">attach_money</i>
                            <p>Orders</p>
                        </a>
                    </li>


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
                $chef_id = $_SESSION['chef_id'];
                $sql = "SELECT * FROM $t_name WHERE chef='$chef_id'";
                $result = mysqli_query($con, $sql);
                $resultch = mysqli_num_rows($result);
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
                        <div class="col m3 l3"></div>
                        <div class="col s12 m6 l6">
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

                        <div class="col m3 l3"></div>
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
                                            <th data-field="name">Table No.</th>
                                            <th data-field="price">Quantity</th>
                                            <th data-field="price">Timestamp</th>
                                            <th data-field="price">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody">

                                        <?php
                                        $show = false;
                                        date_default_timezone_set('Asia/Kolkata');
                                        $today_date = date('Y-m-d');

                                        $sql = "SELECT * FROM $t_name WHERE chef='$chef_id'  order by id desc ";
                                        $result = mysqli_query($con, $sql);
                                        $resultch = mysqli_num_rows($result);
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
                                                        <td><?php echo $table_no; ?></td>
                                                        <td><?php echo $quantity; ?></td>
                                                        <td><?php echo $row['timestamp_']; ?></td>
                                                        <td>

                                                            <?php
                                                            if ($item_status == 'pending') {
                                                                echo "<a class='status'><i style='color:#ea4e60;'  class=' fas fa-circle'> Pending</i></a>";
                                                            }

                                                            if ($item_status == 'completed') {
                                                                echo "<a class='status'  ><i style='color:#648813;'  class=' fas fa-circle'> Completed</i></a>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <form action="change_order_status.php" method="POST">
                                                                <input name="order_id" type="hidden" value="<?php echo $row['id'];?>">
                                                                <p style=" text-align: center;">
                                                                    <button type="submit" data-position='top' data-tooltip='Assign Order' class="waves-effect waves-light btn-small "
                                                                     name="change_order_submit" style="text-align: left; background-color: #1c1c1c; text-transform: capitalize;  border:none; cursor: pointer;   ">
                                                                        Change Status
                                                                    </button>
                                                                </p>
                                                            </form>
                                                        </td>
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
    header("Location:index.php?error=Login As Admin");
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