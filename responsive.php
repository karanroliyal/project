<?php
$title = "Responsive";
include_once "header.php";
?>


<div class="card flex-fill w-100 draggable">
    <div class="card-header">
        <h5 class="card-title mb-0">Recent Movement</h5>
    </div>
    <div class="card-body py-3">
        <div class="chart chart-sm"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="chartjs-dashboard-line" style="display: block; height: 252px; width: 428px;" width="856" height="504" class="chart-line chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="assets/js/responsive.js"></script>
<?php

include_once "footer.php";

?>