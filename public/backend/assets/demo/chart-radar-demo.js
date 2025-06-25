  Chart.defaults.global.defaultFontFamily =
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = "#292b2c";

    var ctx = document.getElementById("myRadarChart");
    var myRadarChart = new Chart(ctx, {
        type: "radar",
        data: {
            labels: ["Communication", "Coding", "Design", "Leadership", "Teamwork", "Creativity"],
            datasets: [
                {
                    label: "John",
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    data: [70, 85, 60, 75, 80, 65]
                },
                {
                    label: "Emma",
                    backgroundColor: "rgba(255,193,7,0.2)",
                    borderColor: "rgba(255,193,7,1)",
                    pointBackgroundColor: "rgba(255,193,7,1)",
                    data: [80, 60, 75, 85, 90, 70]
                }
            ]
        },
        options: {
            responsive: true,
            scale: {
                ticks: {
                    beginAtZero: true
                }
            }
        }
    });