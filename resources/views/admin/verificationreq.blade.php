@extends('layout.admin')

@section('content')

<!-- Verification Requirements Page -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Verification Requirements</h4>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Add New Requirement Button -->
    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addRequirementModal">
        Add New Requirement
    </button>
    <!-- Create Document Button -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createDocumentModal">
        Create Document
    </button>

    <!-- Table for Verification Requirements -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Document Type</th>
                    <th>Required</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($verificationRequirements as $requirement)
                <tr>
                    <td>{{ $requirement->level }}</td>
                    <td>{{ $requirement->document_type }}</td>
                    <td>Yes</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="openDeleteConfirmation('{{ $requirement->id }}')">
                            Delete
                        </button>
                        <form id="deleteRequirementForm" method="post" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<script>
    function openDeleteConfirmation(requirementId) {
        if (confirm('Are you sure you want to delete this requirement?')) {
            var form = document.getElementById('deleteRequirementForm');
            form.action = '{{ route("delete.requirement", ["id" => ":requirementId"]) }}'.replace(':requirementId', requirementId);
            form.submit();
        }
    }
</script>

<!-- Add Requirement Modal -->
<div class="modal fade" id="addRequirementModal" tabindex="-1" role="dialog" aria-labelledby="addRequirementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRequirementModalLabel">Add New Requirement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields here for adding a new requirement -->
                <form action="{{ route('requirements.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="levelAdd" class="form-label">Level</label>
                        <select class="form-select @error('program') is-invalid @enderror" id="levelAdd" name="levelAdd">
                            <option value="ND 1 fulltime">ND 1 fulltime</option>
                            <option value="ND 1 partime">ND 1 partime</option>
                            <option value="ND 2 fulltime">ND 2 fulltime</option>
                            <option value="ND 2 partime">ND 2 partime</option>
                            <option value="HND 1 fulltime">HND 1 fulltime</option>
                            <option value="HND 1 partime">HND 1 partime</option>
                            <option value="HND 1 fulltime">HND 1 fulltime</option>
                            <option value="HND 1 partime">HND 1 partime</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="documentTypeAdd" class="form-label">Document Type</label>
                        <select class="form-select" id="documentTypeAdd" name="documentTypeAdd">
                            @foreach($docTypes as $docType)
                            <option value="{{ $docType->name }}">{{ $docType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Create and List Documents Modal -->
<div class="modal fade" id="createDocumentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Manage Documents</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add New Document Form -->
                <form action="{{ route('doc-types.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="documentName" class="form-label">Document Name</label>
                        <input type="text" class="form-control" id="documentName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Document</button>
                </form>

                <hr>

                <!-- List Existing Documents -->
                <h5 class="mt-4">Existing Documents</h5>
                <ul class="list-group">
                    <!-- Loop through doc_types and display each item -->
                    @foreach($docTypes as $docType)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $docType->name }}
                        <a href="{{ route('doc-types.destroy', $docType->id) }}" class="bx bx-trash btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('deleteDocTypeForm{{ $docType->id }}').submit();"></a>
                        <form id="deleteDocTypeForm{{ $docType->id }}" action="{{ route('doc-types.destroy', $docType->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




@endsection