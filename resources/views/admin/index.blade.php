@extends('layout.admin')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Welcome back, Admin! 🎉</h5>
                            <p class="mb-4">
                                Thank you for your continued dedication to the admin tasks.
                                Stay organized and keep managing with excellence!
                            </p>


                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <h1><i class='bx bxs-user bx-4x'></i></h1>
                                </div>
                            </div>
                            <span class="fw-medium d-block mb-1">Total students</span>
                            <h3 class="card-title mb-2">{{ $totalStudents }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <h1><i class='bx bx-check-circle bx-4x'></i></h1>
                                </div>
                            </div>
                            <span>Approved students</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $approvedStudents }}</h3>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Statistics</h5>
                        <div class="card-body">
                            <canvas id="studentsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <h1><i class='bx bx-user-minus bx-4x'></i></h1>
                                </div>
                            </div>
                            <span class="d-block mb-1">Unapproved students</span>
                            <h3 class="card-title text-nowrap mb-2"> {{ $unapprovedStudents }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <h1> <i class='bx bx-calendar bx-4x'></i></h1>
                                </div>
                            </div>
                            <span class="fw-medium d-block mb-1">Session</span><br>
                            <h3 class="card-title mb-2"> {{ $session->name }}</h3>
                        </div>
                    </div>
                </div>

                <!-- </div>
    <div class="row"> -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Submission deadline</h5>
                                        <span class="badge bg-label-warning rounded-pill">{{ $session->name }}</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        @php
                                        $formattedDeadline = \Carbon\Carbon::parse($submission->deadline)->format('F j, Y');
                                        @endphp

                                        <h3 class="mb-0">{{ $formattedDeadline }}</h3>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('studentsChart').getContext('2d');
        var studentsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Approved Students', 'Unapproved Students'],
                datasets: [{
                    label: 'Number of Students',
                    data: [
                        {{ $approvedStudents }},
                        {{ $unapprovedStudents }}
                    ],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                },
                plugins: {
                    legend: {
                        display: false, // Hide the legend
                    },
                    title: {
                        display: true,
                        text: 'Student Approval Statistics',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });
    });
</script>

<!-- / Content -->

@endsection