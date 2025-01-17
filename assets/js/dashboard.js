$(document).ready(function(){

    // Make button selected on UI
    $(".sidebar-btn:nth-child(1)").addClass("click");

    // Pie chart data
    function chartData(){
        $.ajax({
            url: "assets/backend/pieChartDataCall.php",
            type: "POST",
            success: function(data){
                data = JSON.parse(data);

                // Update the DOM with the returned data
                $(".user-number").text(data.user);
                $(".item-number").text(data.item);
                $(".invoice-number").text(data.invoice);
                $(".client-number").text(data.client);
                $(".invoice-total").text(data.total);
                // data for line chart let itemData = data.lineData;
                let itemData = data.lineData;
                
                // pie chart with the updated data
                createPieChart(data.user, data.item, data.invoice, data.client);
                // line chart with the updated data
                lineChart(itemData);

            }
        })
    }

    // Function to create the pie chart
    function createPieChart(user, item, invoice, client) {
        var chartsPie = document.querySelectorAll(".chart-pie");
        
        chartsPie.forEach(function(chart) {
            if (!chart.getAttribute('data-chart-initialized')) {
                new Chart(chart, {
                    type: "pie",
                    data: {
                        labels: ["Users", "Item", "Client", "Invoice"],
                        datasets: [{
                            data: [user, item, client, invoice],  // Use the updated values here
                            backgroundColor: [
                                "#007bff", // Primary color (blue)
                                "#ffcc00", // Warning color (yellow)
                                "#dc3545",  // Danger color (red)
                                "#198754", // Success color (green)
                            ],
                            borderWidth: 5
                        }]
                    },
                    options: {
                        responsive: !window.MSInputMethodContext,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 100
                    }
                });
                chart.setAttribute("data-chart-initialized", "true");
            }
        });
    }

    function lineChart(itemData) {

        var chartsLine = document.querySelectorAll(".chart-line");

        chartsLine.forEach(function (chart) {
            if (!chart.getAttribute('data-chart-initialized')) {
                var ctx = chart.getContext("2d");

                var gradient = ctx.createLinearGradient(0, 0, 0, 225);
                gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
                gradient.addColorStop(1, "rgba(215, 227, 244, 0)");

                let sum = 0;

                for (let i = 0; i < itemData.length; i++) {
                    sum += Number(itemData[i].total);
                }


                // Line chart
                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: itemData.map(ele => {
                            return ele.item_name
                        }),
                        datasets: [{
                            label: "Sales (₹)",
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: "#007bff",  // Static color for the border
                            data: itemData.map(ele => {
                                return ele.total
                            })
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            intersect: false
                        },
                        hover: {
                            intersect: true
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            // Updated axes configuration for Chart.js v3+
                            x: {
                                reverse: false,  // Reverse the order of the x-axis
                                grid: {
                                    color: "rgba(0,0,0,0.0)"  // Hide the x-axis grid lines
                                }
                            },
                            y: {
                                ticks: {
                                    stepSize: sum / itemData.length,
                                },
                                display: true,
                                grid: {
                                    color: "rgba(0,0,0,0.0)",  // Hide the y-axis grid lines
                                    borderDash: [3, 3]
                                }
                            }
                        }
                    }
                });
                chart.setAttribute("data-chart-initialized", "true");
            }
        });

    }

    // Call the chartData function to load the data and render the chart
    chartData();

});
