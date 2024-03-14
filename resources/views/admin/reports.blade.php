@extends('layout.admin')

@section('content')

<!-- Reports Page -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Reports</h4>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Total Students Card -->
        <div class="col">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">Total Students</h5>
                    <p class="card-text display-4 text-white">  {{ $totalStudentsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Approved Students Card -->
        <div class="col">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">Approved Students</h5>
                    <p class="card-text display-4 text-white"> {{ $approvedStudentsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Unapproved Students Card -->
        <div class="col">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">Unapproved Students</h5>
                    <p class="card-text display-4 text-white"> {{ $unapprovedStudentsCount }}</p>
                </div>
            </div>
        </div>


        @php
        $departmentColors = [
        'Accountancy' => 'bg-success',
        'Agricultural Technology' => 'bg-info',
        'Architectural Technology' => 'bg-warning',
        'Art and Design' => 'bg-primary',
        'Business Administration and Management' => 'bg-danger',
        'Chemical Engineering Technology' => 'bg-secondary',
        'Computer Engineering' => 'bg-dark',
        'Computer Science' => 'bg-success',
        'Electrical / Electronic Engineering' => 'bg-info',
        'Estate Mangement And Valuation' => 'bg-warning',
        'Food Technology' => 'bg-primary',
        'Hospitality Management' => 'bg-danger',
        'Leisure And Tourism management' => 'bg-secondary',
        'Mass Communication' => 'bg-dark',
        'Mechanical Engineering Technology' => 'bg-success',
        'Nutrition and Dietetics' => 'bg-info',
        'Office Technology And Management' => 'bg-warning',
        'Pharmaceutical Technology' => 'bg-primary',
        'Quantity Surveying' => 'bg-danger',
        'Science Laboratory Technology' => 'bg-secondary',
        'Statistics' => 'bg-dark',
        'Surveying and Geo-Informatics' => 'bg-success',
        'Urban and Regional Planning' => 'bg-info',
        ];
        @endphp

        @foreach ($departmentApprovals as $department => $approval)
        <div class="col">
            <div class="card {{ $departmentColors[$department] }} text-white">
                <div class="card-body">
                    <h5 class="card-title text-white">{{ $department }}</h5>
                    <p class="card-text display-4">Approved: {{ $approval['approvalPercentage'] }}%</p>
                </div>
            </div>
        </div>
        @endforeach



        <!-- Add more cards as needed -->
    </div>
</div>

@endsection