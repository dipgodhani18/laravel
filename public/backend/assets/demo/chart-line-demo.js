Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctxArea = document.getElementById("myLineChart");
var myAreaChart = new Chart(ctxArea, {
    type: "line",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [
            {
                label: "Revenue",
                data: [1000, 2000, 1500, 3000, 2500, 4000, 3500],
                borderColor: "rgba(2,117,216,1)",
                backgroundColor: "rgba(2,117,216,0.2)",
                pointBackgroundColor: "#fff",
                pointBorderColor: "rgba(2,117,216,1)",
                fill: false,
            },
        ],
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: "Area Chart - Revenue Growth",
        },
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
        },
    },
});
