Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctx = document.getElementById("myScatterChart")

    var myScatterChart = new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Test Scores',
                data: [
                    { x: 10, y: 20 },
                    { x: 20, y: 30 },
                    { x: 30, y: 10 },
                    { x: 40, y: 40 },
                    { x: 50, y: 25 }
                ],
                backgroundColor: "rgba(255,99,132,0.6)",
                borderColor: "rgba(255,99,132,1)",
                showLine: false // keep false for scatter effect
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Scatter Chart Example'
            },
            scales: {
                xAxes: [{
                    type: 'linear',
                    position: 'bottom',
                    ticks: {
                        beginAtZero: true
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });