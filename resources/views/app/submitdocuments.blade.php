@extends('layout.app')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Student Area /</span> Submit Documents / {{ $user->program }}</h4>
    <!-- Submit Documents Table -->
    <div class="card">
        <h5 class="card-header">Submit Documents</h5>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($requiredDocuments as $document)
                    <tr>
                        <td>
                            <i class="bx bx-file bx-sm text-danger me-3"></i>
                            <span class="fw-medium">{{ $document->document_type }}</span>
                        </td>
                        <td>{{ $document->document_type }} Description</td>
                        <td>
                            @if($user->documents()->where('document_name', $document->document_type)->exists())
                            <span class="badge bg-label-success me-1">Completed</span>
                            @else
                            <span class="badge bg-label-secondary me-1">Not Uploaded Yet</span>
                            @endif
                        </td>
                        <td>
                            @if($user->documents()->where('document_name', $document->document_type)->exists())
                            {{-- Document exists, hide upload button --}}
                            <button class="btn btn-success btn-sm" disabled>
                                <i class="bx bx-cloud-upload"></i> Upload
                            </button>
                            @elseif(strtotime(now()) > strtotime($submissionDeadline))
                            {{-- Submission deadline has passed, hide upload button --}}
                            <span class="badge bg-label-danger me-1">Deadline Passed</span>
                            @else
                            {{-- Document does not exist, show upload button --}}
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal{{ $document->id }}" data-document-name="{{ $document->document_type }}">
                                <i class="bx bx-cloud-upload"></i> Upload
                            </button>
                            @endif
                        </td>
                        <!-- Modal for document upload -->
                        <!-- Modal for document upload -->
                        <div class="modal fade" id="uploadDocumentModal{{ $document->id }}" tabindex="-1" aria-labelledby="uploadDocumentModalLabel{{ $document->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadDocumentModalLabel{{ $document->id }}">Upload Document</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('document.upload', ['document_type' => $document->document_type]) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="document_file" class="form-label">Select File:</label>
                                                <input type="file" class="form-control" id="document_file" name="document_file" accept=".pdf, .jpg, .jpeg, .png" required>
                                                @error('document_file')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <script>
                            // JavaScript to update the hidden input value when the modal is shown
                            $('.upload-btn').on('click', function() {
                                var documentName = $(this).data('document-name');
                                $('#document_name').val(documentName);
                            });
                        </script>


                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <!--/ Submit Documents Table -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Document Upload Assistance Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Having Trouble Uploading Your Documents?</h5>
                <p class="card-text">
                    If you're experiencing difficulties with the document upload process or have any questions,
                    we're here to help!
                </p>
                <p class="card-text">
                    Our Frequently Asked Questions (FAQs) may provide answers to common issues. If you need
                    further assistance, feel free to reach out to our support team.
                </p>
                <div>
                    <a href="{{ route('faqs') }}" class="btn btn-primary me-2">Visit FAQs</a>
                    <a href="#contactUsSection" class="btn btn-secondary">Contact Us</a>
                </div>
            </div>
        </div>
        <!--/ Document Upload Assistance Card -->

    </div>


</div>
<!-- / Content -->


@endsection