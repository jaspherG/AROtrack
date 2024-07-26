@extends('layouts.user_type.auth')

@section('content')
<a class="nav-link {{ ($_page == 'completed' ? 'active' : '') }}" href="{{ url('completed') }}">
<div class="row  mb-5">
  <div class="col-12 mb-md-0  d-flex align-items-center justify-content-center gap-2 pt-2">
      <a href="{{ route('completed-filter', ['program' => 'All', 'service'=> $_service] ) }}" class="btn btn-sm btn-outline-dark  {{ ($_program == 0 ? 'active' : '') }}">All</a>
      @if(isset($programs) && count($programs) > 0)
        @foreach($programs as $program)
            @if($program)
            <a href="{{ route('completed-filter', ['program' => $program->program_name, 'service'=> $_service] ) }}" class="btn btn-sm btn-outline-danger  {{ ($_program == $program->id ? 'active' : '') }}">{{ ucfirst($program->program_name) }}</a>
            @endif
        @endforeach
      @endif
  </div>
</div>


<div class="card-body px-0 pt-0 pb-2">
  <div class="p-0">
    <table id="example" class="table align-items-center mb-0 table-hover table table-striped" style="width:100%">
      <thead>
          <tr>
          <table id="example" class="table table-striped" style="width:100%">
            <th>#</th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                Photo
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
              Students Number
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7" >
              Student Name                    
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
              Program
            </th>
            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
              Year Level
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
              Remarks
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
             School Year
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
              Status
            </th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(isset($serviceData->requirements) && count($serviceData->requirements) > 0)
           
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
                      <td class="">{{$requirement->status}}</td>
                      <td class="ps-4">{{$requirement->academic_year}}</td>
                      <td class="ps-4">{{ ($requirement->is_new_student == 0 ? ucfirst($requirement->service->service_name) : 'Regular') }}</td>
                      <td class="ps-4">{{ ucfirst($requirement->service->service_name)}}</td>

                    </tr>
            @endforeach
        @else
        <tr>
            <td colspan="8">No records found</td>
        </tr>
        @endif
                          </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

@endsection