<?php
session_start();
if (isset($_SESSION['A_username'])) {



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
        $logo = $_SESSION['A_logo'];
        $company = $_SESSION['A_company'];
        $t_name = "orders_" . $company;
        $t_name2 = "notifications"

      

        ?>

        <title>Motel-Admin DashBord</title>
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
                    <img class="responsive-image" src="<?php echo $logo; ?>" style=" height:7vh; 
                 width: 100% ;  margin: 0.7vh;   object-fit:contain;  ">

                    <hr style="    width: calc(100% - 4 0px); height:0px; border: 1px solid lightgray;">
                </div>
            </div>
            <div class="row" style="margin: 20px;">
                <ul>
                    <li id="dash_link" class="active">
                        <a href="admin_dash.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard </p>
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
                        <a href="subscriptions.php?title=Employees">
                            <i class="material-icons">store_mall_directory</i>
                            <p>Subscriptions</p>
                        </a>
                    </li>
                    <li id="_link">
                        <a href="users.php?title=Employees">
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
                <?php
               
                $sql1 = "SELECT * FROM company ";
                $users = 0;
                
                if (mysqli_query($con, $sql1)) {
                    $result1 = mysqli_query($con, $sql1);
                    $resultch1 = mysqli_num_rows($result1);
                }
                if (!$resultch1 < 1) {

                    while ($row1 = mysqli_fetch_assoc($result1)) {
                       $users++;
                    }
                }
                $subscriptions = 0;
                $activated=0;
                $sql1 = "SELECT * FROM subscriptions ";
                $resultch1=0;
                if(mysqli_query($con, $sql1)){
                $result1 = mysqli_query($con, $sql1);
                $resultch1 = mysqli_num_rows($result1);
                }
                if (!$resultch1 < 1) {

                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $subscriptions++;
                        if($row1['status']=='activated'){
                            $activated++;
                        }
                    }
                }

                ?>
                <!-- main section -->
                <div class="row main_sec">
                    <div class="col s12 m12 l12">
                        <div class="col s12 m4 l4">
                            <a href="users.php?title=Subscriptions">
                                <div class="card z-depth-3 cards " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 0px;">
                                            <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                                <div class="card" style="  height: 7em; background: linear-gradient(60deg, #66bb6a, #43a047);    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                                                    <div class="card-image cneter-align">
                                                        <p style="text-align: center;">
                                                            <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-users fa-3x"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Users</p>
                                                <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                    <?php echo $users; ?></h1>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em;">Companies Registered Till Now</p>

                                    </div>
                                </div>
                        </div>
                        </a>
                        <a href="subscriptions.php?title=Subscriptions">
                            <div class="col s12 m4 l4">
                                <div class="card z-depth-3 cards " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 0px;">
                                            <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                                <div class="card" style="  height: 7em;   background: linear-gradient(60deg, #ef5350, #e53935);
                             box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4); border-radius: 5px;">
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
                                        <p style="color: #a3a3a3;margin-top: 1em;">Compines Subscribed with plans</p>

                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="subscriptions.php?title=Subscriptions">
                            <div class="col s12 m4 l4 ">
                                <div class="card z-depth-3 cards " style=" border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 0px;">
                                            <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                                <div class="card" style="  height: 7em;   background: linear-gradient(60deg, #ffa726, #fb8c00);
                             box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4); border-radius: 5px;">
                                                    <div class="card-image cneter-align">
                                                        <p style="text-align: center;">
                                                            <i style="padding: 20px;margin-bottom: 0.2em; color: white;" class="medium material-icons">verified_user</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em"> Activated Subs.</p>
                                                <h1 style="font-size:2em; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                    <?php echo $activated; ?></h1>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em;">Just Updated</p>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- =========================================================================================================== -->
                    <div class="col s12 m8 l8">
                        <div class="col s12 m12 l12" style="margin-top: 5em;">

                            <div class="card z-depth-3 cards " style="border-radius: 8px;">
                                <div class="card-content " style="padding: 18px;">
                                    <div class="card" style=" padding: 17px;background: linear-gradient(60deg, #ffa726, #fb8c00); 
         margin-top: -4em;   box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);   border-radius: 5px;">
                                        <div class="card-image white-text cneter-align">
                                            <p class="valign-wrapper" style="text-align: left;   font-size: 2em; ">
                                                Notificitions
                                            </p>
                                            <p class="valign-wrapper" style="text-align: left;  font-size: 1.8vh; ">
                                                All The Notifications related to chef and food orders will Be shown Here
                                            </p>
                                        </div>
                                    </div>
                                    <table>
                                        <tbody">
                                            <?php
                                            $show = false;
                                            $sql = "SELECT * FROM $t_name2   order by id desc ";
                                            $resultch=0;
                                            if(mysqli_query($con, $sql)){
                                                $result = mysqli_query($con, $sql);
                                                $resultch = mysqli_num_rows($result);
                                            }
        
                                            if ($resultch < 1) {
                                            ?>

                                                <p style="text-align: center;">
                                                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                                    <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_O0LsYM.json" background="transparent" speed="0.7" style=" height:30vh;" loop autoplay></lottie-player>
                                                </p>
                                                <?php
                                            } else {
                                                $subtotal = 0;
                                                $show = true;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <?php
                                                        $title = $row['title'];
                                                        $timestamp = $row['timestamp_'];

                                                        ?>

                                                        <div onclick="orders();" class="valign-wrapper card-panel hoverable  " style=" cursor: pointer; border: 1px solid #dedede; padding: 0px;">
                                                            <div class=" col s6 m8 l8 ">
                                                                <p>
                                                                    <a class="text1"> <?php echo $title; ?></a>
                                                                </p>
                                                            </div>
                                                            <div class=" col s3 m3 l3 ">
                                                                <p>
                                                                    <a href="#" class="text2"> <?php echo $timestamp; ?></a>
                                                                </p>
                                                            </div>
                                                            <div class="col s3  m1 l1 waves-effect   waves-red " style=" height: 9vh;  ">
                                                                <form action="del_not.php" method="get">
                                                                    <input name="noti_id" type="hidden" value="<?php echo $row['id'] ?>">
                                                                    <button class="left" type="submit" name="del_noti_submit" style="text-align: left; height: 100%; border:none; background-color:transparent; cursor: pointer;  box-shadow: none; ">
                                                                        <i style=" color: gray;" class=" material-icons ">clear</i>
                                                                    </button>
                                                                </form>
                                                            </div>

                                                        </div>



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
                    <!-- ===================================================================================================== -->
                    <div class="right col s12 m4 l4 ">
                        <?php
                        if (isset($_SESSION['A_id'])) {
                            $admin_id = $_SESSION['A_id'];
                            $sql = "SELECT * FROM admin_tab WHERE id='$admin_id';";
                            $result = mysqli_query($con, $sql);
                            $resultch = mysqli_num_rows($result);
                            if ($resultch < 1) {
                                $Err = "Invalid Login";
                                header("Location:../admin_log.php?error=$Err");
                                exit();
                            } else {
                                $row = mysqli_fetch_assoc($result);
                                $username = $row['username'];
                                $email1 = $row['email'];
                            }
                        }
                        ?>
                        <!-- main section -->
                        <div onclick="profile();" class="row main_sec" style="cursor: pointer; margin-top: 0px;">
                            <div class="col s12 m12 l12" style="margin-top: 4em;">
                                <div class="card z-depth-1 cards " style="border-radius: 8px;">
                                    <div class="card-content " style="padding: 18px;">
                                        <div class="card" style="background-color: transparent;  box-shadow: none; padding: 17px;  margin-top: -6em;">
                                            <p style="text-align: center;"> <img style="height: 8em; width:8em;" src="  ./img/user1.svg" alt="" class="z-depth-3  circle responsive-img">
                                            </p>
                                        </div>
                                        <div class="row">
                                            <p style="text-align: center; font-weight: bold; color: #6f6f6f; font-size: 1em; ">
                                                <?php
                                                echo $username;
                                                ?>
                                            </p>
                                            <hr style="width: 20px;">
                                            <div class="col s12 m12 l12" style="margin-top:0em;">

                                                <p style="text-align: center;  color: #6f6f6f; margin-top: 0.5em; font-size: 1.3em; ">
                                                    <?php
                                                    echo $email1;
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <p style="text-align: center;margin-top: 2em;">
                                                    <a href="logout.php" class="waves-effect waves-light btn  " style=" background: linear-gradient(60deg, #ef5350, #e53935);
                             box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);text-align: left;">
                                                        Logout
                                                    </a>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
    header("Location:../index.php?error=Login As Admin");
}
?>
<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });


    $(document).ready(function() {
        $(' li').on('click', function() {
            var clicked = $(this);
            $('ul li').each(function() {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                }
            });
            $(this).addClass('active');
        });
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

    .text1 {
        color: #6f6f6f;
        font-size: 2.2vh;
        text-align: left;
        font-weight: normal;

    }

    .text2 {
        font-size: 2vh;
        text-align: left;
        font-weight: normal;
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

    #total {
        text-align: center;
        font-size: 2.5vh;
        color: #ea4e60;
        font-weight: 600;

    }

    .cards {
        margin-top: 1px;
    }

    .card1 {
        margin-top: 4.5em;
    }

    .side_sec {
        margin: 30px;
    }

    @media only screen and (max-width: 600px) {
        .side_sec {
            margin: 0px;
        }

        .card1 {
            margin-top: 1em;
        }

        .cards {
            margin-top: 3em;
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

        .text1 {
            color: #6f6f6f;
            font-size: 1.7vh;
            text-align: center;
        }

        .text2 {
            font-size: 1.5vh;
            text-align: center;
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