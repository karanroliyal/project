<?php

$title = "Layout";

include_once "header.php";

?>



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





    <?php
    
    include_once "footer.php";
    
    ?>