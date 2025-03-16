<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    $company = $_SESSION['company'];
    $t_name = "orders_" . $company;
    $t_name2 = "users_" . $company;
    if (!isset($_SESSION['user_username'])) {
        header("Location:user_login.php");
    } else {
        $email = $_SESSION['user_email'];
        $username = $_SESSION['user_username'];
    }


    if (isset($_GET['order_id'])) {
        $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
        $sql2 = "UPDATE  $t_name SET item_status='cancled'WHERE id='$order_id';";
        mysqli_query($con, $sql2);
    }
    ?>

    <title>User Dash-<?php echo $company; ?></title>
</head>

<body style="background-color: #f1f5f6;">
    <?php
    $sql = "SELECT * FROM company WHERE c_name='$company'";
    $result = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result);
    if ($resultch > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['menu_c_logo'] = $row['c_logo'];
    ?>

        <div class="row" style=" margin: 5px;border-bottom: 1px solid #a3a3a3;">
            <div>
                <div class="col s6 m6 l6">
                    <a href="menu.php"><img class="responsive-image" src="admin/img/<?php echo $_SESSION['menu_c_logo']; ?>" style=" height:8vh; 
                   object-fit:contain;  margin-left: 3vw; "></a>
                </div>
                <div class="col s6 m6 l6">
                    <?php
                    if (isset($_SESSION['user_email'])) {
                        $username = $_SESSION['user_username'];

                    ?>
                        <ul class="right ">
                            <li style="display: inline-flex;"><a class="dropdown-trigger" href="#!" data-target="user_profile"><i class="material-icons" style=" color: #616161;">account_circle</i>
                                </a>
                                <p style="margin: 0px;margin-right: 2vw; margin-left: 1vw;"><?php echo $username; ?></p>
                            </li>
                        </ul>
                    <?php
                    } else {

                    ?>
                        <ul class="right ">
                            <li style="display: inline-flex;"><a class="dropdown-trigger" href="user_login.php" style="margin-right: 1vw; color: #1c1c1c; font-size: 2.5vh;">Login
                                </a>
                            </li>
                            <li style="display: inline-flex;"><a class="dropdown-trigger" href="user_register.php" style="margin-right: 2vw; color: #1c1c1c; font-size: 2.5vh;">Signup
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <ul id="user_profile" class="dropdown-content">
            <li><a href="menu.php">Menu</a></li>
            <li class="divider"></li>
            <li><a href="partial/user_logout.php">Logout</a></li>
        </ul>

    <?php
    }
    $sql = "SELECT * FROM services WHERE c_name='$company'";
    $result1 = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result1);
    if ($resultch > 0) {
        $row = mysqli_fetch_assoc($result1);
        $wallet = $row['wallet'];
        $parsel_ser = $row['parsel'];
    }

    ?>

    <!-- main section -->
    <div class="row main_sec">

        <div class="col s12 m4 l4 right">
            <div class="card z-depth-1 cards " style="border-radius: 8px;">
                <div class="card-content " style="padding: 18px;">
                    <div class="card" style="background-color: transparent;  box-shadow: none; padding: 17px;  margin-top: -6em;">
                        <p style="text-align: center;"> <img style="height: 8em; width:8em;" src="img/user1.svg" alt="" class="z-depth-3  circle responsive-img">
                        </p>
                    </div>
                    <div class="row">
                        <p style="text-align: center; font-weight: bold; color: #6f6f6f; font-size: 1em; ">
                            <?php
                            echo $username;
                            ?>
                        </p>
                        <hr style="width: 20px;">
                        <div class="col s12 m12 l12" style="margin-top: 1em;">

                            <p style="text-align: center;  color: #6f6f6f; margin-top: 0.5em; font-size: 1.3em; ">
                                <?php
                                echo $email;
                                ?>
                            </p>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <p style="text-align: center;margin-top: 2em;">
                                <a href="partial/user_logout.php" class="waves-effect waves-light btn  " style=" background: linear-gradient(60deg, #ef5350, #e53935);
                             box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);text-align: left;">
                                    Logout
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m8 l8 left">
            <div class="card z-depth-1 cards " style="border-radius: 8px;">
                <div class="card-content " style="padding: 18px;">
                    <div class="card" style=" padding: 17px; background: linear-gradient(60deg, #66bb6a, #43a047); 
                     margin-top: -4em;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                        <div class="card-image white-text cneter-align">
                            <p style="text-align: center;   font-size: 1.5em; ">
                                Your Orders
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <table class="bordered  responsive-table" style="margin: 5px;">
                            <thead>
                                <tr>
                                    <th data-field="id">Item name</th>
                                    <th data-field="name"> Price</th>
                                    <th data-field="price"> Quantity</th>
                                    <?php
                                    if ($parsel_ser == 'on') {
                                    ?>
                                        <th data-field="price"> Parsel</th>
                                    <?php
                                    }
                                    ?>
                                    <th data-field="price"> Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $show = false;
                                $sql = "SELECT * FROM $t_name WHERE order_by='$email' order by id desc ";
                                $resultch = 0;
                                if (mysqli_query($con, $sql)) {
                                    $result = mysqli_query($con, $sql);
                                    $resultch = mysqli_num_rows($result);
                                }
                                if ($resultch < 1) {
                                ?>

                                    <p style="text-align: center;">
                                        <a href="menu.php"><img class="responsive-img" style="height: 60vh;" src="img/undraw_add_to_cart_vkjp.svg">
                                        </a>
                                    </p>
                                    <?php
                                } else {
                                    $subtotal = 0;
                                    $show = true;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        date_default_timezone_set('Asia/Kolkata');
                                        $today_date = date('Y-m-d');
                                        if ($row['timestamp_'] == $today_date) {
                                            $item_status = $row['item_status'];
                                            $parsel = $row['parsel'];

                                            if ($item_status == 'cancled') {
                                                $color = 'lightgray';
                                            } else {
                                                $color = 'white';
                                            }

                                    ?>
                                            <tr style="background-color: <?php echo $color; ?>;">

                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['item_price']; ?></td>
                                                <td><?php echo $row['item_quantity']; ?></td>

                                                <?php
                                                if ($parsel_ser == 'on') {
                                                    if ($parsel == 'on') {
                                                ?>
                                                        <td><i class="material-icons" style="color: #66bb6a;">check</i></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td>-</td>
                                                <?php
                                                    }
                                                }
                                                ?>

                                                <?php
                                                if ($item_status == 'pending') {
                                                ?>
                                                    <td>Processing</td>
                                                <?php
                                                } elseif ($row['payment'] == 'pending') {
                                                ?>
                                                    <td><a href="cart.php"> Payment Due</a></td>
                                                <?php
                                                } elseif ($item_status == 'completed') {
                                                ?>
                                                    <td>Completed</td>
                                                <?php
                                                } elseif ($item_status == 'cancled') {
                                                ?>
                                                    <td>Cancled</td>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if ($wallet == 'on') {
                                                ?>
                                                    <td>
                                                        <a href="user_dash.php?order_id=<?php echo $row['id']; ?>" class="valign-wrapper  " style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                            <i style="margin-left: 0px; color: #fd5a61;" class="left material-icons">delete</i>
                                                        </a>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                    <p style=" text-align:center; margin-top: 3em; z-index: 1;"> <a href="menu.php" style="background-color: #1c1c1c " class=" modal-trigger z-depth-5 btn-floating btn-large waves-effect waves-light  ">
                            <i class=" material-icons">add</i>
                        </a>
                    </p>
                </div>
            </div>
            <!-- ================================== -->

        </div>

        <div class="col s12 m8 l8">
            <div class="card z-depth-1 cards " style="border-radius: 8px;">
                <form action="send_feed.php" method="POST">
                    <div class="card-content " style="padding: 18px;">
                        <div class="card" style=" padding: 17px; background: linear-gradient(60deg, #66bb6a, #43a047); 
                     margin-top: -4em;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                            <div class="card-image white-text cneter-align">
                                <p style="text-align: center;   font-size: 1.5em; ">
                                    Write Us a Line
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-content white-text">
                                <span style="margin-top:3vh; color:#727475 ;  font-weight: 500;">Name:</span>
                                <br><br>
                                <input name="name" type="text" style="border:1px solid #f1f1f1;width: 98%;  background-color: #f9f9f9;;
                    padding:1px;      ">
                                <br><br>
                                <span style="margin-top:3vh; color:#727475 ;  font-weight: 700;">Email:</span>
                                <br><br>
                                <input name="email" type="email" class="validate" style="
                     background-color: #f9f9f9; border:1px solid #f1f1f1; width: 98%; ">
                                <br><br>
                                <span style="margin-top:3vh; color:#727475 ;  font-weight: 700;">Message:</span>
                                <br><br>
                                <textarea name="message" type="text" style="border:1px solid #f1f1f1;width: 98%; height: 20vh;
                     background-color: #f9f9f9;; "></textarea>
                            </div>

                        </div>
                        <p style=" text-align:center; margin-top: 3em; z-index: 1;">
                            <button type="submit" name="feed_submit" class="waves-effect waves-light btn-large  " style=" background: linear-gradient(60deg, #ef5350, #e53935);
                            margin-bottom:1em;  box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);text-align: left;">
                                Send Now
                            </button>
                            </>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if ($wallet == 'on') {
        ?>
            <div class="col s12 m4 l4 " style="margin-top: 3.8em;">
                <div class="card z-depth-1  cards1" style="border-radius: 8px;">
                    <div class="card-content white-text">
                        <div class="row" style="margin-bottom: 0px; border-bottom: 1px solid #d9dddd;">
                            <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                <div class="card" style="  height: 7em;  background: linear-gradient(60deg, #ffa726, #fb8c00); box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4); border-radius: 5px;">
                                    <div class="card-image cneter-align">
                                        <p style="text-align: center;">
                                            <i style="padding: 20px; color: white;" class="medium material-icons">account_balance_wallet</i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php


                            $sql = "SELECT * FROM $t_name2 WHERE user_email='$email';";
                            $result = mysqli_query($con, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $balance = $row['balance'];
                            }
                            ?>
                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Wallet</p>
                                <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                    <?php echo "$" . $balance; ?></h1>
                            </div>
                        </div>
                        <p style="color: #a3a3a3;margin-top: 1em;"> Add Money <a href="#add_money" class="modal-trigger"> <i style=" color: gray; border-radius: 2px;background: linear-gradient(60deg, #ffa726, #fb8c00); box-shadow: 0 15px 10px 0px rgba(0, 0, 0, 0.14), 0 8px 10px -5px rgba(255, 152, 0, 0.9); color: white;" class="right small material-icons  ">add</i></a></p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div id="add_money" class="modal md" style="border-radius: 10px;">
        <div class="modal-content">
            <form action="pay.php" method="post">
                <div class="row">

                    <div class="input-field col s12 m12 l12">
                        <p style="text-align: center;">
                            <input name="pay_ment" placeholder="Amount" required type="number" min=1 class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                        </p>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <p style="text-align: center;margin-top: 1em;">
                            <button name="add_money" type="submit" class="waves-effect waves-light btn  " style=" 
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


    <?php
    include_once 'partial/scripts.php';
    ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });
    $(document).ready(function() {
        $('.modal').modal();
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

    .dropdown-content {
        border-radius: 10px;
        color: #1c1c1c !important;
    }

    .dropdown-content li>span {
        color: #1c1c1c;
    }

    .dropdown-content li>a,
    .dropdown-content li>span {
        font-size: 16px;
        color: black;
        display: block;
        line-height: 22px;
        padding: 14px 16px;
    }

    .dropdown-content {
        border-radius: 6px;
    }

    .dropdown-content>li:hover {
        background-color: #1c1c1c;
        color: #e0e0e0;
    }

    .dropdown-content>li>a:hover {
        color: #e0e0e0;
    }

    .dropdown-content>li {
        border-radius: 0px;
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