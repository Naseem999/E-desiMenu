<?php
session_start();
if (!isset($_SESSION['A_username'])) {
    header("Location:../index.php?error=Smothing Went Wrong");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include_once 'partial/head.php';
    if (isset($_GET['plan_id'])) {
        $plan_id = mysqli_real_escape_string($con, $_GET['plan_id']);
    }

    ?>
    <title>Document</title>
</head>

<body>
    <div class="row" style="margin-top: 3em; margin-left: 1em;margin-right: 1em;">
        <?php
        include_once 'partial/nav.php';
        ?>
    </div>
    <div class="row" style="border-bottom: 1px solid lightgray; padding-bottom: 10px;">
        <?php
        $sql = "SELECT * FROM subscriptions WHERE plan_id='$plan_id' ";
        $resultch = 0;
        if (mysqli_query($con, $sql)) {
            $result = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
        }

        if ($resultch  > 0) {
            $row = mysqli_fetch_assoc($result);
        ?>

            <div class="col s12 m12 l12 ">

                <div class="col s8 m6 l6 ">
                    <p style="color: gray; font-size: 2.5vh;font-weight: 600; margin: 0px;">Start Date : <span style="color: #f96464;"><?php echo $row['start']; ?></span></p>
                    <p style="color: gray; font-size: 2.5vh; font-weight: 600; margin: 0px;">End Date : <span style="color: #f96464;"><?php echo $row['end']; ?></span></p>

                </div>
                <div class="col s4 m6 l6 ">
                    <?php
                    if ($row['status'] == 'activated') {
                    ?>
                        <p style="color: gray; font-size: 2.5vh; text-align: right; font-weight: 600; margin: 0px;">Status : <span style="color: #648813;">Active</span></p>
                    <?php
                    } else {
                    ?>
                        <p style="color: gray; font-size: 2.5vh; text-align: right; font-weight: 600; margin: 0px;">Status : <span style="color: #f96464;">Expired</span></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
    <div class="row" style="margin: 5px; margin-top: 3em; margin-bottom: 3em;">
        <?php
        $sql = "SELECT * FROM subscriptions WHERE plan_id='$plan_id' ";
        $resultch = 0;
        if (mysqli_query($con, $sql)) {
            $result2 = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
        }
        if ($resultch  > 0) {
            $row2 = mysqli_fetch_assoc($result2);
            $status = $row2['status'];
            $c_name = $row2['c_name'];
        }
        ?>

        <?php
        $sql = "SELECT * FROM services WHERE plan_id='$plan_id' ";
        $resultch = 0;
        if (mysqli_query($con, $sql)) {
            $result = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
        }
        if ($resultch  > 0) {
            $row1 = mysqli_fetch_assoc($result);
            $menu_customization = $row1['menu_customization'];
            $task = $row1['task'];
            $employee_managment = $row1['employee_managment'];
            $e_kitchen = $row1['e_kitchen'];
            $wallet = $row1['wallet'];
            $feedback = $row1['feedback'];
            $parsel     = $row1['parsel'];
            $stock     = $row1['stock'];
            $qr_code     = $row1['qr_code'];
        }
        ?>

        <!-- =========================================================================================== -->
        <div class="col s12 m6 l6">
            <?php
            $sql_a = "SELECT * FROM admin_tab WHERE company='$c_name' ";
            $resultch_a = 0;
            if (mysqli_query($con, $sql)) {
                $result_a = mysqli_query($con, $sql_a);
                $resultch_a = mysqli_num_rows($result_a);
            }
            if ($resultch_a  > 0) {
                $row_a = mysqli_fetch_assoc($result_a);
                $username = $row_a['username'];
                $pass = $row_a['pass'];
            }
            ?>
            <table class="centered z-depth-1" style="padding: 10px;  border-radius: 10px;">
                <thead>
                    <tr>
                        <th data-field="id">Username</th>
                        <th data-field="name">Password</th>
                        <th> <a href="gen_pdf.php?co=<?php echo $c_name;?>&username=<?php echo $username;?>&pass=<?php echo $pass;?>" class="btn-floating btn-small waves-effect waves-light" style="background-color: #1c1c1c;"><i class="material-icons">local_printshop</i></a></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $pass; ?></td>
                    </tr>

                </tbody>
            </table>

            <?php
            if ($qr_code == 'on') {
            ?>
                <div class="card" style="margin-top: 2em; border-radius: 10px; border: 1px solid lightgray;">
                    <div class="card-content">
                        <?php
                        $path = 'img/QR/';
                        $file = $path . $c_name . "_QR.png";
                        ?>
                        <p style="text-align: center;"> <img class="responsive-img" src="<?php echo $file; ?>" alt="">
                        </p>
                        <p style="text-align: right;"> <a href="<?php echo $file; ?>" download class="btn-floating btn-small waves-effect waves-light" style="background-color: #1c1c1c;"><i class="material-icons">file_download</i></a></p>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>
        <!-- ============================================================================================================= -->
        <div class="col s12 m6 l6 z-depth-4 right" style="border: 1px solid lightgray; border-radius: 10px;">

            <div class="col s12 m12 l12" style="border-bottom: 1px solid lightgray; padding: 10px;">
                <div class="col s6 m6 l6 ">
                    <p style="color: gray; font-size: 4.5vh; text-align: center; vertical-align: middle; margin-top: 0.8vh;">Services</p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($status  == 'activated') {
                    ?>
                        <p style='text-align:center;  '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $plan_id; ?>&action=expire&status=activated"><i style="font-size: 2.2em;" class='fas fa-toggle-on fa-2x'></i></a></p>
                    <?php
                    } elseif ($status  == 'expired') {
                    ?>
                        <p style='text-align:center;  '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $plan_id; ?>&action=activate&status=expired"><i style="font-size: 2.2em;" class='fas fa-toggle-off fa-2x'></i></a></p>
                    <?php
                    }
                    ?>
                </div>
            </div>



            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Menu Customization
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($menu_customization  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=menu_customization&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($menu_customization  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=menu_customization&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Task Managment
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($task  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=task&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($task  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=task&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Employee Managment
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($employee_managment  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=employee_managment&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($employee_managment  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=employee_managment&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        E-kitchen
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($e_kitchen  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=e_kitchen&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($e_kitchen  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=e_kitchen&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Wallet for Your Customers
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($wallet  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=wallet&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($wallet  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=wallet&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Feedback From Customers
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($feedback  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=feedback&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($feedback  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=feedback&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Parsel Option for Customers
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($parsel  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=parsel&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($parsel  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=parsel&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Inventory Managment
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($stock  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=stock&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($stock  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=stock&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->
            <!-- ================================================================================================================== -->
            <div class="col s12 m12 l12">
                <div class="col s6 m6 l6 " style="border-right: 1px solid lightgray;">
                    <p style="color: #2f2e41; text-align: center; font-size: 2.7vh; font-weight: bold;">
                        Scannable E-Menu
                    </p>
                </div>
                <div class="col s6 m6 l6 ">
                    <?php
                    if ($qr_code  == 'on') {
                        if ($status == 'activated') {
                    ?>
                            <p style='text-align:center; '><a style='color:#648813' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=qr_code&status=on"><i class='fas fa-toggle-on fa-2x'></i></a></p>
                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-on fa-2x'></i></a></p>

                        <?php
                        }
                    } elseif ($qr_code  == 'off') {
                        if ($status == 'expired') {
                        ?>
                            <p style='text-align:center; '><a style='color:lightgray' href="#!"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                        <?php
                        } else {
                        ?>
                            <p style='text-align:center; '><a style='color:#f96464' href="plan_actions_chang.php?plan_id=<?php echo $row['plan_id']; ?>&ser=qr_code&status=off"><i class='fas fa-toggle-off fa-2x'></i></a></p>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- ================================================================================================================== -->


        </div>


    </div>

    <?php
    include_once 'partial/scripts.php';
    ?>
</body>

</html>