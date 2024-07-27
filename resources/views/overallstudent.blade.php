@extends('layouts.user_type.auth')

@section('content')
<div class="row  mb-5">
  <div class="col-12 mb-md-0  d-flex align-items-center justify-content-center gap-2 pt-2">
      <a href="{{ route('f-all-students', ['program' => 'All', 'service'=> $_service] ) }}" class="btn btn-sm btn-outline-dark  {{ ($_program == 0 ? 'active' : '') }}">All</a>
      @if(isset($programs) && count($programs) > 0)
        @foreach($programs as $program)
            @if($program)
            <a href="{{ route('f-all-students', ['program' => $program->program_name, 'service'=> $_service ] ) }}" class="btn btn-sm btn-outline-danger  {{ ($_program == $program->id ? 'active' : '') }}">{{ ucfirst($program->program_name) }}</a>
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
          <table class="table table-sm table-bordered table-hover display nowrap"  style="width:100%">
          <th>No.</th>
            <th class="text-uppercase text-center text-secondary text-s font-weight-bolder opacity-10">
                Photo
            </th>
            <th class="text-uppercase text-center text-secondary text-s font-weight-bolder opacity-10">
              Students Number
            </th>
            <th class="text-uppercase text-center text-secondary text-s font-weight-bolder opacity-10" >
              Student Name                    
            </th>
            <th class="text-uppercase text-center text-secondary text-s font-weight-bolder opacity-10">
              Program
            </th>
            <th class="text-uppercase text-center text-secondary text-s font-weight-bolder opacity-10">
              Year Level
            </th>
            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-10">
              Academic Year
            </th>
            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-10">
              Remarks
            </th>
            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-10">
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

                        <td class="ps-4">{{$requirement->academic_year}}</td>
                        <td class="text-secondary text-s font-weight-bold">{{$requirement->status}}</td>
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

@endsection