<!DOCTYPE html>
<html lang="en">

<head>
    <title>User-Login</title>
    <?php
    include_once 'partial/head.php';
    session_start();

    ?>
</head>

<body>
    <div class="row" style="margin-top: 10vh; ">
        <div class="col m4 l4"></div>
        <div class="col s12 m4 l4 center-align ">

            <div class="f_card col s12 m12 l12  z-depth-5  " style=" 
                                box-shadow: 0 24px 38px 3px rgba(244, 67, 54, 0.2), 0 9px 46px 8px rgba(244, 67, 54, 0.2), 0 11px 15px -7px rgba(0, 0, 0, 0.2);
            background-color: rgba(0, 0, 0, 0.9); backdrop-filter: blur(10px) ; border-radius: 20px; border:2px solid transparent; padding:30px;
            height:35em">
                <img class="responsive-image" src="admin/img/<?php echo $_SESSION['menu_c_logo'];?>" style=" height:10vh; filter:contrast(); width: 100%; margin-top: 0px; object-fit:contain;  ">
                <br>
                <div class="card-content white-text">
                    <form method="post" action="partial/u_login.php">
                        <br><br>
                        <p style="text-align: center;"> <input placeholder="Email" required name="email" class="validate" id="first_name" type="email" style="width:80%; 
                      color: #e87272; background-color: transparent; text-align: center; border-bottom: 1px solid #e87272;"></p>
                        <p style="text-align: center;"> <input placeholder="Password" required name="pass" id="first_name" type="password" class="validate" style="
                      width: 80%; text-align: center;color: white ; color:#e87272; border-bottom: 1px solid #e87272;  background-color: transparent;"></p>
                        <br>
                        <p style="text-align: center;"> <button name="u_login_submit" type="submit" style=" border: 0.2px solid #1c1c1c; background-color:transparent;  text-transform: capitalize; width: 70%; color: #f53838; font-weight: 600;  margin-top: 1.5em; border-radius: 50px;  " class=" waves-effect waves-red btn-large z-depth-3 ">Log in</button>
                        </p>
                        <p style="text-align: center; margin-top: 4em;"> <a href="user_register.php" style="  color:gray; ">Not Signed Up?</a>
                        </p>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <div class="col m4 l4"></div>

    </div>


    <?php
    include_once 'partial/scripts.php';
    ?>

</body>
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

</html>

<style>
    body {
        background: url(img/signup_back.jpg) no-repeat 50% 50%;
        background-size: cover;
    }

    .z-depth-3 {
        box-shadow: 0 24px 38px 3px rgba(244, 67, 54, 0.1), 0 9px 46px 8px rgba(244, 67, 54, 0.1), 0 11px 15px -7px rgba(0, 0, 0, 0.2);
    }


    [type="checkbox"].filled-in:checked+span:not(.lever):after {
        border: 2px solid #1c1c1c !important;
        background-color: #1c1c1c !important;
    }

    [type="checkbox"]+span:not(.lever) {
        line-height: 20px;
    }

    @media only screen and (max-width: 600px) {
        body {
            height: 100vh;
        }
    }
</style>