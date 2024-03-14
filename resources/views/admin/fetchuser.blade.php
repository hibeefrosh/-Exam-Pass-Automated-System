@extends('layout.admin')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Verification Requirements</h4>

    <form action="{{ route('fetchUsers') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-select @error('department') is-invalid @enderror" id="department" name="department">
                <option value="Accountancy">Accountancy</option>
                <option value="Agricultural Technology">Agricultural Technology</option>
                <option value="Architectural Technology">Architectural Technology</option>
                <option value="Art and Design">Art and Design</option>
                <option value="Business Administration and Management">Business Administration and Management</option>
                <option value="Chemical Engineering Technology">Chemical Engineering Technology</option>
                <option value="Computer Engineering">Computer Engineering</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Electrical / Electronic Engineering">Electrical / Electronic Engineering</option>
                <option value="Estate Mangement And Valuation">Estate Mangement And Valuation</option>
                <option value="Food Technology">Food Technology</option>
                <option value="Hospitality Management">Hospitality Management</option>
                <option value="Leisure And Tourism management">Leisure And Tourism management</option>
                <option value="Mass Communication">Mass Communication</option>
                <option value="Mechanical Engineering Technology">Mechanical Engineering Technology</option>
                <option value="Nutrition and Dietetics">Nutrition and Dietetics</option>
                <option value="Office Technology And Management">Office Technology And Management</option>
                <option value="Pharmaceutical Technology">Pharmaceutical Technology</option>
                <option value="Quantity Surveying">Quantity Surveying</option>
                <option value="Science Laboratory Technology">Science Laboratory Technology</option>
                <option value="Statistics">Statistics</option>
                <option value="Surveying and Geo-Informatics">Surveying and Geo-Informatics</option>
                <option value="Urban and Regional Planning">Urban and Regional Planning</option>
            </select>
            @error('department')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Fetch Students</button>
    </form>

</div>

@endsection