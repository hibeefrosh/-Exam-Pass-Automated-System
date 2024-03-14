@extends('layout.admin')

@section('content')

<!-- Courses Page -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Courses</h4>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Add New Course Button -->
    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addCourseModal">
        Add New Course
    </button>

    <!-- Table for Courses -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="openDeleteConfirmation('{{ $course->id }}')">
                            Delete
                        </button>
                        <form id="deleteCourseForm{{ $course->id }}" method="post" style="display: none;">
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
    function openDeleteConfirmation(courseId) {
        if (confirm('Are you sure you want to delete this course?')) {
            var form = document.getElementById('deleteCourseForm' + courseId);
            form.action = '{{ route("courses.destroy", ["id" => ":courseId"]) }}'.replace(':courseId', courseId);
            form.submit();
        }
    }
</script>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields here for adding a new course -->
                <form action="{{ route('courses.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="courseNameAdd" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courseNameAdd" name="courseNameAdd" required>
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

@endsection