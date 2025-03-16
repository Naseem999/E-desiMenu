<?php
session_start();
if (isset($_SESSION['A_username'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
        $admin_id = $_SESSION['A_id'];
        $company = $_SESSION['A_company'];



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
                    <img class="responsive-image" src="<?php echo $_SESSION['A_logo']; ?>" style=" height:7vh; 
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
                    <li id="_link">
                        <a href="todo.php?title=Todo-List">
                            <i class="material-icons">content_paste</i>
                            <p>Todo List</p>
                        </a>
                    </li>
                    <li id="_link" class="active">
                        <a href="subscriptions.php?title=Subscriptions">
                            <i class="material-icons">store_mall_directory</i>
                            <p>Subscriptions</p>
                        </a>
                    </li>
                    <li id="_link">
                        <a href="users.php?title=Users">
                            <i class="material-icons">people</i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li>
                        <a href="notifications.php?title=Notifications">
                            <i class="material-icons">notifications</i>
                            <p>Notifications</p>
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
                $subscriptions = 0;
                $activated = 0;
                $sql1 = "SELECT * FROM subscriptions ";
                $resultch1 = 0;
                if (mysqli_query($con, $sql1)) {
                    $result1 = mysqli_query($con, $sql1);
                    $resultch1 = mysqli_num_rows($result1);
                }
                if (!$resultch1 < 1) {

                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $subscriptions++;
                        if ($row1['status'] == 'activated') {
                            $activated++;
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
                                                        <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-store-alt fa-3x"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m6 l6" style="margin-top: 0px">
                                            <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Subscriptions</p>
                                            <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                <?php echo $subscriptions; ?></h1>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px;">
                                    <p style="color: #a3a3a3;margin-top: 1em;">Companies Subscribed</p>

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
                                                        <i style="padding: 20px;margin-bottom: 0.2em; color: white;" class="medium material-icons">verified_user</i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 m6 l6" style="margin-top: 0px">
                                            <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Active subscribers</p>
                                            <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                <?php echo  $activated; ?></h1>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px;">
                                    <p style="color: #a3a3a3;margin-top: 1em;">Companies With Plans Active</p>

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
                                            Subscriptions
                                        </p>
                                    </div>
                                </div>

                                <table class="responsive-table ">
                                    <thead>
                                        <tr>
                                            <th data-field="id"> Subscrption Id</th>
                                            <th data-field="name">Company</th>
                                            <th data-field="name">Email</th>
                                            <th data-field="price">Plan</th>
                                            <th data-field="price">Start</th>
                                            <th data-field="price">End</th>
                                            <th data-field="price">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody">

                                        <?php
                                        $show = false;
                                        date_default_timezone_set('Asia/Kolkata');
                                        $today_date = date('Y-m-d');

                                        $sql = "SELECT * FROM subscriptions order by id desc ";
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



                                            ?>

                                                <tr>
                                                    <?php
                                                    $plan_id = $row['plan_id'];
                                                    $c_name = $row['c_name'];
                                                    $email = $row['email'];
                                                    $plan = $row['plan'];
                                                    $status = $row['status'];
                                                    $start = $row['start'];
                                                    $end = $row['end'];

                                                    ?>

                                                    <td>
                                                        <?php
                                                        if ($row['status'] == 'pending' && $row['timestamp_'] == $today_date) {
                                                        ?>
                                                            <?php echo $plan_id; ?> <span class='center new badge red'></span>

                                                        <?php
                                                        } else {
                                                            echo $plan_id;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $c_name; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $plan; ?></td>
                                                    <td><?php echo $start; ?></td>
                                                    <td><?php echo $end; ?></td>

                                                    <td>

                                                        <?php
                                                        if ($status == 'expired') {
                                                        ?>
                                                            <p style="font-family: Rubik;"><a><i style='color:#ea4e60;' class=' fas fa-circle'>Expired</i></a>
                                                            </p>
                                                        <?php
                                                        }

                                                        if ($status == 'activated') {
                                                        ?>
                                                            <p style="font-family: Rubik;"><a><i style='color:#648813;' class=' fas fa-circle'>Active</i></a>
                                                            </p>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <form action="assign_order.php" method="get">
                                                            <input name="item_id" type="hidden" value="">
                                                            <!-- <a href="plan_actions.php?plan_id=<?php echo $plan_id; ?>&title=<?php echo $c_name; ?>" data-position='top' data-tooltip='Assign Order' class="valign-wrapper tooltipped modal-trigger" name="assign_order_submit" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                                <i style="margin-left: 0px; " class="left material-icons">open_in_new</i>
                                                            </a> -->
                                                            <a href="gen_qr.php?plan_id=<?php echo $plan_id; ?>&title=<?php echo $c_name; ?>" data-position='top' data-tooltip='Assign Order' class="valign-wrapper tooltipped modal-trigger" name="assign_order_submit" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                                <i style="margin-left: 0px; " class="left material-icons">open_in_new</i>
                                                            </a>
                                                        </form>
                                                    </td>



                                                </tr>


                                        <?php
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
    header("Location:../index.php?error=Login As Admin");
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

    .main_sec {
        margin: 30px;
        margin-top: 9vh;
    }

    .side_sec {
        margin: 30px;
    }

    .md {
        width: 50vw;
        height: 100vh;
    }

    @media only screen and (max-width: 600px) {
        .side_sec {
            margin: 0px;
        }

        .main_sec {
            margin: 6px;
            margin-top: 0px;
        }

        .md {
            width: 99vw;
            height: 100vh;
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