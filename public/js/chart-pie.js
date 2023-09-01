// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
if($( "#myPieChart" ).length>0){
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: arealabel,
      datasets: [{
        data: areaamt,
        backgroundColor: areacolor,
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#2e59d9', '#17a673', '#2c9faf','#2e59d9', '#17a673', '#2c9faf','#2e59d9', '#17a673', '#2c9faf'],
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
        display: true
      },
      cutoutPercentage: 80,
    },
  });
}



if($( "#outstandingChart" ).length>0){
  // Pie Chart Example
  var ctx1 = document.getElementById("outstandingChart");
  var outstandingChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: arealabel2,
      datasets: [{
        data: areaout,
        backgroundColor: areacolor,
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#2e59d9', '#17a673', '#2c9faf','#2e59d9', '#17a673', '#2c9faf','#2e59d9', '#17a673', '#2c9faf'],
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
        display: true
      },
      cutoutPercentage: 80,
    },
  });



  $( "#outstandingChart" ).on( "click", function(evt) {
      var activePoints = outstandingChart.getElementsAtEvent(evt);
      if(activePoints.length > 0)
      {
          var clickedElementindex = activePoints[0]["_index"];
          var label = outstandingChart.data.labels[clickedElementindex];
          var value = outstandingChart.data.datasets[0].data[clickedElementindex];
          $("input[name='areadesc']").val(label);
          $("#outstandingform").submit();
      }
  });
}
