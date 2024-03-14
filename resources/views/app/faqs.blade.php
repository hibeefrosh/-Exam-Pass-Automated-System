@extends('layout.app')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Student Area /</span>FAQs</h4>
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
<!-- / Content -->


@endsection