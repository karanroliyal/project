$(document).ready(function () {



    function dataReceveived() {
        $.ajax({
            url: "assets/backend/pieChartDataCall.php",
            type: "POST",
            success: function (data) {
                data = JSON.parse(data);
                let itemData = data.lineData;
                lineChart(itemData);
            }
        })
    }
    dataReceveived();


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




})


