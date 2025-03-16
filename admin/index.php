<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin-Login</title>
    <?php
    include_once 'partial/head.php';
    session_start();
    if(isset($_SESSION['admin_username'])){
        header("Location:admin_dash.php");
    }
    ?>
</head>
<body >
    <div class="row" style="margin-top: 10vh; ">
        <div class="col m4 l4"></div>
        <div class="col s12 m4 l4 center-align ">

            <div class="f_card col s12 m12 l12  z-depth-5  " style=" background-color: rgba(0, 0, 0, 0.7); backdrop-filter: blur(15px) ; border-radius: 20px; border:2px solid transparent; padding:30px;
            height:35em">
                <img class="responsive-image" src="img/lo.png" style=" height:10vh; width: 100%; margin-top: 0px; object-fit:contain;  ">
                <br>
                <div class="card-content white-text">
                    <form action="partial/admin_login.php" method="post" >
                        <br><br>
                        <p style="text-align: center;"> <input placeholder="Username" required name="uname" class="validate" id="first_name" type="text" style="width:80%; 
                      color: #fafafaeb; background-color: transparent; text-align: center;"></p>
                        <p style="text-align: center;"> <input placeholder="Password" required name="pass" id="first_name" type="password" class="validate" style="
                      width: 80%; text-align: center;color: white ; color:#fafafaeb;  background-color: transparent;"></p>
                        <br>
                        <p style="text-align: center;"> <button name="login_submit" type="submit" style=" background-color:transparent; border: 0.5px solid #eeeeee69  ; width: 70%; color: #fafafaeb; font-weight: 600;  margin-top: 1.5em; border-radius: 50px;  " class=" waves-effect waves-light btn-large ">Log in</button>
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
   body{
       background: url(img/signup_back1.jpg) no-repeat 50% 50%;
     background-size:cover;
   }
    [type="checkbox"].filled-in:checked+span:not(.lever):after {
        border: 2px solid #1c1c1c !important;
        background-color: #1c1c1c !important;
    }

    [type="checkbox"]+span:not(.lever) {
        line-height: 20px;
    }
    @media only screen and (max-width: 600px) {
        body{
            height: 100vh;
   }
    }
</style>