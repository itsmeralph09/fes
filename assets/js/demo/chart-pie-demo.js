// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Polar Area Chart Example
var ctx = document.getElementById("myPolarChart");
var myPolarChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ["Student", "Faculty", "Admin"],
        datasets: [{
            data: [20, 30, 2],
            backgroundColor: ['#7b0d0d', '#7b6d6d', '#F65b78'],
            hoverBackgroundColor: ['#9b2d2d', '#7b3d3d', '#f54b50'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        scale: {
            gridLines: {
                color: "#e3e3e3"
            },
            ticks: {
                beginAtZero: true
            }
        },
    },
});
