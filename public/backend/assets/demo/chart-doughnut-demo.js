  Chart.defaults.global.defaultFontFamily =
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = "#292b2c";

    var ctx = document.getElementById("myDoughnutChart");
    var myDoughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Active", "Blocked", "Unverified"],
            datasets: [
                {
                    data: [65, 25, 10],
                    backgroundColor: ["#28a745", "#dc3545", "#ffc107"],
                    hoverBackgroundColor: ["#218838", "#c82333", "#e0a800"],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: "bottom",
            },
        },
    });