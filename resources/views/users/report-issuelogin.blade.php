@extends('layouts.fsdk-user.app')

@section('title', 'Report Issue')

@section('content')

<style>
    .report-issue-page {
        min-height: 100vh;
        padding-top: 120px;
        padding-bottom: 80px;
        background-color: #08005e;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .report-intro h2 {
        font-weight: 700;
        color: #ffffff;
    }

    .report-intro p {
        color: rgba(255, 255, 255, 0.8);
    }

    .report-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18);
    }

    .report-card-header {
        padding: 25px 30px;
        background: #ffffff;
        border-bottom: 1px solid #eeeeee;
    }

    .report-card-header h4 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .report-card-header p {
        color: #6c757d;
        margin-bottom: 0;
    }

    .report-card-body {
        padding: 30px;
        background: #ffffff;
    }

    .form-label {
        font-weight: 600;
        color: #343a40;
    }

    .form-control,
    .form-select {
        border-radius: 9px;
        padding: 11px 14px;
        border: 1px solid #dee2e6;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3351f8;
        box-shadow: 0 0 0 0.2rem rgba(51, 81, 248, 0.12);
    }

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }

    .upload-box {
        border: 2px dashed #d9dee7;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        background: #fafbfc;
        transition: 0.2s ease;
    }

    .upload-box:hover {
        border-color: #3351f8;
        background: #f8f9ff;
    }

    .upload-box i {
        font-size: 32px;
        color: #3351f8;
        margin-bottom: 8px;
    }

    .submit-area {
        border-top: 1px solid #eeeeee;
        margin-top: 25px;
        padding-top: 25px;
    }
</style>


<section class="report-issue-page">
    <div class="container">
        <!-- Introduction -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center report-intro" data-aos="fade-up">
                <h2>
                    Report an Issue
                </h2>
                <p>
                    Help us maintain a better and safer environment
                    by reporting facility or equipment problems.
                </p>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                <div class="card report-card">
                    <!-- Header -->
                    <div class="report-card-header">
                        <h4>
                            Complaint Information
                        </h4>
                        <p>
                            Please provide accurate information about the issue.
                        </p>
                    </div>

                    <!-- Body -->
                    <div class="report-card-body">
                        <form action="{{ route('user.report-issue.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Issue Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label">
                                    Issue Title
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Example: Air conditioner is not working" required>
                            </div>
                                       
                            <!-- Location & Category -->
                            <div class="row">
                                <!-- Location -->
                                <div class="col-md-6 mb-4">
                                    <label for="location_id" class="form-label">
                                        Location
                                    </label>

                                    <select class="form-select" id="location_id" name="location_id" required>
                                        <option value="">
                                            Select location
                                        </option>

                                        @foreach ($locations as $location)
                                            <option
                                                value="{{ $location->location_id }}"
                                                data-facilities="{{ $location->available_facility_types }}"
                                                {{ old('location_id') == $location->location_id ? 'selected' : '' }}
                                            >
                                                {{ $location->location_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('location_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-md-6 mb-4">
                                    <label for="facility_type_id" class="form-label">
                                        Category
                                    </label>

                                    <select class="form-select" id="facility_type_id"
                                        name="facility_type_id" required disabled>
                                        <option value="">
                                            Select location first
                                        </option>
                                    </select>

                                    @error('facility_type_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label">
                                    Description
                                </label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Describe the problem in detail..." required></textarea>
                            </div>

                            <!-- Evidence -->
                            <div class="mb-4">
                                <label for="evidence" class="form-label">
                                    Supporting Evidence
                                    <span class="text-muted fw-normal">
                                        (Optional)
                                    </span>
                                </label>
                                <div class="upload-box">
                                    <i class="bi bi-cloud-arrow-up d-block"></i>
                                    <p class="mb-2">
                                        Upload an image of the issue
                                    </p>
                                    <input type="file" class="form-control" id="evidence" name="evidence" accept="image/*">
                                    <small class="text-muted d-block mt-2">
                                        JPG, JPEG or PNG
                                    </small>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="submit-area">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-light">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-send me-1"></i>
                                        Submit Complaint
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const locationSelect = document.getElementById('location_id');
        const facilitySelect = document.getElementById('facility_type_id');

        const facilityTypes = @json($facilityTypes);

        locationSelect.addEventListener('change', function () {

            const selectedOption = this.options[this.selectedIndex];

            // Kosongkan category terlebih dahulu
            facilitySelect.innerHTML = '';

            // Jika belum memilih lokasi
            if (!this.value) {
                facilitySelect.innerHTML = `
                    <option value="">
                        Select location first
                    </option>
                `;

                facilitySelect.disabled = true;
                return;
            }

            // Ambil ID fasilitas dari lokasi
            const facilityIds = selectedOption.dataset.facilities
                ? JSON.parse(selectedOption.dataset.facilities)
                : [];

            // Tambahkan pilihan awal
            facilitySelect.innerHTML = `
                <option value="">
                    Select category
                </option>
            `;

            // Tampilkan fasilitas yang tersedia pada lokasi
            facilityTypes.forEach(function (facility) {

                if (facilityIds.includes(String(facility.facility_type_id)) ||
                    facilityIds.includes(Number(facility.facility_type_id))) {

                    const option = document.createElement('option');

                    option.value = facility.facility_type_id;
                    option.textContent = facility.facility_type_name;

                    facilitySelect.appendChild(option);
                }

            });

            // Aktifkan category
            if (facilityIds.length > 0) {
                facilitySelect.disabled = false;
            } else {
                facilitySelect.innerHTML = `
                    <option value="">
                        No facility available at this location
                    </option>
                `;

                facilitySelect.disabled = true;
            }

        });

    });
</script>
@endsection