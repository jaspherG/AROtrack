@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Report Data</h5>
                        </div>
                        
                        <div class="col-md-10 gap-2 ">  
                          <div class="row">
                            <div class="col-md-2">
                                <select class="form-control filter-class-year form-select">
                                <option value="">Year Level</option>
                                <option value="First Year">First Year</option>
                                <option value="Second Year">Second Year</option>
                                <option value="Third Year">Third Year</option>
                                <option value="Fourth Year">Fourth Year</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                              <select required class="form-control filter-remarks form-select "  type="text">
                                 <option value="">Remarks</option>
                                 <option value="Completed">Completed</option>
                                 <option value="Deficiency">Deficiency</option>
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select required class="form-control filter-program form-select "  type="text">
                                 <option value="">Program</option>
                                @if(isset($programs) && count($programs) > 0)
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                    @endforeach
                                @endif
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select required class="form-control filter-service form-select "  type="text">
                                <option value="">Status</option>
                                  @if(isset($services) && count($services) > 0)
                                    @foreach($services as $service)
                                      <option value="{{ $service->id }}" >{{ucfirst($service->service_name)}}</option>  
                                    @endforeach
                                  @endif
                              </select>
                            </div>
                            <div class="col-md-2">
                              <select required class="form-control filter-academic-year form-select "  type="text">
                                    <option value="">School year </option>  
                                    @if(isset($academic_years) && count($academic_years) > 0)
                                      @foreach($academic_years as $academic_year)
                                        <option value="{{ $academic_year }}" >{{$academic_year}}</option>  
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button data-id="admin-service-report" type="button" class="btn btn-outline-dan print" >
                                    Generate
                                </button>
                                <!-- <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Generate
                                </button> -->
                                
                                <div class="dropdown-menu">
                                    <a  data-id="csv" class="dropdown-item service_export" href="#">Excel</a>
                                    <a  data-id="admin-service-report"class="dropdown-item print" href="#">Print</a>
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>
                          
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover ">
                            <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Student No.</th>
                                  <th>Student Name</th>
                                  <th>Program</th>
                                  <th>Year Level</th>
                                  <th>Status</th>
                                  <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                              @if(isset($table_data) && count($table_data) > 0)
                                @foreach($table_data as $key => $data)
                                    <tr>
                                  <td>{{$key+=1}}</td>
                                  <td>{{$data->user_student->student_number}}</td>
                                  <td>{{$data->user_student->name}}</td>
                                  <td>{{$data->program->program_name}}</td>
                                  <td>{{$data->class_year}}</td>
                                  <td>{{ ($data->is_new_student == 0 ? ucfirst($data->service->service_name) : 'Regular') }}</td>
                                  <td>{{$data->status}}</td>
                                    </tr>
                                @endforeach
                              @else
                                  <tr>
                                      <td colspan="4">No records found</td>
                                  </tr>
                              @endif
                          </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      $(document).on('change', '.filter-remarks', function(){
        filterTable();
      });
      $(document).on('change', '.filter-academic-year', function(){
        filterTable();
      });
      $(document).on('change', '.filter-service', function(){
        filterTable();
      });

      $(document).on('change', '.filter-program', function(){
        filterTable();
      });

      $(document).on('change', '.filter-class-year', function(){
        filterTable();
      });

      const filterTable = () => {
        var remarks = $('.filter-remarks').val();
        
        var service_id = $('.filter-service').val();
        var program_id = $('.filter-program').val();
        var academic_year = $('.filter-academic-year').val();
        var class_year = $('.filter-class-year').val();
        $.get("{{ route('html-functions', ['id' => 'get-filtered-report-data']) }}", {
            remarks: remarks,
            service_id: service_id,
            program_id: program_id,
            academic_year: academic_year,
            class_year: class_year,
        }, function(html) {
            $('#table_body').html(html);
        });
      }

      $('.service_export').click(function(){
        var remarks = $('.filter-remarks').val();
        var service_id = $('.filter-service').val();
        var program_id = $('.filter-program').val();
        var academic_year = $('.filter-academic-year').val();
        var class_year = $('.filter-class-year').val();

        $.get(`{{ route('service.export') }}`, {
            remarks: remarks,
            service_id: service_id,
            program_id: program_id,
            academic_year: academic_year,
            class_year: class_year,
        }, function(data){
            let year = data.year !== 'All' ? `_${data.year}_` : '';
            const titleRow = `${data.title} Requirements S.Y. ${data.year}`;
            let csvContent = `${titleRow}\n\n`; 
            const tableData = data.data;
            // csvContent += tableData.map((row) => row.join(',')).join('\n'); 

            tableData.forEach(function(row) {
                var csvRow = row.map(function(cell) {
                    if (typeof cell === 'string' && cell.indexOf(',') !== -1) {
                        return '"' + cell + '"';
                    }
                    // Otherwise, return the cell value as is
                    return cell;
                }).join(',');
                
                // Append the CSV row to the CSV content
                csvContent += csvRow + '\n';
            });

            const currentDate = new Date().toISOString().slice(0, 10);
            const filename = `${data.title}${year}_report_data_${currentDate}.csv`;

            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);

            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', filename);

            document.body.appendChild(link);
            link.click();

            document.body.removeChild(link);
        });
      });

      $(document).on('click', '.print', function(){
            var id = $(this).data('id'); 
            var remarks = $('.filter-remarks').val();
            var service_id = $('.filter-service').val();
            var program_id = $('.filter-program').val();
            var academic_year = $('.filter-academic-year').val();
            var class_year = $('.filter-class-year').val();

            
            setTimeout(function(){
                // Construct the route URL with the dynamic parameters
                var routeUrl = "/generate-report?id="+id+"&service_id="+service_id+"&academic_year="+academic_year+"&program_id="+program_id+"&remarks="+remarks+"&class_year="+class_year;
                var pr = window.open(routeUrl, "_blank");
                pr.onload = function() {
                    pr.print();
                    pr.onafterprint = function () {
                        pr.close();
                        window.location.href = '/reports';
                    }
                }
            }, 0);
        });

        
    });
</script>
 
@endsection