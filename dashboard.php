<?php

$title = "Dashboard";

include_once "header.php"

?>

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
        <div class="content-wrapper">


            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card bg-primary">
                        <a href="user_master.php" style="text-decoration: none;">
                        <div class="card-body">
                            <img src="assets/images/user-dash.svg" width="40%" alt="">
                            <h5 class="card-title mt-2 text-white">User Master</h5>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger">
                        <a href="client_master.php" style="text-decoration: none;">
                        <div class="card-body">
                        <img src="assets/images/users-dash.svg" width="40%" alt="">
                            <h5 class="card-title mt-2 text-white">Client Master</h5>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-warning">
                        <a href="item_master.php" style="text-decoration: none;">
                        <div class="card-body">
                            <img src="assets/images/cart-dash.svg" width="40%" alt="">
                            <h5 class="card-title mt-2 text-white">Item Master</h5>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-success">
                        <a href="invoice.php" style="text-decoration: none;">
                        <div class="card-body">
                        <img src="assets/images/invoice-dash.svg" width="40%" alt="">
                        <h5 class="card-title mt-2 text-white">Invoice</h5>
                        </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>

    </div>


</div>




<script src="assets/js/dashboard.js"></script>
<?php

include_once "footer.php";

?>