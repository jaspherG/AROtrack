<div class="col-lg-12">
  <ul class="nav nav-tabs mb-3">
    <li class="nav-item">
      <a class="nav-link active" href="javascript:void(0)" id="all-requirements-tab" data-bs-toggle="pill" data-bs-target="#all-requirements" type="button" role="tab" aria-controls="all-requirements" aria-selected="true">All Requirements</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" id="all-documents-tab" data-bs-toggle="pill" data-bs-target="#all-documents" type="button" role="tab" aria-controls="all-documents" aria-selected="false">All Documents</a>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="all-requirements" role="tabpanel" aria-labelledby="all-requirements-tab">
      <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0">
            <table class="table align-items-center mb-0 table-hover ">
              <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Service                    
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Course
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Class Year
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Completion
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Academic Year
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody id="table_body_requirement">
                  @if(count($data->student_requirements) > 0)
                    @foreach($data->student_requirements as $requirement) 
                      <tr class="table-row">
                        <td class="ps-4">{{ucfirst($requirement->service->service_name)}}</td>
                        <td class="ps-4">{{$requirement->course}}</td>
                        <td class="ps-4">{{$requirement->class_year}}</td>
                        <td class="ps-4">
                          <div class="progress-wrapper w-75 ">
                            <div class="progress-warning  mb-1">
                              <div class="progress-percentage">
                                <span class="text-xs font-weight-bold">({{$requirement->completedDocumentsCount}} out of {{$requirement->totalDocumentsCount}})</span> | 
                                <span class="text-xs font-weight-bold">{{$requirement->completionPercentageFormatted}}%</span>
                              </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="{{ $requirement->completionPercentageFormatted }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </td>
                        <td class="ps-4">{{$requirement->academic_year}}</td>
                        <td class="text-center"> 
                          <a data-bs-toggle="collapse" href="#collapseExample{{$requirement->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" class="" data-bs-toggle="tooltip" data-bs-original-title="View Documents">
                              <i class="fas fa-file text-secondary"></i>
                          </a>
                        </td>
                      </tr>
                      <tr class="collapse" id="collapseExample{{$requirement->id}}">
                          <td colspan="6">
                              <div class="card card-body bg-secondary px-0 pt-0 pb-2 my-3">
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
                                                          <h6 class="mb-0 text-sm text-light">{{ ($document->status == 1 ? 'Completed' : 'Deficient') }}</h6>
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
    <!-- all documents -->
    <div class="tab-pane fade" id="all-documents" role="tabpanel" aria-labelledby="all-documents-tab">
      <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0">
            <table class="table align-items-center mb-0 table-hover ">
              <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Service                    
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Document
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Academic Year
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Image
                    </th>
                  </tr>
                </thead>
                <tbody id="table_body_requirement">
                  @if(count($data->requirement_documents) > 0)
                    @foreach($data->requirement_documents as $document) 
                      <tr class="table-row">
                        <td class="ps-4">{{ucfirst($document->service->service_name)}}</td>
                        <td class="ps-4">{{$document->document->document_name}}</td>
                        <td class="ps-4">{{$document->requirement->academic_year}}</td>
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

<script src="/assets/vendor/fslightbox-basic-3.4.1/fslightbox.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      function updateProgressBar(progressbar, percentage) {
          $(progressbar).animate({
              width: percentage + "%"
          }, 500); // Animation duration in milliseconds
      }

      $('#table_body_requirement .table-row').each(function() {
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