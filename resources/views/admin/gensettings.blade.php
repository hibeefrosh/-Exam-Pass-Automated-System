@extends('layout.admin')

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Session Management</span></h4>


    <!-- Session Management Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Session Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($session)
            <tr>
                <td contenteditable="true">{{ $session->name }}</td>
                <td>{{ $session->start_date }}</td>
                <td>{{ $session->end_date }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal">
                        Update
                    </button>
                </td>
            </tr>
            @else
            <tr>
                <td colspan="4">No session data available.</td>
            </tr>
            @endif
        </tbody>
    </table>


    <!-- Submission Deadline and Level Upgrade Management -->
    <div class="my-4">
        <!-- Submission Deadline Management -->
        <div>
            <h5 class="fw-bold">Submission Deadline Management</h5>
            <div class="mb-3">
                <h3>Submission Deadline : {{ $submission->deadline }}</h3>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateSubmissionModal">
                Update Deadline
            </button>
        </div>

    </div>
    <!-- Level Upgrade Management -->
    <!-- <div class="mt-3">
        <h5 class="fw-bold">Level Upgrade Management</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upgradeLevelModal">
            Upgrade Student Levels
        </button>
    </div> -->
    <!-- Update Submission Deadline Modal -->
    <div class="modal fade" id="updateSubmissionModal" tabindex="-1" role="dialog" aria-labelledby="updateSubmissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubmissionModalLabel">Update Submission Deadline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update.submission-deadline') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="submissionDeadline" class="form-label">Submission Deadline</label>
                            <input type="date" class="form-control" id="submissionDeadline" name="submissionDeadline" value="{{ $submission->deadline }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Session Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update.session', ['id' => $session->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="sessionName" class="form-label">Session Name</label>
                            <input type="text" class="form-control" id="sessionName" name="sessionName" value="{{ $session->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" value="{{ $session->start_date }}">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" value="{{ $session->end_date }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Update Modal -->

    <!-- Submission Deadline Modal -->
    <div class="modal fade" id="submissionDeadlineModal" tabindex="-1" role="dialog" aria-labelledby="submissionDeadlineModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionDeadlineModalLabel">Submission Deadline Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change the submission deadline?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Submission Deadline Modal -->

</div>
<!-- / Content -->

@endsection