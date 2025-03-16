<?php
include_once 'partial/head.php';
include_once 'eeEncrypt.php';
if(isset($_GET['plan_id'])){
    $plan_id=$_GET['plan_id'];
    $title=$_GET['title'];

    $sql1 = "SELECT * FROM subscriptions ";
    $result1 = mysqli_query($con, $sql1);
    $resultch1 = mysqli_num_rows($result1);
    if ($resultch1 > 0) {
        while($row1=mysqli_fetch_assoc($result1)){
            include_once 'partial/phpqrcode/qrlib.php';

            $c_name=$row1['c_name'];
            $menu_url=encrypt_url($c_name);
            $path = '../super_a/img/QR/';
            $file = $path . $c_name . "_QR.png";
            QRcode::png("http://localhost:82/e-desimenu/menu.php?cid=$menu_url", $file, 'L', 10);
        }
        echo "<script>
                                    window.location.assign('plan_actions.php?plan_id=$plan_id&title=$title');
                                    </script>";
    }
}
?>