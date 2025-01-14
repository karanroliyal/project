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
                <h1>Dashboard</h1>
            </div>

        </div>


    </div>





    <?php
    
    include_once "footer.php";
    
    ?>