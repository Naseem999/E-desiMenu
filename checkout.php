<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

    <title>Motel-Checkout</title>
</head>

<body>

    <?php
    session_start();


    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    } else {
        header("Location:user_login.php");
    }


    $company = $_SESSION['company'];
    $t_name = "orders_" . $company;
    $t_name1 = "users_" . $company;

    if (isset($_POST['update_cart_submit'])) {
        $item_quantity = mysqli_real_escape_string($con, $_POST['item_quantity']);
        $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
        $sql = "UPDATE $t_name SET item_quantity='$item_quantity' WHERE id='$item_id' order by id desc ";
        $result = mysqli_query($con, $sql);
        header("Location:checkout.php?msg=Cart Updated");
    }

    $sql = "SELECT * FROM services WHERE c_name='$company'";
    $result1 = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result1);
    if ($resultch > 0) {
        $row = mysqli_fetch_assoc($result1);
        $wallet = $row['wallet'];
    }

    if (isset($_GET['pay_ment'])) {

        $pay_amount = mysqli_real_escape_string($con, $_GET['pay_ment']);
        $sql = "SELECT * FROM $t_name1 WHERE user_email='$user_email'";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch > 0) {
            $row = mysqli_fetch_assoc($result);
            $balance = $row['balance'];
            if ($balance < $pay_amount) {
                echo "<script>alert('Not Enough Balance In wallet');
                window.location.assign('checkout.php');
                </script>";
            } else {
                $new_bal = $balance - $pay_amount;
                $sql1 = "UPDATE  $t_name1 SET balance='$new_bal' WHERE user_email='$user_email';";
                mysqli_query($con, $sql1);

                $sql2 = "UPDATE  $t_name SET payment='done',wallet_pay_option='on' WHERE order_by='$user_email';";
                mysqli_query($con, $sql2);

                echo "<script>alert('Paymeny Done');
                window.location.assign('menu.php');
                </script>";
            }
        }
    }


    ?>
    <!-- hreader==================================== -->
    <?php
    $sql = "SELECT * FROM company WHERE c_name='$company'";
    $result = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result);
    if ($resultch > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['menu_c_logo'] = $row['c_logo'];
    ?>

        <div class="row" style=" margin: 5px;">
            <div>
                <div class="col s6 m6 l6">
                    <img class="responsive-image" src="admin/img/<?php echo $_SESSION['menu_c_logo']; ?>" style=" height:8vh; 
                   object-fit:contain;  margin-left: 3vw; ">
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
            <li><a href="user_dash.php">Dash</a></li>
            <li class="divider"></li>
            <li><a href="partial/user_logout.php">Logout</a></li>
        </ul>

    <?php
    }
    ?>
    <!--=========================================== -->



    <!-- header section -->
    <div class="row header_sec">

        <div class="parallax-container" style="  height:35vh">

            <div class="parallax">
                <img src="img/cart_bg.png" alt="Parallax">
            </div>

            <div class="row" style="  width: 100%; height: 100%;  margin-top:9vh; ">
                <div class="col s12 m12 l12 center-align">
                    <h3 style="   text-align: center; 
                    font-weight: 600; margin-bottom: 0px;  font-size: 8.5vh; color: #f6f6f6; ">
                        Checkout
                    </h3>
                    <hr style="width: 60px; height: 2px; border: none; background-color: #dedede;">
                </div>

            </div>
        </div>
    </div>

    <!-- main sec -->
    <div class="row main_row">
        <!-- side bar ============================================================================================================ -->
        <div class="col s12 m6 l6" style="padding: 5px;">
            <p style="color: #727475; margin-left: 0px; font-size: 3vh; font-weight: 600;">Summary</p>

            
            <p style="text-align: right;"> <a id="btn-Convert-Html2Image" href="#!" class="btn-floating btn-small waves-effect waves-light" style="background-color: #1c1c1c;"><i class="material-icons">local_printshop</i></a>
                            </p>

            <div id="html-content-holder" class="col s12 m12 l12" style="background-color: #f9f9f9;">

                <?php
                $show = false;
                $sql = "SELECT * FROM $t_name WHERE order_by='$user_email' order by id desc ";
                $result = mysqli_query($con, $sql);
                $resultch = mysqli_num_rows($result);
                if ($resultch < 1) {
                } else {
                    $subtotal = 0;
                    $show = true;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <?php
                        if ($row['payment'] == 'pending') {
                            $item_name = $row['item_name'];
                            $img = $row['item_img'];
                            $price = $row['item_price'];
                            $quantity = $row['item_quantity'];
                            $total = $price * $quantity;
                            $subtotal = $subtotal + $total;

                        ?>
                            <div class="col s12 m12 l12">
                                <div class="valign-wrapper card-panel z-depth-0  " style=" margin: 0px;  background-color:transparent;  padding: 0px;">
                                    <div class=" col s6 m6 l6 ">
                                        <p class=" text">
                                            <?php echo $item_name; ?>
                                        </p>
                                    </div>

                                    <div class="col s3  m3 l3">
                                        <a href="#<?php echo $row['id']; ?>" class="text modal-trigger  waves-effect waves-light ">
                                            <?php echo  $quantity ?>
                                            <hr style="width: 10px; margin-top:0px; margin-bottom: 0px;">
                                        </a> </div>
                                    <div class="col s3  m3 l3 center-align">
                                        <p class="text">$<?php echo $total; ?></p>
                                    </div>
                                </div>

                                <form action="checkout.php" method="post">
                                    <input name="item_id" type="hidden" value="<?php echo $row['id'] ?>">

                                    <div id="<?php echo $row['id']; ?>" class="modal bottom-sheet" style="  background-color: rgba(0,0,0,0.5); backdrop-filter: blur(20px)">
                                        <div class="modal-content" style="margin-top:2px; padding: 5px;background-color: transparent;">
                                            <div class="row z-depth-2" style="border-radius: 15px;    margin-bottom: 0px;background-color:#f6f6f6; ">
                                                <?php

                                                echo " <div class='col s3 m3 l3' style='
                                                             border-top-left-radius: 15px;
                                                             border-bottom-left-radius: 15px;
                                                             height: 15vh;
                                                             background: url(admin/img/$img) no-repeat 50% 50%  ;
                                                             background-size: cover;
                                                             '></div>";

                                                ?>
                                                <div class="col s3 m3 l3 " style="border-right:1px solid  #dedede ;height: 15vh;">
                                                    <?php
                                                    $num = str_word_count($item_name);
                                                    if ($num <= 2) {
                                                        echo "<p class='para_modal1'>$item_name</p>";
                                                    } else {
                                                        echo "<p class='para_modal2'> $item_name</p>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col s3 m3 l3" style="border-right:1px solid  #dedede ; height: 15vh; ">
                                                    <p style="text-align: center; margin-top:5vh; color: red; font-size: 3.2vh; font-weight: 300;  ">$ <?php echo $price; ?> </p>

                                                </div>
                                                <div class="col s3 m3 l3 center-align ">
                                                    <input id="number" type="number" name="item_quantity" min="1" value="<?php echo $quantity; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer " style="background-color: transparent;">
                                            <a href="#!" class=" modal-action modal-close waves-effect waves-red btn " style="background-color: #a3a3a3; border-radius: 3px;">Cancle</a>
                                            <button type="submit" name="update_cart_submit" class=" waves-effect waves-light btn " style=" margin-left: 20px; font-weight: bold; border-radius: 3px;background-color: rgb(237, 90, 107); ">Change Quantity</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                    <?php
                        }
                    }
                    ?>

                    <div class="col s12 m12 l12">
                        <hr>
                        <div class="valign-wrapper card-panel z-depth-0  " style=" margin: 0px; margin-bottom: 20px ;  background-color:transparent;  padding: 0px;">
                            <div class=" col s6 m6 l6 ">
                                <p class="text" style="font-weight: bold; color: #585858;">Subtotal:</p>
                                <p class="text" style="font-weight: lighter; color: #585858;">Taxs:</p>
                                <p class="text" style="font-weight: lighter; color: #585858;">Donation to Feed India:</p>
                            </div>
                            <div class="col s3  m3 l3">
                            </div>
                            <div class="col s3  m3 l3 center-align">
                                <p class="text" style="color: #ea4e60;">$<?php echo $subtotal; ?></p>
                                <p class="text" style="font-weight: lighter;">$2</p>
                                <p class="text" style="font-weight: lighter;">$0.5</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <hr>
                        <div class="valign-wrapper card-panel z-depth-0  " style=" margin: 0px;  background-color:transparent;  padding: 0px;">
                            <div class=" col s6 m6 l6 ">
                                <p class="text" style="font-weight: bold; font-size: 2.5vh; color: #585858;">Grand Total:</p>

                            </div>
                            <div class="col s3  m3 l3">
                            </div>
                            <div class="col s3  m3 l3 center-align">
                                <p class="text" style=" font-weight: bold; font-size: 2.5vh; color: #ea4e60;">$<?php echo $subtotal + 2 + 0.5; ?></p>
                            </div>
                        </div>
                    </div>
            </div>

        <?php
                }
        ?>
        <!-- <input id="btn-Preview-Image" type="button" value="Preview" /> -->
        <!-- <div id="previewImage">
        </div> -->
        </div>
        <!-- right side -->
        <div class="col s12 m6 l6">


            <div class="col s12 l12 l12 main_row" style="margin-top:3em;">
                <div class="col s12 m12 l12">
                    <p style="color:#727475; font-weight:600 ; font-size: 3.5vh;  margin-top: 15px;">Payment Options</p>
                    <?php
                    if ($wallet == 'on') {
                    ?>
                        <a href="checkout.php?pay_ment=<?php echo $subtotal; ?>">
                            <div class="col s12 m6 l6 hoverable" id="hdfc" onclick="highlight_bnk1();" style="cursor: pointer; padding: 10px; margin: 5px; border:  1px solid #dedede; border-radius: 8px;">
                                <div class="col s12 m12 l12  " style="margin-bottom: 0px;">
                                    <p id="hdfc_check" style="margin: 5px; color: #a3a3a3;" class="right"><i class="far fa-check-circle fa-lg"></i></p>
                                </div>
                                <div class="col s12 m12 l12 center-align " style=" padding: 0px;">
                                    <i style="padding: 0px; color: gray;" class="medium material-icons">account_balance_wallet</i>
                                </div>
                                <div class="col s12 m12  l12" style="padding: 2px; margin-top: 0px;">
                                    <p style="text-align: center; font-size:  2.2vh; color: #585858;">Your Wallet</p>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                    <a href="pay.php?pay_ment=<?php echo $subtotal; ?>">
                        <div class="col s12 m6 l6 hoverable" id="icici" onclick="highlight_bnk2();" style="cursor: pointer; padding: 10px; margin: 5px; border:  1px solid #dedede; border-radius: 8px;">

                            <div class="col s12 m12 l12  " style="margin-bottom: 0px;">
                                <p id="icici_check" style="margin: 5px; color: #a3a3a3;" class="right"><i class="far fa-check-circle fa-lg"></i></p>
                            </div>
                            <div class="col s12 m12 l12 center-align " style=" padding: 0px;">
                                <img style=" border-radius: 3px; padding: 0px; height:5vh; width: 100%;" class="left responsive-img" src="img/checkout_upi.svg">
                            </div>
                            <div class="col s12 m12  l12" style="padding: 2px; margin-top: 0px;">
                                <p style="text-align: center; font-size:  2.2vh; color: #585858;">Other Options </p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>



    <?php
    include_once 'partial/scripts.php';
    ?>


</body>

</html>






<script>
    var element = $("#html-content-holder"); // global variable
    var getCanvas; // global variable

    $(document).ready(function() {
        // $('#btn-Preview-Image').click();
        html2canvas(element, {
            onrendered: function(canvas) {
                // $("#previewImage").append(canvas);
                getCanvas = canvas;
            }
        });
        
    });
    $("#btn-Preview-Image").on('click', function() {
         
    });

    $("#btn-Convert-Html2Image").on('click', function() {

       

        var imgageData = getCanvas.toDataURL("image/png");
        // Now browser starts downloading it instead of just showing it
        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        $("#btn-Convert-Html2Image").attr("download", "Bill.png").attr("href", newData);
    });








    $(document).ready(function() {
        $('.parallax').parallax();
    });

    $(document).ready(function() {
        $('select').formSelect();
    });
    $(document).ready(function() {
        $('.modal').modal();
    });


    function highlight_bnk1() {
        document.getElementById("hdfc").style.border = "1px solid #5cef62 ";
        document.getElementById("hdfc").style.backgroundColor = "#fdfdfd ";
        document.getElementById("hdfc_check").style.color = " #5cef62 ";
        // hdfc
        document.getElementById("icici").style.border = "1px solid #dedede ";
        document.getElementById("icici").style.backgroundColor = "#ffffff ";
        document.getElementById("icici_check").style.color = " #dedede ";

        document.getElementById("axis").style.border = "1px solid #dedede ";
        document.getElementById("axis").style.backgroundColor = "#ffffff ";
        document.getElementById("axis_check").style.color = " #dedede ";

        document.getElementById("kotak").style.border = "1px solid #dedede ";
        document.getElementById("kotak").style.backgroundColor = "#ffffff ";
        document.getElementById("kotak_check").style.color = " #dedede ";

        document.getElementById("sbi").style.border = "1px solid #dedede ";
        document.getElementById("sbi").style.backgroundColor = "#ffffff ";
        document.getElementById("sbi_check").style.color = " #dedede ";

    }

    function highlight_bnk2() {
        document.getElementById("hdfc").style.border = "1px solid #dedede ";
        document.getElementById("hdfc").style.backgroundColor = "#ffffff ";
        document.getElementById("hdfc_check").style.color = " #dedede ";
        // ICICI
        document.getElementById("icici").style.border = "1px solid #5cef62 ";
        document.getElementById("icici").style.backgroundColor = "#fdfdfd ";
        document.getElementById("icici_check").style.color = " #5cef62 ";
        // icici
        document.getElementById("axis").style.border = "1px solid #dedede ";
        document.getElementById("axis").style.backgroundColor = "#ffffff ";
        document.getElementById("axis_check").style.color = " #dedede ";

        document.getElementById("kotak").style.border = "1px solid #dedede ";
        document.getElementById("kotak").style.backgroundColor = "#ffffff ";
        document.getElementById("kotak_check").style.color = " #dedede ";

        document.getElementById("sbi").style.border = "1px solid #dedede ";
        document.getElementById("sbi").style.backgroundColor = "#ffffff ";
        document.getElementById("sbi_check").style.color = " #dedede ";

    }
</script>

<style>
    .dropdown-content {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        color: #f1f1f1 !important;
    }

    .dropdown-content li>span {
        color: #f6f6f6;
    }

    .header_sec {
        margin: 23px;

    }

    .main_row {
        margin: 60px;
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

    .sub_total {
        margin-right: -8px;
        text-align: right;
        font-weight: 500;
        font-size: 3vh;
        color: #585858;
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
        font-size: 2vh;
        text-align: left;
        font-weight: 500;

    }

    .quant {
        color: #727475;
        font-size: 2.5vh;
        text-align: left;
        font-weight: 500;
        margin-top: 0px;
    }

    #price {
        text-align: center;
        width: 100%;
        border: none;
        font-size: 2.5vh;
        margin-top: 5px;
        color: #727475;
        font-weight: 500;

    }

    #total {
        text-align: center;
        width: 100%;
        border: none;
        font-size: 2.5vh;
        margin-top: 5px;
        color: #ea4e60;
        font-weight: 500;

    }

    @media only screen and (max-width: 600px) {
        .header_sec {
            margin: 0px;
            margin-bottom: 50px;
        }

        .main_row {
            margin: 0px;
        }

        .sub_total {
            margin-right: -8px;
            text-align: left;
            font-weight: 700;
            font-size: 3vh;
            color: #585858;
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

        #price {
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
            text-align: left;
        }

    }

    ::-webkit-scrollbar {
        width: 0px;
    }
</style>