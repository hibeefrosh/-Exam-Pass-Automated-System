@extends('layout.app')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Student Area /</span>Documents status / {{ $user->program }}</h4>
    <!-- Document Status Table -->
    <div class="card">
        <h5 class="card-header">Document Status</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Status</th>
                        <th>Compliment</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($submittedDocuments as $document)
                    <tr>
                        <td>{{ $document->document_name }}</td>
                        <td>
                            @if($document->status == 'pending')
                            <span class="badge bg-label-primary">Pending</span>
                            @elseif($document->status == 'approved')
                            <span class="badge bg-label-success">Approved</span>
                            @elseif($document->status == 'rejected')
                            <span class="badge bg-label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            @if($document->status == 'pending')
                            Sorry,  Check back while we verify your submission.
                            @elseif($document->status == 'approved')
                            Good job! Your document has been successfully uploaded.
                            @elseif($document->status == 'rejected')
                            Please check your email or notifications for the reason why it was rejected.
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Document Status Table -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Document Upload Assistance Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Please check your mail for any updates or important messages regarding
                    your document status.</h5>
                
            </div>
        </div>
        <!--/ Document Upload Assistance Card -->


    </div>


</div>
<!-- / Content -->


@endsection