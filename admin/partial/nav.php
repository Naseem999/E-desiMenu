<?php
if (isset($_GET['title'])) {
    $title = $_GET['title'];
} else {
    $title = "Dashboard";
}
?>
<nav style=" background-color: transparent; box-shadow: none; position: relative; margin-top: -40px; border-bottom: 1px solid #e0e0e0 ; ">
    <div class="nav-wrapper ">
        <a class="brand-logo" style="font-size: 2.5vh; color: #616161; font-weight: 500;" class=""><?php echo $title; ?></a>

        <ul class="right hide-on-med-and-down ">

            <li><a href="admin_dash.php">
                    <i class="material-icons" style="color: #616161;">dashboard</i></a></li>
                    <li><a href="notifications.php"><i class="material-icons" style="color: #616161;">notifications</i></a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-trigger" href="#!" data-target="user_profile"><i class="material-icons" style="color: #616161;">account_circle</i></a></li>
        </ul>
    </div>
</nav>
<ul id="user_profile" class="dropdown-content">
    <li><a href="profile.php">Profile</a></li>
    <li class="divider"></li>
    <li><a href="./logout.php">Logout</a></li>
</ul>
<style>
    .dropdown-content li>a,
    .dropdown-content li>span {
        font-size: 16px;
        color: black;
        display: block;
        line-height: 22px;
        padding: 14px 16px;
    }

    .dropdown-content {
        border-radius: 6px;
    }

    .dropdown-content>li:hover {
        background-color: #1c1c1c;
        color: #e0e0e0;
    }

    .dropdown-content>li>a:hover {
        color: #e0e0e0;
    }

    .dropdown-content>li {
        border-radius: 0px;
    }
</style>