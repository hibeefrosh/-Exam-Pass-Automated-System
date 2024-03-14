<!-- courses.blade.php -->

@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Student Area /</span> My courses</h4>
    <h4 class="py-3 mb-4">My Courses</h4>

    <!-- Button to trigger the Add Course modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
        Add Course
    </button>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- courses.blade.php -->

    <!-- Button to trigger printing the course form -->
    <a href="{{ route('show.course.form') }}" class="btn btn-success">
        Print Exam Pass
    </a>


    <!-- JavaScript to handle printing -->
    <script>
        function printCourseForm() {
            // Implement your logic for printing here
            // You can use window.print() or open a new page with the course information
        }
    </script>


    <!-- Table for displaying enrolled courses -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>
                        <form action="{{ route('delete.enrolled.course', ['courseId' => $course->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">No courses enrolled yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <!-- Add Course Modal Content -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.courses.enroll') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="courseSelect" class="form-label">Select Course:</label>
                            <select class="form-select" id="courseSelect" name="course_id" required>
                                @foreach($availableCourses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enroll</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection