@extends('layout.admin')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Documents review /</span>{{ $user->department }}</h4>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Review Details Page -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Document Review - {{ $user->full_name }}</h5>
            <div class="table-responsive text-nowrap">
                <!-- Table for Review Details -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Document Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- Check if the user has documents -->
                        @forelse($user->documents as $document)
                        <tr>
                            <td>{{ $document->document_name }}</td>
                            <td>
                                @if($document->status == 'approved')
                                <span class="badge bg-label-success">Approved</span>
                                @else
                                <span class="badge bg-label-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('document.view', ['document_id' => $document->id]) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class='bx bx-show'></i> View
                                </a>

                                @if($document->status != 'approved')
                                <form action="{{ route('document.approve', ['document_id' => $document->id]) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class='bx bx-check'></i> Approve
                                    </button>
                                </form>

                                <!-- Button to open the modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $document->id }}">
                                    <i class='bx bx-x'></i> Reject
                                </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal{{ $document->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $document->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel{{ $document->id }}">Reject Document</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for providing reasons for rejection -->
                                        <form action="{{ route('document.reject', ['document_id' => $document->id]) }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="rejectionReason{{ $document->id }}" class="form-label">Reason for Rejection:</label>
                                                <textarea class="form-control" id="rejectionReason{{ $document->id }}" name="rejection_reason" rows="4" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class='bx bx-x'></i> Reject
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class='bx bx-arrow-back'></i> Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <!-- Display a message when there are no documents -->
                        <tr>
                            <td colspan="3">No documents available for review.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</div>
<!-- / Content -->

@endsection