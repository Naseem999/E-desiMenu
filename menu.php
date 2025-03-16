<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include_once 'partial/head.php';
    include_once 'eeEncrypt.php';


    if (isset($_GET['cid'])) {
        $encryption = $_GET['cid'];
        $co = decrypt_url($encryption);
        $_SESSION['company'] = $co;
    }
    $company = $_SESSION['company'];
    $t_name = "offers_" . $company;
    $t_name2 = "menu_items_" . $company;
    $t_category = "category_" . $company;

    $sql = "SELECT * FROM services WHERE c_name='$company'";
    $result1 = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result1);
    if ($resultch > 0) {
        $row = mysqli_fetch_assoc($result1);
        $wallet = $row['wallet'];
        $parsel_ser = $row['parsel'];
    }

    ?>
    <title>Menu-<?php echo $company; ?></title>
</head>

<body style="background-color: #f6f6f6;">
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
            <li><a href="user_dash.php">Dash</a></li>
            <li class="divider"></li>
            <li><a href="partial/user_logout.php">Logout</a></li>
        </ul>

    <?php
    }
    ?>
    <div class="row" style="z-index: 0;">
        <div class="carousel carousel-slider" style="cursor: grabbing;">
            <?php
            $sql = "SELECT * FROM $t_name ;";
            $resultch = 0;
            if (mysqli_query($con, $sql)) {
                $result = mysqli_query($con, $sql);
                $resultch = mysqli_num_rows($result);
            }
            if ($resultch > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class=" carousel-item fadeIn " style="  width: 100%;">
                        <img src="admin/img/<?php echo $row['image']; ?>" class="car_img responsive-img" alt="">
                    </div>
                <?php
                }
            } else {
                ?>
                <div class=" carousel-item fadeIn" style=" width: 100%;
    filter: brightness(100%);
    background: url(img/menu_bg1.jpg) no-repeat 50% 50%;
    background-size: cover;">
                    <div class="row">
                        <div class="col s12 m12 l12" style="height: 13vh;"></div>
                        <p style="color: #f6f6f6; font-size: 7vh ; font-family: Rubik; text-align: center;"><?php echo "Menu  " . $company; ?></p>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
    <!-- <div class="row serve_section">
        <div class="col s12 m4 l4">
            <div class="card  hoverable" style="border-radius:10px; ">
                <div class="card-image waves-effect waves-block waves-light" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <img class="activator responsive-img" src="img/restaurant_header_bg3.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4" style="font-weight: 500; "> Vegetarian <i class="material-icons right">more_vert</i></span>
                </div>
                <div class="card-reveal white " style=" border-radius: 10px;">
                    <hr style="width: 20px;">
                    <br>
                    <span class="card-title  text-darken-4" style="font-weight: 900; color:	#808080">Vegetarian <a style="color: #adadad;"> <i onclick="mix();" class="material-icons right">close</i></a></span>
                    <p style="color:#A0A0A0;">
                        1) Extra Vegetable Fried Rice.<br>
                        2) Peanut Slaw with Soba Noodles<br>
                        3) Pinto Posole<br>
                        4) Vegetable Paella<br>
                    </p>
                    <p style=" color:#f6f6f6; text-align:left; margin-top: 10px; "> <a href="#veg" style="align-self:left;
                                         background-color: transparent; color:#808080; margin-top:20px;" class=" waves-effect waves-light-green btn " onclick="veg();">Find More</a></p>
                </div>

            </div>
        </div>

        <div class="col s12 m4 l4">
            <div class="card  hoverable" style="border-radius:10px; ">
                <div class="card-image waves-effect waves-block waves-light" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <img class="activator responsive-img" src="img/restaurant_card1_bg.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4" style="font-weight: 500; "> Continental <i class="material-icons right">more_vert</i></span>
                </div>
                <div class="card-reveal white" style=" border-radius: 10px;">
                    <hr style="width: 20px;">
                    <br>
                    <span class="card-title  text-darken-4" style="font-weight: 900; color:#808080">Continental<a style="color: #adadad;"> <i onclick="mix();" class="material-icons right">close</i></a></span>
                    <p style="color: #A0A0A0;">
                        1) Extra Vegetable Fried Rice.<br>
                        2) Peanut Slaw with Soba Noodles<br>
                        3) Pinto Posole<br>
                        4) Vegetable Paella<br>
                    </p>
                    <p style=" color:#f6f6f6; text-align:left; margin-top: 10px; "> <a href="#conti" style="align-self:left;
                                         background-color: transparent; color:#808080; margin-top:20px;" class=" waves-effect waves-light-green btn " onclick="conti();">Find More</a></p>
                </div>

            </div>
        </div>
        <div class="col s12 m4 l4">
            <div class="card  hoverable" style="border-radius:10px; ">
                <div class="card-image waves-effect waves-block waves-light" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <img class="activator responsive-img" src="img/restaurant_card2_bg.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4" style="font-weight: 500; "> Non-Vegetarian <i class="material-icons right">more_vert</i> </span>
                </div>
                <div class="card-reveal white " style=" border-radius: 10px;">
                    <hr style="width: 20px;">
                    <br>
                    <span class="card-title  text-darken-4" style="font-weight: 900; color:#808080">Non-Vegetarian <a style="color: #adadad;"> <i onclick="mix();" class="material-icons right">close</i></a></span>
                    <p style="color: #A0A0A0;">
                        1) Extra Vegetable Fried Rice.<br>
                        2) Peanut Slaw with Soba Noodles<br>
                        3) Pinto Posole<br>
                        4) Vegetable Paella<br>
                    </p>
                    <p style=" color:#f6f6f6; text-align:left; margin-top: 10px; "> <a href="#non_veg" style="align-self:left;
                                         background-color: transparent; color:#808080; margin-top:20px;" class=" waves-effect waves-light-green btn " onclick="non_veg();">Find More</a></p>
                </div>

            </div>
        </div>
    </div> -->


    <!-- menu section ---------------------------------------------------------------------------------------------- -->

    <div id="modal1" class="modal" style=" width: 80vw;  border-top-left-radius: 15px;border-top-right-radius: 15px; background-color:transparent; box-shadow: none;">
        <div class="modal-content">
            <div class="row" style="background-color: #f6f6f6; border-radius: 15px; padding: 20px; background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
                <form action="menu.php" method="get">
                    <div class="col s12 m9 l9">
                        <div class="input-field col s12">
                            <select name="sort_category" required style="color: #f1f5f6 !important;">
                                <option value="" disabled selected>Select Category</option>
                                <?php
                                $sql = "SELECT * FROM  $t_category ";
                                $resultch = 0;
                                if (mysqli_query($con, $sql)) {
                                    $result = mysqli_query($con, $sql);
                                    $resultch = mysqli_num_rows($result);
                                }
                                if ($resultch < 1) {
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $name = $row['name'];
                                        echo "<option value='$name'>$name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col s12 m3 l3 ">
                        <button name="sort_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left; margin-top: 1.3em;">
                            Sort
                        </button>
                </form>
                <a href="menu.php?title=Menu&sort_clear_submit=true" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left; margin-top: 1.3em;">
                    Clear
                </a>
            </div>
            </form>
        </div>
    </div>
    </div>

    <?php
    if (isset($_GET['sort_submit'])) {
        $sort_category = mysqli_real_escape_string($con, $_GET['sort_category']);
        $sql_sort = "SELECT * FROM $t_name2 WHERE item_category='$sort_category';";
    } else {
        $sql_sort = "SELECT * FROM $t_name2 order by id desc ";
    }
    if (isset($_GET['sort_clear_submit'])) {
        if ($_GET['sort_clear_submit'] == true) {
            $sql_sort = "SELECT * FROM $t_name2 order by id desc ";
        }
    }
    ?>

    <div class="row serve_section" id="mix" style="display: block;">
        <div class="col s12 m12 l12 " style="margin-top: 0px;">
            <p style="text-align: center; margin-top: 0px;"> <a class="waves-effect waves-light modal-trigger   z-depth-5" style="color: #f6f6f6; background-color: #1c1c1c; padding: 5px; border-radius:5px;" href="#modal1">
                    <i style="font-size: 2em;" class="  small material-icons">sort</i></a>
            </p>
            <hr style="width: 10px; margin-bottom:2em">
        </div>



        <div class="row center-align">
            <?php
            function pickColor()
            {

                $colors = array('#133840', '#2b4b40', '#92a742', '#d7b957', '#d7b957', '#e3686b', '#f88e28');

                // selecting random color 
                $random_color = array_rand($colors);

                return $colors[$random_color];
            }
            ?>


            <?php

            $show = false;

            $resultch = 0;
            if (mysqli_query($con, $sql_sort)) {
                $result = mysqli_query($con, $sql_sort);
                $resultch = mysqli_num_rows($result);
            }
            $subtotal = 0;
            $show = true;
            if ($resultch > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $item_name = $row['item_name'];
                    $img = $row['item_img'];
                    $price = $row['item_price'];

            ?>

                    <div class="col s12 m4 l4">
                        <div class="valign-wrapper card-panel grey lighten-5 z-depth-3 " style="padding: 0px; border-radius: 10px;">
                            <div class="col s5 m5 l5" style="
                          height: 17vh;
                          background: url(admin/img/<?php echo $img; ?>) no-repeat 50% 50%  ;
                          background-size: cover;
                          border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                            </div>
                            <div class="col s8 m12 l12">
                                <p style="color: #727475; font-size: 2.7vh; font-weight: 300; margin-top: 0px;"><?php echo $item_name; ?></p>
                                <?php
                                $color = pickColor();
                                ?>
                                <a class="waves-effect waves-light  modal-trigger" href="#<?php echo $row['id']; ?>" style=" padding: 0px;  border: none; background-color: transparent; box-shadow: none;"><span style="background-color: <?php echo $color; ?>;  color:#f6f6f6; padding:2px;">order now</span></a>

                            </div>
                            <div class="col s4 m4 l4 waves-effect waves-light-green" style="background-color:<?php echo $color; ?>; height: 17vh; border-bottom-right-radius: 10px; border-top-right-radius: 10px;">
                                <p style="color: #f6f6f6; font-size: 3vh; margin-top:1em;text-align: center; ">$<br><span style="font-size: 3vh;"><?php echo $price; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Structure -->
                    <form action="user_order.php" method="post">
                        <input name="item_name" type="hidden" value="<?php echo $item_name; ?>">
                        <input name="item_price" type="hidden" value="<?php echo $price; ?>">
                        <input name="item_img" type="hidden" value="<?php echo $img; ?>">
                        <input name="item_category" type="hidden" value="<?php echo $row['item_category']; ?>">

                        <div id="<?php echo $row['id']; ?>" class="modal " style="height: 100vh; width: 80vw;  border-top-left-radius: 15px;border-top-right-radius: 15px; background-color:transparent; box-shadow: none;">
                            <div class="modal-content" style="margin-top:2px; padding: 5px; background-color: transparent; ">
                                <div class="row z-depth-2" style="border-radius: 15px; margin-bottom: 0px;background-color:#f6f6f6; ">
                                    <div class="col s12 m12 l12" style="
                      border-top-left-radius: 15px;
                      border-top-right-radius: 15px;
                          height: 14vh;
                          background: url(admin/img/<?php echo $img; ?>) no-repeat 50% 50%  ;
                          background-size: cover;
                         "></div>

                                    <div class="row" style="border-bottom: 1px solid gray;">
                                        <div class="col s6 m6 l6 " style="border-right:1px solid  #dedede ; height: 15vh;">
                                            <?php
                                            $num = str_word_count($item_name);
                                            if ($num <= 2) {
                                                echo "<p class='para_modal1'>$item_name</p>";
                                            } else {
                                                echo "<p class='para_modal2'> $item_name</p>";
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if($parsel_ser=='on'){
                                        ?>
                                        <div class="col s6 m6 l6 " style="border-right:1px solid  #dedede ; height: 15vh;">
                                            <p style="margin-top: 2.5em;">
                                                <label>
                                                    <input name="parsel" type="checkbox" class="filled-in"  />
                                                    <span>Parsel</span>
                                                </label>
                                            </p>
                                        </div>
                                        <?php
                                        }else{
                                            ?>
                                            <div class="col s6 m6 l6 " style="border-right:1px solid  #dedede ; height: 15vh;">
                                                <p style="margin-top: 2.5em;">
                                                    <label>
                                                        <input name="parsel" type="checkbox" disabled class="filled-in"  />
                                                        <span>Parsel (<span style="font-size: 2vh; color: #a3a3a3;">Service Not Avialabe</span>)</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col s4 m4 l4" style=" border-right:1px solid  #dedede ; height: 15vh;">
                                        <p style="text-align: center; margin-top:5vh; color: #727475; font-size: 3.5vh; font-weight: 300;  ">$<?php echo $price; ?></p>

                                    </div>
                                    <div class="col s4 m4 l4 center-align ">
                                        <input id="number" type="number" name="item_quantity" min="1" value="1">

                                    </div>
                                    <div class="col s4 m4 l4" style=" border-left:1px solid  #dedede ; height: 15vh;">
                                        <select name="tabel_no" style="margin-top: 1.4em;">
                                            <option value="" disabled selected>Table Number</option>
                                            <?php
                                            $sql1 = "SELECT * FROM  company  WHERE c_name='$company' ";
                                            $resultch1 = 0;
                                            if (mysqli_query($con, $sql1)) {
                                                $result1 = mysqli_query($con, $sql1);
                                                $resultch1 = mysqli_num_rows($result1);
                                            }
                                            if ($resultch1 < 1) {
                                            } else {
                                                $row1 = mysqli_fetch_assoc($result1);
                                                $num = $row1['num_tables'];
                                                for ($i = 1; $i <= $num; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer " style="background-color: transparent;">
                                <a href="#!" class=" modal-action modal-close waves-effect waves-red btn " style="background-color: #a3a3a3;">Cancle</a>
                                <button style="background-color: rgb(237, 90, 107); font-weight: bold;" type="submit" name="add_cart_submit" class=" waves-effect waves-light btn ">Order</button>
                            </div>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
            <!-- ============================================================================================================================== -->


        </div>

        <style>
            .dropdown-content {
                border-radius: 10px;
                color: #1c1c1c !important;
            }

            .dropdown-content li>span {
                color: #1c1c1c;
            }


            #number {
                text-align: center;
                border-bottom: none;
                width: 50%;
                font-size: 3.6vh;
                color: #727475;
                font-weight: 500;
                margin-top: 3.8vh;

            }

            .para_modal1 {
                text-align: center;
                color: #727475;
                font-size: 3.5vh;
                margin-bottom: 0px;
                font-weight: 300;
                margin-top: 5vh;
            }

            .para_modal2 {
                text-align: center;
                color: #727475;
                font-size: 3vh;
                margin-bottom: 0px;
                font-weight: 300;
                margin-top: 4vh;
            }

            @media only screen and (max-width: 600px) {


                .para_modal1 {
                    text-align: center;
                    color: #727475;
                    font-size: 2.7vh;
                    margin-bottom: 0px;
                    font-weight: 300;
                    margin-top: 4vh;
                }

                .para_modal2 {
                    text-align: center;
                    margin-top: 3vh;
                    color: #727475;
                    font-size: 2.4vh;
                    font-weight: 300;
                }
            }
        </style>
    </div>






    <div id="cart_btn" style=" padding: 25px;
           position: fixed;
           bottom: 0;
           z-index: 1;
           right: 0;
          margin: 0px;
          margin-bottom: 0px;  
          ">
        <?php
        $num_items = 0;
        if (isset($_SESSION['user_email'])) {
            $t_name3 = "orders_" . $company;
            $username = $_SESSION['user_email'];
            $sql = "SELECT * FROM $t_name3 WHERE order_by='$username' ";
            if (mysqli_query($con, $sql)) {
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $payment = $row['payment'];
                    if ($payment == 'pending') {
                        $num_items++;
                    }
                }
            }
        }
        ?>

        <span id="cart_num" class="right" style=" border-radius: 100px; margin-bottom:0px; vertical-align:top; background-color: transparent; margin-right: 10px;  font-size:3.2vh; color:rgb(237, 90, 107); font-weight: bolder;">
            <?php echo $num_items; ?>
        </span>
        <p style="  color:gray; text-align:right; margin-top: 0px; z-index: 1;"> <a href="cart.php" style="background-color: rgb(237, 90, 107); " class=" z-depth-5 btn-floating btn-large waves-effect waves-light  ">
                <i class="large material-icons">shopping_cart</i>
            </a>
        </p>

    </div>

    </div>

    <?php
    include_once 'partial/scripts.php';
    if (isset($_GET['msg'])) {
    ?>
        <script>
            var toastHTML =
                "<span style='color:#a9ffac;'><?php echo $_GET['msg']; ?></span>"
            var toastElement = document.querySelector('.toast');
            M.toast({
                html: toastHTML,
                displayLength: 6000,
                outDuration: 600
            });
            document.getElementById("cart_btn").style.animation = "bounce 1.5s linear 2";
            document.getElementById("cart_num").style.animation = "bounce 1.5s linear 7";
        </script>
    <?php
    }

    if (isset($_GET['error'])) {
    ?>
        <script>
            var toastHTML =
                "<span style='color:pink;'><?php echo $_GET['error']; ?></span>"
            var toastElement = document.querySelector('.toast');
            M.toast({
                html: toastHTML,
                displayLength: 6000,
                outDuration: 600
            });
            document.getElementById("cart_btn").style.animation = "bounce 1.5s linear 2";
            document.getElementById("cart_num").style.animation = "bounce 1.5s linear 7";
        </script>
    <?php
    }
    ?>


</body>

</html>

<style>
    ::-webkit-scrollbar {
        width: 0px;
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

    @-webkit-keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            -webkit-transform: translateY(0);
        }

        40% {
            -webkit-transform: translateY(-30px);
        }

        60% {
            -webkit-transform: translateY(-15px);
        }
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-30px);
        }

        60% {
            transform: translateY(-15px);
        }
    }

    .bounce {
        -webkit-animation-name: bounce;
        animation-name: bounce;
    }

    .serve_section {
        margin: 50px;
    }

    .car_img {
        height: 400px !important;
    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (max-width: 600px) {
        .serve_section {
            margin: 0px;
            margin-top: 20px;
        }

        .car_img {
            height: 150px !important;
        }

        .serveice_card {
            margin-top: 10px;
        }

    }
</style>
<script>
    function mix() {
        var conti = document.getElementById("conti");
        var mix = document.getElementById("mix");
        var veg = document.getElementById("veg");
        var non = document.getElementById("non_veg");
        if (mix.style.display === "none") {
            mix.style.display = "block";
            veg.style.display = "none";
            conti.style.display = "none";
            non.style.display = "none";

        }
    }


    function non_veg() {
        var conti = document.getElementById("conti");
        var mix = document.getElementById("mix");
        var veg = document.getElementById("veg");
        var non = document.getElementById("non_veg");
        if (non.style.display === "none") {
            non.style.display = "block";
            veg.style.display = "none";
            conti.style.display = "none";
            mix.style.display = "none";

        }
    }

    function veg() {
        var mix = document.getElementById("mix");
        var conti = document.getElementById("conti");
        var veg = document.getElementById("veg");
        var non = document.getElementById("non_veg");
        if (veg.style.display === "none") {
            veg.style.display = "block";
            non.style.display = "none";
            conti.style.display = "none";
            mix.style.display = "none";


        }
    }

    function conti() {
        var mix = document.getElementById("mix");
        var conti = document.getElementById("conti");
        var veg = document.getElementById("veg");
        var non = document.getElementById("non_veg");
        if (conti.style.display === "none") {
            conti.style.display = "block";
            non.style.display = "none";
            veg.style.display = "none";
            mix.style.display = "none";

        }
    }


    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: false
    });

    // setInterval(function() {
    //     $('.carousel.carousel-slider').carousel('next');
    // }, 5000);
    $(document).ready(function() {
        $('.modal').modal();
    });
    setInterval(function() {
        $('.carousel.carousel-slider').carousel('next');
    }, 5000);

    $(document).ready(function() {
        $('.parallax').parallax();
        $('.collapsible').collapsible();
    });
    $(document).ready(function() {
        $('select').formSelect();
    });
</script>