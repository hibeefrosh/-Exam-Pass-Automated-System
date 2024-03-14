@extends('layout.guest')

@section('content')

<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">Empower Your Education Journey 🎓</h4>
                    <p class="mb-4">Simplify student credentials submission for a seamless academic experience!</p>


                    <form id="formAuthentication" class="mb-3" action="{{ route('signup') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Fullname</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" placeholder="Enter your Fullname" autofocus />
                            @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="program" class="form-label">Programme</label>
                            <select class="form-select @error('program') is-invalid @enderror" id="program" name="program">
                                <option value="ND 1 fulltime">ND 1 fulltime</option>
                                <option value="ND 1 partime">ND 1 partime</option>
                                <option value="ND 2 fulltime">ND 2 fulltime</option>
                                <option value="ND 2 partime">ND 2 partime</option>
                                <option value="HND 1 fulltime">HND 1 fulltime</option>
                                <option value="HND 1 partime">HND 1 partime</option>
                                <option value="HND 1 fulltime">HND 1 fulltime</option>
                                <option value="HND 1 partime">HND 1 partime</option>
                            </select>
                            @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select @error('department') is-invalid @enderror" id="department" name="department">
                                <option value="Accountancy">Accountancy</option>
                                <option value="Agricultural Technology">Agricultural Technology</option>
                                <option value="Architectural Technology">Architectural Technology</option>
                                <option value="Art and Design">Art and Design</option>
                                <option value="Business Administration and Management">Business Administration and Management</option>
                                <option value="Chemical Engineering Technology">Chemical Engineering Technology</option>
                                <option value="Computer Engineering">Computer Engineering</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Electrical / Electronic Engineering">Electrical / Electronic Engineering</option>
                                <option value="Estate Mangement And Valuation">Estate Mangement And Valuation</option>
                                <option value="Food Technology">Food Technology</option>
                                <option value="Hospitality Management">Hospitality Management</option>
                                <option value="Leisure And Tourism management">Leisure And Tourism management</option>
                                <option value="Mechanical Engineering Technology">Mass Communication</option>
                                <option value="Mechanical Engineering Technology">Mechanical Engineering Technology</option>
                                <option value="Nutrition and Dietetics">Nutrition and Dietetics</option>
                                <option value="Office Technology And Management">Office Technology And Management</option>
                                <option value="Pharmaceutical Technology">Pharmaceutical Technology</option>
                                <option value="Quantity Surveying">Quantity Surveying</option>
                                <option value="Science Laboratory Technology">Science Laboratory Technology</option>
                                <option value="Statistics">Statistics</option>
                                <option value="Surveying and Geo-Informatics">Surveying and Geo-Informatics</option>
                                <option value="Urban and Regional Planning">Urban and Regional Planning</option>
                            </select>
                            @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="matric_no" class="form-label">Matric Number</label>
                            <input type="text" class="form-control @error('matric_no') is-invalid @enderror" id="matric_no" name="matric_no" placeholder="Enter your Matric Number" value="{{ old('matric_no') }}" />
                            @error('matric_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>


                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('viewlogin') }}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>

<!-- / Content -->

@endsection