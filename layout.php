<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit;
}

// echo "Welcome to our website {$_SESSION['email']}";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <title>Layout</title>
</head>

<body>

    <!-- <h1>I am layout</h1>

    <a id="logout-btn" href="logout.php" >Logout</a> -->


    <div class="layout-wrapper">

        <div class="navigation-wrapper">
            
            <?php
                include_once "navigation.php";
            ?>

        </div>

        <div class="sidebar-and-content-wrapper">

            <div class="sidebar-wrapper">

                <?php
                    include_once "sidebar.php";
                ?>

            </div>
            <div class="content-wrapper">content</div>

        </div>


    </div>





    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/layout.js"></script>
</body>

</html>