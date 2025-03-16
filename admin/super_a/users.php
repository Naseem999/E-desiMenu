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

        if (isset($_GET['user_id'])) {
            $id = mysqli_real_escape_string($con, $_GET['user_id']);
            $sql = "DELETE FROM company WHERE id='$id'";
            mysqli_query($con, $sql);
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
                    <li id="_link">
                        <a href="subscriptions.php?title=Subscriptions">
                            <i class="material-icons">store_mall_directory</i>
                            <p>Subscriptions</p>
                        </a>
                    </li>
                    <li id="_link" class="active">
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

                <div class="row" style="margin-top: 7em; ">


                    <div class="card z-depth-1 cards " style="border-radius: 8px;">
                        <div class="card-content " style="padding: 5px;">
                            <div class="card" style=" padding: 17px; background: linear-gradient(60deg, #66bb6a, #43a047); 
         margin-top: -4em;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                                <div class="card-image white-text cneter-align">
                                    <p style="text-align: center;   font-size: 1.5em; ">
                                        Users
                                    </p>
                                </div>
                            </div>

                            <table class="responsive-table ">
                                <thead>
                                    <tr>
                                        <th data-field="id"></th>
                                        <th data-field="name">Username</th>
                                        <th data-field="name">Email</th>
                                        <th data-field="price">Company Name</th>
                                        <th data-field="price">Numbers of Tables</th>
                                        <th data-field="price">About</th>
                                        <th data-field="price">Timestamp</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody">

                                    <?php
                                    $show = false;
                                    date_default_timezone_set('Asia/Kolkata');
                                    $today_date = date('Y-m-d');

                                    $sql = "SELECT * FROM company order by id desc ";
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
                                                $logo = $row['c_logo'];
                                                $username = $row['username'];
                                                $email = $row['email'];
                                                $c_name = $row['c_name'];
                                                $num_tables = $row['num_tables'];
                                                $c_des = $row['c_des'];
                                                $timestamp_ = $row['timestamp_'];

                                                ?>

                                                <td><img style="height:5vh;" src="../img/<?php echo $logo; ?>" alt=""></td>
                                                <td><?php echo $username; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $c_name; ?></td>
                                                <td><?php echo $num_tables; ?></td>
                                                <td><?php echo $c_des; ?></td>
                                                <td><?php echo $timestamp_; ?></td>


                                                <td>
                                                    <form action="assign_order.php" method="get">
                                                        <input name="item_id" type="hidden" value="">
                                                        <a href="users.php?user_id=<?php echo $row['id']; ?>&title=<?php echo $c_name; ?>" data-position='top' data-tooltip='Assign Order' class="valign-wrapper tooltipped modal-trigger" name="assign_order_submit" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                            <i style="margin-left: 0px; color: #fd5a61;" class="left material-icons">delete</i>
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