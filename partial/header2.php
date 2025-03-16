<?php
session_start();
?>
<nav style="background-color: transparent; box-shadow: none; margin-top: 2vh; ">
    <div class="row main_nav">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo left"><img class=" responsive-img logo-main" src="img/logo.png" style="margin-top: 0px;" alt=""></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger right  "><i style="color: #0B132A;" class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="button btn" style="background-color: transparent;
              text-transform: capitalize; font-size: 16px; border: none; font-weight: bolder; border-radius: 50px; color:black; font-family: Rubik;font-style: normal; box-shadow: none;"><?php echo $_SESSION['c_name']; ?><i class="left material-icons ">account_circle</i> </a></li>
                <li><a class="waves-effect waves-red btn" href="partial/logout.php" style="background-color: transparent;
                text-transform: capitalize;  font-size: 16px; border: 1px solid #F53855; font-weight: bolder; width: 8em; border-radius: 50px; color: #F53855; font-family: Rubik;font-style: normal; box-shadow: none;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<ul class="sidenav" id="mobile-demo">
    <?php
    if(isset($_SESSION['c_email'])){
        ?>
            <li><a href="#"><i class="left material-icons ">account_circle</i> <?php echo $_SESSION['c_name'];?></a></li>
            <li><a href="partial/logout.php"><i class="left material-icons ">power_settings_new</i> Logout</a></li>
<?php
    }else{
        ?>
        <li><a href="register.php">Sign Up</a></li>
        <li><a href="company_login.php"> Sign In</a></li>
<?php
    }
    ?>
</ul>
<style>
    .main_nav {
        margin-left: 100px;
        margin-right: 100px;
    }

    .link:hover {
        background-color: #f6f6f6;
    }

    .link {
        font-family: Rubik;
        font-size: 16px;
        color: #4F5665;
    }

    .li_s {
        margin-right: 15vw;
    }

    @media only screen and (max-width: 1024px) {
        .main_nav {
            margin-left: 0px;
            margin-right: 0px;
        }

        .logo-main {
            margin-top: 5px !important;
        }

        .li_s {
            margin-right: 10vw;
        }
    }

    @media only screen and (max-width: 600px) {
        .main_nav {
            margin-left: 0px;
            margin-right: 0px;
        }

        .logo-main {
            margin-top: 5px !important;
            height: 10vh !important;
        }
    }
</style>