@extends('layouts.user_type.auth')

@section('content')
<form id="userForm" action="/user-profile" method="POST" role="form text-left" enctype="multipart/form-data">
    <div>
        <div class="row">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0 font-weight-bolder  alert alert-dark mx-10 role=alert text-white text-center text-primary">{{ __('Student Information') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @if(isset($formData->id))
                            @method('PUT')
                        @endif
                        @csrf
                        <input type="hidden" name="student_id" value="{{$formData->id ?? ''}}"> 
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

                        @elseif(session('failed'))
                          <div class="mt-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
                                <span class="alert-text text-white">
                                {{ session('failed') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Full Name') }} <b class="text-danger">*</b></label>
                                        <input required class="form-control @error('name') border-danger @enderror" type="text" placeholder="Name" id="user-name" name="name" value="{{ old('name') ?? $formData->name }}" >
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Email') }} <b class="text-danger">*</b></label>
                                        <input required class="form-control @error('email') border-danger @enderror" id="user-email" type="email" placeholder="Email"  name="email" value="{{ old('email') ?? $formData->email }}">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course" class="form-control-label">{{ __('Course') }} <b class="text-danger">*</b></label>
                                    <input required class="form-control @error('course') border-danger @enderror" type="text" placeholder="Course" id="course" name="course" value="{{ old('course') ?? $formData->course }}" >
                                    @error('course')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class_year" class="form-control-label">{{ __('Class Year') }} <b class="text-danger">*</b></label>
                                    @php
                                        $c_year = old('class_year') ?? $formData->class_year;
                                    @endphp
                                    <select required class="form-control form-select @error('class_year') border-danger @enderror" type="text" id="class_year" name="class_year">
                                        <option value="">-- select class year --</option>  
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_number" class="form-control-label">{{ __('Student Number') }} </label>
                                    <input  class="form-control @error('student_number') border-danger @enderror" type="text" placeholder="Student ID Number" id="student_number" name="student_number" value="{{ old('student_number') ?? $formData->student_number }}" >
                                    @error('student_number')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">{{ __('Profile Photo') }} </label>
                                    <input  class="form-control @error('image') border-danger @enderror" type="file" placeholder="Profile Photo" id="image" name="image" >
                                    @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger float-end btn-md mt-4 mb-4" >
                          {{ (isset($formData->id) ? 'Update' : 'Save' )}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 
@endsection