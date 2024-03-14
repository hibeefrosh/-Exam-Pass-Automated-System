@extends('layout.app')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Student Area /</span>Profile</h4>

    <!-- Extended Profile Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="text-center">
                <img src="../assets/img/avatars/1.png" alt="Profile Picture" class="rounded-circle" width="150" height="150">
                <h5 class="mt-3">{{ $user->full_name }}</h5>
                <p class="text-muted">Student</p>
            </div>

            <!-- User Details -->
            <div class="mt-4">
                <h6>About Me</h6>
                <p>
                    As a dedicated and passionate student in the field of {{ $user->department }}, I am committed to excellence and continuous learning , and I strive to contribute positively to the academic community.
                </p>
            </div>


            <!-- Contact Information -->
            <div class="mt-4">
                <h6>Contact Information</h6>
                <ul class="list-unstyled">
                    <li>Email: {{ $user->email }}</li>
                    <li>Phone: {{ $user->phone_number ?? 'Not provided' }}</li>
                </ul>
            </div>

            <!-- Additional Details -->
            <div class="mt-4">
                <h6>Additional Details</h6>
                <ul class="list-unstyled">
                    <li>Department: {{ $user->department }}</li>
                    <li>Level: {{ $user->program }}</li>
                    <li>School: {{ $user->school ?? 'Not provided' }}</li>
                </ul>
            </div>

            <!-- Edit Profile Button -->
            <div class="text-center mt-4">
                <a href="{{ route('showeditprofile') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>
    <!--/ Extended Profile Card -->



</div>
<!-- / Content -->



@endsection