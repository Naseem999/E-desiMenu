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
        $t_name = "notifications_" . $company;

        
        $logo = $_SESSION['A_logo'];


        
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
                    <img class="responsive-image" src="<?php echo $logo;?>" style=" height:7vh; 
                 width: 100% ;  margin: 0.7vh;   object-fit:contain;  ">
                    <hr style="    width: calc(100% - 4 0px); height:0px; border: 1px solid lightgray;">
                </div>
            </div>
            <div class="row" style="margin: 20px;">
            <ul>
                    <li id="dash_link" >
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
                    
                    <li class="active">
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
                <!-- =================================================================================================== -->
                <div class="row main_sec">

                    <div class="col s12 m12 l12">

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
                                        $sql = "SELECT * FROM notifications_edesimenu WHERE n_for='edesimenu'  order by id desc ";
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
                                                                <a class="text"> <?php echo $timestamp; ?></a>
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
                <!-- =================================================================================================== -->

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

   

    .side_sec {
        margin: 30px;
    }

    .card-panel {
        box-shadow: none;
        border-radius: 10px;
    }
    .text1 {
        color: #6f6f6f;
        font-size: 2.2vh;
        text-align: left;
        font-weight: normal;

    }

    .text{
        font-size: 2vh;
        text-align: left;
        font-weight: normal;
    }

    .main_sec {
        margin: 30px;
        margin-top: 9vh;
    }


    .header_sec {
        margin: 23px;

    }
    .cards{
        margin-top:2em;
    }

    @media only screen and (max-width: 600px) {
        .side_sec {
            margin: 0px;
        }
        .cards{
        margin-top:4em;
    }

        .main_sec {
            margin: 6px;
            margin-top: 0px;
        }
        .card-panel {
            border-radius: 10px;
        }

     
        .header_sec {
            margin: 0px;
            margin-bottom: 50px;
        }

       

        .text1{
            color: #6f6f6f;
            font-size: 1.7vh;
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