@extends('layouts.user_type.registrar')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
        {{$programData->description}} ({{$programData->program_name}})

        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{$programData->program_name}} Students</h5>
                        </div>
                        <div class=" d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control filter-input" placeholder="Type here...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Student No.
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        LRN
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Class Year
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone #
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Address
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="table_body_programs">
                                @if(isset($programData->students) && count($programData->students) > 0)
                                    @foreach($programData->students as $key => $student)
                                    <tr>
                                    <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$key+1}}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <a data-fslightbox="student-list" href="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}">
                                                    <img src="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}" class="avatar avatar-sm me-3">
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->student_number}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->lrn_number}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->class_year}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$student->email}}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$student->phone_number}}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$student->address}}</span>
                                        </td>
                                       
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="mx-3 view-requirement" data-id="{{$student}}" data-bs-toggle="tooltip" data-bs-original-title="View Requirements">
                                                <i class="fas fa-receipt text-secondary"></i>
                                            </a>
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

    <!-- Modal -->
    <button type="button" id="openRequirement" class="btn btn-primary float-end btn-md mt-4 mb-4 visually-hidden" data-bs-toggle="modal" data-bs-target="#viewRequirement">
        open viewRequirement
    </button>
    <div class="modal fade" id="viewRequirement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Requirements</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
              
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.view-requirement', function(){ 
            var data = $(this).data('id'); 
            var id = data.id; 
            var name = data.name;
            $('#viewRequirement').find('.modal-title').text(name); // Show the modal
            $.get("{{ route('html-functions', ['id' => 'get-student-requirements-data']) }}", {
                student_id: id
            }, function(html) {
                $('#viewRequirement').find('.modal-body').html(html);
                $('#openRequirement').trigger('click'); // Show the modal
            });
        });

        // PHP code in Blade template:
        @php
            $program_id = $programData->id;
        @endphp

        $(document).on('input', '.filter-input', function(){
            var text = $(this).val();
            $.get("{{ route('html-functions', ['id' => 'get-filtered-program-student-list']) }}", {
                filter_text: text,
                filter_program: @json($program_id)
            }, function(html) {
                $('#table_body_programs').html(html);
            });
        });

    });
 

</script>
 
@endsection