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
        $t_name = "category_" . $company;

          
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
                    <li id="dash_link" >
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
                    <li id="_link" >
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
                    <li id="_link" >
                        <a href="employee.php?title=Employees">
                            <i class="material-icons">people</i>
                            <p>Employees</p>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <li  >
                        <a href="notifications.php?title=Notifications">
                            <i class="material-icons">notifications</i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li id="s_menu_link" >
                        <a href="menu.php?title=Menu">
                            <i class="material-icons">restaurant_menu</i>
                            <p> Menu</p>
                        </a>
                    </li>
                    <li id="s_menu_link" class="active">
                        <a href="categories.php?title=Categories">
                            <i class="material-icons">view_module</i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li id="a_menu_link" >
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
                    <li id="orders_link" >
                        <a href="orders.php?title=Orders">
                            <i class="material-icons">attach_money</i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <!-- =================================== -->
                    <?php
                    if($parsel=='on'){
                    ?>
                    <li id="orders_link" >
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
                    <li id="orders_link" >
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
                    <li id="orders_link" >
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
                <div class="row">
                    <?php
                    $sql1 = "SELECT * FROM $t_name order by id desc";
                    $resultch1 = 0;
                    if (mysqli_query($con, $sql1)) {
                        $result1 = mysqli_query($con, $sql1);
                        $resultch1 = mysqli_num_rows($result1);
                    }
                    if ($resultch1 < 1) {
                    ?>
                        <p style="text-align: center;">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_vvjhceqy.json" background="transparent" speed="0.7" style=" height:30vh;" loop autoplay></lottie-player>                           
                                                 <p style="color:gray; text-align: center; font-size: 5vh;"> Add Categories</p>
                            <hr style="width: 50px;">
                            <?php
                        } else {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $title = $row1['name'];
                                $desc = $row1['description'];
                            ?>
                                <div class="col s12 m4 l4 ">
                                    <div class="card z-depth-2" style="border-radius: 10px;">
                                        <div class="card-image waves-effect waves-block waves-light" style="border-radius: 10px;">
                                            <img class="activator" class="responsive-img" src="img/<?php echo $row1['thumbnail']; ?>" style="height: 25vh; width: 100%; " >
                                        </div>
                                        <div class="card-content">

                                            <div class="row" style="margin-bottom: 0px;">
                                                <div class="col s12 m6 l6 " >
                                                    <p class="card-title activator" style="color: #3e3e3e; font-size: 3.2vh;font-weight: bold;"><?php echo $title; ?></p>

                                                </div>

                                                <div class="col s6 m6 l6 right" style="margin-top: 1.5vh;">
                                                    <a href="crud_categories.php?del_id=<?php echo $row1['id']; ?>" class="right " style="  text-align: left; margin-left: 1.6em; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                        <i style=" color: gray;" class=" material-icons  ">delete</i>
                                                    </a>
                                                    <a href="#note<?php echo $row1['id']; ?>" class="right modal-trigger " style=" border-radius: 10px; text-align: left; margin-left: 20px; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                        <i style=" color: gray;" class=" material-icons  ">edit</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-reveal">
                                            <span class="card-title grey-text text-darken-4"><?php echo $title ?><i class="material-icons right">close</i></span>
                                            <p><?php echo $desc; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!--Edit Note Modal Structure -->
                                <div id="<?php echo "note" . $row1['id']; ?>" class="modal md" style="border-radius: 10px;">
                                    <div class="modal-content">
                                        <form action="crud_categories.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="category_id" value="<?php echo $row1['id']; ?>">
                                            <div class="row">
                                                <div class="input-field col s12 m12 l12">
                                                    <p style="text-align: center;">
                                                        <input name="name" placeholder="Category Name"  type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                    </p>
                                                </div>
                                                <div class="input-field col s12 m12 l12">
                                                    <p style="text-align: center;">
                                                        <textarea name="description"  placeholder="Description..." type="text" class="validate materialize-textarea" style="width: 80%; text-align: left; font-size: 2.5vh;"></textarea>
                                                    </p>
                                                </div>

                                                <div class="col s12 m11 l11">
                                                    <div class="file-field input-field">
                                                        <div class="btn waves-effect waves-light" style="text-transform: capitalize; background-color: #1c1c1c;">
                                                            <span>Thumbnail</span>
                                                            <input type="file" name="thumbnail">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input disabled class="file-path " type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-field col s12 m12 l12">
                                                    <p style="text-align: center;margin-top: 1em;">
                                                        <button name="update_category_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                         background-color: #1c1c1c;
        box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                                            Update Category
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                </div>


                <div id="cart_btn" style=" padding: 25px;
           position: fixed;
           bottom: 0;
           z-index: 1;
           right: 0;
          margin: 0px;
          margin-bottom: 0px;  
          ">
                    <p style=" text-align:right; margin-top: 0px; z-index: 1;"> <a href="#add" style="background-color: #1c1c1c " class=" modal-trigger z-depth-5 btn-floating btn-large waves-effect waves-light  ">
                            <i class=" material-icons">add</i>
                        </a>
                    </p>

                </div>


                <!--add Note Modal Structure -->
                <div id="add" class="modal md" style="border-radius: 10px;">
                    <div class="modal-content">
                        <form action="crud_categories.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;">
                                        <input name="name" placeholder="Category Name" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                    </p>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;">
                                        <textarea name="description" required placeholder="Description..." type="text" class="validate materialize-textarea" style="width: 80%; text-align: left; font-size: 2.5vh;"></textarea>
                                    </p>
                                </div>

                                <div class="col s12 m11 l11">
                                    <div class="file-field input-field">
                                        <div class="btn waves-effect waves-light" style="text-transform: capitalize; background-color: #1c1c1c;">
                                            <span>Thumbnail</span>
                                            <input type="file" name="thumbnail">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input disabled class="file-path " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;margin-top: 1em;">
                                        <button name="add_category_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                         background-color: #1c1c1c;
        box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                            Add Category
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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