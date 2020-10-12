$(document).ready( function () {
   $('#table_id').DataTable();
} );

// CHART 1 - ROTATED CHART

var config = {
   type: 'doughnut',
   data: {
      datasets: [{
         data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
         ],
         backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow,
            window.chartColors.green,
            window.chartColors.blue,
         ],
         label: 'Dataset 1'
      }],
      labels: [
         'Red',
         'Orange',
         'Yellow',
         'Green',
         'Blue'
      ]
   },
   options: {
      responsive: true,
      legend: {
         position: 'top',
      },
      title: {
         display: true,
         text: 'Test Results'
      },
      animation: {
         animateScale: true,
         animateRotate: true
      }
   }
};


// CHART 2 - GRAPH

var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
   'October', 'November', 'December'
];
var color = Chart.helpers.color;
var barChartData = {
   labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
   datasets: [{
      label: 'Dataset 1',
      backgroundColor: color(window.chartColors.orange).alpha(0.7).rgbString(),
      borderColor: window.chartColors.red,
      borderWidth: 1,
      data: [
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor()
      ]
   }, {
      label: 'Dataset 2',
      backgroundColor: color(window.chartColors.blue).alpha(0.7).rgbString(),
      borderColor: window.chartColors.blue,
      borderWidth: 1,
      data: [
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor(),
         randomScalingFactor()
      ]
   }]

};

// Onload function for both charts
window.onload = function () {
   // Chart 1
   var ctx1 = document.getElementById('chart-area').getContext('2d');
   window.myDoughnut = new Chart(ctx1, config);

   // Chart 2
   var ctx2 = document.getElementById('canvas').getContext('2d');
   window.myBar = new Chart(ctx2, {
      type: 'bar',
      data: barChartData,
      options: {
         responsive: true,
         legend: {
            position: 'top',
         },
         title: {
            display: true,
            text: 'Test Results'
         }
      }
   });
};

