Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctx = document.getElementById("myHorizontalBarChart");
var myHorizontalBarChart = new Chart(ctx, {
    type: "horizontalBar",
    data: {
        labels: ["Laravel", "React", "Vue", "Angular", "jQuery"],
        datasets: [
            {
                label: "Projects",
                backgroundColor: [
                    "#007bff",
                    "#28a745",
                    "#ffc107",
                    "#dc3545",
                    "#6f42c1",
                ],
                borderColor: "#fff",
                data: [12, 19, 8, 15, 10],
            },
        ],
    },
    options: {
        scales: {
            xAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                    gridLines: {
                        display: true,
                    },
                },
            ],
            yAxes: [
                {
                    gridLines: {
                        display: false,
                    },
                },
            ],
        },
        legend: {
            display: false,
        },
        responsive: true,
    },
});
