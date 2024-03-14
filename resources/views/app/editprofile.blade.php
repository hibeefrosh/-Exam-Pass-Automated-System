@extends('layout.app')

@section('content')


<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account settings /</span>Account</h4>

    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('updateProfile') }}">
                @csrf
                @method('patch')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input class="form-control" type="text" id="fullname" name="full_name" value="{{ old('full_name', $user->full_name) }}" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select @error('department') is-invalid @enderror" id="department" name="department">
                            @php
                            $departments = [
                            'Accountancy',
                            'Agricultural Technology',
                            'Architectural Technology',
                            'Art and Design',
                            'Business Administration and Management',
                            'Chemical Engineering Technology',
                            'Computer Engineering',
                            'Computer Science',
                            'Electrical / Electronic Engineering',
                            'Estate Mangement And Valuation',
                            'Food Technology',
                            'Hospitality Management',
                            'Leisure And Tourism management',
                            'Mass Communication',
                            'Mechanical Engineering Technology',
                            'Nutrition and Dietetics',
                            'Office Technology And Management',
                            'Pharmaceutical Technology',
                            'Quantity Surveying',
                            'Science Laboratory Technology',
                            'Statistics',
                            'Surveying and Geo-Informatics',
                            'Urban and Regional Planning',
                            ];
                            @endphp

                            @foreach($departments as $department)
                            <option value="{{ $department }}" {{ old('department', $user->department) == $department ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                            @endforeach
                        </select>

                        @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="matricNumber" class="form-label">Matric Number</label>
                        <input class="form-control" type="text" id="matricNumber" name="matric_no" value="{{ old('matric_no', $user->matric_no) }}" />
                    </div>
                    @if($user->level == 'ND 2 fulltime' || $user->level == 'ND 2 partime')
                    <div class="mb-3 col-md-6">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select @error('program') is-invalid @enderror" id="program" name="program">
                            <option value="HND 1 fulltime">HND 1 fulltime</option>
                            <option value="HND 1 partime">HND 1 partime</option>
                        </select>
                    </div>
                    @endif
                    <!-- ... (existing form fields) ... -->
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                </div>
            </form>


        </div>
        <!-- /Account -->
    </div>



</div>
<!-- / Content -->


@endsection