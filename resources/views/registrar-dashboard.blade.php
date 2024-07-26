@extends('layouts.user_type.registrar')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Hi {{$user->name}}</strong> Welcome
        </span>
    </div>
    <div class="row  my-4 mx-2">
      <div class="col-lg-8 col-md-12 mb-md-0 mb-4 ">
        <div class="row ">
          <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
              <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                      <p class="text-muted fw-medium">Requirements</p>
                      <h4 class="mb-0">
                          <div>{{$dashboardData->requirements}}</div>
                      </h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                          <i class="fas fa-list text-white"></i>
                      </span>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-3">
            <div class="card border-0 shadow-sm">
              <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                      <p class="text-muted fw-medium">Documents</p>
                      <h4 class="mb-0">
                          <div>{{$dashboardData->documents}}</div>
                      </h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary d-flex align-items-center justify-content-center">
                      <span class="avatar-title">
                          <i class="fas fa-file text-white"></i>
                      </span>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3 d-none">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Number of Students</p>
                                <h4 class="mb-0">
                                    <div>{{$dashboardData->student_count }}</div>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mb-md-0 mb-4">
        <div class="row ">
          <div id="piechart">

          </div>
        </div>
      </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  var options = {
      title: {
          text: 'Programs'
        },
        subtitle: {
          text:
          'The number of students in each program'
        },
      series: [],
      chart: {
          width: 380,
          type: 'pie',
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
      $pie_data = $dashboardData->pie_data;
      $pie_labels = $dashboardData->pie_categories;
  @endphp

  // Assign data to options.series and options.labels
  options.series = @json($pie_data);
  options.labels = @json($pie_labels);

  var chart = new ApexCharts(document.querySelector("#piechart"), options);
  chart.render();

</script>
 
@endsection