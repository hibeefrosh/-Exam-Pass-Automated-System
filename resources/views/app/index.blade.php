@extends('layout.app')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container mt-4">

        <!-- Welcome Message with Image Background -->
        <div class="col-md-12 mb-4 welcome-section">
            <div class="card welcome-card">
                <div class="d-flex align-items-end row">
                    <div class="col-md-9">
                        <div class="card-body text-center">
                            <!-- Welcome Message -->
                            <h2 class="mb-3">
                                <span class="sideways-text" id="greeting-message"></span>
                            </h2>

                            <!-- Small Contextual Description -->
                            <p class="mb-4 h5">
                                Welcome to the Exam pass generating System. Start submitting your credentials now to streamline the verification process and access exam pass printing.
                            </p>

                            <!-- Start Submitting Button -->
                            <a href="{{ route('submitdocuments') }}" class="btn btn-primary btn-lg">Start Submitting</a>
                        </div>
                    </div>

                    <div class="col-md-3 text-center text-md-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <!-- Image Section -->
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="200" alt="Student Submission" />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <!-- User Details Card -->
            <div class="col-md-6 mb-4">
                <div class="card user-details-card">
                    <div class="card-body text-center">

                        @isset($user)
                        <h4 class="card-title">
                            <i class="bx bx-user"></i> {{ $user->full_name }} <span>{{ $user->matric_no }}</span>
                        </h4>
                        <p class="card-text">
                            <i class="bx bx-book-alt"></i> Department: {{ $user->department }}
                        </p>
                        <p class="card-text">
                            <i class="bx bx-layer"></i> Level: {{ $user->program }}
                        </p>
                        @else
                        <p>No user data available.</p>
                        @endisset

                    </div>
                </div>
            </div>


            <!-- Submission Deadline Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Submission Deadline</h5>
                        @php
                        $formattedDeadline = \Carbon\Carbon::parse($submission->deadline)->format('F j, Y');
                        @endphp
                        <p class="card-text">Deadline: {{ $formattedDeadline }}</p>

                        <!-- Countdown Timer Template -->
                        <div id="countdown" class="text-center countdown-timer"></div>

                        <!-- Inline JavaScript for Countdown Timer -->
                        <script>
                            // Countdown Timer Script (Adjust date and time accordingly)
                            var countdownDate = new Date("{{ $submission->deadline }}").getTime();

                            var x = setInterval(function() {
                                var now = new Date().getTime();
                                var distance = countdownDate - now;

                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                document.getElementById("countdown").innerHTML =
                                    "<span class='countdown-days'>" +
                                    days +
                                    "days </span>" +
                                    "<span class='countdown-hours'>" +
                                    hours +
                                    "hrs </span>" +
                                    "<span class='countdown-minutes'>" +
                                    minutes +
                                    "min </span>" +
                                    "<span class='countdown-seconds'>" +
                                    seconds +
                                    "sec </span>";

                                if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById("countdown").innerHTML = "EXPIRED";
                                }
                            }, 1000);
                        </script>
                    </div>
                </div>
            </div>



        </div>

        <div class="row">
            <!-- Submission Statistics Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class='bx bx-bar-chart bx-lg mr-2 text-primary'></i> Submission Statistics
                        </h5>
                        <p class="card-text"><i class='bx bxs-check-circle bx-lg mr-2 text-info'></i>Completed Submissions: {{ $completedSubmissionsCount }}</p>
                        <p class="card-text"><i class='bx bxs-time bx-lg mr-2 text-warning'></i>Pending Submissions: {{ $pendingSubmissionsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Document Status Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class='bx bx-file bx-lg mr-2 text-primary'></i> Document Status
                        </h5>
                        <p class="card-text"><i class='bx bx-list-ul bx-lg mr-2 text-success'></i> Required Documents: {{ $requiredDocumentsCount }}</p>
                        <p class="card-text"><i class='bx bx-check bx-lg mr-2 text-info'></i> Documents Submitted: {{ $submittedDocumentsCount }}</p>
                    </div>
                </div>
            </div>


        </div>

        <!-- FAQ Section -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Frequently Asked Questions (FAQs)</h5>

                        <!-- Accordion -->
                        <div class="accordion" id="accordionExample">
                            <!-- FAQ Item 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        What are the things I need to take note of before uploading my documents?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>The management reserves the right to remove an uploaded document if the quality of the document is unacceptable, if a virus is detected, or if it does not match the admission requirement. This will result in delays in reviewing your application and making a decision, so please follow the instructions below.</strong>
                                        <ul>
                                            <li>Your full name must appear on all uploaded documents.</li>
                                            <li>Ensure that all information on the document is readable.</li>
                                            <li>Scan your document in black and white.</li>
                                            <li>Scanning at a resolution of 300 DPI is recommended.</li>
                                            <li>Ensure that the scanned document orientation matches the original. For example, transcripts that are printed vertically (portrait) should be scanned so that they appear in portrait format. Transcripts printed horizontally (landscape) should appear in landscape format.</li>
                                            <li>Do not upload all your supporting documents as one file. Create one PDF for each type of document you are required to upload.</li>
                                            <li>Multipage documents should be saved as a single PDF document. Please ensure that all pages of the document are in the correct order.</li>
                                            <li>All documents must be saved in an unsecured PDF format before they can be uploaded. Your PDF document must not be password protected.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How do I convert my documents to PDF?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Documents should be saved and uploaded as PDF. Follow the instructions below to convert your documents to PDF format:</strong>
                                        <p>To convert a DOC file to PDF:</p>
                                        <!-- Add the rest of the content for FAQ Item 2 here -->
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How do I reduce the size of my documents?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Your saved PDF must be less than 3 MB in size. To reduce the size of the file:</strong>
                                        <ul>
                                            <!-- Add the content for FAQ Item 3 here -->
                                        </ul>
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
<!-- / Content -->



@endsection