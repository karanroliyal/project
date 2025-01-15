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
                                <h5 class="card-title mt-2 text-white">User Master (<span class="user-number"></span>)</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger">
                        <a href="client_master.php" style="text-decoration: none;">
                            <div class="card-body">
                                <img src="assets/images/users-dash.svg" width="40%" alt="">
                                <h5 class="card-title mt-2 text-white">Client Master (<span class="client-number"></span>)</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-warning">
                        <a href="item_master.php" style="text-decoration: none;">
                            <div class="card-body">
                                <img src="assets/images/cart-dash.svg" width="40%" alt="">
                                <h5 class="card-title mt-2 text-white">Item Master (<span class="item-number"></span>)</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-success">
                        <a href="invoice.php" style="text-decoration: none;">
                            <div class="card-body">
                                <img src="assets/images/invoice-dash.svg" width="40%" alt="">
                                <h5 class="card-title mt-2 text-white">Total Invoice = ₹<span class="invoice-total"></span></h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row mt-5">

                <div class="col-md-6 col-sm-12">
                    <div class="card flex-fill w-100 draggable">

                        <div class="card-body d-flex">
                            <div class="align-self-center w-100">
                                <div class="py-3">
                                    <div class="chart chart-xs">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="chartjs-dashboard-pie" width="856" height="400" style="display: block; height: 200px; width: 428px;" class="chart-pie chartjs-render-monitor"></canvas>
                                    </div>
                                </div>

                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>User</td>
                                            <td class="text-end user-number"></td>
                                        </tr>
                                        <tr>
                                            <td>Client</td>
                                            <td class="text-end client-number"></td>
                                        </tr>
                                        <tr>
                                            <td>Item</td>
                                            <td class="text-end item-number"></td>
                                        </tr>
                                        <tr>
                                            <td>Invoice</td>
                                            <td class="text-end invoice-number"></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6 col-sm-12">

                    <div class="card flex-fill w-100 draggable">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Sales</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="chartjs-dashboard-line" style="display: block; height: 252px; width: 428px;" width="856" height="504" class="chart-line chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>

                </div>


            </div>





        </div>

    </div>




</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/dashboard.js"></script>
<?php

include_once "footer.php";

?>