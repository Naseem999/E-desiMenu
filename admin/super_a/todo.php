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
        $init = $_SESSION['A_company'];
        $company = str_replace( array("#", "'","-",";"), '', $init);
        $t_name = "todo_" . $company;


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
                    <img class="responsive-image" src="<?php echo $_SESSION['A_logo']; ?>" style=" height:7vh; 
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
                    <li id="_link" class="active">
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
                <div class="row">
                    <?php
                    $sql1 = "SELECT * FROM $t_name WHERE note_for=$admin_id order by id desc";
                    $resultch1 = 0;
                    if (mysqli_query($con, $sql1)) {
                        $result1 = mysqli_query($con, $sql1);
                        $resultch1 = mysqli_num_rows($result1);
                    }
                    if ($resultch1 < 1) {
                    ?>
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

                        <p style="text-align: center;">
                            <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_2pqqIT.json" background="transparent" speed="0.7" style="width: 70vw; height:60vh;" loop autoplay></lottie-player>
                            <p style="color:gray; text-align: center; font-size: 3vh; font-weight: bold;"> Add Your Frist Note</p>
                            <hr style="width: 50px;">
                            <?php
                        } else {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $title = $row1['title'];
                                $desc = $row1['description'];
                            ?>
                                <div class="col s12 m4 l4 ">
                                    <div class="card z-depth-1 " style="border-radius: 10px;">
                                        <div class="card-content black-text">
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <p class="card-title" style="color: #3C4858; font-size: 3vh;"><?php echo $title; ?></p>
                                                </div>
                                                  <div class="col s12 m12 l12 ">
                                                    <textarea disabled rows="6" cols="50" style=" height: auto; font-size: 2vh; border: none; margin-left: 5px; color: gray;"><?php echo $desc; ?></textarea>
                                                </div>

                                            </div>
                                            <div class="row" style="margin-bottom: 0px;">
                                                <div class="col s6 m6 l6 ">
                                                    <p style="font-size: 1.7vh; margin-left: 5px; color: lightgray;"><?php echo $row1['timestamp_']; ?></p>
                                                </div>
                                                <div class="col s6 m6 l6 ">
                                                    <a href="crud_note.php?del_id=<?php echo $row1['id']; ?>" class="right " style="  text-align: left; margin-left: 1.6em; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                        <i style=" color: gray;" class=" material-icons  ">delete</i>
                                                    </a>
                                                    <a href="#note<?php echo $row1['id']; ?>" class="right modal-trigger " style=" border-radius: 10px; text-align: left; margin-left: 20px; height: 100%; background-color:transparent;   box-shadow: none; ">
                                                        <i style=" color: gray;" class=" material-icons  ">edit</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--add Note Modal Structure -->
                                <div id="<?php echo "note" . $row1['id']; ?>" class="modal md" style="border-radius: 10px;">
                                    <div class="modal-content">
                                        <form action="crud_note.php" method="post">
                                            <input type="hidden" name="note_id" value="<?php echo $row1['id']; ?>">
                                            <div class="row">
                                                <div class="input-field col s12 m12 l12">
                                                    <p style="text-align: center;">
                                                        <input name="edit_title" placeholder="<?php echo $title ?>" type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                                    </p>
                                                </div>
                                                <div class="input-field col s12 m12 l12">
                                                    <p style="text-align: center;">
                                                        <textarea name="edit_desc" placeholder="<?php echo $desc ?> " type="text" class="validate materialize-textarea" style="width: 80%; text-align: left; font-size: 2.5vh;"></textarea>
                                                    </p>
                                                </div>
                                                <div class="input-field col s12 m12 l12">
                                                    <p style="text-align: center;margin-top: 1em;">
                                                        <button name="update_note_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                         background-color: #1c1c1c;
        box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                                            Update Note
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
                        <form action="crud_note.php" method="post">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;">
                                        <input name="title" placeholder="Title" required type="text" class="validate " style="width: 80%; text-align: left; font-size: 2.5vh;">
                                    </p>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;">
                                        <textarea name="desc" required placeholder="Take a note..... " type="text" class="validate materialize-textarea" style="width: 80%; text-align: left; font-size: 2.5vh;"></textarea>
                                    </p>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <p style="text-align: center;margin-top: 1em;">
                                        <button name="add_note_submit" type="submit" class="waves-effect waves-light btn  " style=" 
                         background-color: #1c1c1c;
        box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -webkit-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57);
        -moz-box-shadow: 2px 3px 12px 1px rgba(28, 28, 28, 0.57); text-align: left;">
                                            Add Note
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