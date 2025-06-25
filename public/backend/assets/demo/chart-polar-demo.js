  Chart.defaults.global.defaultFontFamily =
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = "#292b2c";

    var ctx = document.getElementById("myPolarChart");

    var myPolarChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ["Electronics", "Furniture", "Clothing", "Books", "Groceries"],
            datasets: [{
                label: "Product Sales",
                data: [120, 90, 70, 50, 100],
                backgroundColor: [
                    "#007bff",
                    "#dc3545",
                    "#ffc107",
                    "#28a745",
                    "#6610f2"
                ]
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right'
            },
            scale: {
                ticks: {
                    beginAtZero: true
                }
            }
        }
    });