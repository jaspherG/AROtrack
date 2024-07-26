@extends('layouts.user_type.auth')

@section('content')
<div class="alert alert-danger mx-5 mb-2" role="alert">
    <span class="text-white">
        <strong>Welcome AROtrack  User</strong>
    </span>
</div>
<!-- graph -->
<div class="row  my-4 mx-2">
  <div class="col-lg-8 col-md-12 mb-md-0 mb-4 ">
    <div class="card">
        <div id="chart"></div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12 mb-md-0 mb-4 ">
    <div class="card">
        <div id="piechart"></div>
    </div>
  </div>
</div>
<!-- <div class="row mx-2 mb-4"> -->
<!--     
  <div class="col-lg-12 col-md-12 mb-md-0 mb-4"> -->
  <!-- <div class="card">
        <div id="chart"></div>
    </div>   -->

    
  <!-- </div> -->
  
   


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var options = {
          series: [{
          name: 'Completed',
          data: [/* Completed requirements for each category */]
        }, {
          name: 'Deficiency',
          data: [/* Deficient requirements for each category */]
        }, {
          name: 'Total Number Of Students',
          data: [/* total number of students */]
        }],
        chart: {
          type: 'bar',
          height: 350,
          events: {
            dataPointSelection: function(event, chartContext, config) {
              var seriesIndex = config.seriesIndex;
              var dataPointIndex = config.dataPointIndex;
              var seriesName = config.w.config.series[seriesIndex].name;
              var categoryName = config.w.config.xaxis.categories[dataPointIndex];
              var dataValue = config.w.config.series[seriesIndex].data[dataPointIndex];
              // +"/"+seriesName.toLowerCase().replace(/ /g, '-')
               
              var url = "/"+categoryName.toLowerCase().replace(/ /g, '-');
             if(seriesName == 'Total Number Of Students') {
               window.location.href = "/overall-student"+url;
             } else if(seriesName == 'Completed') {
               window.location.href = "/completed"+url;
             } else if(seriesName == 'Deficiency') {
               window.location.href = "/deficiency"+url;
             }
    
              //alert('You clicked on ' + seriesName + ' in category ' + categoryName + ' with value ' + dataValue);
              // Add your custom logic here, for example, navigate to another page or perform an action
            }
          }
        },
        colors: ['#00E396', '#FF4560', '#FFD700'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '40%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Overall']
        },
        yaxis: {
          title: {
            text: ''
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return " " + val + " "
            }
          }
        }
        };

        // PHP code in Blade template:
    @php
        $completedCounts = $dashboardData->completed_data;
        $deficientCounts = $dashboardData->deficient_data;
        // Compute the sum of completed and deficient counts for each category
        $totalCounts = [];
        for ($i = 0; $i < count($completedCounts); $i++) {
            $totalCounts[] = $completedCounts[$i] + $deficientCounts[$i];
        }
    @endphp

    options.series[1].data = @json($deficientCounts);
    options.series[0].data = @json($completedCounts);
    options.series[2].data = @json($totalCounts);
    
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // $(document).ready(function() {
        
    // });

    // var options = {
    //       series: [44, 55, 13, 43, 22, 15],
    //       chart: {
    //       width: 380,
    //       type: 'pie',
    //     },
    //     labels: ['BSIT', 'BSEDMT', 'BSEDEN', 'BPA', 'BPAFA','BPAPFM'],
    //     responsive: [{
    //       breakpoint: 480,
    //       options: {
    //         chart: {
    //           width: 200
    //         },
    //         legend: {
    //           position: 'bottom'
    //         }
    //       }
    //     }]
    //     };

    //     var chart = new ApexCharts(document.querySelector("#chart"), options);
    //     chart.render();


    // ============== Pie Chart =============
   var options = {
    title: {
        text: 'Programs'
    },
    subtitle: {
        text: ''
    },
    series: [],
    chart: {
        width: 380,
        type: 'pie',
        events: {
            dataPointSelection: function(event, chartContext, config) {
                var label = chartContext.w.globals.labels[config.dataPointIndex];
                var value = chartContext.w.globals.series[config.seriesIndex][config.dataPointIndex];
                window.location.href = "/student-list/"+label;
            }
        }
    },
    dataLabels: {
        enabled: false  // Disable data labels
    },
    labels: [],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

// PHP code in Blade template:
@php
    $pie_data = $registrar->pie_data;
    $pie_labels = $registrar->pie_categories;
@endphp

// Assign data to options.series and options.labels
options.series = @json($pie_data);
options.labels = @json($pie_labels);

var chart = new ApexCharts(document.querySelector("#piechart"), options);
chart.render();
</script>


    
@endsection
@push('dashboard')
@endpush


