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
        $admin_email = $_SESSION['admin_email'];
        $company = $_SESSION['company'];
        $t_name = "category_" . $company;
        $t_name2 = "offers_" . $company;

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
                    if($task=='on'){
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
                    if($employee_managment=='on'){
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
                    <li id="a_menu_link" class="active">
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
                    <li id="orders_link">
                        <a href="orders.php?title=Orders">
                            <i class="material-icons">attach_money</i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <!-- =================================== -->
                    <?php
                    if($parsel=='on'){
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
                    if($feedback=='on'){
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
                    if($stock=='on'){
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
                <div class="row">

                    <div class="col s12 m6 l6 right">
                        <p style="color: #c6c9ca; font-weight: bold; margin-top: 0px; margin-left: 10px; margin-bottom: 2px; font-size: 2.5vh; text-align: left;">Add Item To Menu</p>
                        <div class="card" style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);

box-shadow:  5px 5px 5px #c6c9ca,
             -5px -5px 5px #ffffff;  border-radius: 20px;">
                            <div class="card-content">
                                <form action="add_item.php" method="POST" enctype="multipart/form-data">
                                    <ul class="stepper leinier" style="background-color: #FBAB7E;
background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
">
                                        <!-- basic details sec -->
                                        <li class="step active">
                                            <div class="step-title waves-effect " style="border-radius: 20px; ">
                                                <span style="color: #1c1c1c;">Basic Details</span>
                                            </div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col s12 m12 l12">
                                                        <input name="item_name" placeholder="Item Name" required type="text" class="validate " style="color: #1c1c1c; text-align: center; font-size: 2.4vh;">
                                                    </div>
                                                    <div class="input-field col s12 m12 l12">
                                                        <input name="item_price" required placeholder="Price ($5)" type="number" class="validate " style="color: #1c1c1c; text-align: center; font-size: 2.4vh;">
                                                    </div>
                                                </div>

                                                <div class="step-actions">
                                                    <button style="background-color: #1c1c1c;" class=" waves-effect waves-dark btn next-step">CONTINUE</button>
                                                </div>
                                            </div>
                                        </li>
                                        <!--  Upload img  sec -->
                                        <li class="step ">
                                            <div class="step-title waves-effect" style="border-radius: 20px; ">
                                                <span style="color: #1c1c1c;">Upload Item Image</span>
                                            </div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col s12 m10 l10">
                                                        <p style="text-align: center;">
                                                            <i style="color: #1c1c1c;" class="large material-icons">cloud_upload</i>

                                                        </p>
                                                        <div class="col s12 m12 l12">
                                                            <div class="file-field input-field">
                                                                <div class="btn waves-effect waves-light" style="background-color: #1c1c1c;">
                                                                    <span>Upload</span>
                                                                    <input type="file" name="image">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text" style="color: #1c1c1c;">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="step-actions">
                                                    <!-- Here goes your actions buttons -->
                                                    <button style="background-color: #1c1c1c;" class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                                    <button style="background-color: #5a5a5a    ;" class="waves-effect waves-dark btn previous-step">BACK</button>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Other details sec -->
                                        <li class="step ">
                                            <div class="step-title waves-effect " style="border-radius: 20px; ">
                                                <span style="color: #1c1c1c;">Other Details</span>
                                            </div>
                                            <div class="step-content">
                                                <div class="row">
                                                    <div class="input-field col s12 m10 l10">
                                                        <select name="item_category" class="browser-default">
                                                            <option value="" disabled selected>Select Category</option>
                                                            <?php
                                                            $sql = "SELECT * FROM  $t_name ";
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

                                                <div class="step-actions">
                                                    <button name="add_item_submit" type="submit" style="background-color: #1c1c1c;" class="waves-effect waves-light btn ">Add to menu</button>
                                                    <button style="background-color: #5a5a5a;" class="waves-effect waves-dark btn previous-step">BACK</button>
                                                </div>
                                            </div>
                                        </li>


                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ====================================================Side -->
                    <div class="col s12 m6 l6 left ">
                        <?php
                        $sql = "SELECT * FROM  company WHERE email='$admin_email' ";
                        $num_tables = 0;
                        $resultch = 0;
                        if (mysqli_query($con, $sql)) {
                            $result = mysqli_query($con, $sql);
                            $resultch = mysqli_num_rows($result);
                        }
                        if ($resultch < 1) {
                            $num_tables = 0;
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $num_tables = $row['num_tables'];
                            }
                        }
                        ?>
                        <div class="card z-depth-1  cards1" style="border-radius: 8px; margin-top: 3em;">
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
                                        <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Number of Tables</p>
                                        <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                            <?php echo $num_tables; ?></h1>
                                    </div>
                                </div>
                                <p style="color: #a3a3a3;margin-top: 1em;">Update No Of tables<a href="#update_num_table" class="modal-trigger"> <i style=" color: gray;" class="right material-icons  ">create</i></a></p>
                            </div>
                        </div>
                        <!-- ============================= -->
                        <hr style="width: 50%; margin-top: 3em;">
                        <?php
                        if ($menu_customization == 'on') {
                        ?>
                            <div class="col s12 m12 l12 ">

                                <p style="color: #a3a3a3;text-align: center; margin-bottom: 2em;">offers</p>
                                <div class="col s12 m12 l12">
                                    <?php
                                    $show = false;
                                    $sql = "SELECT * FROM $t_name2 order by id desc ";
                                    $resultch = 0;
                                    if (mysqli_query($con, $sql)) {
                                        $result = mysqli_query($con, $sql);
                                        $resultch = mysqli_num_rows($result);
                                    }

                                    if ($resultch < 1) {
                                    } else {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="card horizontal" style="border-radius: 10px;">
                                                <div class="card-image" style="padding: 5px;">
                                                    <img src="img/<?php echo $row['image']; ?>" style="border-radius: 10px; height: 15vh;">
                                                </div>
                                                <div class="card-stacked">
                                                    <div class="card-content">
                                                        <div class="row">
                                                            <div class="col s9 m9 l9">
                                                                <p style="color: #1c1c1c; text-align: left;font-size: 2.6vh; font-weight: 600;"><?php echo $row['name']; ?></p>
                                                            </div>
                                                            <div class="col s3 m3 l3">
                                                                <a href="add_item.php?del_offer_id=<?php echo $row['id']; ?>" class="right " style="  text-align: left; margin-top: 1em; margin-left: 1.6em; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                                    <i style=" color: gray;" class=" material-icons  ">delete</i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <p style=" text-align:center; margin-top: 0px; z-index: 1;"> <a href="#add_offers" style="background-color: #1c1c1c " class=" modal-trigger z-depth-5 btn-floating btn-large waves-effect waves-light  ">
                                        <i class=" material-icons">add</i>
                                    </a>
                                </p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div id="add_offers" class="modal " style="border-radius: 10px;">
                    <div class="modal-content">
                        <form action="add_item.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;">
                                        <input name="offer_name" placeholder="Offer Name" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                    </p>
                                </div>

                                <div class="col s12 m11 l11">
                                    <div class="file-field input-field">
                                        <div class="btn waves-effect waves-light" style="text-transform: capitalize; background-color: #1c1c1c;">
                                            <span>Thumbnail</span>
                                            <input type="file" name="offer_thumbnail">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input disabled class="file-path " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;margin-top: 1em;">
                                        <button name="offers_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                            Add Offers
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="update_num_table" class="modal " style="border-radius: 10px;">
                    <div class="modal-content">
                        <form action="add_menu_item.php" method="post">
                            <div class="row">

                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;">
                                        <input name="num_tables" placeholder="Number Of tables" required type="number" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                    </p>
                                </div>

                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;margin-top: 1em;">
                                        <button name="update_table_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                            Update Table Numbers
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_POST['update_table_submit'])) {
                    $num_tables = mysqli_real_escape_string($con, $_POST['num_tables']);
                    $sql1 =  "UPDATE  company SET num_tables='$num_tables' WHERE email='$admin_email';";
                    mysqli_query($con, $sql1);
                    echo "<script>alert('Number of tables Uodated');
                window.location.assign('add_menu_item.php');
                </script>";
                    exit();
                }
                ?>


                <?php
                include_once './partial/scripts.php';
                ?>
                <style>
                    [type="radio"]:checked+span:after,
                    [type="radio"].with-gap:checked+span:after {
                        background-color: #1c1c1c;
                    }

                    [type="radio"]:checked+span:after,
                    [type="radio"].with-gap:checked+span:before,
                    [type="radio"].with-gap:checked+span:after {
                        border: 2px solid #1c1c1c;
                    }
                </style>
                <script>
                    var stepper = document.querySelector('.stepper');
                    var stepperInstace = new MStepper(stepper)

                    function show_type1() {
                        let food_type = document.getElementById('food_type');
                        let drink_type = document.getElementById('drink_type');

                        food_type.style.display = "block";
                        drink_type.style.display = "none";

                    }

                    function show_type2() {
                        let food_type = document.getElementById('food_type');
                        let drink_type = document.getElementById('drink_type');

                        food_type.style.display = "none";
                        drink_type.style.display = "block";
                    }
                </script>
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