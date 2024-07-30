@extends('layouts.user_type.auth')

@section('content')
<form id="userForm" action="/requirement" method="POST" role="form text-left" enctype="multipart/form-data">
    <div>
        <div class="row">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0 font-weight-bolder  alert alert-warning mx-10 role=alert text-white text-center text-primary">{{ __('Student Information') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @if(isset($formData->id))
                            @method('PUT')
                        @endif
                        @csrf
                        <input type="hidden" name="route_name" value="returnee">
                        <input type="hidden" name="service_id" value="2">
                        <input type="hidden" name="requirement_id" value="{{$formData->id ?? ''}}"> 
                        <input type="hidden" name="student_id" value="{{$formData->student_id ?? ''}}"> 
                        @if($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="mt-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                                <span class="alert-text text-white">
                                {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Year Admitted') }} <b class="text-danger">*</b></label>
                                <input required class="form-control @error('year_admitted') border-danger @enderror" type="date" id="year_admitted" name="year_admitted" value="{{ old('year_admitted') ?? $formData->year_admitted }}" >
                                @error('year_admitted')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_number" class="form-control-label">{{ __('Student No.') }} <b class="text-danger">*</b></label>
                                    <input  class="form-control @error('student_number') border-danger @enderror" type="text" placeholder="Student ID Number" id="student_number" name="student_number" value="{{ old('student_number') ?? $formData->user_student->student_number }}" >
                                    @error('student_number')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Full Name') }} <b class="text-danger">*</b></label>
                                        <input required class="form-control @error('name') border-danger @enderror" type="text" placeholder="Name" id="user-name" name="name" value="{{ old('name') ?? $formData->user_student->name }}" >
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Email') }} <b class="text-danger">*</b></label>
                                        <input required class="form-control @error('email') border-danger @enderror" id="user-email" type="email" placeholder="Email"  name="email" value="{{ old('email') ?? $formData->user_student->email }}">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course" class="form-control-label">{{ __('Program') }} <b class="text-danger">*</b></label>
                                    @php
                                        $c_year = old('course') ?? $formData->program_id;
                                    @endphp
                                    <select required class="form-control form-select @error('course') border-danger @enderror" type="text" id="course" name="course">
                                        <option value="">-- select course --</option>  
                                        @if(isset($programs) && count($programs) > 0)
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id}}" {{ $c_year == $program->id ? 'selected' : '' }}>{{$program->program_name}}</option>  
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('course')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class_year" class="form-control-label">{{ __('Year Level') }} <b class="text-danger">*</b></label>
                                    @php
                                        $c_year = old('class_year') ?? $formData->class_year;
                                    @endphp
                                    <select required class="form-control form-select @error('class_year') border-danger @enderror" type="text" id="class_year" name="class_year">
                                        <option value="">-- select Year Level --</option>  
                                        <option value="First Year" {{ $c_year == 'First Year' ? 'selected' : '' }}>First Year</option>  
                                        <option value="Second Year" {{ $c_year == 'Second Year' ? 'selected' : '' }}>Second Year</option>  
                                        <option value="Third Year" {{ $c_year == 'Third Year' ? 'selected' : '' }}>Third Year</option>  
                                        <option value="Fourth Year" {{ $c_year == 'Fourth Year' ? 'selected' : '' }}>Fourth Year</option>  
                                    </select>
                                    @error('class_year')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" >
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                            <h6 class="font-weight-bolder alert alert-warning mx-10 role=alert text-white text-center text-primary">Student Requirements for Re-Admission/Returnee</h6>
                    </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documents</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($documents) && count($documents)) 
                                            @foreach($documents as $key => $document)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <h6 class="mb-0 text-sm">{{ $document->document_name }}</h6>
                                                    </div>
                                                </td>
                                                
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        @if(count($formData->requirement_documents) > 0)
                                                            @php
                                                                $r_document = $formData->requirement_documents->first(function ($q) use ($document) {
                                                                    return $q->document_id == $document->id;
                                                                });
                                                            @endphp
                                                        @endif
                                                        <div class="checklist {{ isset($r_document) && $r_document->status == 1 ? 'pe-none' : '' }}">
                                                            <input type="hidden" name="r_document_id[]" value="{{ isset($r_document) ? $r_document->id : '' }}">
                                                            <input type="checkbox" class="document-checkbox" name="documents[]" value="{{ $document->id }}" {{ isset($r_document) && $r_document->status == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                                        <div class="checklist {{ isset($r_document) && $r_document->status == 1 ? 'd-none' : '' }}">
                                                            @if(isset($r_document) && $r_document->status == 1)
                                                            <input type="text" class="form-control form-input file-input" name="file_id_{{ $document->id }}" value="{{ isset($r_document) && $r_document->status == 1 ? 'no_value' : '' }}">
                                                            @else 
                                                            <input type="file" class="form-control form-input file-input" name="file_id_{{ $document->id }}">
                                                            @endif
                                                        </div>
                                                        @if(isset($r_document) && !empty($r_document->image))
                                                        <div>
                                                            <a data-fslightbox="all-requirements" href="/images/freshmen/{{$r_document->image}}">
                                                                <img src="/images/freshmen/{{$r_document->image}}" class="avatar avatar-sm me-3 ">
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
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-danger float-end btn-md mt-4 mb-4" id="receivedButton">
                Received By
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="" class="form-control-label">{{ __('Academic Year:') }} <b class="text-danger">*</b></label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required type="number" id="academic_year_1" class="form-control  @error('academic_year_1') border-danger @enderror" placeholder="Input year" name="academic_year_1" min="2023" max="2100" value="{{ old('academic_year_1') ?? $formData->academic_year_1 }}">
                                    @error('academic_year_1')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required type="number" id="academic_year_2" class="form-control  @error('academic_year_2') border-danger @enderror"  placeholder="Input year" name="academic_year_2" min="2023" max="2100" value="{{ old('academic_year_2') ?? $formData->academic_year_2 }}">
                                    @error('academic_year_2')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remarks-name" class="form-control-label">{{ __('Full Name') }} <b class="text-danger">*</b></label>
                                    <input required class="form-control @error('remarks_name') border-danger @enderror" value="{{ old('remarks_name') }}" type="text" placeholder="Name" id="remarks-name" name="remarks_name">
                                    @error('remarks_name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 d-none">
                                <div class="form-group">
                                    <label for="remarks_email" class="form-control-label">{{ __('Email') }} <b class="text-danger">*</b></label>
                                    <input class="form-control @error('remarks_email') border-danger @enderror" id="remarks_email" type="email" placeholder="Email"  name="remarks_email" value="{{ old('remarks_email') }}">
                                    @error('remarks_email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 

<script>
    document.getElementById('receivedButton').addEventListener('click', function(event) {
        const checkboxes = document.querySelectorAll('.document-checkbox');
        let valid = true;
        let atleastOneChecked = false;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                atleastOneChecked = true;
                const fileInput = document.querySelector(`input[name="file_id_${checkbox.value}"]`);
                if (!fileInput.value) {
                    valid = false;
                    fileInput.classList.add('is-invalid');  // Add invalid class for highlighting
                } else {
                    fileInput.classList.remove('is-invalid');
                }
            } 
        });

        if (!atleastOneChecked) {
            valid = false;
            alert('Please select at least one document.');
            return;
        }

        if (!valid) {
            if (!atleastOneChecked) {
                alert('Please select at least one document.');
            } else {
                alert('Please upload files for all selected documents.');
            }
        } else {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            });
            myModal.show();
        }

    });
</script>

@endsection