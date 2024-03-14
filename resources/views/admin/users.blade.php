@extends('layout.admin')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Users -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Students Management</h5>
            <div class="p-3 d-flex align-items-center">
                <i class="bx bx-search me-2"></i>
                <input type="text" class="form-control border-0 shadow-none ps-1 rounded-pill" placeholder="Search Users..." aria-label="Search Users..." />
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></button>
                                <button type="button" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></button>
                                <button type="button" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->

@endsection