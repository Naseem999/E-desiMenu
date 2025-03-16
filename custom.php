<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include_once 'partial/head.php';

    ?>
    <title>e-DesiMenu</title>
</head>

<body>
    <?php
    include_once 'partial/header2.php';
    if (!isset($_SESSION['c_email'])) {
        echo "<script>alert('Login or Signup');
        window.location.assign('company_login.php');
        </script>";
    }
    ?>
    <div class="row">
        <hr>
        <p style="font-family: Rubik; font-size: 4vh; margin-bottom: 10px; font-weight: bolder; text-align: center; color: gray;">Select Services</p>
        <hr style="width: 20px; margin-top: 0px;">

        <div class="col s12 m12 l12">

            <div class="col m3 l3 "></div>
            <div class="col s12 m6 l6">
                <form action="subscription.php" method="POST">
                    <input type="hidden" name="plan_type" value="Custom">
                    <div class="row" style="margin-top: 3em;">
                        <div class="col s12 m6 l6">
                            <div class="card " >
                                <div class="card-content ">
                                    <p style="font-size: 3vh; font-family: Rubik ; font-weight: 500; text-align: left; color:#1c1c1c;">
                                        Default <i style="vertical-align: middle; color: #2FAB73;" class="material-icons">check_circle</i>
                                    </p>
                                    <div class="row" style="margin-top: 2em;">
                                        <div class="col s12 m12 l12">
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <i class="material-icons" style="color: #1c1c1c; ">dashboard</i>
                                                <p style="margin-left: 1em; font-size: 1.1em; color:#1c1c1c;font-weight: 500;">Admin Dashboard </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <i class="material-icons" style="color: #1c1c1c;">restaurant</i>
                                                <p style="margin-left: 1em; font-size: 1.1em; color:#1c1c1c;font-weight: 500;"> menu (Uncustomized) </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <i class="material-icons" style="color: #1c1c1c;">add_box</i>
                                                <p style="margin-left: 1em; font-size: 1.1em; color:#1c1c1c; font-weight: 500;">Add Item To Menu </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <i class="material-icons" style="color: #1c1c1c;">attach_money</i>
                                                <p style="margin-left: 1em; font-size: 1.1em; color:#1c1c1c;font-weight: 500;">Orders handling </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <i class="material-icons" style="color: #1c1c1c;">notifications </i>
                                                <p style="margin-left: 1em; font-size: 1.1em; color:#1c1c1c;font-weight: 500;">Notification System </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- ======================================= -->
                        <div class="col s12 m6 l6">
                            <div class="card " >
                                <div class="card-content ">
                                    <p style="font-size: 3vh; font-family: Rubik ; font-weight: 500; text-align: left; color:#1c1c1c;">
                                        Choose <i style="vertical-align: middle; color: #2FAB73;" class="material-icons">check_circle</i>
                                    </p>
                                    <div class="row" style="margin-top: 2em;">
                                        <div class="col s12 m12 l12">
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="menu_customization" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">Menu Customization</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="task"  type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">Task Managment </span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="employee_managment" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">Employee Managment </span>
                                                    </label>
                                                </p>
                                            </div>
                                           
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="e_kitchen" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">E-Kicthen With Chef Dedicated Dashboard </span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="wallet" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">
                                                        Virtual Wallet For Customers</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="feedback" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">
                                                        FeedBack From Customers</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="parsel" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">
                                                        Parsel Option for Customers</span>
                                                    </label>
                                                </p>
                                            </div>

                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="stock" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">
                                                        Stock & inventory Managment</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m12 l12" style="display: flex; margin-top: 1em;">
                                                <p>
                                                    <label>
                                                        <input name="qr_code" type="checkbox" class="filled-in" />
                                                        <span style="color: #1c1c1c; font-weight:600; font-size:1.3em;">
                                                        Qr code For Menu</span>
                                                    </label>
                                                </p>
                                            </div>

                                            <div class="col s12 m12 l12" style=" margin-top: 1em; margin-top: 2em;">
                                                <hr>
                                                <p style="text-align: center; font-size:1.em; font-weight: bold;">
                                                    $1 ser/Mo
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <p style="text-align: center;">
                            <button class="btn-large waves-effect waves-light z-depth-3 " type="submit" name="custom_submit" style="
         
         width: 250px; margin-top: 5vh; text-transform: capitalize; font-weight: bold; background-color: #F53838; border-radius: 10px;">
                                Countinue
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once 'partial/scripts.php';
    ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });
</script>