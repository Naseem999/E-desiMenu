    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once 'partial/head.php';
        session_start();


        if (isset($_POST['take_plan'])) {
            if (isset($_SESSION['c_email'])) {
                $c_email = $_SESSION['c_email'];
                $c_name = $_SESSION['c_name'];
            } else {
                echo "<script>alert('Login or Signup');
        window.location.assign('company_login.php');
        </script>";
            }

            $sql = "SELECT * FROM subscriptions WHERE c_name='$c_name';";
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                header("Location:../register.php?error=Company Already exsist");
                exit();
            } else {
                $plan = mysqli_real_escape_string($con, $_POST['plan_type']);
                $sql = "INSERT INTO subscriptions(c_name, email, plan, timestamp_) VALUES('$c_name','$c_email','$plan',now());";
                mysqli_query($con, $sql);

                echo "<script>alert('Email Has Been Sent to You mail');
            window.location.assign('index.php');
            </script>";
                exit();
            }
        }

        ?>
        <title>Plans</title>
    </head>

    <body>
        <div class="row">
            <div class="col m4 l4"></div>
            <div class="col s12 m3 l3">
                <div class="card  "
                    style=" background-image: linear-gradient(to top, lightgrey 0%, lightgrey 1%, #e0e0e0 26%, #efefef 48%, #d9d9d9 75%, #bcbcbc 100%);">
                    <div class="card-content white-text">
                        <form action="index.php" method="post">
                            <input type="hidden" name="plan_type" value="Demo">
                            <p
                                style=" text-align: left; color: #1c1c1c; margin-bottom: 10px; font-size: 2.6vh; font-weight: 700;">
                                Demo</p>
                            <p
                                style="text-align: left; color: #727475; font-size: 5.5vh; margin-bottom: 10px; margin-top: 0px;">
                                $ Free</p>
                            <p style="text-align: left; color: #727475; font-size: 2vh; ">15 DAYS</p>
                            <div style="margin-top:6vh; margin-bottom: 6vh;">
                                <p style="text-align: left; color: #a3a3a3; font-size: 2.5vh;">Lorem ipsum dolor sit</p>
                                <hr style="width: 80%; margin-left: 0px;">
                                <p style="text-align: left; color: #a3a3a3; font-size: 2.5vh;">Lorem ipsum dolor sit</p>
                                <hr style="width: 80%; margin-left: 0px;">
                                <p style="text-align: left; color: #a3a3a3; font-size: 2.5vh;">Lorem ipsum dolor sit</p>
                                <hr style="width: 80%; margin-left: 0px;">
                                <p style="text-align: left; color: #a3a3a3; font-size: 2.5vh;">Lorem ipsum dolor sit</p>
                                <hr style="width: 80%; margin-left: 0px;">
                            </div>
                            <p style="text-align: left; color: #a3a3a3; font-size: 2.5vh; 
                             margin-bottom:1vh;">
                                <button name="take_plan" type="submit" class="waves-effect waves-light btn-small "
                                    style="background-color: #1c1c1c;">Take</button></p>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col m3 l3"></div>

        </div>
        <?php
        include_once 'partial/scripts.php';
        ?>
    </body>

    </html>