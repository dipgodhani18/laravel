Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

var ctx = document.getElementById("myBubbleChart");

var myBubbleChart = new Chart(ctx, {
    type: "bubble",
    data: {
        datasets: [
            {
                label: "Population Data",
                data: [
                    { x: 10, y: 20, r: 15 },
                    { x: 25, y: 10, r: 10 },
                    { x: 15, y: 30, r: 20 },
                    { x: 20, y: 25, r: 8 },
                ],
                backgroundColor: "rgba(54, 162, 235, 0.6)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
            },
        ],
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: "Bubble Chart Example",
        },
        scales: {
            xAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
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
