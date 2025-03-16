<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include_once 'partial/head.php';
    $company = $_SESSION['company'];
    $logo=$_SESSION['c_logo'];
    ?>

    <title>User-Register</title>
</head>

<body style="background: url(img/too.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">

  <?php
  
  ?>


    <div class="row" style="margin-top: 4vh;" >
        <div class="container">
            <div class="card " style="
                    box-shadow: 0 24px 38px 3px rgba(244, 67, 54, 0.2), 0 9px 46px 8px rgba(244, 67, 54, 0.2), 0 11px 15px -7px rgba(0, 0, 0, 0.2);

            border-radius: 10px; background-color: rgba(0, 0, 0, 0.9); backdrop-filter: blur(12px); ">
                <div class="card-content white-text">
                <img class="responsive-image" src="admin/img/<?php echo $logo;?>" style=" height:8vh; filter:contrast(); width: 100%; margin-top: 0px; object-fit:contain;  ">

                    <form action="partial/user_signup.php" method="post" >
                        <ul class="stepper horizontal" style="height: 70vh;">
                            <li class="step active" >
                                <div class="step-title waves-effect" style="border-radius: 30px;">
                                    <p style="color: #f53838;font-weight: 500;">Login Details</p>
                                </div>
                                <div class="step-content">
                                    <div class="row" style="margin-top:2.5em;">
                                        <div class="col m3 l3 hide-on-med-and-down"></div>
                                        <div class="col s12 m6 l6">
                                            <div class="input-field col s12 m12 l12">
                                                <input style="color: #e87272; border: 1px solid #f53838; text-align: center; border-radius: 20px;" 
                                                placeholder="Username" required name="user_username" type="text" class="validate">
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <input style="color: #e87272; border: none; text-align: center;border: 1px solid #f53838; border-radius: 20px;" 
                                                placeholder="Email" required name="user_email" type="email" class="validate">
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <input style="color: #e87272; border: none; text-align: center;border: 1px solid #f53838; border-radius: 20px;"
                                                 placeholder="Password" required name="user_pass" type="password" class="validate">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="step-actions">
                                        <button class="waves-effect waves-red btn next-step z-depth-3" style="text-transform: capitalize !important; border-radius: 5px; background-color:transparent;  color: #f53838; ">Continue</button>
                                        <a href="menu.php" class="waves-effect waves-red btn  left " style="text-transform: capitalize !important; border-radius: 5px; background-color:transparent;  color: #f53838; ">Back</a>

                                    </div>
                                </div>
                            </li>
                            <li class="step">
                                <div class="step-title waves-effect" style="border-radius: 30px;">
                                    <p style="color: #f53838; font-weight: 500;">Other Deatils</p>
                                </div>
                                <div class="step-content">
                                    <div class="row" style="margin-top:0em;">
                                        <div class="col m3 l3 hide-on-med-and-down"></div>
                                        <div class="col s12 m6 l6">
                                            <div class="input-field col s12 m12 l12">
                                                <input style="color: #e87272; border: 1px solid #f53838; text-align: center; border-radius: 20px;"
                                                 placeholder="Phone No." required name="user_phone" type="text" class="validate">
                                            </div>
                                            <div class="input-field col s12 m12 l12">
                                                <input style="color: #e87272; border: 1px solid #f53838; text-align: center; border-radius: 20px;"
                                                 placeholder="Address" required name="address" type="text"  class="validate">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="step-actions">
                                        <button name="company_signup_submit" class="waves-effect waves-dark btn z-depth-3" type="submit" style="border-radius: 5px; background-color:#f53838;text-transform: capitalize; ">Register</button>
                                        <button class="waves-effect waves-dark btn previous-step" style="text-transform: capitalize; color: #f53838; border-radius: 5px; background-color:transparent; ">Back</button>

                                    </div>
                                </div>
                            </li>

                        </ul>
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
<script>
    var stepper = document.querySelector('.stepper');
    var stepperInstace = new MStepper(stepper, {
        // options
        firstActive: 0 // this is the default
    })
</script>
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
    .z-depth-3 {
        box-shadow: 0 24px 38px 3px rgba(244, 67, 54, 0.1), 0 9px 46px 8px rgba(244, 67, 54, 0.1), 0 11px 15px -7px rgba(0, 0, 0, 0.2);
    }

    ul.stepper.horizontal::before {
  box-shadow: none;
}

    @media only screen and (max-width: 600px) {}
</style>