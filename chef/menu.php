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
        $t_name = "menu_items_" . $company;
        $t_name2 = "category_" . $company;

        ?>

        <title>Menu</title>
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
                    <li id="s_menu_link" class="active">
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
                
                    <li id="orders_link">
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
                    <div class="col s12 m12 l12  z-depth-5" style="margin-top: 2em; padding: 20px; border-radius: 10px; background-color: #4158D0;
background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
">
                        <form action="menu.php" method="get">
                            <div class="col s12 m9 l9">
                                <div class="input-field col s12">
                                    <select name="sort_category" required  style="color: #f1f5f6;">
                                        <option value="" disabled selected>Select Category</option>
                                        <?php
                                        $sql = "SELECT * FROM  $t_name2 ";
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
                        <a href="menu.php?title=Menu&sort_clear_submit=true"  class="waves-effect waves-light btn  " style=" 
                             background-color: #1c1c1c;
            box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
            -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left; margin-top: 1.3em;">
                            Clear
                        </a>
                    </div>

                    <?php
                    if (isset($_GET['sort_submit'])) {
                        $sort_category = mysqli_real_escape_string($con, $_GET['sort_category']);
                        $sql_sort = "SELECT * FROM $t_name WHERE item_category='$sort_category';";
                    } else {
                        $sql_sort = "SELECT * FROM $t_name order by id desc ";
                    }
                    if (isset($_GET['sort_clear_submit'])) {
                        if($_GET['sort_clear_submit']==true){
                        $sql_sort = "SELECT * FROM $t_name order by id desc ";
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- =========================================================================================== -->

            <?php
            $show = false;
            $sql = "SELECT * FROM $t_name ";
            $resultch = 0;
            if (mysqli_query($con, $sql)) {
                $result = mysqli_query($con, $sql);
                $resultch = mysqli_num_rows($result);
            }
            if ($resultch < 1) {
            ?>

                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <a href="add_menu_item.php?title=Add To Menu">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_alyseq4q.json" background="transparent" speed="1" style="width: 60em; height:70vh;" loop autoplay></lottie-player>
                </a>
            <?php
            } else {
            ?>



                <!-- MENU ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                <?php
                $show = false;
                $resultch = 0;
                if (mysqli_query($con, $sql_sort)) {
                    $result = mysqli_query($con, $sql_sort);
                    $resultch = mysqli_num_rows($result);
                }
                ?>

                <div class="row items_row " style="background: #FFE000;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #799F0C, #FFE000);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #799F0C, #FFE000); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
 border-radius: 0px; margin-top: 3em;">
                    <?php
                    $subtotal = 0;
                    $show = true;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_name = $row['item_name'];
                        $item_category = $row['item_category'];
                        $img = $row['item_img'];
                        $price = $row['item_price'];

                    ?>

                        <div class="col s12 m6 l6">
                            <div class="valign-wrapper card-panel grey lighten-5 z-depth-3 " style="padding: 0px; border-radius: 10px;">
                                <div class="col s7 m7 l7" style="
                          height: 8em;
                          background: url('img/<?php echo $img; ?>') no-repeat 50% 50%  ;
                          background-size: cover;
                          border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                </div>
                                <div class="col s5 m5 l5" style=" height: 8em;">
                                    <?php
                                    $num = str_word_count($item_name);
                                    if ($num <= 2) {
                                        echo "<p class='para_modal_menu1'>$item_name</p>";
                                    } else {
                                        echo "<p class='para_modal_menu'> $item_name</p>";
                                    }
                                    ?>
                                    <p style="text-align: left;margin-top: 1vh;  color:#ea4e60;  font-size: 3vh; font-weight: bold;  "><span><?php echo $price; ?><i style="vertical-align: text-top;" class="tiny material-icons">attach_money</i></span></p>

                                </div>
                                
                            </div>
                        </div>
                      

                    <?php
                    }
                    ?>
                </div>






            <?php

            }
            ?>

            <script>
                $(document).ready(function() {
                    $('.modal').modal();
                });
            </script>
            <style>
                .items_row {
                    padding: 5px;
                }

                .dropdown-content {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        color: #f1f1f1 !important;
    }

    .dropdown-content li>span {
        color: #f6f6f6;
    }
    .select-wrapper input.select-dropdown{
        color: #f1f1f1;
    }
                #number_menu {
                    text-align: center;
                    border-bottom: 1px solid #dedede;
                    width: 100%;
                    font-size: 3.5vh;
                    color: #ea4e60;
                    font-weight: 500;
                    margin-top: 0.7em;

                }

                .para_modal_menu1 {
                    color: #727475;
                    font-size: 2.7vh;
                    margin-bottom: 0px;
                    font-weight: 300;
                    margin-top: 4vh;
                }

                .para_modal_menu {
                    color: #727475;
                    font-size: 2.7vh;
                    margin-bottom: 0px;
                    font-weight: 300;
                    margin-top: 2vh;
                }

                @media only screen and (max-width: 600px) {
                    .items_row {
                        padding: 0px;
                    }

                    .para_modal_menu1 {
                        color: #727475;
                        font-size: 2.7vh;
                        margin-bottom: 0px;
                        font-weight: 300;
                        margin-top: 4vh;
                    }

                    .para_modal_menu {
                        text-align: left;
                        margin-top: 1vh;
                        color: #727475;
                        font-size: 2.3vh;
                        font-weight: 300;
                    }
                }
            </style>
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
    header("Location:index.php?error=Login As Chef");
}
?>
<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });

    $(document).ready(function() {
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