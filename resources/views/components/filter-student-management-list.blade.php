
@if(count($requirements) > 0)
  @foreach($requirements as $key => $requirement) 
    <tr class="table-row">
      <td>{{ $key += 1}}</td>
      <td>
          <div>
              <a data-fslightbox="student-list" href="{{(!empty($requirement->user_student->image) ? '/images/avatars/'.$requirement->user_student->image : '/images/user.jpg' )}}">
                  <img src="{{(!empty($requirement->user_student->image) ? '/images/avatars/'.$requirement->user_student->image : '/images/user.jpg' )}}" class="avatar avatar-sm me-3">
              </a>
          </div>
      </td>
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
              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $requirement->completionPercentageFormatted }}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </td>
      <td class="ps-4">{{$requirement->academic_year}}</td>
      <td class="ps-4">{{ ($requirement->is_new_student == 0 ? ucfirst($requirement->service->service_name) : 'Old Student') }}</td>
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
                                    <h6 class="mb-0 text-sm text-light">{{ ($document->status == 1 ? 'Submitted' : 'Not Submitted') }}</h6>
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
     
    });
</script>