@extends('layouts.user_type.auth')
<style>
.gradient-outline-primary {
  border-width: 2px !important; /* Set the border width as per your preference */
  border-style: solid !important; /* Set the border style to solid */
  border-image: linear-gradient(310deg, #7928ca, #ff0080) 1 !important; /* Apply linear gradient as border image */
  background-color: transparent; /* Set background color as transparent */
}

.add-shadow:hover {
  box-shadow: 2px 5px 8px 5px rgba(0, 0, 0, 0.1); /* Shadow color */
  transform: scale(1.05); /* Scale the element by 5% */
  transition: transform 0.2s ease; /* Add a smooth transition effect */
}



</style>
@section('content')
<div class="row  mb-5">
  <div class="col-12 mb-md-0  d-flex align-items-center justify-content-center gap-2 pt-2">
      <a href="{{ route('show.dash-requirements',['id' => 'All', 'status' => $status ] ) }}" class="btn btn-sm btn-outline-dark  {{ ($_program == 0 ? 'active' : '') }}">All</a>
      @if(isset($programs) && count($programs) > 0)
        @foreach($programs as $program)
          <a href="{{ route('show.dash-requirements', ['id' => $program->program_name, 'status' => $status ] ) }}" class="btn btn-sm btn-outline-danger  {{ ($_program == $program->id ? 'active' : '') }}">{{ ucfirst($program->program_name) }}</a>
        @endforeach
      @endif
  </div>
</div>

<div class="row my-2">
  <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">
                    
                </h5>
            </div>
            
        </div>
       
    </div>

      <div class="card-body px-0 pt-0 pb-2">
        <div class="p-0">
          <table id="example" class="table align-items-center mb-0 table-hover table table-striped" style="width:100%">
            <thead>
                <tr>
                <table id="example" class="table table-striped" style="width:100%">
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    #
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Photo
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Students Number
                  </th>
                
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >
                    Student Name                    
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Program
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Year Level
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                   Remarks
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                   Status
                  </th>
                </tr>
              </thead>
              <tbody id="table_body">
                @if(count($serviceData->requirements) > 0)
                  @foreach($serviceData->requirements as $key => $requirement) 
                    <tr class="table-row">
                      <td>{{ $key += 1}}</td>
                      <td>
                          <div>
                              <a data-fslightbox="student-list" href="{{(!empty($requirement->user_student->image) ? '/images/avatars/'.$requirement->user_student->image : '/images/user.jpg' )}}">
                                  <img src="{{(!empty($requirement->user_student->image) ? '/images/avatars/'.$requirement->user_student->image : '/images/user.jpg' )}}" class="avatar avatar-sm me-3">
                              </a>
                          </div>
                      </td>
                      <td class="ps-4">{{$requirement->user_student->student_number}}</td>
                      <td class="ps-4">
                        {{$requirement->user_student->name}}
                      </td>
                      <td class="ps-4">{{$requirement->course}}</td>
                      <td class="ps-4">{{$requirement->class_year}}</td>
                      <td class="ps-4">{{ ucfirst($requirement->status)}}</td>
                      <td class="ps-4">{{ ucfirst($requirement->service->service_name)}}</td>

                    </tr>
                   
                  @endforeach
                @else
                <tr>
                  <td col-span="4">No records found</td>
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
      function updateProgressBar(progressbar, percentage) {
          $(progressbar).animate({
              width: percentage + "%"
          }, 500); // Animation duration in milliseconds
      }

      $('.table-row').each(function() {
          var $progressbar = $(this).find('.progress-bar');
          var percentage = parseInt($progressbar.attr("aria-valuenow"));

          if (!isNaN(percentage)) {
              updateProgressBar($progressbar, percentage);
          } else {
              console.log("Invalid percentage value");
          }
      });

      $(document).on('input', '.filter-input', function(){
        filterTable();
      });

      $(document).on('change', '.filter-academic-year', function(){
        filterTable();
      });

      $(document).on('change', '.filter-document', function(){
        filterTable();
      });

      $(document).on('change', '.filter-document-status', function(){
        filterTable();
      });

      $(document).on('change', '.filter-program', function(){
        filterTable();
      });
      
      $(document).on('change', '.filter-requirement', function(){
        filterTable();
      });
      

      const filterTable = () => {
        var requirement_id = $('.filter-requirement').val();
        // var program_id = $('.filter-program').val();
        var document_id = $('.filter-document').val();
        var document_status = $('.filter-document-status').val();
        var academic_year = $('.filter-academic-year').val();
        var text = $('.filter-input').val();
        var service = $('.service_category').val();
        var completed = $('.completed_category').val();
        var deficient = $('.deficient_category').val();
        $.get("{{ route('html-functions', ['id' => 'get-filtered-student-management-list']) }}", {
            filter_program: requirement_id,
            filter_document: document_id,
            filter_document_status: document_status,
            filter_academic_year: academic_year,
            filter_service: service,
            filter_completed: completed,
            filter_deficient: deficient,
            filter_text: text,
        }, function(html) {
            $('#table_body').html(html);
        });
      }

     
    });
</script> 
@endsection


