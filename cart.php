<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    } else {
        header("Location:user_login.php");
    }
    include_once 'partial/head.php';
    $company = $_SESSION['company'];
    $t_name = "orders_" . $company;

    if (isset($_POST['update_cart_submit'])) {
        $item_quantity = mysqli_real_escape_string($con, $_POST['item_quantity']);
        $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
        $sql = "UPDATE $t_name SET item_quantity='$item_quantity' WHERE id='$item_id' order by id desc ";
        $result = mysqli_query($con, $sql);
        header("Location:cart.php?msg=Cart Updated");
    }

    if (isset($_POST['del_item_submit'])) {
        $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
        if (empty($item_id)) {
            $Err = "Somthing went Wrong";
            header("Location:cart.php?error=$Err");
            exit();
        } else {
            $sql = "DELETE FROM $t_name WHERE id=$item_id";
            mysqli_query($con, $sql);
            header("Location:cart.php?msg=Item Removed From Cart");
        }
    }

    ?>
    <title>Cart</title>
</head>

<body>
    <?php
    if (isset($_GET['error'])) {
    ?>
        <script>
            var toastHTML =
                "<div style='color:#e57373' ><p style='margin-bottom:0px'>Item Already Exsist in Cart.<br>You Can Increse and Decrease The Quantity or Continue Ordering.</p><br><a href='<?php echo $_SERVER['HTTP_REFERER']; ?>' style='color:white; background-color:#1c1c1c ;margin:1px; margin-top:0px; margin-left:0px' class='btn-flat toast-action'>Continue</button></div>"
            var toastElement = document.querySelector('.toast');
            M.toast({
                html: toastHTML,
                displayLength: 6000,
                outDuration: 600
            });
        </script>
    <?php
    }
    if (isset($_GET['msg'])) {
    ?>
        <script>
            var toastHTML =
                "<span style='color:#a9ffac' ><?php echo $_GET['msg']; ?></span>"
            var toastElement = document.querySelector('.toast');
            M.toast({
                html: toastHTML,
                displayLength: 6000,
                outDuration: 600
            });
        </script>
    <?php
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
        <div class="parallax-container" style="  height:50vh;">

            <div class="parallax">
                <img src="img/cart_bg.png" alt="Parallax">
            </div>

            <div class="row" style="  width: 100%; height: 100%;  margin-top:9vh; ">
                <div class="col s12 m12 l12 center-align">
                    <h3 style="   text-align: center; 
                    font-weight: 600; margin-bottom: 0px;  font-size: 8.5vh; color: #f6f6f6; ">
                        CART
                    </h3>
                    <hr style="width: 60px; height: 2px; border: none; background-color: #dedede;">
                </div>

            </div>
        </div>
    </div>

    <!-- main section -->
    <div class="row main_sec">

        <div class="valign-wrapper card-panel  z-depth-1  " style=" border-radius: 10px; border: 1px solid #dedede; margin-top: 0px; padding: 0px;">

            <div class=" col s5 m4 l4 ">
                <p class="text" style="color: #585858;">Item Name</p>
            </div>
            <div class="col s2  m2 l2 center-align">
                <p style="text-align: center; color: #585858;" class="text">Price</p>
            </div>

            <div class="col s2  m2 l2 center-align">
                <p style="text-align: center;color: #585858;" class="text">Quantity</p>
            </div>
            <div class="col s2  m2 l2 center-align">

                <p style="text-align: center;color:#585858;" class="text">Total</p>

            </div>

            <div class="col s3  m1 l1 " style=" height: 9vh;  ">

            </div>
        </div>

        <table>
            <tbody">
                <?php
                $show = false;
                $sql = "SELECT * FROM $t_name WHERE order_by='$user_email' order by id desc ";
                $result = mysqli_query($con, $sql);
                $resultch = mysqli_num_rows($result);
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
                        $payment = $row['payment'];
                        if ($payment == 'done') {
                    ?>
                           
                        <?php
                        } else {

                        ?>
                            <tr>
                                <?php
                                $item_name = $row['item_name'];
                                $img = $row['item_img'];
                                $price = $row['item_price'];
                                $quantity = $row['item_quantity'];


                                $total = $price * $quantity;
                                $subtotal = $subtotal + $total;

                                ?>


                                <div class="valign-wrapper card-panel hoverable  " style="border: 1px solid #dedede; padding: 0px;">
                                    <div class=" col s5 m4 l4 ">
                                        <p class=" text">
                                            <a href="#<?php echo $row['id'] ?>" class="text modal-trigger "> <?php echo $row['item_name']; ?></a>
                                        </p>
                                    </div>
                                    <div class="col s2  m2 l2 center-align">

                                        <p id="price">$<?php echo $price; ?></p>

                                    </div>

                                    <div class="col s2  m2 l2 center-align">

                                        <a href="#<?php echo $row['id'] ?>" class="text modal-trigger  waves-effect waves-light ">
                                            <?php echo  $quantity ?>
                                            <hr style="width: 10px; margin-top:0px; margin-bottom: 0px;">
                                        </a>

                                    </div>
                                    <div class="col s2  m2 l2 center-align">

                                        <p id="total" type="text">$<?php echo $total; ?> </p>

                                    </div>

                                    <div class="col s3  m1 l1 waves-effect   waves-red " style=" height: 9vh;  ">
                                        <form action="cart.php" method="post">
                                            <input name="item_id" type="hidden" value="<?php echo $row['id'] ?>">
                                            <button class="left" type="submit" name="del_item_submit" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                <i style=" color: gray;" class=" material-icons ">delete</i>
                                            </button>
                                        </form>
                                    </div>

                                </div>

                                <form action="cart.php" method="post">
                                    <input name="item_id" type="hidden" value="<?php echo $row['id'] ?>">

                                    <div id="<?php echo $row['id'] ?>" class="modal bottom-sheet" style=" border-top-left-radius: 15px;border-top-right-radius: 15px; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(20px)">
                                        <div class="modal-content" style="margin-top:2px; padding: 5px;background-color: transparent;">
                                            <div class="row z-depth-2" style="border-radius: 15px;  margin-bottom: 0px;background-color:#f6f6f6; ">
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


                            </tr>



                <?php
                        }
                    }
                }
                ?>
                <p style=" text-align:center; margin-top: 3em; z-index: 1;"> <a href="menu.php" style="background-color: #1c1c1c " class=" modal-trigger z-depth-5 btn-floating btn-large waves-effect waves-light  ">
                        <i class=" material-icons">add</i>
                    </a>
                </p>
                </tbody>
        </table>

        <?php
        if ($show != false) {
        ?>
            <div class="valign-wrapper card-panel  z-depth-0  center-align  " style="   border: 1px solid #dedede; border-radius: 5px; margin-top:5vh; padding: 0px;">

                <div class="col s6 m10 l10 ">
                    <p class="sub_total">
                        Subtotal:<span style="color:#ea4e60;">$<?php echo $subtotal; ?></span></p>
                </div>

                <div class="col s6 m2 l2  ">
                        <a href="checkout.php" style=" background-color: rgb(237, 90, 107);   font-weight: bold;" class="right waves-effect waves-light btn  modal-trigger ">Checkout</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    include_once 'partial/scripts.php';
    ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $('.parallax').parallax();
    });
    $(document).ready(function() {
        $('.modal').modal();
    });
</script>

<style>
    ::-webkit-scrollbar {
        width: 0px;
    }
    dropdown-content {
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

    .sub_total {
        margin-right: -8px;
        text-align: right;
        font-weight: 700;
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
        margin: 0px;

    }



    #price {
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

    @media only screen and (max-width: 600px) {
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
</style>