<?php
session_start();
if (isset($_SESSION['A_username'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
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
                    <img class="responsive-image" src="<?php echo $_SESSION['A_logo'];?>" style=" height:7vh; 
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
                    <li id="profile_link" class="active">
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
                if (isset($_SESSION['A_id'])) {
                    $admin_id = $_SESSION['A_id'];
                    $sql = "SELECT * FROM admin_tab WHERE id='$admin_id';";
                    $result = mysqli_query($con, $sql);
                    $resultch = mysqli_num_rows($result);
                    if ($resultch < 1) {
                        $Err = "Invalid Login";
                        header("Location:admin_log.php?error=$Err");
                        exit();
                    } else {
                        $row = mysqli_fetch_assoc($result);
                        $username = $row['username'];
                        $email1 = $row['email'];
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
                        <div class="col s12 m8 l8 left">
                            <div class="card z-depth-1 cards " style="border-radius: 8px;">
                                <div class="card-content " style="padding: 18px;">
                                    <div class="card" style=" padding: 17px; background: linear-gradient(60deg, #66bb6a, #43a047); 
                     margin-top: -4em;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                                        <div class="card-image white-text cneter-align">
                                            <p style="text-align: center;   font-size: 1.5em; ">
                                                Edit Profile
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form action="update_admin.php" method="post">
                                            <div class="input-field col s12 m12 l12">
                                                <p style="text-align: center;">
                                                    <input name="username" placeholder="Name"  type="text" class="validate " style="width: 70%; text-align: left; font-size: 2.5vh;">
                                                </p>
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <p style="text-align: center;">
                                                    <input name="email"  placeholder="Email" type="email" class="validate " style="width: 70%; text-align: left; font-size: 2.5vh;">
                                                </p>
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <p style="text-align: center;">
                                                    <input name="pass"  placeholder="Password" type="text" class="validate " style="width: 70%; text-align: left; font-size: 2.5vh;">
                                                </p>
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <p style="text-align: center;margin-top: 1em;">
                                                    <button name="update_admin_submit" type="submit" class="waves-effect waves-light btn  " style=" background: linear-gradient(60deg, #66bb6a, #43a047); 
                        box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4); text-align: left;">
                                                        Update Profile
                                                    </button>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    echo "<script>window.location.assign('admin_log.php?error=invalid Access');</script>";
                } ?>
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