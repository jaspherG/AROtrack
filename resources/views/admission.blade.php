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
                            @php
            // Check if formData exists and has an ID
            $isDisabled = isset($formData->id) && !empty($formData->id);
        @endphp

        <div class="card-body pt-4 p-3">
            @if($isDisabled)
                @method('PUT')
            @endif
            @csrf
            <input type="hidden" name="route_name" value="freshman">
            <input type="hidden" name="service_id" value="1">
            <input type="hidden" name="requirement_id" value="{{ $formData->id ?? '' }}">
            <input type="hidden" name="student_id" value="{{ $formData->student_id ?? '' }}">

            @if($errors->any())
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
            @endif
            @if(session('success'))
                <div class="mt-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
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
                        <label for="year_admitted" class="form-control-label">{{ __('Year Admitted') }} <b class="text-danger">*</b></label>
                        <input {{ $isDisabled ? 'disabled' : '' }} required class="form-control @error('year_admitted') border-danger @enderror" 
                            type="number" min="2020" max="2100" placeholder="Year Admitted" id="year_admitted" name="year_admitted" 
                            value="{{ old('year_admitted') ?? $formData->year_admitted }}" >
                        @error('year_admitted')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_number" class="form-control-label">{{ __('Student No.') }} <b class="text-danger">*</b></label>
                        <input {{ $isDisabled ? 'disabled' : '' }} required class="form-control @error('student_number') border-danger @enderror" type="text" placeholder="Student ID Number" id="student_number" name="student_number" value="{{ old('student_number') ?? $formData->user_student->student_number }}">
                        @error('student_number')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-control-label">{{ __('Full Name') }} <b class="text-danger">*</b></label>
                        <input {{ $isDisabled ? 'disabled' : '' }} required class="form-control @error('name') border-danger @enderror" type="text" placeholder="Name" id="name" name="name" value="{{ old('name') ?? $formData->user_student->name }}">
                        @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-control-label">{{ __('Email') }} <b class="text-danger">*</b></label>
                        <input {{ $isDisabled ? 'disabled' : '' }} required class="form-control @error('email') border-danger @enderror" id="email" type="email" placeholder="Email" name="email" value="{{ old('email') ?? $formData->user_student->email }}">
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
                        <select {{ $isDisabled ? 'disabled' : '' }} required class="form-control form-select @error('course') border-danger @enderror" id="course" name="course">
                            <option value="">-- select course --</option>
                            @if(isset($programs) && count($programs) > 0)
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ $c_year == $program->id ? 'selected' : '' }}>{{ $program->program_name }} {{ $program->description }}</option>
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
                        <select {{ $isDisabled ? 'disabled' : '' }} required class="pe-none form-control form-select @error('class_year') border-danger @enderror" id="class_year" name="class_year">
                            <!-- <option value="" disabled selected>-- select Year level --</option> -->
                            <option value="First Year" {{ $c_year == 'First Year' ? 'selected' : '' }}>First Year</option>
                            <option value="Second Year" {{ $c_year == 'Second Year' ? 'selected' : '' }}>Second Year</option>
                            <option value="Third Year" {{ $c_year == 'Third Year' ? 'selected' : '' }}>Third Year</option>
                            <option value="Fourth Year" {{ $c_year == 'Fourth Year' ? 'selected' : '' }}>Fourth Year</option>
                        </select>
                        @error('class_year')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        @if($isDisabled)
                            <input type="hidden" id="hidden_class_year" name="class_year" value="{{$c_year}}">
                        @endif
                    </div>
                </div>



        <div class="row mt-5" >
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                            <h6 class="font-weight-bolder alert alert-warning mx-10 role=alert text-white text-center text-primary">Student Requirements for Freshman</h6>
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
                                                    <h6 class="mb-0 text-sm">{{ $document->document_name }} <span class="text-secondary">{{ ($document->document_name == "Affidavit of Non-Enrollment" ? "(optional)" : "")}}</span></h6>
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
                                                        <input type="checkbox" class="document-checkbox {{ isset($r_document) && $r_document->status == 1 ? 'visually-hidden' : '' }}" name="documents[]" value="{{ $document->id }}" 
                                                            {{ isset($r_document) && $r_document->status == 1 ? 'checked' : '' }}
                                                            data-document-name="{{ $document->document_name }}">

                                                        <input type="checkbox" data-name="docu_id_{{ $document->id }}" class="document-checkbox {{ isset($r_document) && $r_document->status == 1 ? '' : 'visually-hidden' }}" value="{{ $document->id }}" 
                                                            {{ isset($r_document) && $r_document->status == 1 ? 'checked' : '' }}
                                                            data-document-name="{{ $document->document_name }}">

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-start gap-2">
                                                    <div class="inputlist {{ isset($r_document) && $r_document->status == 1 ? 'd-none' : '' }}">
                                                        @if(isset($r_document) && $r_document->status == 1)
                                                        <input type="text" class="form-control form-input file-input" name="file_id_{{ $document->id }}" value="{{ isset($r_document) && $r_document->status == 1 ? 'no_value' : '' }}">
                                                        @else 
                                                        <input type="file" class="form-control form-input file-input" name="file_id_{{ $document->id }}">
                                                        @endif
                                                    </div>
                                                    @if(isset($r_document) && !empty($r_document->image))
                                                    <div>
                                                        <a data-fslightbox="all-requirements" href="/images/freshman/{{$r_document->image}}">
                                                            <img src="/images/freshman/{{$r_document->image}}" class="avatar avatar-sm me-3 ">
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
    @if($formData->status != 'Completed')
    <button type="button" class="btn btn-danger float-end btn-md mt-4 mb-4" id="receivedButton" >
        Received By
    </button>
    @endif
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
                        <label for="" class="form-control-label">{{ __('School Year:') }} <b class="text-danger">*</b></label>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input required type="number" id="academic_year_1" class="form-control @error('academic_year_1') border-danger @enderror" placeholder="Input year" name="academic_year_1" min="2020" max="2100" value="{{ old('academic_year_1') ?? $formData->academic_year_1 }}">
                                @error('academic_year_1')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input required type="number" id="academic_year_2" class="form-control @error('academic_year_2') border-danger @enderror" placeholder="Input year" name="academic_year_2" min="2020" max="2100" value="{{ old('academic_year_2') ?? $formData->academic_year_2 }}">
                                @error('academic_year_2')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remarks-name" class="form-control-label">{{ __('Full Name') }} <b class="text-danger">*</b></label>
                                <input readonly required class="pe-none form-control @error('remarks_name') border-danger @enderror" value="{{ $user->name }}" type="text" placeholder="Name" id="remarks-name" name="remarks_name">
                                @error('remarks_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label for="remarks_email" class="form-control-label">{{ __('Email') }} <b class="text-danger">*</b></label>
                                <input class="form-control @error('remarks_email') border-danger @enderror" id="remarks_email" type="email" placeholder="Email" name="remarks_email" value="{{ old('remarks_email') }}">
                                @error('remarks_email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to check if all checkboxes are checked
        function updateButtonState() {
            const allCheckboxes = document.querySelectorAll('.document-checkbox');
            const button = document.getElementById('receivedButton');
            const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);

            button.disabled = allChecked;
        }

        // Attach event listeners to checkboxes
        document.querySelectorAll('.document-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonState);
        });

        // Initial call to set button state on page load
        updateButtonState();
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    let isEdit = @json($_title);

    // Disable all checkboxes within the same row
    // Find all checked checkboxes
    const $checkedCheckboxes = $('input[data-name^="docu_id_"]:checked');
    $checkedCheckboxes.prop('disabled', true);

    const $AffidavitChecked = $('input[data-name="docu_id_9"]');
    
    const $docuCheck = $('input[data-name="docu_id_7"]');
    const $docuRow = $docuCheck.closest('tr');
    if($($docuCheck).is(':checked') && isEdit == "Edit"){
        const $AffidavitCheck = $('input[data-name="docu_id_9"]'); 
        const $AffdocuRow = $AffidavitCheck.closest('tr');
        const $checkLists = $AffdocuRow.find('.checklist');
        const $inputlists = $AffdocuRow.find('.inputlist');
        $checkLists.addClass('pe-none')
        $AffidavitCheck.prop('disabled', true);
        $inputlists.addClass('d-none'); 
    }

    const $checkboxes = $('.document-checkbox');
    const $receivedButton = $('#receivedButton');
    const $affidavitCheckbox = $checkboxes.filter('[data-document-name="Affidavit of Non-Enrollment"]');
    const $form137Checkbox = $checkboxes.filter('[data-document-name="Form 137-A Copy for PUP Bansud"]');

    $form137Checkbox.on('change', function() {
        const $affidavitRow = $affidavitCheckbox.closest('tr');
        const $affidavitFileInput = $affidavitRow.find('input[type="file"]');
       
        if(isEdit != "Edit" || !$AffidavitChecked.is(':checked')) {
            if ($(this).is(':checked')) {
                $affidavitCheckbox.prop('checked', false).prop('disabled', true);
                $affidavitFileInput.prop('disabled', true); // Disable file input in the affidavit row
            } else {
                $affidavitCheckbox.prop('disabled', false);
                $affidavitFileInput.prop('disabled', false); // Enable file input in the affidavit row
            }
        }
    });

    $('input[type="file"]').on('change', function() {
        const $fileInput = $(this); // Reference to the file input
        const file = $fileInput[0].files[0]; // Get the selected file

        if (file) {
            // If a file is selected, remove the 'is-invalid' class
            $fileInput.removeClass('is-invalid');
        } 
    });

    $receivedButton.on('click', function() {
        let valid = true;
        let atleastOneChecked = false;

        $checkboxes.each(function() {
            if ($(this).is(':checked')) {
                atleastOneChecked = true;
                const $row = $(this).closest('tr');
                const $fileInput = $row.find('input[class="form-control form-input file-input"]');
                if (!$fileInput.val()) {
                    valid = false;
                    $fileInput.addClass('is-invalid');  // Add invalid class for highlighting
                } else {
                    $fileInput.removeClass('is-invalid');
                }
            }
        });

        if (!atleastOneChecked) {
            valid = false;
            alert('Please select at least one document.');
            return;
        }

        if (!valid) {
            alert('Please upload files for all selected documents.');
        } else {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            });
            myModal.show();
        }
    });

    // class year
    $('#year_admitted').on('blur', function(){
        var currentYear = new Date().getFullYear();
        var yearAdmitted = parseInt($(this).val());

        if(!isNaN(yearAdmitted) && yearAdmitted > 0){
            var yearDifference = currentYear - yearAdmitted;
            var classYear;

            switch(yearDifference){
                case 0:
                    classYear = 'First Year';
                    break;
                case 1:
                    classYear = 'Second Year';
                    break;
                case 2:
                    classYear = 'Third Year';
                    break;
                case 3:
                    classYear = 'Fourth Year';
                    break;
                default:
                    classYear = null;
            }

            if(classYear){
                $('#class_year').val(classYear);
            } else {
                alert('Invalid year admitted.');
            }
        } else {
            alert('Please enter a valid year.');
        }
    });

    $('#academic_year_1').on('blur', function() {
        var lastYear = @json($formData->academic_year_1);
        var newAcademicYear = parseInt($(this).val());
        var yearDifference = newAcademicYear - lastYear + 1;
        var classYear = null;

        // Check if the new academic year is valid
        if (newAcademicYear < lastYear) {
            alert('Invalid year admitted.');
            return;
        }

        // Determine the class year based on the difference
        switch(yearDifference) {
            case 0:
                classYear = 'First Year';
                break;
            case 1:
                classYear = 'Second Year';
                break;
            case 2:
                classYear = 'Third Year';
                break;
            case 3:
                classYear = 'Fourth Year';
                break;
            default:
                classYear = null;
        }

        // Update the class year if valid, otherwise show an alert
        if (classYear) {
            $('#class_year').val(classYear);
            $('#hidden_class_year').val(classYear);
        } else {
            alert('Invalid year difference. Only valid for a 4-year course.');
        }
    });

});

</script>

@endsection