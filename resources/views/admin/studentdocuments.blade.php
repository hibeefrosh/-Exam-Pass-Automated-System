@extends('layout.admin')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Students List Page -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Documents Review - {{ $department }}</h5>
            <div class="table-responsive text-nowrap">
                <!-- Check if there are users to display -->
                @if(count($users) > 0)
                <!-- Table for All Students -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- Iterate over users and display each row -->
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->program }}</td>
                            <td>
                             <a href="{{ route('review.details', ['id' => encrypt($user->id)]) }}" class="btn btn-primary btn-sm">Review</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <!-- Display a message if there are no users -->
                <p class="text-center mt-4">No students found for the selected department.</p>
                @endif
            </div>
        </div>
    </div>




</div>
<!-- / Content -->

@endsection