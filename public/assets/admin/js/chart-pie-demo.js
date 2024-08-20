var label_info = [];
var data_info = [];

$.ajax({
  url: "/statistik/sumber_informasi",
  type: 'GET',
  dataType: 'json', // added data type
  success: function(res) {
      res.forEach(function(item, index) {
        label_info.push(item.value)
        data_info.push(item.total)
      })

      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';

      // Pie Chart Example
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: label_info,
          datasets: [{
            data: data_info,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#ff6384', '#FFA500', '#cc65fe', '#ffce56', '#00FF00', '#A020F0'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
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
          cutoutPercentage: 80,
        },
      });
  }
});
