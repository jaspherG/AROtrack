@extends('layouts.user_type.auth')
<style>
.gradient-outline-primary {
  border-width: !important; /* Set the border width as per your preference */
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
      <a href="{{ route('show.requirements', ['id' => 'All'] ) }}" class="btn btn-sm btn-outline-dark  {{ ($_program == 0 ? 'active' : '') }}">All</a>
      @if(isset($programs) && count($programs) > 0)
        @foreach($programs as $program)
          <a href="{{ route('show.requirements', ['id' => $program->program_name ] ) }}" class="btn btn-sm btn-outline-danger  {{ ($_program == $program->id ? 'active' : '') }}">{{ ucfirst($program->program_name) }}</a>
        @endforeach
      @endif
  </div>
</div>

<div class="row my-2">
  <div class="col-lg-12 col-md-6 mb-md-0 mb-4 mt-2">
    <div class="card">
      <div class="card-header pb-0">
        
        <div class="row mb-3">
        <div class="col-12 mb-md-0  d-flex align-items-center justify-content-between gap-2 pt-2">
            <div>
                <h5 class="mb-0">
                    Student
                    List
                </h5>
            </div>
            <div class="row">
                <div class="col-md-2 d-none">
                    <select id="entries" name="entries" class="form-control form-select" onchange="handleEntriesChange()">
                    <option value="">Entries per page</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <!-- <div class="col-md-2 ">
                    <select class="form-control filter-program form-select">
                        <option value="">Filter program</option>
                        @if(isset($programs) && count($programs) > 0)
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div> -->
                <div class="col-md-2">
                    <select class="form-control filter-class-year form-select">
                    <option value="">-- Year Level --</option>
                        <option value="First Year">First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                    </select>
                </div>
                <div class="col-md-3"> 
                    <select class="form-control filter-service form-select">
                        <option value="">-- Admission Status --</option>
                        @if(isset($services) && count($services) > 0)
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ ucfirst($service->service_name) }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3 d-none">
                    <select class="form-control filter-document form-select">
                        <option value="">-- Document --</option>
                        @if(isset($documents) && count($documents) > 0)
                            @foreach($documents as $document)
                                <option value="{{ $document->id }}">{{ $document->document_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3 d-none">
                    <select class="form-control filter-document-status form-select">
                    <option value="">-- Document status --</option></marquee>
                        <option value="1">Completed</option>
                        <option value="0">Deficient</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control filter-requirement-status form-select">
                    <option value="">-- Remarks --</option></marquee>
                        <option value="Completed">Completed</option>
                        <option value="Deficiency">Deficient</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control filter-academic-year form-select">
                        <option value="">-- School Year --</option>
                        @if(isset($academic_years) && count($academic_years) > 0)
                            @foreach($academic_years as $academic_year)
                                <option value="{{ $academic_year }}" >{{ $academic_year }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control filter-input" placeholder="Type here...">
                    </div>
                </div>
            </div>
          </div>
        </div>
        <input type="hidden" class="program_category" value="{{ $_program }}">
        <input type="hidden" class="completed_category" value="{{ $_completed }}">
        <input type="hidden" class="deficient_category" value="{{ $_deficiency }}">
    </div>
  
      <div class="card-body px-0 pt-0 pb-2">
        <div class="p-0">
          <table id="example" class="table align-items-center mb-0 table-hover table table-striped" style="width:100%">
            <thead>
                <tr>
                <table id="StudentManagement" class="table table-sm table-bordered table-hover display nowrap"  style="width:100%">
                  <th>#</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Photo
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Year Admitted
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Previous School
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Student Number
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
                    Completion of Requirements
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    School Year
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Admission Status
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Action
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
                      <td class="ps-4">{{$requirement->year_admitted}}</td>
                      <td class="ps-4">{{$requirement->previous_school}}</td>
                      <td class="ps-4">{{$requirement->user_student->student_number}}</td>
                      <td class="ps-4">
                        <a href="{{ route('edit.student', ['name'=> str_replace(' ', '_', $requirement->user_student->name), 'id'=> $requirement->user_student->id]) }}" class="mx-1" data-bs-toggle="tooltip" data-bs-original-title="View {{ $requirement->user_student->name}}">
                          {{$requirement->user_student->name}}
                        </a>
                      </td>
                      <td class="ps-4">{{$requirement->course}}</td>
                      <td class="ps-4">{{$requirement->class_year}}</td>
                      <td class="ps-4">
                        <div class="progress-wrapper w-75 ">
                          <div class="progress-info  mb-1">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">({{$requirement->completedDocumentsCount}} out of {{$requirement->totalDocumentsCount}})</span> | 
                              <span class="text-xs font-weight-bold">{{$requirement->completionPercentageFormatted}}%</span>
                            </div>
                          </div>
                          <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{ $requirement->completionPercentageFormatted }}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="ps-4">{{$requirement->academic_year}}</td>
                      <td class="ps-4">{{ ucfirst($requirement->service->service_name)}}</td>

                      <td class="text-center"> 
                        <a data-bs-toggle="collapse" href="#collapseExample{{$requirement->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" class="" >
                            <i class="fas fa-file text-secondary" data-bs-toggle="tooltip" data-bs-original-title="View Requirements"></i>
                        </a>
                        <a href="/{{$requirement->service->service_name}}/{{$requirement->id}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Requirement">
                            <i class="fas fa-edit text-secondary"></i>
                        </a>
                      </td>
                    </tr>
                    <tr class="collapse" id="collapseExample{{$requirement->id}}">
                      <td colspan="8">
                          <div class="card card-body bg-gradient-dark px-0 pt-0 pb-2 my-3">
                            <div class="table-responsive p-0">
                              <table class="table mb-0 table-hover">
                                  <thead>
                                      <tr>
                                          <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Documents</th>
                                          <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                          <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if(isset($requirement->requirement_documents) && count($requirement->requirement_documents)) 
                                          @foreach($requirement->requirement_documents as $key => $document)
                                          <tr class="border-b ">
                                              <td>
                                                  <div class="d-flex px-2">
                                                      <h6 class="mb-0 text-sm text-light">{{ $document->document->document_name }}</h6>
                                                  </div>
                                              </td>
                                              <td class="align-middle text-center">
                                                  <div class="d-flex px-2">
                                                      <h6 class="mb-0 text-sm text-light">
                                                      {{ ($document->document->id == 9 && $document->status != 1) ? 'Optional' : ($document->status == 1 ? 'Submitted' : 'Unsubmitted') }}
                                                      </h6>
                                                  </div>
                                              </td>
                                              <td class="align-middle text-center">
                                                  <div class="d-flex align-items-center justify-content-start gap-2">
                                                      @if(isset($document->image ) && !empty($document->image))
                                                      <div >
                                                        <a data-fslightbox="all-requirements" href="/images/{{ $document->service->service_name }}/{{$document->image}}">
                                                            <img src="/images/{{ $document->service->service_name }}/{{$document->image}}" class="avatar avatar-sm me-3 ">
                                                        </a>
                                                      </div>
                                                      @endif
                                                  </div>
                                              </td>
              
                                          </tr>
                                          @endforeach
                                         
                                      @else 
                                      <tr>
                                          {{ 'No document selected' }}
                                      <tr>
                                      @endif
                                    </tbody>
                                </table>
                              </div>  
                          </div>
                      </td>
                      <td colspan="3">
                          <div class="card card-body bg-gradient-dark px-0 pt-0 pb-2 my-3">
                            <div class="table-responsive p-0">
                              <table class="table mb-0 table-hover">
                                  <thead>
                                      <tr>
                                          <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Received By:</th>
                                          <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                          <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Submitted</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if(isset($requirement->requirement_remarks) && count($requirement->requirement_remarks)) 
                                          @foreach($requirement->requirement_remarks as $key => $remark)
                                          <tr class="border-b ">
                                              <td>
                                                  <div class="d-flex px-2">
                                                      <h6 class="mb-0 text-sm text-light">{{ $remark->name }}</h6>
                                                  </div>
                                              </td>
                                              <td>
                                                  <div class="d-flex px-2">
                                                      <h6 class="mb-0 text-sm text-light">{{ $remark->type }}</h6>
                                                  </div>
                                              </td>
                                              <td>
                                                  <div class="d-flex px-2">
                                                      <h6 class="mb-0 text-sm text-light">{{ $remark->created_at }}</h6>
                                                  </div>
                                              </td>
                                             
                                          </tr>
                                          @endforeach
                                         
                                      @else 
                                      <tr>
                                          {{ 'No document selected' }}
                                      <tr>
                                      @endif
                                    </tbody>
                                </table>
                              </div>  
                          </div>
                      </td>
                  </tr>
                  @endforeach
                @else
                <tr>
                  <td colspan="10">No records found</td>
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
      
      $(document).on('change', '.filter-service', function(){
        filterTable();
      });

      $(document).on('change', '.filter-requirement-status', function(){
        filterTable();
      });

      $(document).on('change', '.filter-class-year', function(){
        filterTable();
      });

      const filterTable = () => {
        var service_id = $('.filter-service').val();
        var program_id = $('.program_category').val();
        // var document_id = $('.filter-document').val();
        // var document_status = $('.filter-document-status').val();
        var academic_year = $('.filter-academic-year').val();
        var class_year = $('.filter-class-year').val();
        var text = $('.filter-input').val();
        // var service = $('.program_category').val();
        // var completed = $('.completed_category').val();
        // var deficient = $('.deficient_category').val();
        var requirement_status = $('.filter-requirement-status').val();
        
        $.get("{{ route('html-functions', ['id' => 'get-filtered-student-management-list']) }}", {
            filter_program: program_id,
            filter_text: text,
            filter_service: service_id,
            filter_requirement_status: requirement_status,
            filter_academic_year: academic_year,
            filter_class_year: class_year,

        }, function(html) {
            $('#table_body').html(html);
        });
      }
    });

</script> 
@endsection


